@extends('layouts.app')

@section('content')
<div style="background-image: url('{{ asset('images/bg_register.png') }}'); height: 100vh; width: 100%; background-size: cover; display: flex; justify-content: center; align-items: center;">
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
    <div class="card shadow-lg" style="width: 80%; background-color: white; border-radius: 2rem; padding: 2rem; box-sizing: border-box;">
        <div class="text-center" style="margin-bottom: 2rem;">
            <img src="{{ asset('images/logo_beenefit.png') }}" alt="Beenefit Logo" style="width: 120px; margin-bottom: 1rem;" >
            <h2 style="font-weight: bold;">{{ __('Reset Password') }}</h2>
        </div>
        <form method="POST" action="{{ route('password.update') }}" style="display: flex; flex-direction: column; gap: 1rem;">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">
            <!-- Row for Email -->
            <div class="flex-row-responsive" style="display: flex; justify-content: space-between; gap: 1rem;">
                <!-- Email input -->
                <div class="form-group" style="flex: 1;">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus style="border-color: #228B22" placeholder="Enter your email" >
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <!-- Row for Password -->
            <div class="flex-row-responsive" style="display: flex; justify-content: space-between; gap: 1rem;">
                <!-- Password input -->
                <div class="form-group" style="flex: 1;">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" style="border-color: #228B22" placeholder="Enter your new password" >
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <!-- Row for Confirm Password -->
            <div class="flex-row-responsive" style="display: flex; justify-content: space-between; gap: 1rem;">
                <!-- Confirm password input -->
                <div class="form-group" style="flex: 1;">
                    <label for="password-confirm" class="form-label">Confirm Password</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" style="border-color: #228B22" placeholder="Confirm password" >
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <!-- Submit button -->
            <div class="text-center" style="margin-top: 1rem;">
                <button type="submit" class="btn btn-warning" style="background-color: #FFD700; border: none; padding: 0.5rem; width: 60%;">Reset Password</button>
            </div>
        </form>
    </div>
</div>
@endsection