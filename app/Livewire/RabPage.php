<?php

namespace App\Livewire;

use App\Models\Rab;
use Livewire\Component;

class RabPage extends Component
{
    public $rabList;
    public $count = 1;
    public function mount ($project_id) {
        $this->rabList = Rab::where('project_id', $project_id)->get();
    }

    public function render()
    {
        return view('livewire.rab-page')->extends('components.layouts.app')->section('content');
    }
}
