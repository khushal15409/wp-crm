@extends('layouts.app')
@section('title', 'Lead')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Lead: {{ $lead->name ?? $lead->phone }}</h4>
                <div class="card-header-action">
                    <a href="{{ route('leads.edit', $lead) }}" class="btn btn-warning">Edit</a>
                </div>
            </div>
            <div class="card-body">
                <p><strong>Phone:</strong> {{ $lead->phone }}</p>
                <p><strong>Name:</strong> {{ $lead->name ?? '—' }}</p>
                <p><strong>Email:</strong> {{ $lead->email ?? '—' }}</p>
                <p><strong>Stage:</strong> {{ $lead->stage }}</p>
                <p><strong>Source:</strong> {{ $lead->source }}</p>
                @if(auth()->user()->hasRole('super_admin'))<p><strong>Organization:</strong> {{ $lead->organization->name ?? '—' }}</p>@endif
                <p><strong>Notes:</strong> {{ $lead->notes ?? '—' }}</p>
                <a href="{{ route('leads.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
</div>
@endsection
