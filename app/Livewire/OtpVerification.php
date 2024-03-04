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
use Illuminate\Support\Facades\RateLimiter;

class OtpVerification extends Component
{
    public $phone;
    public $otp = ['', '', '', ''];
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
        RateLimiter::attempt('otp-verification', $perMinute = 1, function() {
            $otpCode = rand(1000, 9999);
            Cache::put('otp_'.$this->phone, strval($otpCode), 300); // Store the OTP in cache for 5 minutes
            Mail::to($this->userEmail)->send(new OtpMail($otpCode));
        });
    }

    public function verifyOtp()
    {
        // Combine the OTP parts
        $inputOtp = implode('', $this->otp);
        $storedOtp = Cache::get('otp_'.$this->phone);

        if ($inputOtp === $storedOtp) {
            // OTP valid
            // Save user data
            $user = User::create(Crypt::decrypt(session('user_data')));
            session()->forget('user_data');
            Auth::login($user, false);
            Cache::forget('otp_'.$this->phone);
            Redirect::to('/');
        } else {
            // OTP not valid
            $this->addError('otp', 'The provided OTP is incorrect.');
        }
    }

    public function resendOtp()
    {
        $this->setOtp();
    }

    public function render()
    {
        return view('livewire.otp-verification')->extends('layouts.app');
    }
}
