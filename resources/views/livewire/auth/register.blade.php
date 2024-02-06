<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4">
                <div class="card-body">
                    <form wire:submit.prevent="register">
                        <h3 class="text-center mb-4">Registrasi</h3>
                        <div class="d-flex flex-row gap-4 justify-content-center">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" wire:model="email">
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" wire:model="name">
                            </div>
                        </div>
                        <div class="d-flex flex-row gap-4 justify-content-center">
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="tel" class="form-control" id="phone" wire:model="phone">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" wire:model="password">
                                <small class="form-text text-muted">Minimal 8 karakter</small>
                            </div>
                        </div>
                        <div class="d-flex flex-column align-items-center">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Daftar</button>
                            </div>
                        </div>
                        <div class="text-center">
                            <a href="/login">Sudah punya akun? Masuk</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
