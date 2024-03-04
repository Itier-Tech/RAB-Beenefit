<?php

namespace App\Livewire;
use App\Models\Rab_item;
use App\Models\Item;
use App\Models\Rab;
use App\Models\Project;

use Livewire\Component;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class RabDetail extends Component
{
    public $rab_id;
    public $project_name;
    public $rab_discount;
    public $categoryList = ['Tanaman', 'Material', 'Operasional'];
    public $selectedCategory;
    public $availableItems;
    public $selectedItem;
    public $itemQuantity = 0;
    public $discountPercentage = 0;
    public $items_list = []; // Daftar atribut barang-barang
    public $totalFinalRAB, $totalBuyPrice;

    protected $listeners = ['refreshComponent' => '$refresh'];

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
        $this->project_name = $project->project_name;
        $this->rab_id = $rab_id;
        $this->loadRab();
        $this->loadAvailableItems();
        $curr_items = Rab_item::where('rab_id', $rab_id)->get()->keyBy('item_id');
        foreach ($curr_items as $it) {
            $this->items_list[$it->item_id] = ["item_discount" => $it->item_discount, "item_count" => $it->item_count,
                                                "item_total_price" => $it->item_total_price]; 
        }
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
        if (!array_key_exists($this->selectedItem, $this->items_list)) { // Add a new entry
            $this->items_list[$this->selectedItem] = ["item_discount" => $this->discountPercentage, "item_count" => $this->itemQuantity,
            "item_total_price" => 0];
            $this->calculateTotal($this->selectedItem);
        } else {
            $checkItem = $this->items_list[$this->selectedItem];
            $this->updateItemVolume($this->selectedItem, $this->itemQuantity + $checkItem['item_count']);
            $this->updateItemDiscount($this->selectedItem, $this->discountPercentage + $checkItem['item_discount']);
        }
        
        $this->reset(['selectedItem', 'discountPercentage', 'itemQuantity']);
    }

    public function deleteRabItem($item_id)
    {
        // Retrieve the specific Rab_item entry
        unset($this->items_list[$item_id]);
    }

    public function updateItemVolume(int $item_id, int $newVol)
    {
        if($newVol === 0) {
            unset($this->items_list[$item_id]);
            return;
        }
        $this->items_list[$item_id]['item_count'] = $newVol;
    }

    public function updateItemDiscount(int $item_id, int $newDisc)
    {
        $this->items_list[$item_id]['item_discount'] = $newDisc;
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

    public function calculateTotal($item_id)
    {
        $rab_item = $this->items_list[$item_id];
        if (!$rab_item) {
            return 0; // Or handle the case where the rab_item is not found
        }

        $item = Item::find($item_id);
        if (!$item) {
            return 0; // Or handle the case where the item is not found
        }

        // Calculate total using the formula: harga jual * volume * (100 - diskon) / 100
        $total = $item->sell_price * $rab_item['item_count'] * (100 - $rab_item['item_discount']) / 100;
        $rab_item['item_total_price'] = $total;
        return $total;
    }

    public function saveItems()
    {
        // Simpan semua data yang ada ke database
        foreach ($this->items_list as $key=>$it) {
            $checkItem = Rab_item::where('rab_id', $this->rab_id)->where('item_id', $key)->first();
            if ($checkItem != null) { // Perbaharui data
                Rab_item::where('rab_id', $this->rab_id)->where('item_id', $key)->update($it);
            } else {
                // Buat baru
                $data = $it;
                $data['rab_id'] = $this->rab_id;
                $data['item_id'] = $key;
                Rab_item::create($data);
            }
        }
        // Hapus item yang sudah dihapus
        Rab_item::where('rab_id', $this->rab_id)->whereNotIn('item_id', array_keys($this->items_list))->delete();
        // Save to RAB
        Rab::where('rab_id', $this->rab_id)->update(['rab_discount' => $this->rab_discount, 'total_price' => round($this->totalFinalRAB), 'total_buy_price' => round($this->totalBuyPrice)]);
        return redirect(request()->header('Referer'));
    }

    public function unduhRAB()
    {
        return redirect()->to("/rab/{$this->rab_id}/final");
    }

    public function backToRABList()
    {
        return redirect()->to("/rab" ."/". Rab::where('rab_id', $this->rab_id)->first()->project_id);
    }

    public function render()
    {
        $rab = Rab::find($this->rab_id);
        $items = Item::whereIn('item_id', array_keys($this->items_list))->get();
        $items_category = Item::whereIn('item_id', array_keys($this->items_list))->get();

        // Initialize totals and subtotals
        $this->totalBuyPrice = 0;
        $totalSellPrice = 0;
        $totalRAB = 0;
        $this->totalFinalRAB = 0;
        $subtotals = [
            'buy' => [],
            'sell' => []
        ];

        // Calculate subtotals for each category and total buy/sell prices
        foreach ($items as $item) {
            $rab_item = $this->items_list[$item->item_id] ?? null;
            if ($rab_item) {
                $volume = $rab_item['item_count'] ?? 0;
                $discount = $rab_item['item_discount'] ?? 0;

                // Calculate the sell price after discount for this item
                $sellPriceAfterDiscount = ($item->sell_price * (100 - $discount) / 100) * $volume;

                // Update category subtotals for buy price
                $subtotals['buy'][$item->category] = ($subtotals['buy'][$item->category] ?? 0) + ($item->buy_price * $volume);

                // Update category subtotals for sell price using the sell price after discount
                $subtotals['sell'][$item->category] = ($subtotals['sell'][$item->category] ?? 0) + $sellPriceAfterDiscount;

                // Update total buy price
                $this->totalBuyPrice += $item->buy_price * $volume;

                // Update total sell price using the sell price after discount
                $totalSellPrice += $sellPriceAfterDiscount;

                // Total RAB is the sum of the sell price after discount for each item
                $totalRAB += $sellPriceAfterDiscount;
            }
        }

        // Now, apply the RAB discount to the total RAB
        $rabDiscount = $this->rab_discount; // Assume there is a rab_discount field in your rabs table
        $this->totalFinalRAB = $totalRAB * (100 - $rabDiscount) / 100;

        // Calculate Total Margin
        $totalMargin = $totalSellPrice - $this->totalBuyPrice;

        // Log data
        Log::info('Complete Items Data1: ', ['item_list' => $items->toArray()]);
        Log::info('Subtotals: ', ['subtotals' => $subtotals]);
        Log::info('Total Margin: ', ['totalMargin' => $totalMargin]);
        Log::info('Total RAB: ', ['totalRAB' => $totalRAB]);
        Log::info('Total Item: ', ['availableItems' => $this->availableItems]);


        return view('livewire.rab-detail', [
            'rab' => $rab,
            'item_list' => $items,
            'subtotals' => $subtotals,
            'totalMargin' => $totalMargin,
            'totalRAB' => $totalRAB,
            'availableItems' => $this->availableItems,
        ])->extends('components.layouts.app')->section('content');
    }



}
