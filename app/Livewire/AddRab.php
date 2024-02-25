<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Rab;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class AddRab extends Component
{
    public $projectId;

    public function mount () {
        $projectId = Crypt::decrypt(session()->get('project_id'));
        // Check if the logged in user has access to the project
        if (Project::where('project_id', $projectId)->first()->user_id != Auth::user()->user_id) {
            abort(403, 'Forbidden access');
        }
        $this->projectId = $projectId;
    }
    public function create()
    {
        $rab = new Rab();

        $rab->project_id = $this->projectId;
        $rab->status = 0;

        $rab->save();
        response()->json(['message' => 'Rab created successfully', 'data' => $rab], 201);
        return redirect('/rab')->with('project_id', Crypt::encrypt($this->projectId));
    }

    public function render()
    {
        return view('livewire.add-rab')->extends('components.layouts.app')->section('content');
    }
}
