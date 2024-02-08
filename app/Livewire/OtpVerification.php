<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class OtpVerification extends Component
{
    public $phone;
    public $otp;

    public function mount()
    {
        // Get user ID from session dan get phone number
        $user_id = session('user_id');
        $user = User::find($user_id);

        if ($user) {
            $this->phone = $user->phone;
        } else {
            // If it doesn't found, redirect to registration page ke halaman registrasi atau login
            return redirect()->to('/register');
        }
    }

    public function updatedOtp()
    {
        if (strlen($this->otp) === 4) {
            // Validasi OTP
        }
    }

    public function resendOtp()
    {
        $this->dispatchBrowserEvent('startResendTimer');
        // Reset timer
        $this->timer = 60;
        // Logika untuk mengirim ulang OTP
    }

    public function render()
    {
        return view('livewire.otp-verification')->extends('layouts.app')->section('content');
    }
}
