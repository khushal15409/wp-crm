@extends('layouts.app')
@section('title', 'Follow-ups')
@section('page_subtitle', 'Stay on top of your reminders and never miss a follow-up.')
@section('page_actions')
    <a href="{{ route('follow-ups.create') }}" class="btn btn-primary">Add Follow-up</a>
@endsection
@section('content')
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header"><h4>Today's Follow-ups</h4></div>
            <div class="card-body">
                @forelse($todayFollowUps as $fu)
                    <div class="mb-3">
                        <div class="font-weight-600">{{ $fu->lead->name ?? $fu->lead->phone }}</div>
                        <div class="text-muted small">{{ $fu->due_at->format('M d, H:i') }}</div>
                        <div class="text-muted small">{{ $fu->notes ? \Illuminate\Support\Str::limit($fu->notes, 40) : '—' }}</div>
                        @if($fu->status !== 'done')
                            <form action="{{ route('follow-ups.update-status', $fu) }}" method="POST" class="d-inline">@csrf @method('PUT')<input type="hidden" name="status" value="done"><button type="submit" class="btn btn-sm btn-success mt-2">Mark Done</button></form>
                        @endif
                    </div>
                @empty
                    <p class="text-muted mb-0">No follow-ups due today.</p>
                @endforelse
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header"><h4>Upcoming Follow-ups</h4></div>
            <div class="card-body">
                @forelse($upcomingFollowUps as $fu)
                    <div class="mb-3">
                        <div class="font-weight-600">{{ $fu->lead->name ?? $fu->lead->phone }}</div>
                        <div class="text-muted small">{{ $fu->due_at->format('M d, H:i') }}</div>
                        <div class="text-muted small">{{ $fu->notes ? \Illuminate\Support\Str::limit($fu->notes, 40) : '—' }}</div>
                    </div>
                @empty
                    <p class="text-muted mb-0">No upcoming follow-ups.</p>
                @endforelse
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header"><h4>Overdue Follow-ups</h4></div>
            <div class="card-body">
                @forelse($overdueFollowUps as $fu)
                    <div class="mb-3">
                        <div class="font-weight-600">{{ $fu->lead->name ?? $fu->lead->phone }}</div>
                        <div class="text-muted small">{{ $fu->due_at->format('M d, H:i') }}</div>
                        <div class="text-danger small">Overdue</div>
                        @if($fu->status !== 'done')
                            <form action="{{ route('follow-ups.update-status', $fu) }}" method="POST" class="d-inline">@csrf @method('PUT')<input type="hidden" name="status" value="done"><button type="submit" class="btn btn-sm btn-danger mt-2">Resolve</button></form>
                        @endif
                    </div>
                @empty
                    <p class="text-muted mb-0">No overdue follow-ups.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card crm-datatable-card">
            <div class="card-header">
                <h4>All Follow-ups</h4>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table id="followups-table" class="table table-striped crm-datatable">
                        <thead>
                            <tr><th>Lead</th><th>Due at</th><th>Status</th><th>Notes</th><th>Action</th></tr>
                        </thead>
                        <tbody>
                            @forelse($followUps as $fu)
                            <tr>
                                <td><a href="{{ route('leads.show', $fu->lead) }}">{{ $fu->lead->name ?? $fu->lead->phone }}</a></td>
                                <td>{{ $fu->due_at->format('M d, Y H:i') }}</td>
                                <td>
                                    @if($fu->status === 'done')
                                    <span class="crm-badge crm-badge--success">Done</span>
                                    @elseif($fu->status === 'missed')
                                    <span class="crm-badge crm-badge--danger">Missed</span>
                                    @else
                                    <span class="crm-badge crm-badge--warning">Pending</span>
                                    @endif
                                </td>
                                <td>{{ $fu->notes ? \Illuminate\Support\Str::limit($fu->notes, 30) : '—' }}</td>
                                <td>
                                    @if($fu->status !== 'done')
                                    <form action="{{ route('follow-ups.update-status', $fu) }}" method="POST" class="d-inline">@csrf @method('PUT')<input type="hidden" name="status" value="done"><button type="submit" class="btn btn-sm btn-success">Done</button></form>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="5" class="crm-datatable-empty"><span class="crm-datatable-empty-icon">&#128336;</span><br>No follow-ups.</td></tr>
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
    if ($('#followups-table tbody tr').length && !$('#followups-table tbody tr').first().find('.crm-datatable-empty').length) {
        $('#followups-table').DataTable({
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            searching: true,
            lengthChange: true,
            order: [[1, 'asc']],
            pageLength: 25,
            columnDefs: [{ orderable: false, searchable: false, targets: -1 }]
        });
    }
});
</script>
@endpush
@endsection
