<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Rab;

class RabController extends Controller
{
    public function create(Request $request, $projectId)
    {
        // dd($request);
        $request->validate([
            'project_id' => $projectId,
        ]);

        $rab = new Rab();

        $rab->project_id = $projectId;
        $rab->status = 0;

        $rab->save();
        return response()->json(['message' => 'Rab created successfully', 'data' => $rab], 201);
    }

    public function applyDiscount(Request $request, $rab_id)
    {
        $validator = Validator::make($request->all(), [
            'discount' => 'required|numeric|min:0|max:100', // memastikan diskon adalah numerik dan antara 0-100%
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $rab = Rab::find($rab_id);
        if (!$rab) {
            return response()->json(['message' => 'RAB not found'], 404);
        }

        $discountPercentage = $request->discount;
        $totalPrice = $rab->total_price;
        $discountAmount = ($discountPercentage / 100) * $totalPrice;
        $finalPrice = $totalPrice - $discountAmount;

        $rab->rab_discount = $discountPercentage;
        $rab->total_price = $finalPrice;
        $rab->save();

        return response()->json([
            'message' => 'Discount applied successfully',
            'final_price' => $finalPrice
        ]);
    }
}
