<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class ProjectView extends Component
{
    use WithPagination;

    public $status_select = 2;
    public $project_name = '';

    public function mount() 
    {
        $this->project_name = request()->query('searchTerm');
    }

    public function seeRab($project_id)
    {
        return redirect('/rab' . '/' . $project_id);
    }

    public function createProject()
    {
        return redirect('/project-create');
    }

    public function updatingStatusSelect() {
        $this->resetPage();
    }

    public function askPrevPage() {
        $this->previousPage();
    }

    public function resetSelection()
    {
        $this->status_select = 2;
        $this->resetPage();
    }

    public function changeProjectStatus($p_id)
    {
        if (Project::where('project_id', $p_id)->first()->user_id != Auth::user()->user_id) {
            abort(403, 'Forbidden access');
        }
        $proj = Project::find($p_id);
        $proj->status = $proj->status === 1 ? 0:1;
        $proj->save();
    }

    public function render()
    {
        if ($this->project_name != '') {
            $project_list = Project::where('user_id', Auth::user()->user_id)->where('project_name', 'LIKE', '%'. $this->project_name . '%');
        } else {
            $project_list = Project::where('user_id', Auth::user()->user_id);
        }
        if ($this->status_select != 2) {
            return view('livewire.project-view')->with(['project' => $project_list->where('status', $this->status_select)->latest()->paginate(3)
                        , 'status_select' => $this->status_select])->extends('components.layouts.app')->section('content');
        } else {
            return view('livewire.project-view')->with(['project' => $project_list->orderBy('status')->latest()->paginate(3)
                        , 'status_select' => $this->status_select])->extends('components.layouts.app')->section('content');
        }
    }
}
