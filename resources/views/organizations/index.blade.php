@extends('layouts.app')
@section('title', 'Organizations')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Organizations</h4>
                <div class="card-header-action">
                    <a href="{{ route('organizations.create') }}" class="btn btn-primary">Add Organization</a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr><th>Name</th><th>Slug</th><th>Users</th><th>Leads</th><th>Active</th><th>Action</th></tr>
                        </thead>
                        <tbody>
                            @foreach($organizations as $org)
                            <tr>
                                <td>{{ $org->name }}</td>
                                <td>{{ $org->slug }}</td>
                                <td>{{ $org->users_count }}</td>
                                <td>{{ $org->leads_count }}</td>
                                <td>{{ $org->is_active ? 'Yes' : 'No' }}</td>
                                <td>
                                    <a href="{{ route('organizations.show', $org) }}" class="btn btn-sm btn-info">View</a>
                                    <a href="{{ route('organizations.edit', $org) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('organizations.destroy', $org) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this organization?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @if($organizations->hasPages())
            <div class="card-footer">{{ $organizations->links() }}</div>
            @endif
        </div>
    </div>
</div>
@endsection
