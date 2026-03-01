@extends('layouts.app')
@section('title', 'Add WhatsApp API Configuration')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header"><h4>Add WhatsApp API Configuration</h4></div>
            <div class="card-body">
                <p class="text-muted">Credentials are stored securely and never exposed to the frontend. Use Meta (Facebook) Business credentials.</p>
                <form action="{{ route('whatsapp-settings.store') }}" method="POST" id="whatsapp-form">
                    @csrf
                    <input type="hidden" name="provider" value="meta">
                    <div class="form-group">
                        <label>App ID <span class="text-danger">*</span></label>
                        <input type="text" name="app_id" class="form-control" value="{{ old('app_id') }}" required>
                        @error('app_id')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label>App Secret <span class="text-danger">*</span></label>
                        <input type="password" name="app_secret" class="form-control" required autocomplete="off">
                        @error('app_secret')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label>Phone Number ID <span class="text-danger">*</span></label>
                        <input type="text" name="phone_number_id" class="form-control" value="{{ old('phone_number_id') }}" required>
                        @error('phone_number_id')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label>Business Account ID</label>
                        <input type="text" name="business_account_id" class="form-control" value="{{ old('business_account_id') }}">
                        @error('business_account_id')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label>Access Token <span class="text-danger">*</span></label>
                        <input type="password" name="access_token" class="form-control" required autocomplete="off">
                        <small class="form-text text-muted">Never shared or displayed after save.</small>
                        @error('access_token')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label>Webhook Verify Token</label>
                        <input type="text" name="webhook_verify_token" class="form-control" value="{{ old('webhook_verify_token') }}">
                        @error('webhook_verify_token')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="inactive" {{ old('status', 'inactive') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                            <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Active (use this configuration)</option>
                        </select>
                        <small class="form-text text-muted">Only one configuration can be active system-wide.</small>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save &amp; Test connection</button>
                        <a href="{{ route('whatsapp-settings.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
