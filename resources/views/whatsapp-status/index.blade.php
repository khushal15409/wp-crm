@extends('layouts.app')
@section('title', 'WhatsApp Status')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header"><h4>WhatsApp Connection Status</h4></div>
            <div class="card-body">
                @if($configured)
                    <dl class="row mb-0">
                        <dt class="col-sm-4">Status</dt>
                        <dd class="col-sm-8">
                            @if($connected)
                                <span class="badge badge-success">Connected</span>
                            @else
                                <span class="badge badge-warning">Configured (check connection)</span>
                            @endif
                        </dd>
                        <dt class="col-sm-4">Phone Number ID</dt>
                        <dd class="col-sm-8">{{ $phone_number_id ?? '—' }}</dd>
                    </dl>
                    <hr>
                    <p class="text-muted mb-0">
                        <i class="fas fa-info-circle"></i> Contact your administrator to change WhatsApp credentials or connection settings.
                    </p>
                @else
                    <p class="text-muted mb-0">No WhatsApp configuration is active. Contact your administrator to set up the connection in System Settings.</p>
                    <p class="text-muted mt-2"><i class="fas fa-info-circle"></i> Contact admin to change WhatsApp credentials.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
