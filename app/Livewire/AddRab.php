<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Rab;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class AddRab extends Component
{
    public $projectId;
    public $projectName;

    public function mount ($project_id) {
        // Check if the logged in user has access to the project
        if (Project::where('project_id', $project_id)->first()->user_id != Auth::user()->user_id) {
            abort(403, 'Forbidden access');
        }
        $this->projectId = $project_id;
        $project = Project::find($project_id);

        if ($project) {
            $this->projectName = $project->project_name;
        } else {
            $this->projectName = 'Nama Proyek Tidak Ditemukan';
        }
    }
    public function create()
    {
        $rab = new Rab();

        $rab->project_id = $this->projectId;
        $rab->status = 0;

        $rab->save();
        response()->json(['message' => 'Rab created successfully', 'data' => $rab], 201);
        return redirect('/rab' . '/' . $this->projectId);
    }

    public function render()
    {
        return view('livewire.add-rab')->extends('components.layouts.app')->section('content');
    }
}
