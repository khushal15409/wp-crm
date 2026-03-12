@extends('layouts.app')
@section('title', 'Broadcasts')
@section('page_subtitle', 'Plan and track your WhatsApp broadcast campaigns.')
@section('page_actions')
    <a href="{{ route('broadcasts.create') }}" class="btn btn-primary">Create Broadcast</a>
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card crm-datatable-card">
            <div class="card-header">
                <h4>Broadcasts</h4>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table id="broadcasts-table" class="table table-striped crm-datatable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Status</th>
                                @if(auth()->user()->hasRole('super_admin'))<th>Organization</th>@endif
                                <th>Recipients</th>
                                <th>Scheduled</th>
                                <th>Sent</th>
                                <th>Delivery</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($broadcasts as $b)
                            <tr>
                                <td>{{ $b->name }}</td>
                                <td>@if($b->status === 'sent')<span class="crm-badge crm-badge--success">Sent</span>@else<span class="crm-badge crm-badge--secondary">{{ $b->status }}</span>@endif</td>
                                @if(auth()->user()->hasRole('super_admin'))<td>{{ $b->organization->name ?? '—' }}</td>@endif
                                <td>{{ $b->recipients_count }}</td>
                                <td>{{ $b->scheduled_at ? $b->scheduled_at->format('M d, H:i') : '—' }}</td>
                                <td>{{ $b->sent_at ? $b->sent_at->format('M d, H:i') : '—' }}</td>
                                <td>{{ $b->status === 'sent' ? 'Delivered' : 'Pending' }}</td>
                                <td><div class="crm-btn-group"><a href="{{ route('broadcasts.show', $b) }}" class="btn btn-sm btn-info">View</a></div></td>
                            </tr>
                            @empty
                            <tr><td colspan="{{ auth()->user()->hasRole('super_admin') ? 8 : 7 }}" class="crm-datatable-empty"><span class="crm-datatable-empty-icon">&#128172;</span><br>No broadcasts yet.</td></tr>
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
            order: [[4, 'desc']],
            pageLength: 25,
            columnDefs: [{ orderable: false, searchable: false, targets: -1 }]
        });
    }
});
</script>
@endpush
@endsection
