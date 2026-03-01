@extends('layouts.app')
@section('title', 'WhatsApp Configuration')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>WhatsApp API Configuration</h4>
                <div class="card-header-action">
                    <a href="{{ route('whatsapp-settings.edit', $whatsappSetting) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('whatsapp-settings.test', $whatsappSetting) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-info">Test connection</button>
                    </form>
                    <a href="{{ route('whatsapp-settings.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <dl class="row">
                    <dt class="col-sm-3">Provider</dt>
                    <dd class="col-sm-9">{{ ucfirst($whatsappSetting->provider) }}</dd>
                    <dt class="col-sm-3">App ID</dt>
                    <dd class="col-sm-9"><code>{{ $whatsappSetting->app_id ?? '—' }}</code></dd>
                    <dt class="col-sm-3">Phone Number ID</dt>
                    <dd class="col-sm-9"><code>{{ $whatsappSetting->phone_number_id ?? '—' }}</code></dd>
                    <dt class="col-sm-3">Business Account ID</dt>
                    <dd class="col-sm-9">{{ $whatsappSetting->business_account_id ?? '—' }}</dd>
                    <dt class="col-sm-3">Access Token</dt>
                    <dd class="col-sm-9"><span class="text-muted">••••••••</span> <small>(never displayed)</small></dd>
                    <dt class="col-sm-3">Status</dt>
                    <dd class="col-sm-9">
                        @if($whatsappSetting->status === 'active')
                            <span class="badge badge-success">Connected</span>
                        @else
                            <span class="badge badge-danger">Not Connected</span>
                        @endif
                    </dd>
                    <dt class="col-sm-3">Last updated</dt>
                    <dd class="col-sm-9">{{ $whatsappSetting->updated_at->format('M j, Y H:i') }}</dd>
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection
