<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;

class ProjectView extends Component
{
    use WithPagination;

    public $status_select = 2;
    private $viewedProjects;

    public function seeRab($project_id, $project_name) 
    {
        return redirect('/rab'. '/'. $project_id . '/' . $project_name);
    }

    public function createProject()
    {
        return redirect('/projectCreate');
    }

    public function filter()
    {
        $this->render();
    }

    public function resetSelection()
    {
        $this->status_select = 2;
    }

    public function render()
    {
        if ($this->status_select != 2) {
            // Retrieve all projects for the user
            $allProjects = Project::where('user_id', Auth::user()->user_id)->latest()->get();

            // Filter the projects based on the status
            $filteredProjects = $allProjects->filter(function ($project) {
                return $project->status() == $this->status_select;
            });

            // Paginate the filtered projects
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $perPage = 3; // Number of items per page
            $currentPageItems = $filteredProjects->slice(($currentPage - 1) * $perPage, $perPage)->all();
            $this->viewedProjects = new LengthAwarePaginator($currentPageItems, count($filteredProjects), $perPage, $currentPage);
        } else {
            $this->viewedProjects = Project::where('user_id', Auth::user()->user_id)->latest()->paginate(3);
        }
        return view('livewire.project-view')->with(['project' => $this->viewedProjects, 'status_select' => $this->status_select])->extends('components.layouts.app')->section('content');
    }
}
