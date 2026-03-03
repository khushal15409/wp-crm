@extends('layouts.app')
@section('title', 'System Settings')
@section('content')
<div class="row">
    <div class="col-12">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <div class="card">
            <div class="card-header"><h4>System Settings</h4></div>
            <div class="card-body">
                <form action="{{ route('settings.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <h5 class="mb-3">App</h5>
                    <p class="text-muted small">App name and support contact.</p>
                    <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <input type="hidden" name="settings[0][key]" value="app_name">
                            <input type="hidden" name="settings[0][group]" value="app">
                            <div class="form-group">
                                <label>App name</label>
                                <input type="text" name="settings[0][value]" class="form-control" value="{{ \App\Models\Setting::get('app_name', config('app.name')) }}">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <input type="hidden" name="settings[1][key]" value="support_email">
                            <input type="hidden" name="settings[1][group]" value="app">
                            <div class="form-group">
                                <label>Support email</label>
                                <input type="email" name="settings[1][value]" class="form-control" value="{{ \App\Models\Setting::get('support_email') }}">
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">
                    <h5 class="mb-3">WhatsApp Cloud API</h5>
                    <p class="text-muted small">Credentials used system-wide for WhatsApp Cloud API. Only Super Admins can view or change these.</p>
                    <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <input type="hidden" name="settings[2][key]" value="whatsapp_base_url">
                            <input type="hidden" name="settings[2][group]" value="whatsapp">
                            <div class="form-group">
                                <label>Base URL</label>
                                <input type="text" name="settings[2][value]" class="form-control" value="{{ setting('whatsapp_base_url') }}" placeholder="e.g. https://graph.facebook.com/v21.0">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <input type="hidden" name="settings[3][key]" value="whatsapp_phone_number_id">
                            <input type="hidden" name="settings[3][group]" value="whatsapp">
                            <div class="form-group">
                                <label>Phone Number ID</label>
                                <input type="text" name="settings[3][value]" class="form-control" value="{{ setting('whatsapp_phone_number_id') }}">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <input type="hidden" name="settings[4][key]" value="whatsapp_business_account_id">
                            <input type="hidden" name="settings[4][group]" value="whatsapp">
                            <div class="form-group">
                                <label>Business Account ID</label>
                                <input type="text" name="settings[4][value]" class="form-control" value="{{ setting('whatsapp_business_account_id') }}">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <input type="hidden" name="settings[5][key]" value="whatsapp_access_token">
                            <input type="hidden" name="settings[5][group]" value="whatsapp">
                            <div class="form-group">
                                <label>Access Token</label>
                                <input type="password" name="settings[5][value]" class="form-control" value="" autocomplete="off" placeholder="Paste to update (leave blank to keep)">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <input type="hidden" name="settings[6][key]" value="whatsapp_verify_token">
                            <input type="hidden" name="settings[6][group]" value="whatsapp">
                            <div class="form-group">
                                <label>Verify Token</label>
                                <input type="password" name="settings[6][value]" class="form-control" value="" autocomplete="off" placeholder="Webhook verify token">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <input type="hidden" name="settings[7][key]" value="whatsapp_default_organization_id">
                            <input type="hidden" name="settings[7][group]" value="whatsapp">
                            <div class="form-group">
                                <label>Default Organization ID (incoming leads)</label>
                                <input type="number" name="settings[7][value]" class="form-control" value="{{ setting('whatsapp_default_organization_id') }}" placeholder="Optional">
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <form action="{{ route('settings.test-whatsapp') }}" method="POST" class="d-inline ml-2">
                            @csrf
                            <button type="submit" class="btn btn-outline-secondary">Test WhatsApp Connection</button>
                        </form>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
