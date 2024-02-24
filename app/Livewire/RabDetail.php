<?php

namespace App\Livewire;

use Livewire\Component;

class RabDetail extends Component
{
    public $rab_id;

    public function mount ($rab_id) {
        $this->rab_id = $rab_id;
    }


    public function render()
    {
        return view('livewire.rab-detail',)->extends('components.layouts.app')->section('content');;
    }
}
