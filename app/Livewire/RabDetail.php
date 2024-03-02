<?php

namespace App\Livewire;
use App\Models\Rab_item;
use App\Models\Item;
use App\Models\Rab;
use App\Models\Project;

use Livewire\Component;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RabDetail extends Component
{
    public $rab_id;
    public $rab_discount;
    public $categoryList = ['Tanaman', 'Material', 'Operasional'];
    public $selectedCategory;
    public $availableItems;
    public $selectedItem;
    public $itemQuantity = 0;
    public $discountPercentage = 0;

    protected $listeners = ['refreshComponent' => '$refresh', 'updateCategory' => 'updatedSelectedCategory',];

    public function rules() {
        return [
            'selectedItem' => ['required'],
            'itemQuantity' => ['required', 'gt:0'],
            'discountPercentage' => ['required'],
        ];
    }

    public function mount($rab_id)
    {
        $openedRab = Rab::where('rab_id',$rab_id)->first();
        $project = Project::where('project_id', $openedRab->project_id)->first();
        if ($project->user_id != Auth::user()->user_id) {
            abort(403, 'Forbidden access');
        }
        $this->rab_id = $rab_id;
        $this->loadRab();
        $this->loadAvailableItems();
    }

    public function loadRab()
    {
        $rab = Rab::find($this->rab_id);
        $this->rab_discount = $rab?->rab_discount ?? 0;
    }

    public function loadAvailableItems()
    {
        $this->availableItems = Item::all();
    }

    public function addItem()
    {
        $this->validate();
        // Check if item has been added before
        $checkItem = Rab_item::where('rab_id', $this->rab_id)->where('item_id', $this->selectedItem)->first();
        if ($checkItem === null) {
            $rab_item = new Rab_item();
            $rab_item->rab_id = $this->rab_id;
            $rab_item->item_id = $this->selectedItem;
            $rab_item->item_discount = $this->discountPercentage;
            $rab_item->item_count = $this->itemQuantity;
            $rab_item->save();
        } else {
            $this->updateItemVolume($this->selectedItem, $this->itemQuantity + $checkItem->item_count);
            $this->updateItemDiscount($this->selectedItem, $this->discountPercentage + $checkItem->item_discount);
        }
        
        $this->reset(['rab_id', 'selectedItem', 'discountPercentage', 'itemQuantity']);
        return redirect(request()->header('Referer'));
    }

    public function deleteRabItem($item_id)
    {
        // Retrieve the specific Rab_item entry
        Rab_item::where('rab_id', $this->rab_id)->where('item_id', $item_id)->delete();
    }

    public function updateItemVolume(int $item_id, int $newVol)
    {
        if($newVol === 0) {
            Rab_item::where('rab_id', $this->rab_id)->where('item_id', $item_id)->delete();
            return;
        }

        $rabItem = Rab_item::where('rab_id', $this->rab_id)->where('item_id', $item_id)->first();

        $data = [
            'rab_id' => $rabItem->rab_id,
            'item_id'=> $rabItem->item_id,
            'item_discount' => $rabItem->item_discount,
            'item_count' => $newVol,
        ];
        Rab_item::where('rab_id', $this->rab_id)->where('item_id', $item_id)->update($data);
    }

    public function updateItemDiscount(int $item_id, int $newDisc)
    {
        $rabItem = Rab_item::where('rab_id', $this->rab_id)->where('item_id', $item_id)->first();

        $data = [
            'rab_id' => $rabItem->rab_id,
            'item_id'=> $rabItem->item_id,
            'item_discount' => $newDisc,
            'item_count' => $rabItem->item_count,
        ];
        Rab_item::where('rab_id', $this->rab_id)->where('item_id', $item_id)->update($data);
    }

    public function updatedSelectedCategory($value)
    {
        if (!empty($value)) {
            // Filter `availableItems` berdasarkan kategori yang dipilih
            $this->availableItems = Item::where('category', $value)->get();
        } else {
            // Reset atau ambil semua item jika tidak ada kategori yang dipilih
            $this->availableItems = Item::all();
        }
    }

    public function updatedRabDiscount($value)
    {
        Rab::where('rab_id', $this->rab_id)->update(['rab_discount' => $value]);
    }

    public function calculateTotal($item_id)
    {
        $rab_item = Rab_item::where('rab_id', $this->rab_id)->where('item_id', $item_id)->first();
        if (!$rab_item) {
            return 0; // Or handle the case where the rab_item is not found
        }

        $item = Item::find($item_id);
        if (!$item) {
            return 0; // Or handle the case where the item is not found
        }

        // Calculate total using the formula: harga jual * volume * (100 - diskon) / 100
        $total = $item->sell_price * $rab_item->item_count * (100 - $rab_item->item_discount) / 100;
        $affectedRows = Rab_item::where('rab_id', $this->rab_id)
        ->where('item_id', $item_id)
        ->update([
            'item_total_price' => $total
        ]);
        return $total;
    }

    public function unduhRAB()
    {
        return redirect()->to("/rab/{$this->rab_id}/final");
    }

    public function render()
    {
        $rab = Rab::find($this->rab_id);
        $rab_items = Rab_item::where('rab_id', $this->rab_id)->get()->keyBy('item_id');
        $items = Item::whereIn('item_id', $rab_items->keys())->get();
        $items_category = Item::whereIn('item_id', $rab_items->keys())->get();

        // Initialize totals and subtotals
        $totalBuyPrice = 0;
        $totalSellPrice = 0;
        $totalRAB = 0;
        $totalFinalRAB = 0;
        $subtotals = [
            'buy' => [],
            'sell' => []
        ];

        // Calculate subtotals for each category and total buy/sell prices
        foreach ($items as $item) {
            $rab_item = $rab_items[$item->item_id] ?? null;
            if ($rab_item) {
                $volume = $rab_item->item_count ?? 0;
                $discount = $rab_item->item_discount ?? 0;

                // Calculate the sell price after discount for this item
                $sellPriceAfterDiscount = ($item->sell_price * (100 - $discount) / 100) * $volume;

                // Update category subtotals for buy price
                $subtotals['buy'][$item->category] = ($subtotals['buy'][$item->category] ?? 0) + ($item->buy_price * $volume);

                // Update category subtotals for sell price using the sell price after discount
                $subtotals['sell'][$item->category] = ($subtotals['sell'][$item->category] ?? 0) + $sellPriceAfterDiscount;

                // Update total buy price
                $totalBuyPrice += $item->buy_price * $volume;

                // Update total sell price using the sell price after discount
                $totalSellPrice += $sellPriceAfterDiscount;

                // Total RAB is the sum of the sell price after discount for each item
                $totalRAB += $sellPriceAfterDiscount;
            }
        }

        // Now, apply the RAB discount to the total RAB
        $rabDiscount = $rab->rab_discount ?? 0; // Assume there is a rab_discount field in your rabs table
        $totalFinalRAB = $totalRAB * (100 - $rabDiscount) / 100;

        // Calculate Total Margin
        $totalMargin = $totalSellPrice - $totalBuyPrice;

        // Log data
        Log::info('Complete Items Data1: ', ['item_list' => $items->toArray()]);
        Log::info('Subtotals: ', ['subtotals' => $subtotals]);
        Log::info('Total Margin: ', ['totalMargin' => $totalMargin]);
        Log::info('Total RAB: ', ['totalRAB' => $totalRAB]);
        Log::info('Total Item: ', ['availableItems' => $this->availableItems]);


        return view('livewire.rab-detail', [
            'rab' => $rab,
            'item_list' => $items,
            'rab_items' => $rab_items,
            'subtotals' => $subtotals,
            'totalMargin' => $totalMargin,
            'totalRAB' => $totalRAB,
            'totalFinalRAB' => $totalFinalRAB,
            'availableItems' => $this->availableItems,
        ])->extends('components.layouts.app')->section('content');
    }



}
