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
                </p>
            </div>
        </div>
        <form wire:submit.prevent="verifyOtp" style="width:90%; margin:0 auto;">
            <div style="width:100%; display:flex; flex-direction:column; justify-content:center; gap:1rem;">
                <div style="width:100%; display:flex; justify-content:space-around;">
                    @foreach ($otp as $digit)
                    <input type="text" style="width:2rem; text-align:center;" wire:model="otp.{{ $loop->index }}" maxlength="1" autofocus onkeyup="checkInput(this)">
                    @endforeach
                </div>
                <button type="submit">Verifikasi</button>
            </div>
        </form>
        <div>
            <p>Belum menerima kode?
                <a href="" wire:click="resendOtp" style="color:green;">Kirim Ulang</a>
                <span id="timer"></span>
            </p>
        </div>
    </div>
</div>

<script>
    let timer = 60;
    setInterval(countDown, 1000);
    function checkInput(input) {
        if (input.value.length >= input.maxLength) {
            input.nextElementSibling.focus();
        }
    }

    function countDown() {
        timer--;
        document.getElementById("timer").innerHTML = '0' + (Math.floor(timer/60)).toString() + ':' + 
                                                    (timer > 10 ? '' : '0') + (timer%60).toString(); 
    }
</script>