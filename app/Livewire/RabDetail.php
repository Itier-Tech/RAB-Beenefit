<?php

namespace App\Livewire;
use App\Models\Rab_item;
use App\Models\Item;

use Livewire\Component;
use Illuminate\Support\Facades\Log;

class RabDetail extends Component
{
    public $rab_id;

    public function mount ($rab_id)
    {
        $this->rab_id = $rab_id;
    }

    public function deleteRabItem($item_id)
    {
        // Retrieve the specific Rab_item entry
        Rab_item::where('rab_id', $this->rab_id)->where('item_id', $item_id)->delete();
    }

    public function decrementVolume($item_id)
    {
        // Retrieve the specific Rab_item entry
        $rab_item = Rab_item::where('rab_id', $this->rab_id)->where('item_id', $item_id)->first();

        // Check if the rab_item exists and item_count is greater than 0
        if ($rab_item && $rab_item->item_count > 0) {
            // Decrement the item_count
            $affectedRows = Rab_item::where('rab_id', $this->rab_id)
            ->where('item_id', $item_id)
            ->decrement('item_count');

            // // If after decrementing the count is 0, delete the row
            // if ($affectedRows->item_count === 0) {
            //     $affectedRows->delete();
            // }
        }
        return redirect(request()->header('Referer'));
    }

    public function incrementVolume($item_id)
    {
        // Perform a manual update on the rab_items table
        $affectedRows = Rab_item::where('rab_id', $this->rab_id)
                                 ->where('item_id', $item_id)
                                 ->increment('item_count');

        // If no rows are affected, it means the rab_item doesn't exist, so create it.
        if ($affectedRows === 0) {
            Rab_item::create([
                'rab_id' => $this->rab_id,
                'item_id' => $item_id,
                'item_count' => 1, // Starting count
                // Set other fields as needed
                'updated_at' => now() // Use the now() helper to set the current timestamp
            ]);
        }
        return redirect(request()->header('Referer'));
    }

    public function decrementDiscount($item_id)
    {
        // Retrieve the specific Rab_item entry
        $rab_item = Rab_item::where('rab_id', $this->rab_id)->where('item_id', $item_id)->first();

        // Check if the rab_item exists and item_discount is greater than 0
        if ($rab_item && $rab_item->item_discount > 0) {
            // Decrement the item_discount
            $affectedRows = Rab_item::where('rab_id', $this->rab_id)
            ->where('item_id', $item_id)
            ->decrement('item_discount');
        }
        return redirect(request()->header('Referer'));
    }

    public function incrementDiscount($item_id)
    {
        // Perform a manual update on the rab_items table
        $affectedRows = Rab_item::where('rab_id', $this->rab_id)
                                 ->where('item_id', $item_id)
                                 ->increment('item_discount');

        // If no rows are affected, it means the rab_item doesn't exist, so create it.
        if ($affectedRows === 0) {
            Rab_item::create([
                'rab_id' => $this->rab_id,
                'item_id' => $item_id,
                'item_discount' => 1, // Starting count
                // Set other fields as needed
                'updated_at' => now() // Use the now() helper to set the current timestamp
            ]);
        }
        return redirect(request()->header('Referer'));
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


    public function render()
    {
        $rab_items = Rab_item::where('rab_id', $this->rab_id)->get()->keyBy('item_id');
        $items = Item::whereIn('item_id', $rab_items->keys())->get();

        // Initialize totals and subtotals
        $totalBuyPrice = 0;
        $totalSellPrice = 0;
        $totalRAB = 0;
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

        // Calculate Total Margin
        $totalMargin = $totalSellPrice - $totalBuyPrice;

        // Log data
        Log::info('Complete Items Data1: ', ['item_list' => $items->toArray()]);
        Log::info('Subtotals: ', ['subtotals' => $subtotals]);
        Log::info('Total Margin: ', ['totalMargin' => $totalMargin]);
        Log::info('Total RAB: ', ['totalRAB' => $totalRAB]);

        return view('livewire.rab-detail', [
            'item_list' => $items,
            'rab_items' => $rab_items,
            'subtotals' => $subtotals,
            'totalMargin' => $totalMargin,
            'totalRAB' => $totalRAB
        ])->extends('components.layouts.app')->section('content');
    }



}
