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
    private $page_length = 2;

    public function mount ($project_id, $project_name) {
        $this->project_id = $project_id;
        $this->project_name = $project_name;
    }

    public function updatingPage($page)
    {
        $count *= $page * $this->page_length;
    }

    public function deleteRab($rab_id) 
    {
        Rab::where('rab_id', $rab_id)->delete();
        return redirect(request()->header('Referer'));
    }

    public function render()
    {
        return view('livewire.rab-page', ['rabList' => Rab::where('project_id', $this->project_id)->paginate($this->page_length),
                                           'project_name' => $this->project_name])
        ->extends('components.layouts.app')->section('content');
    }
}
