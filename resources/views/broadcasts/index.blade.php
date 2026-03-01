@extends('layouts.app')
@section('title', 'Broadcasts')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Broadcasts</h4>
                <div class="card-header-action">
                    <a href="{{ route('broadcasts.create') }}" class="btn btn-primary">Create Broadcast</a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr><th>Name</th><th>Status</th>@if(auth()->user()->hasRole('super_admin'))<th>Organization</th>@endif<th>Recipients</th><th>Action</th></tr>
                        </thead>
                        <tbody>
                            @foreach($broadcasts as $b)
                            <tr>
                                <td>{{ $b->name }}</td>
                                <td><span class="badge badge-{{ $b->status === 'sent' ? 'success' : 'secondary' }}">{{ $b->status }}</span></td>
                                @if(auth()->user()->hasRole('super_admin'))<td>{{ $b->organization->name ?? '—' }}</td>@endif
                                <td>{{ $b->recipients_count }}</td>
                                <td><a href="{{ route('broadcasts.show', $b) }}" class="btn btn-sm btn-info">View</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @if($broadcasts->hasPages())<div class="card-footer">{{ $broadcasts->links() }}</div>@endif
        </div>
    </div>
</div>
@endsection
