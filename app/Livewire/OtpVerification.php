<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Cache;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class OtpVerification extends Component
{
    public $phone;
    public $otp = ['', '', '', ''];
    public $timer = null;
    public $userEmail;

    protected $listeners = ['resendOtp' => 'resendOtp'];

    public function mount()
    {
        $user_data = Crypt::decrypt(session('user_data'));

        if (!$user_data) {
            return Redirect::to('/register');
        }

        $this->phone = $user_data['phone'];
        $this->userEmail = $user_data['email'];
        $this->setOtp();
    }

    private function setOtp()
    {
        $otpCode = rand(1000, 9999);
        Cache::put('otp_'.$this->phone, strval($otpCode), 300); // Store the OTP in cache for 5 minutes
        Mail::to($this->userEmail)->send(new OtpMail($otpCode));
        $this->resetTimer();
    }

    public function verifyOtp()
    {
        // Combine the OTP parts
        $inputOtp = implode('', $this->otp);
        $storedOtp = Cache::get('otp_'.$this->phone);

        if ($inputOtp === $storedOtp) {
            // OTP valid
            // Simpan data user
            $user = User::create(Crypt::decrypt(session('user_data')));
            session()->forget('user_data');
            Auth::login($user, false);
            Redirect::to('/');
            Cache::forget('otp_'.$this->phone);
        } else {
            // OTP tidak valid
            $this->addError('otp', 'The provided OTP is incorrect.');
        }


    }

    public function resendOtp()
    {
        $this->setOtp();
    }

    public function resetTimer()
    {
        $this->timer = 60;
    }

    public function render()
    {
        return view('livewire.otp-verification')->extends('layouts.app');
    }
}
