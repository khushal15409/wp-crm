@extends('layouts.app')
@section('title', 'Roles')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card crm-datatable-card">
            <div class="card-header"><h4>Roles (view only)</h4></div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table id="roles-table" class="table table-striped crm-datatable">
                        <thead>
                            <tr><th>Name</th><th>Users</th></tr>
                        </thead>
                        <tbody>
                            @forelse($roles as $role)
                            <tr><td><span class="crm-badge crm-badge--info">{{ $role->name }}</span></td><td>{{ $role->users_count }}</td></tr>
                            @empty
                            <tr><td colspan="2" class="crm-datatable-empty"><span class="crm-datatable-empty-icon">&#128274;</span><br>No roles.</td></tr>
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
    if ($('#roles-table tbody tr').length && !$('#roles-table tbody tr').first().find('.crm-datatable-empty').length) {
        $('#roles-table').DataTable({
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
