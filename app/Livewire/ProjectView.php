<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Project;
use App\Models\Rab;

class ProjectView extends Component
{
    public $project;
    public $allRab;
    public function getProjectDetails()
    {
        $this->project = Project::where('user_id', 2)->get();
    }

    public function render()
    {
        $this->getProjectDetails();
        return view('livewire.project-view');
    }
}
