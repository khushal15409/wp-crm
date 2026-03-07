@extends('layouts.app')
@section('title', 'Users')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card crm-datatable-card">
            <div class="card-header">
                <h4>Users</h4>
                <div class="card-header-actions">
                    <a href="{{ route('users.create') }}" class="btn btn-primary">Add User</a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table id="users-table" class="table table-striped crm-datatable">
                        <thead>
                            <tr><th>Name</th><th>Email</th><th>Role</th><th>Organization</th></tr>
                        </thead>
                        <tbody>
                            @forelse($users as $u)
                            <tr>
                                <td>{{ $u->name }}</td>
                                <td>{{ $u->email }}</td>
                                <td><span class="crm-badge crm-badge--info">{{ $u->getRoleNames()->first() ?? '—' }}</span></td>
                                <td>{{ $u->organization->name ?? '—' }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="crm-datatable-empty"><span class="crm-datatable-empty-icon">&#128100;</span><br>No users found.</td></tr>
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
    if ($('#users-table tbody tr').length && !$('#users-table tbody tr').first().find('.crm-datatable-empty').length) {
        $('#users-table').DataTable({
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            searching: true,
            lengthChange: true,
            order: [[0, 'asc']],
            pageLength: 25
        });
    }
});
</script>
@endpush
@endsection
