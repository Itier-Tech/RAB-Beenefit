@extends('layouts.app')

@section('content')
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
            <img src="{{ asset('images/logo_beenefit.png') }}" alt="Beenefit Logo" style="width: 120px; margin-bottom: 1rem;">
            <h2 style="font-weight: bold; margin-bottom: 0.5rem;">Lupa Password</h2>
        </div>
        <form action="/forgot-password" method="POST">
            @csrf
            <!-- Row for Email -->
            <div class="flex-row-responsive" style="display: flex; justify-content: space-between; gap: 1rem;">
                <!-- Email input -->
                <div class="form-group" style="flex: 1;">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" style="border-color: #228B22" class="form-control" placeholder="Masukkan email" >
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <button type="submit">Kirim Link Reset</button>
        </form>
    </div>
</div>