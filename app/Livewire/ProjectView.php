<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Crypt;

class ProjectView extends Component
{
    use WithPagination;

    public $status_select = 2;

    public function seeRab($project_id)
    {
        // Send project id through session and encrypt it
        return redirect('/rab')->with('project_id', Crypt::encrypt($project_id));
    }

    public function createProject()
    {
        return redirect('/projectCreate');
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
        $proj = Project::find($p_id);
        $proj->status = $proj->status === 1 ? 0:1;
        $proj->save();
    }

    public function render()
    {
        if ($this->status_select != 2) {
            return view('livewire.project-view')->with(['project' => Project::where('user_id', Auth::user()->user_id)->where('status', $this->status_select)->latest()->paginate(3)
                        , 'status_select' => $this->status_select])->extends('components.layouts.app')->section('content');
        } else {
            return view('livewire.project-view')->with(['project' => Project::where('user_id', Auth::user()->user_id)->orderBy('status')->latest()->paginate(3)
                        , 'status_select' => $this->status_select])->extends('components.layouts.app')->section('content');
        }
    }
}
