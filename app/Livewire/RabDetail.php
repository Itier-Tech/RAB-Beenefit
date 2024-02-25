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

    public function deleteItem($item_id)
    {
        Rab_item::where('rab_id', $this->rab_id)->where('item_id', $item_id)->delete();
        $this->emit('itemDeleted');
    }

    public function addItem($item_id, $item_discount = null, $item_count = null)
    {
        Rab_item::create([
            'rab_id' => $this->rab_id,
            'item_id' => $item_id,
            'item_discount' => $item_discount,
            'item_count' => $item_count
        ]);
        $this->emit('itemAdded');
    }

    public function calculateTotal($item_id, $item_count, $item_discount, $sell_price)
    {
        $discountAmount = ($sell_price * $item_discount) / 100;
        $discountedPrice = $sell_price - $discountAmount;
        $total = $discountedPrice * $item_count;

        return $total;
    }

    public function render()
    {
        // Retrieve all item_id
        $item_ids = Rab_item::where('rab_id', $this->rab_id)->get(['item_id']);
        $items = Item::whereIn('item_id', $item_ids)->get();
        // Log::info('Complete Items Data: ', ['items' => $items->toArray()]);
        return view('livewire.rab-detail', ['item_list' => $items])->extends('components.layouts.app')->section('content');
    }
}
