<div style="background-image: url('{{ url('images/bg_register.png') }}'); height: 100vh; background-size: cover; display: flex; justify-content: center; align-items: center;">
    <div class="card shadow-lg" style="max-width: 90%; width: 100%; max-height: 90%; height: 100%; background-color: white; border-radius: 2rem; display: flex; justify-content: center; align-items: center;">
        <div class="card-body p-16" style="display: flex-row; justify-content: center; align-items: center; padding:16">
            <div class="py-4">
                <img src="{{ url('images/logo_beenefit.png') }}" alt="Beenefit Logo" class="img-fluid" style="width: 100px; margin-bottom: 10px;">
            </div>
            <form wire:submit.prevent="register">
                <div class="form-group mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" wire:model="email" class="form-control" placeholder="Enter your email">
                </div>
                <div class="form-group mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" id="name" wire:model="name" class="form-control" placeholder="Enter your name">
                </div>
                <div class="form-group mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="tel" id="phone" wire:model="phone" class="form-control" placeholder="Enter your phone number">
                </div>
                <div class="form-group mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" wire:model="password" class="form-control" placeholder="Enter your password">
                    <div class="form-text">*Minimal 8 karakter</div>
                </div>
                <button type="submit" class="d-flex btn btn-warning w-10rem" style="background-color: #FFD700; border: none;">Daftar</button>
            </form>
            <div class="mt-3">
                <a href="#" class="text-decoration-none">Sudah punya akun? Masuk</a>
            </div>
        </div>
    </div>
</div>
