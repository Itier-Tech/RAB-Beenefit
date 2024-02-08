<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Project;

class ProjectCreate extends Component
{
    public $project_name, $client_name, $project_address, $budget;
    public function create()
    {
        $user_id = 38;
        Project::create([
            'user_id' => $user_id, // Set the user_id explicitly
            'project_name' => $this->project_name,
            'client_name' => $this->client_name,
            'project_address' => $this->project_address,
            'budget' => $this->budget
        ]);
        
        $this->reset('project_name', 'client_name', 'project_address', 'budget');
        return redirect('/home');
    }

    public function render()
    {
        return view('livewire.project-create')->extends('components.layouts.app')->section('content');
    }
}
