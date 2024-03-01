<div style="background-image: url('{{ asset('images/bg_register.png') }}'); height: 100vh; width: 100%; background-size: cover; display: flex; justify-content: center; align-items: center;">
    @once
        <link href="{{ asset('css/register.css') }}" rel="stylesheet">
    @endonce
    <div class="card shadow-lg" style="width: 80%; background-color: white; border-radius: 2rem; padding: 2rem; box-sizing: border-box;">
        <div class="text-center" style="margin-bottom: 2rem;">
            <img src="{{ asset('images/logo_beenefit.png') }}" alt="Beenefit Logo" style="width: 120px; margin-bottom: 1rem;" >
            <h2 style="font-weight: bold;">Registrasi</h2>
        </div>
        <form wire:submit.prevent="register" style="display: flex; flex-direction: column; gap: 1rem;">
            <!-- Row for Email and Name -->
            <div class="flex-row-responsive" style="display: flex; justify-content: space-between; gap: 1rem;">
                <!-- Email input -->
                <div class="form-group" style="flex: 1;">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" wire:model="email" style="border-color: #228B22" class="form-control" placeholder="Masukkan email" >
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Name input -->
                <div class="form-group" style="flex: 1;">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" id="name" wire:model="full_name" style="border-color: #228B22" class="form-control" placeholder="Masukkan nama">
                    @error('full_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <!-- Row for Phone and Password -->
            <div class="flex-row-responsive" style="display: flex; justify-content: space-between; gap: 1rem;">
                <!-- Phone input -->
                <div class="form-group" style="flex: 1;">
                    <label for="phone" class="form-label">Nomor telepon</label>
                    <input type="tel" id="phone" wire:model="phone" style="border-color: #228B22" class="form-control" placeholder="08************">
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Password input -->
                <div class="form-group" style="flex: 1;">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" wire:model="password" style="border-color: #228B22" class="form-control" placeholder="Masukkan password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text" style="font-weight:lighter; text-color:gray;  ">*Minimal 8 characters</div>
                </div>
            </div>
            <!-- Submit button -->
            <div class="text-center" style="margin-top: 1rem;">
                <button type="submit" class="btn btn-warning" style="background-color: #FFD700; border: none; padding: 0.5rem; width: 60%;">Daftar</button>
            </div>
        </form>
        <div class="text-center" style="margin-top: 2rem;">
            <p>Sudah punya akun?
                <a href="{{ route('login') }}" class="text-decoration-none font-weight-bold" style="color: #228B22;">Masuk</a>
            </p>
        </div>
    </div>
</div>
