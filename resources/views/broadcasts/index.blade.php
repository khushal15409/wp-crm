@extends('layouts.app')
@section('title', 'Broadcasts')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card crm-datatable-card">
            <div class="card-header">
                <h4>Broadcasts</h4>
                <div class="card-header-actions">
                    <a href="{{ route('broadcasts.create') }}" class="btn btn-primary">Create Broadcast</a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table id="broadcasts-table" class="table table-striped crm-datatable">
                        <thead>
                            <tr><th>Name</th><th>Status</th>@if(auth()->user()->hasRole('super_admin'))<th>Organization</th>@endif<th>Recipients</th><th>Action</th></tr>
                        </thead>
                        <tbody>
                            @forelse($broadcasts as $b)
                            <tr>
                                <td>{{ $b->name }}</td>
                                <td>@if($b->status === 'sent')<span class="crm-badge crm-badge--success">Sent</span>@else<span class="crm-badge crm-badge--secondary">{{ $b->status }}</span>@endif</td>
                                @if(auth()->user()->hasRole('super_admin'))<td>{{ $b->organization->name ?? '—' }}</td>@endif
                                <td>{{ $b->recipients_count }}</td>
                                <td><div class="crm-btn-group"><a href="{{ route('broadcasts.show', $b) }}" class="btn btn-sm btn-info">View</a></div></td>
                            </tr>
                            @empty
                            <tr><td colspan="{{ auth()->user()->hasRole('super_admin') ? 5 : 4 }}" class="crm-datatable-empty"><span class="crm-datatable-empty-icon">&#128172;</span><br>No broadcasts yet.</td></tr>
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
    if ($('#broadcasts-table tbody tr').length && !$('#broadcasts-table tbody tr').first().find('.crm-datatable-empty').length) {
        $('#broadcasts-table').DataTable({
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            searching: true,
            lengthChange: true,
            order: [[0, 'asc']],
            pageLength: 25,
            columnDefs: [{ orderable: false, searchable: false, targets: -1 }]
        });
    }
});
</script>
@endpush
@endsection
