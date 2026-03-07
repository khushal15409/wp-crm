@extends('layouts.app')
@section('title', 'Subscriptions')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card crm-datatable-card">
            <div class="card-header"><h4>Subscriptions</h4></div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table id="subscriptions-table" class="table table-striped crm-datatable">
                        <thead>
                            <tr><th>Organization</th><th>Plan</th><th>Starts</th><th>Ends</th><th>Status</th></tr>
                        </thead>
                        <tbody>
                            @forelse($subscriptions as $sub)
                            <tr>
                                <td>{{ $sub->organization->name }}</td>
                                <td>{{ $sub->plan->name }}</td>
                                <td>{{ $sub->starts_at->format('M d, Y') }}</td>
                                <td>{{ $sub->ends_at->format('M d, Y') }}</td>
                                <td>@if($sub->status === 'active')<span class="crm-badge crm-badge--success">Active</span>@elseif($sub->status === 'trial')<span class="crm-badge crm-badge--info">Trial</span>@else<span class="crm-badge crm-badge--secondary">{{ $sub->status }}</span>@endif</td>
                            </tr>
                            @empty
                            <tr><td colspan="5" class="crm-datatable-empty"><span class="crm-datatable-empty-icon">&#128203;</span><br>No subscriptions found.</td></tr>
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
    if ($('#subscriptions-table tbody tr').length && !$('#subscriptions-table tbody tr').first().find('.crm-datatable-empty').length) {
        $('#subscriptions-table').DataTable({
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            searching: true,
            lengthChange: true,
            order: [[2, 'desc']],
            pageLength: 25
        });
    }
});
</script>
@endpush
@endsection
