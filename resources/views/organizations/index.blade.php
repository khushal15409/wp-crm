@extends('layouts.app')
@section('title', 'Organizations')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card crm-datatable-card">
            <div class="card-header">
                <h4>Organizations</h4>
                <div class="card-header-actions">
                    <a href="{{ route('organizations.create') }}" class="btn btn-primary">Add Organization</a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table id="organizations-table" class="table table-striped crm-datatable">
                        <thead>
                            <tr><th>Name</th><th>Slug</th><th>Users</th><th>Leads</th><th>Active</th><th>Action</th></tr>
                        </thead>
                        <tbody>
                            @forelse($organizations as $org)
                            <tr>
                                <td>{{ $org->name }}</td>
                                <td><code class="text-dark">{{ $org->slug }}</code></td>
                                <td>{{ $org->users_count }}</td>
                                <td>{{ $org->leads_count }}</td>
                                <td>@if($org->is_active)<span class="crm-badge crm-badge--success">Yes</span>@else<span class="crm-badge crm-badge--secondary">No</span>@endif</td>
                                <td>
                                    <div class="crm-btn-group">
                                        <a href="{{ route('organizations.show', $org) }}" class="btn btn-sm btn-info">View</a>
                                        <a href="{{ route('organizations.edit', $org) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('organizations.destroy', $org) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this organization?');">@csrf @method('DELETE')<button type="submit" class="btn btn-sm btn-danger">Delete</button></form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="6" class="crm-datatable-empty"><span class="crm-datatable-empty-icon">&#127970;</span><br>No organizations yet.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
$(function() {
    if ($('#organizations-table tbody tr').length && !$('#organizations-table tbody tr').first().find('.crm-datatable-empty').length) {
        $('#organizations-table').DataTable({
            order: [[0, 'asc']],
            pageLength: 25,
            columnDefs: [{ orderable: false, searchable: false, targets: -1 }]
        });
    }
});
</script>
@endpush
@endsection
