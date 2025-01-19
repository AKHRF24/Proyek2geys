@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-primary text-white p-4">
                    <h4 class="mb-0 text-center">{{ __('Welcome Back') }}</h4>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
                        @csrf

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="form-label fw-bold">{{ __('Email Address') }}</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="bi bi-envelope"></i>
                                </span>
                                <input id="email" type="email"
                                    class="form-control form-control-lg @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}"
                                    placeholder="Enter your email"
                                    required autocomplete="email" autofocus>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <label for="password" class="form-label fw-bold">{{ __('Password') }}</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="bi bi-lock"></i>
                                </span>
                                <input id="password" type="password"
                                    class="form-control form-control-lg @error('password') is-invalid @enderror"
                                    name="password"
                                    placeholder="Enter your password"
                                    required autocomplete="current-password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Remember Me -->
                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember"
                                    id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-box-arrow-in-right me-2"></i>{{ __('Sign In') }}
                            </button>
                        </div>

                        <!-- Forgot Password -->
                        @if (Route::has('password.request'))
                            <div class="text-center mt-4">
                                <a class="text-decoration-none" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        @endif

                        <!-- Register Link -->
                        <div class="text-center mt-4">
                            <p class="mb-0">
                                Don't have an account?
                                <a href="{{ route('register') }}" class="text-primary text-decoration-none">Register here</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
