<?php

namespace App\Livewire;

use App\Models\Rab;
use Livewire\Component;
use Livewire\WithPagination;

class RabPage extends Component
{
    use WithPagination;

    public $project_id;
    public $count = 1;
    public function mount ($project_id) {
        $this->project_id = $project_id;
    }

    public function render()
    {
        return view('livewire.rab-page', ['rabList' => Rab::where('project_id', $this->project_id)->paginate(2)])
        ->extends('components.layouts.app')->section('content');
    }
}
