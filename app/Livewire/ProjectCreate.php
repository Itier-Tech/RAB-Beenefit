<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class ProjectCreate extends Component
{
    public $project_name, $client_name, $project_address, $budget;

    public function rules() {
        return [
            'project_name' => ['required'],
            'client_name' => ['required'],
            'project_address' => ['required'],
            'budget' => ['required', 'integer'],
        ];
    }
    public function create()
    {
        $this->validate();
        $user_id = Auth::user()->user_id;
        Project::create([
            'user_id' => $user_id, // Set the user_id explicitly
            'project_name' => trim(strip_tags($this->project_name)),
            'client_name' => trim(strip_tags($this->client_name)),
            'project_address' => trim(strip_tags($this->project_address)),
            'status' => 0,
            'budget' => trim(strip_tags($this->budget))
        ]);
        
        $this->reset('project_name', 'client_name', 'project_address', 'budget');
        return redirect('/project');
    }

    public function render()
    {
        return view('livewire.project-create')->extends('components.layouts.app')->section('content');
    }
}
