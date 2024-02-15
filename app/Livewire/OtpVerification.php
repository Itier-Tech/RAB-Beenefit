<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Cache;

class OtpVerification extends Component
{
    public $phone;
    public $otp = ['', '', '', ''];
    public $timer = null;

    protected $listeners = ['resendOtp' => 'resendOtp'];

    public function mount()
    {
        $user_id = session('user_id');
        $user = User::find($user_id);

        if (!$user) {
            return Redirect::to('/register');
        }

        $this->phone = $user->phone;
        $this->setOtp();
    }

    private function setOtp()
    {
        $otpCode = rand(1000, 9999);
        Cache::put('otp_'.$this->phone, $otpCode, 300);
        $this->sendOtp($otpCode);
        $this->resetTimer();
    }

    public function verifyOtp()
    {
        // Combine the OTP parts
        $inputOtp = implode('', $this->otp);
        $storedOtp = Cache::get('otp_'.$this->phone);

        if ($inputOtp === $storedOtp) {
            // OTP valid
            edirect::to('/register');
            Cache::forget('otp_'.$this->phone); // Hapus OTP dari cache setelah berhasil diverifikasi
        } else {
            // OTP tidak valid
            $this->addError('otp', 'The provided OTP is incorrect.');
        }


    }

    public function resendOtp()
    {
        // Logic to resend the OTP
        // $this->sendOtp();

        // $this->resetTimer();
        // $this->dispatchBrowserEvent('resetTimer', ['duration' => 60]);
        $this->setOtp();
    }

    private function sendOtp($otp)
    {
        // Kirim OTP ke nomor telepon
        // Menggunakan Twilio SDK
        $twilio = new Client(env('TWILIO_SID'), env('TWILIO_TOKEN'));
        $twilio->messages->create($this->phone, [
            'from' => env('TWILIO_FROM'),
            'body' => "Your OTP is: {$otp}"
        ]);
    }

    public function resetTimer()
    {
        $this->timer = 60;
        $this->dispatchBrowserEvent('resetTimer', ['duration' => 60]);
    }

    public function render()
    {
        return view('livewire.otp-verification')->layout('layouts.app');
    }
}
