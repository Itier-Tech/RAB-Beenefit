<?php

namespace App\Livewire;

use App\Models\Rab;
use App\Models\Project;
use Livewire\Component;
use Livewire\WithPagination;

class RabPage extends Component
{
    use WithPagination;

    public $project_id, $project_name;
    public $count = 1;
    private $page_length = 5;

    public function mount ($project_id) {
        if (count(Rab::where('project_id', $project_id)->get()) === 0) {
            return redirect('/project' . '/' . $project_id);
        }
        $this->project_id = $project_id;
        $this->project_name = Project::find($this->project_id)->project_name;
    }

    public function updatingPage($page)
    {
        $this->count = ($page-1) * $this->page_length + 1;
    }

    public function deleteRab($rab_id)
    {
        Rab::where('rab_id', $rab_id)->delete();
        return redirect(request()->header('Referer'));
    }

    public function addRab() 
    {
        return redirect('/project' . '/' . $this->project_id);
    }

    public function render()
    {
        return view('livewire.rab-page', ['rabList' => Rab::where('project_id', $this->project_id)->latest()->paginate($this->page_length),
                                        'project_name' => $this->project_name])
        ->extends('components.layouts.app')->section('content');
    }
}
