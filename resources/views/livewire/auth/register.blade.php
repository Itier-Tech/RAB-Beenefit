<style>
    @media (max-width: 768px) {
      .flex-row-responsive {
        flex-direction: column;
      }
    }
    .form-control:focus {
      border-color: #28a745 !important;
    }
  </style>

<div style="background-image: url('{{ asset('images/bg_register.png') }}'); height: 100vh; width: 100%; background-size: cover; display: flex; justify-content: center; align-items: center;">
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
                    <input type="email" id="email" wire:model="email" style="border-color: #228B22" class="form-control" placeholder="Enter your email" >
                    <!-- Error message for email -->
                </div>
                <!-- Name input -->
                <div class="form-group" style="flex: 1;">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" id="name" wire:model="name" style="border-color: #228B22" class="form-control" placeholder="Enter your name">
                    <!-- Error message for name -->
                </div>
            </div>
            <!-- Row for Phone and Password -->
            <div class="flex-row-responsive" style="display: flex; justify-content: space-between; gap: 1rem;">
                <!-- Phone input -->
                <div class="form-group" style="flex: 1;">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="tel" id="phone" wire:model="phone" style="border-color: #228B22" class="form-control" placeholder="08************">
                    <!-- Error message for phone -->
                </div>
                <!-- Password input -->
                <div class="form-group" style="flex: 1;">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" wire:model="password" style="border-color: #228B22" class="form-control" placeholder="Enter your password">
                    <div class="form-text" style="font-weight:lighter; text-color:gray;  ">*Minimal 8 karakter</div>
                    <!-- Error message for password -->
                </div>
            </div>
            <!-- Submit button -->
            <div class="text-center" style="margin-top: 1rem;">
                <button type="submit" class="btn btn-warning" style="background-color: #FFD700; border: none; padding: 0.5rem; width: 60%;">Daftar</button>
        </div>
        </form>
        <div class="text-center" style="margin-top: 2rem;">
            <p>Sudah punya akun?
                <a href="#" class="text-decoration-none font-weight-bold" style="color: #228B22;">Masuk</a>
            </p>
        </div>

    </div>
</div>