@extends('layouts.app')
@section('title', $organization->name)
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>{{ $organization->name }}</h4>
                <div class="card-header-action">
                    <a href="{{ route('organizations.edit', $organization) }}" class="btn btn-warning">Edit</a>
                </div>
            </div>
            <div class="card-body">
                <p><strong>Slug:</strong> {{ $organization->slug }}</p>
                <p><strong>Email:</strong> {{ $organization->email ?? '—' }}</p>
                <p><strong>Phone:</strong> {{ $organization->phone ?? '—' }}</p>
                <p><strong>Address:</strong> {{ $organization->address ?? '—' }}</p>
                <p><strong>Active:</strong> {{ $organization->is_active ? 'Yes' : 'No' }}</p>
                <p><strong>Users:</strong> {{ $organization->users_count }}</p>
                <p><strong>Leads:</strong> {{ $organization->leads_count }}</p>
                <a href="{{ route('organizations.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
</div>
@endsection
