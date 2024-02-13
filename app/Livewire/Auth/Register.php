<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Models\User;


class Register extends Component
{
    public $full_name;
    public $email;
    public $password;
    public $phone;

    // public function rules()
    // {
    //     return [
    //         'email' => ['required', 'email', 'unique:users'],
    //         'name' => ['required'],
    //         'password' => ['required'],
    //         'phone' => ['required'],
    //     ];
    // }

    public function register()
    {
        $validatedData = $this->validate([
            'full_name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'phone' => 'required|string',
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);

        error_log('Austin');

        $user = User::create($validatedData);
        // Auth::login($user, true);
        return redirect()->to('/home');
    }

    public function render()
    {
        return view('livewire.auth.register')->extends('layouts.app')->section('content');
    }
}
