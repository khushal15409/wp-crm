@extends('layouts.app')
@section('title', 'Pipeline')
@section('page_subtitle', 'Visualize deal stages and move leads across your sales workflow.')
@section('content')
<div class="pipeline-board">
    @foreach($stages as $stage)
        <div class="pipeline-column">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <h6 class="text-uppercase mb-0">{{ str_replace('_', ' ', $stage) }}</h6>
                <span class="badge badge-light">{{ is_countable($byStage[$stage] ?? []) ? count($byStage[$stage] ?? []) : 0 }}</span>
            </div>
            @foreach($byStage[$stage] ?? [] as $lead)
                <div class="pipeline-card">
                    <div class="font-weight-600">{{ $lead->name ?? $lead->phone }}</div>
                    <div class="lead-meta">{{ $lead->phone }}</div>
                    <div class="lead-meta">Deal value: —</div>
                    <div class="lead-meta">Next follow-up: —</div>
                    <div class="mt-2 pipeline-actions">
                        <a href="{{ route('leads.show', $lead) }}" class="btn btn-sm btn-outline-primary">View</a>
                        <a href="{{ route('leads.edit', $lead) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                        <a href="{{ route('follow-ups.create') }}" class="btn btn-sm btn-outline-info">Follow-up</a>
                    </div>
                </div>
            @endforeach
            @if(empty($byStage[$stage]) || (is_countable($byStage[$stage]) ? count($byStage[$stage]) : 0) === 0)
                <p class="text-muted small mb-0">No leads</p>
            @endif
        </div>
    @endforeach
</div>
@endsection
