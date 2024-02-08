<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Project;
use App\Models\Rab;

class ProjectView extends Component
{
    public function seeRab() 
    {
        return redirect('/');
    }

    public function render()
    {
        return view('livewire.project-view')->with(['project' => Project::where('user_id', 30)->get()]);
    }
}
