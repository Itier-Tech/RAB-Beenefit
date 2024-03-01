<div style="background-image: url('{{ asset('images/bg_register.png') }}'); height: 100vh; width: 100%; background-size: cover; display: flex; justify-content: center; align-items: center;">
    @once
        <script src="{{ asset('js/otpVerification.js') }}"></script>
    @endonce
    <div class="card shadow-lg" style="width: 80%; background-color: white; border-radius: 2rem; padding: 2rem; box-sizing: border-box;">
        <div class="text-center" style="margin-bottom: 2rem;">
            <img src="{{ asset('images/logo_beenefit.png') }}" alt="Beenefit Logo" style="width: 120px; margin-bottom: 1rem;">
            <h2 style="font-weight: bold; margin-bottom: 0.5rem;">Verifikasi Akun</h2>
            <div class="text-center" style="margin-top: 2rem;">
                <p>Kode OTP sudah dikirim ke email {{ $userEmail }}
                    <a wire:click="resendOtp" class="text-decoration-none" style="color: #228B22; font-weight: bold; cursor: pointer;">(Kirim ulang kode)</a>
                </p>
            </div>
        </div>
        <form wire:submit.prevent="verifyOtp">
            <div>
                @foreach ($otp as $digit)
                <input type="text" wire:model="otp.{{ $loop->index }}" maxlength="1" autofocus>
                @endforeach
            </div>
            <button type="submit">Verifikasi</button>
        </form>
        <div>
            <p>Belum menerima kode?
                <span wire:click="resendOtp">Kirim Ulang</span>
                <span id="timer">(1:00)</span>
            </p>
        </div>
    </div>
</div>