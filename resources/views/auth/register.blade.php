@extends('layouts.auth')

@section('title', 'Register')

@section('content')
<div class="auth-card card">
    <div class="auth-card-header card-header">
        <h1>Create account</h1>
        <p>Join WP-CRM and manage your WhatsApp leads</p>
    </div>
    <div class="auth-card-body card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('register') }}">
            @csrf
            @if(request('plan_id'))
            <input type="hidden" name="plan_id" value="{{ request('plan_id') }}">
            @endif
            <div class="form-group">
                <label for="organization_name">Organization Name</label>
                <input id="organization_name" type="text" class="form-control" name="organization_name" value="{{ old('organization_name') }}" placeholder="Your company or brand name" required>
            </div>
            <div class="form-group">
                <label for="business_type">Business Type <span class="text-muted">(optional)</span></label>
                <input id="business_type" type="text" class="form-control" name="business_type" value="{{ old('business_type') }}" placeholder="e.g. Real Estate, Agency, Coaching">
            </div>
            <div class="form-group">
                <label for="whatsapp_number">WhatsApp Business Number (with country code)</label>
                <input id="whatsapp_number" type="text" class="form-control" name="whatsapp_number" value="{{ old('whatsapp_number') }}" placeholder="+91 98765 43210" required>
            </div>
            <div class="form-group">
                <label for="name">User Full Name</label>
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Your full name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="your@email.com" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" class="form-control" name="password" placeholder="Choose a password" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" placeholder="Confirm password" required>
            </div>
            <div class="form-group mb-0">
                <button type="submit" class="btn btn-auth btn-lg">Register</button>
            </div>
        </form>
    </div>
</div>
<div class="auth-footer-links">
    <span class="text-muted">Already have an account?</span>
    <a href="{{ route('login') }}">Login</a>
</div>
@endsection
