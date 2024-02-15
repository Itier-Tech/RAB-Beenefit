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
}
