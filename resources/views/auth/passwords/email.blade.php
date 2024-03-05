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
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="text-center" style="margin-bottom: 2rem;">
            <img src="{{ asset('images/logo_beenefit.png') }}" alt="Beenefit Logo" style="width: 120px; margin-bottom: 1rem;" >
            <h2 style="font-weight: bold;">Lupa password</h2>
        </div>
        <form method="POST" action="{{ route('password.email') }}" style="display: flex; flex-direction: column; gap: 1rem;">
            @csrf
            <!-- Row for Email -->
            <div class="flex-row-responsive" style="display: flex; justify-content: space-between; gap: 1rem;">
                <!-- Email input -->
                <div class="form-group" style="flex: 1;">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus style="border-color: #228B22" placeholder="Enter your email" >
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <!-- Submit button -->
            <div class="text-center" style="margin-top: 1rem;">
                <button type="submit" class="btn btn-warning" style="background-color: #FFD700; border: none; padding: 0.5rem; width: 60%;">Kirim Link</button>
            </div>
        </form>
    </div>
</div>
@endsection
