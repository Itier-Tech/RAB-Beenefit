<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rab;
use App\Models\RabItem;
use App\Models\Item;
use Illuminate\Support\Facades\Validator;

class RabItemController extends Controller
{
    public function addItem(Request $request, $rab_id)
    {
        $validator = Validator::make($request->all(), [
            'item_id' => 'required|exists:items,id', // Pastikan item_id ada di database
            'quantity' => 'required|numeric|min:1', // Quantity harus numerik dan minimal 1
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $rab = Rab::find($rab_id);
        if (!$rab) {
            return response()->json(['message' => 'RAB not found'], 404);
        }

        $item = Item::find($request->item_id);
        // Asumsikan buy_price adalah harga per unit item
        $totalItemPrice = $item->buy_price * $request->quantity;

        // Membuat Rab_item baru
        $rabItem = new RabItem([
            'rab_id' => $rab_id,
            'item_id' => $request->item_id,
            'item_count' => $request->quantity,
            'total_price' => $totalItemPrice, // Asumsi ada kolom total_price pada Rab_item
        ]);
        $rabItem->save();

        // Update total_price di RAB, asumsikan total_price adalah total harga semua item
        $rab->total_price += $totalItemPrice;
        $rab->save();

        return response()->json([
            'message' => 'Item added successfully',
            'rab_item' => $rabItem,
            'rab_total_price' => $rab->total_price,
        ]);
    }
}
