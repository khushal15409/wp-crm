@extends('layouts.app')
@section('title', 'Edit WhatsApp API Configuration')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header"><h4>Edit WhatsApp API Configuration</h4></div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <p class="text-muted">Leave access token and app secret blank to keep current values. They are never displayed.</p>
                <form action="{{ route('whatsapp-settings.update', $whatsappSetting) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="provider" value="meta">
                    <div class="form-group">
                        <label>App ID <span class="text-danger">*</span></label>
                        <input type="text" name="app_id" class="form-control" value="{{ old('app_id', $whatsappSetting->app_id) }}" required>
                        @error('app_id')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label>App Secret <small class="text-muted">(leave blank to keep current)</small></label>
                        <input type="password" name="app_secret" class="form-control" autocomplete="new-password" placeholder="••••••••">
                        @error('app_secret')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label>Phone Number ID <span class="text-danger">*</span></label>
                        <input type="text" name="phone_number_id" class="form-control" value="{{ old('phone_number_id', $whatsappSetting->phone_number_id) }}" required>
                        @error('phone_number_id')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label>Business Account ID</label>
                        <input type="text" name="business_account_id" class="form-control" value="{{ old('business_account_id', $whatsappSetting->business_account_id) }}">
                        @error('business_account_id')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label>Access Token <small class="text-muted">(leave blank to keep current)</small></label>
                        <input type="password" name="access_token" class="form-control" autocomplete="new-password" placeholder="••••••••">
                        @error('access_token')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label>Webhook Verify Token</label>
                        <input type="text" name="webhook_verify_token" class="form-control" value="{{ old('webhook_verify_token', $whatsappSetting->webhook_verify_token) }}">
                        @error('webhook_verify_token')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label>Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-control" required>
                            <option value="inactive" {{ old('status', $whatsappSetting->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                            <option value="active" {{ old('status', $whatsappSetting->status) === 'active' ? 'selected' : '' }}>Active</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <form action="{{ route('whatsapp-settings.test', $whatsappSetting) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-info">Test connection</button>
                        </form>
                        <a href="{{ route('whatsapp-settings.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
