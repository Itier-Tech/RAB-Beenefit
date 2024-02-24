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
        return redirect('/rab'. '/'. $project_id);
    }

    public function createProject()
    {
        return redirect('/projectCreate');
    }

    public function resetSelection()
    {
        $this->status_select = 2;
    }

    public function changeProjectStatus(Project $p)
    {
        $p->status = $p->status === 1 ? 0:1;
        $p->save();
    }

    public function render()
    {
        if ($this->status_select != 2) {
            $this->viewedProjects = Project::where('user_id', Auth::user()->user_id)->where('status', $this->status_select)->latest()->paginate(3);;
        } else {
            $this->viewedProjects = Project::where('user_id', Auth::user()->user_id)->latest()->paginate(3);
        }
        return view('livewire.project-view')->with(['project' => $this->viewedProjects, 'status_select' => $this->status_select])->extends('components.layouts.app')->section('content');
    }
}
