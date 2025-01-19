@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-primary text-white p-4">
                    <h4 class="mb-0 text-center">{{ __('Create Account') }}</h4>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('register') }}" class="needs-validation" novalidate>
                        @csrf

                        <!-- Name -->
                        <div class="mb-4">
                            <label for="name" class="form-label fw-bold">{{ __('Full Name') }}</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="bi bi-person"></i>
                                </span>
                                <input id="name" type="text"
                                    class="form-control form-control-lg @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}"
                                    placeholder="Enter your full name"
                                    required autocomplete="name" autofocus>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

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
                                    required autocomplete="email">
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
                                    placeholder="Create a password"
                                    required autocomplete="new-password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-text">Password must be at least 8 characters long</div>
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-4">
                            <label for="password-confirm" class="form-label fw-bold">{{ __('Confirm Password') }}</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="bi bi-lock-fill"></i>
                                </span>
                                <input id="password-confirm" type="password"
                                    class="form-control form-control-lg"
                                    name="password_confirmation"
                                    placeholder="Confirm your password"
                                    required autocomplete="new-password">
                            </div>
                        </div>

                        <!-- Role -->
                        <div class="mb-4">
                            <label for="role" class="form-label fw-bold">{{ __('Account Type') }}</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="bi bi-person-badge"></i>
                                </span>
                                <select id="role" name="role"
                                    class="form-select form-select-lg @error('role') is-invalid @enderror"
                                    required>
                                    <option value="" selected disabled>Select account type</option>
                                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-person-plus me-2"></i>{{ __('Create Account') }}
                            </button>
                        </div>

                        <!-- Login Link -->
                        <div class="text-center mt-4">
                            <p class="mb-0">
                                Already have an account?
                                <a href="{{ route('login') }}" class="text-primary text-decoration-none">Login here</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
