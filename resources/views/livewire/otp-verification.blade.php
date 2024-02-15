<div style="background-image: url('{{ asset('images/bg_register.png') }}'); height: 100vh; width: 100%; background-size: cover; display: flex; justify-content: center; align-items: center;">
    <div class="card shadow-lg" style="width: 80%; background-color: white; border-radius: 2rem; padding: 2rem; box-sizing: border-box;">
        <div class="text-center" style="margin-bottom: 2rem;">
            <img src="{{ asset('images/logo_beenefit.png') }}" alt="Beenefit Logo" style="width: 120px; margin-bottom: 1rem;">
            <h2 style="font-weight: bold; margin-bottom: 0.5rem;">Verifikasi Akun</h2>
            <div class="text-center" style="margin-top: 2rem;">
                <p>Kode OTP sudah dikirim ke nomor {{ $phone }}
                    <a wire:click="resendOtp" class="text-decoration-none" style="color: #228B22; font-weight: bold; cursor: pointer;">(ubah nomor)</a>
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        window.livewire.on('resetTimer', data => {
            let duration = data.duration;
            let display = document.getElementById('timer');
            startTimer(duration, display);
        });

        function startTimer(duration, display) {
            let timer = duration, minutes, seconds;
            const interval = setInterval(function () {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);
                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;
                display.textContent = '(' + minutes + ":" + seconds + ')';
                if (--timer < 0) {
                    timer = duration;
                    clearInterval(interval);
                    window.livewire.emit('resendOtp');
                }
            }, 1000);
        }
    });
</script>
@endpush
