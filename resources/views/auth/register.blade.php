@extends('layouts.guest')

@section('content')
<style>
    body {
        margin: 0;
        padding: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(to right, #f8f9fa, #e0eafc);
    }

    .main-container {
        display: flex;
        min-height: 100vh;
    }

    .left-side {
        flex: 1;
        background: url('{{ asset('img/wikrama1.jpg') }}') no-repeat center center;
        background-size: cover;
        position: relative;
    }

    .btn-back-top {
        position: absolute;
        top: 20px;
        left: 20px;
        background-color: rgba(255, 255, 255, 0.9);
        padding: 0.4rem 1rem;
        border-radius: 30px;
        text-decoration: none;
        color: #007bff;
        font-size: 0.9rem;
        font-weight: 500;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        transition: 0.3s;
    }

    .btn-back-top:hover {
        background-color: #007bff;
        color: white;
    }

    .right-side {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(to right, #ffffff, #f0f4ff);
    }

    .register-box {
        width: 100%;
        max-width: 460px;
        padding: 2.5rem;
        background-color: #ffffff;
        border-radius: 1.5rem;
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.1);
        animation: fadeIn 0.6s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .logo {
        display: block;
        margin: 0 auto 1.5rem auto;
        max-width: 100px;
    }

    h4 {
        font-weight: 600;
        text-align: center;
        color: #343a40;
        margin-bottom: 1.5rem;
    }

    .form-label {
        font-weight: 500;
        color: #495057;
    }

    .form-control, .form-select {
        border-radius: 0.6rem;
        padding: 0.6rem 1rem;
        transition: border-color 0.3s;
    }

    .form-control:focus, .form-select:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.2);
    }

    .btn-primary {
        border-radius: 50px;
        padding: 0.6rem 2rem;
        width: 100%;
        background-color: #007bff;
        border: none;
        font-weight: 600;
        transition: background-color 0.3s;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .login-link {
        text-align: center;
        margin-top: 1.5rem;
        font-size: 0.95rem;
    }

    .login-link a {
        color: #007bff;
        text-decoration: none;
        font-weight: 500;
    }

    .login-link a:hover {
        text-decoration: underline;
    }

    .invalid-feedback {
        font-size: 0.85rem;
        color: #dc3545;
    }
</style>

<div class="main-container">
    <div class="left-side">
        <!-- Tombol Kembali di kiri atas -->
        <a href="{{ url('/') }}" class="btn-back-top">← Kembali</a>
    </div>

    <div class="right-side">
        <div class="register-box">
            <img src="{{ asset('img/logo.png') }}" alt="Logo Wikrama" class="logo">
            <h4>{{ __('Buat Akun Baru') }}</h4>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                {{-- Name --}}
                <div class="mb-3">
                    <label for="name" class="form-label">{{ __('Nama Lengkap') }}</label>
                    <input id="name" type="text"
                           class="form-control @error('name') is-invalid @enderror"
                           name="name" value="{{ old('name') }}" required autofocus>
                    @error('name')
                        <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email') }}</label>
                    <input id="email" type="email"
                           class="form-control @error('email') is-invalid @enderror"
                           name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <input id="password" type="password"
                           class="form-control @error('password') is-invalid @enderror"
                           name="password" required>
                    @error('password')
                        <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div class="mb-3">
                    <label for="password-confirm" class="form-label">{{ __('Konfirmasi Password') }}</label>
                    <input id="password-confirm" type="password"
                           class="form-control"
                           name="password_confirmation" required>
                </div>

                {{-- Role --}}
                <div class="mb-3">
                    <label for="role" class="form-label">{{ __('Daftar Sebagai') }}</label>
                    <select name="role" id="role"
                            class="form-select @error('role') is-invalid @enderror" required>
                        <option value="" disabled selected>Pilih Role</option>
                        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                    @error('role')
                        <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn btn-primary">{{ __('Daftar') }}</button>
            </form>

            <div class="login-link">
                <p>Sudah punya akun? <a href="{{ route('login') }}">Login Sekarang</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
