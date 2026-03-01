@extends('layouts.app')
@section('title', 'Pipeline')
@section('content')
<div class="row">
    @foreach($stages as $stage)
    <div class="col-lg-2 col-md-4 col-sm-6">
        <div class="card">
            <div class="card-header">
                <h6 class="text-uppercase">{{ str_replace('_', ' ', $stage) }}</h6>
            </div>
            <div class="card-body p-2">
                @foreach($byStage[$stage] ?? [] as $lead)
                <div class="border rounded p-2 mb-2 small">
                    <strong>{{ $lead->name ?? $lead->phone }}</strong><br>
                    <span class="text-muted">{{ $lead->phone }}</span><br>
                    <a href="{{ route('leads.show', $lead) }}" class="btn btn-sm btn-outline-primary mt-1">View</a>
                </div>
                @endforeach
                @if(empty($byStage[$stage]) || (is_countable($byStage[$stage]) ? count($byStage[$stage]) : 0) === 0)
                <p class="text-muted small mb-0">No leads</p>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
