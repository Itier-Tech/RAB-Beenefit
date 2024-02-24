<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Cache;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Mail;

class OtpVerification extends Component
{
    public $phone;
    public $otp = ['', '', '', ''];
    public $timer = null;
    public $userEmail;

    protected $listeners = ['resendOtp' => 'resendOtp'];

    public function mount()
    {
        $user_id = session('user_id');
        $user = User::find($user_id);

        if (!$user) {
            return Redirect::to('/register');
        }

        $this->phone = $user->phone;
        $this->userEmail = $user->email;
        $this->setOtp();
    }

    private function setOtp()
    {
        $otpCode = rand(1000, 9999);
        Cache::put('otp_'.$this->phone, $otpCode, 300); // Store the OTP in cache for 5 minutes
        Mail::to($this->userEmail)->send(new OtpMail($otpCode));
        $this->resetTimer();
        return redirect("/");
    }

    public function verifyOtp()
    {
        // Combine the OTP parts
        $inputOtp = implode('', $this->otp);
        $storedOtp = Cache::get('otp_'.$this->phone);

        if ($inputOtp === $storedOtp) {
            // OTP valid
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
        return view('livewire.otp-verification')->layout('layouts.app');
    }
}
