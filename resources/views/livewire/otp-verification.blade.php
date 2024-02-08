<script>
    Livewire.on('updatedOtp', otp => {
        const otpBoxes = document.querySelectorAll('#otpBoxContainer div');
        otp.split('').forEach((num, index) => {
            otpBoxes[index].textContent = num;
        });
        for (let i = otp.length; i < otpBoxes.length; i++) {
            otpBoxes[i].textContent = '•';
        }
    });
</script>

<script>
    window.addEventListener('startResendTimer', () => {
        const resendLink = document.getElementById('resendLink');
        let timer = 60;
        const interval = setInterval(() => {
            if (timer === 0) {
                clearInterval(interval);
                resendLink.textContent = 'Kirim Ulang';
                resendLink.removeAttribute('disabled');
            } else {
                timer--;
                resendLink.textContent = 'Kirim Ulang (' + timer + ')';
                resendLink.setAttribute('disabled', 'disabled');
            }
        }, 1000);
    });
</script>

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
        <form wire:submit.prevent="verifyOtp" style="display: flex; flex-direction: column; gap: 1rem;">
            <!-- Row for OTP -->
            {{-- <div style="display: flex; justify-content: center; gap: 1rem;">
                <input type="text" wire:model="otp1" maxlength="1" style="font-size: 2rem; border-color: #228B22; width: 4rem; text-align: center;" class="form-control">
                <input type="text" wire:model="otp2" maxlength="1" style="font-size: 2rem; border-color: #228B22; width: 4rem; text-align: center;" class="form-control">
                <input type="text" wire:model="otp3" maxlength="1" style="font-size: 2rem; border-color: #228B22; width: 4rem; text-align: center;" class="form-control">
                <input type="text" wire:model="otp4" maxlength="1" style="font-size: 2rem; border-color: #228B22; width: 4rem; text-align: center;" class="form-control">
            </div> --}}
            <input type="text" wire:model="otp" maxlength="4" autofocus />
            <div wire:ignore.self id="otpBoxContainer">
                <div>•</div>
                <div>•</div>
                <div>•</div>
                <div>•</div>
            </div>
            <!-- Submit button -->
            <div class="text-center" style="margin-top: 1.5rem;">
                <button type="submit" class="btn" style="background-color: #FFD700; border: none; padding: 0.75rem 2rem; font-size: 1.2rem; color: black; font-weight: bold;">Verifikasi</button>
            </div>
        </form>
        <div class="text-center" style="margin-top: 2rem;">
            <p>Belum menerima kode?
                {{-- <a wire:click="resendOtp" class="text-decoration-none" style="color: #228B22; font-weight: bold; cursor: pointer;">Kirim Ulang (1:00)</a> --}}
                <a wire:click="resendOtp" id="resendLink">Kirim Ulang</a>
            </p>
        </div>
    </div>
</div>
