<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;


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

        $validatedData['full_name'] = trim(strip_tags($validatedData['full_name']));
        $validatedData['email'] = trim(strip_tags($validatedData['email']));
        $validatedData['password'] = trim($validatedData['password']);
        $validatedData['phone'] = trim(strip_tags($validatedData['phone']));
        
        $validatedData['password'] = bcrypt($validatedData['password']);

        session(['user_data' => Crypt::encrypt($validatedData)]);
        return redirect("/otp-verification");
    }

    public function render()
    {
        return view('livewire.auth.register')->extends('layouts.app')->section('content');
    }
}
