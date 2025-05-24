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

    .login-container {
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        backdrop-filter: blur(2px);
    }

    .login-card {
        background: rgba(255, 255, 255, 0.9);
        border: none;
        border-radius: 1rem;
        box-shadow: 0 8px 16px rgba(0,0,0,0.3);
    }

    .login-card .card-header {
        background-color: transparent;
        border-bottom: none;
        font-size: 1.5rem;
        font-weight: bold;
        text-align: center;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
    }

    .btn-primary {
        border-radius: 50px;
        padding: 0.5rem 2rem;
    }
</style>

<div class="login-container">
    <div class="col-md-6 col-lg-5">
        <div class="card login-card">
            <div class="card-header">{{ __('Login') }}</div>

            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email Address') }}</label>
                        <input id="email" type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                        <span class="invalid-feedback d-block">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input id="password" type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               name="password" required autocomplete="current-password">
                        @error('password')
                        <span class="invalid-feedback d-block">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-3 form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                               {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Login') }}
                        </button>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
