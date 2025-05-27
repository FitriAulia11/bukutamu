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

    .login-box {
        width: 100%;
        max-width: 420px;
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

    .form-control {
        border-radius: 0.6rem;
        padding: 0.6rem 1rem;
        transition: border-color 0.3s;
    }

    .form-control:focus {
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

    .form-check-label {
        font-size: 0.9rem;
        color: #6c757d;
    }

    .text-center a {
        font-size: 0.9rem;
        color: #007bff;
        text-decoration: none;
    }

    .text-center a:hover {
        text-decoration: underline;
    }

    .register-link {
        text-align: center;
        margin-top: 1.5rem;
        font-size: 0.95rem;
    }

    .register-link a {
        color: #007bff;
        text-decoration: none;
        font-weight: 500;
    }

    .register-link a:hover {
        text-decoration: underline;
    }
</style>

<div class="main-container">
    <div class="left-side">
        <a href="{{ url('/') }}" class="btn-back-top">← Kembali</a>
    </div>

    <div class="right-side">
        <div class="login-box">
            <img src="{{ asset('img/logo.png') }}" alt="Logo Wikrama" class="logo">

            <h4>{{ __('Login ke Akun Anda') }}</h4>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email') }}</label>
                    <input id="email" type="email"
                           class="form-control @error('email') is-invalid @enderror"
                           name="email" value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <span class="text-danger small d-block mt-1"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <input id="password" type="password"
                           class="form-control @error('password') is-invalid @enderror"
                           name="password" required>
                    @error('password')
                        <span class="text-danger small d-block mt-1"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" name="remember" id="remember"
                           {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">{{ __('Ingat Saya') }}</label>
                </div>

                <button type="submit" class="btn btn-primary">{{ __('Masuk') }}</button>

                @if (Route::has('password.request'))
                    <div class="text-center mt-3">
                        <a href="{{ route('password.request') }}">{{ __('Lupa Password?') }}</a>
                    </div>
                @endif
            </form>

            <div class="register-link">
                <p>Belum punya akun? <a href="{{ route('register') }}">Daftar Sekarang</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
