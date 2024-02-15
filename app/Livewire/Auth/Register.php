<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Models\User;


class Register extends Component
{
    public $email;
    public $name;
    public $password;
    public $phone;

    public function rules()
    {
        return [
            'email' => ['required', 'email', 'unique:users'],
            'name' => ['required'],
            'password' => ['required'],
            'phone' => ['required'],
        ];
    }
    public function register()
    {
        $this->validate();

        $user = User::create([
            'full_name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'phone' => $this->phone,
        ]);
        // Auth::login($user, true);
        return redirect()->to('/home');
    }

    public function render()
    {
        return view('livewire.auth.register')->extends('layouts.app')->section('content');
    }
}
