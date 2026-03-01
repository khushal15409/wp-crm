@extends('layouts.app')
@section('title', 'System Settings')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header"><h4>System Settings</h4></div>
            <div class="card-body">
                <p class="text-muted">WhatsApp API credentials, Meta webhook token, default plan limits, app name, logo, support email, system flags.</p>
                <form action="{{ route('settings.update') }}" method="POST">
                    @csrf @method('PUT')
                    <input type="hidden" name="settings[0][key]" value="app_name">
                    <input type="hidden" name="settings[0][group]" value="app">
                    <div class="form-group"><label>App name</label><input type="text" name="settings[0][value]" class="form-control" value="{{ \App\Models\Setting::get('app_name', config('app.name')) }}"></div>
                    <input type="hidden" name="settings[1][key]" value="support_email">
                    <input type="hidden" name="settings[1][group]" value="app">
                    <div class="form-group"><label>Support email</label><input type="email" name="settings[1][value]" class="form-control" value="{{ \App\Models\Setting::get('support_email') }}"></div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
