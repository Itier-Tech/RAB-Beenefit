<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class ProjectView extends Component
{
    use WithPagination;

    public function seeRab($project_id, $project_name) 
    {
        return redirect('/rab'. '/'. $project_id . '/' . $project_name);
    }

    public function createProject()
    {
        return redirect('/projectCreate');
    }

    public function render()
    {
        return view('livewire.project-view')->with(['project' => Project::where('user_id', Auth::user()->user_id)->latest()->paginate(3)])->extends('components.layouts.app')->section('content');
    }
}