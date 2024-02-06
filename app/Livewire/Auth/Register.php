<?php

namespace App\Livewire\Auth;

use Livewire\Component;

class Register extends Component
{
    public $email;
    public $name;
    public $password;
    public $phone;

    public function register()
    {

    }

    public function render()
    {
        return view('livewire.auth.register')->extends('layouts.app')->section('content');
    }
}
