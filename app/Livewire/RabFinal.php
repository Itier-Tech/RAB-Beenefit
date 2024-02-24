<?php

namespace App\Livewire;

use Livewire\Component;

class RabFinal extends Component
{
    public function render()
    {
        return view('livewire.rab-final')->extends('components.layouts.app')->section('content');
    }
}
