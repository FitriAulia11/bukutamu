@extends('layouts.app')

@section('content')
<style>
    body {
        background-image: url('{{ asset('img/wikrama1.jpg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }

    .register-container {
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        backdrop-filter: blur(2px);
    }

    .register-card {
        background: rgba(255, 255, 255, 0.9);
        border-radius: 1rem;
        box-shadow: 0 8px 16px rgba(0,0,0,0.3);
    }

    .register-card .card-header {
        background-color: transparent;
        border-bottom: none;
        font-size: 1.5rem;
        font-weight: bold;
        text-align: center;
    }

    .form-control:focus, .form-select:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
    }

    .btn-primary {
        border-radius: 50px;
        padding: 0.5rem 2rem;
    }
</style>

<div class="register-container">
    <div class="col-md-8 col-lg-6">
        <div class="card register-card">
            <div class="card-header">{{ __('Register') }}</div>

            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    {{-- Name --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('Name') }}</label>
                        <input id="name" type="text"
                               class="form-control @error('name') is-invalid @enderror"
                               name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email Address') }}</label>
                        <input id="email" type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                            <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input id="password" type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               name="password" required autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div class="mb-3">
                        <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password"
                               class="form-control"
                               name="password_confirmation" required autocomplete="new-password">
                    </div>

                    {{-- Role --}}
                    <div class="mb-3">
                        <label for="role" class="form-label">{{ __('Daftar sebagai') }}</label>
                        <select name="role" id="role"
                                class="form-select @error('role') is-invalid @enderror" required>
                            <option value="" disabled selected>Pilih role</option>
                            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                        @error('role')
                            <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    {{-- Submit --}}
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Register') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection