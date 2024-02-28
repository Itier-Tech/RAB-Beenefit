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

    public function register()
    {
        $validatedData = $this->validate([
            'full_name' => 'required|string',
            'email' => 'required|email|unique:users|string',
            'password' => 'required|min:8|string',
            'phone' => 'required|string',
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);

        $user = User::create($validatedData);
        session(['user_id' => $user->user_id]);
        // Auth::login($user, true);

        // return redirect()->to('/otp-verification');
        return redirect("/otp-verification");
    }

    public function render()
    {
        return view('livewire.auth.register')->extends('layouts.app')->section('content');
    }
}
