@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="auth-card card">
    <div class="auth-card-header card-header">
        <h1>Welcome back</h1>
        <p>Sign in to your account</p>
    </div>
    <div class="auth-card-body card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter your email" required autofocus>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter your password" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="remember" class="custom-control-input" id="remember-me">
                    <label class="custom-control-label" for="remember-me">Remember Me</label>
                </div>
            </div>
            <div class="form-group mb-0">
                <button type="submit" class="btn btn-auth btn-lg">Login</button>
            </div>
        </form>
    </div>
</div>
<div class="auth-footer-links">
    <span class="text-muted">Don't have an account?</span>
    <a href="{{ route('register') }}">Create One</a>
</div>
@endsection
