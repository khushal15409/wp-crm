@extends('layouts.app')
@section('title', 'Plan Management')
@section('content')
<div class="row">
    <div class="col-12">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="card crm-datatable-card">
            <div class="card-header">
                <h4>Plan Management</h4>
                <div class="card-header-actions">
                    <a href="{{ route('plans.create') }}" class="btn btn-primary">Add Plan</a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table id="plans-table" class="table table-striped crm-datatable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Price (₹/mo)</th>
                                <th>Description</th>
                                <th>Trial days</th>
                                <th>Popular</th>
                                <th>Active</th>
                                <th>Subscriptions</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($plans as $plan)
                            <tr>
                                <td><strong>{{ $plan->name }}</strong></td>
                                <td><code class="text-dark">{{ $plan->slug }}</code></td>
                                <td>₹ {{ $plan->getPriceMonthlyInr() }}</td>
                                <td>{{ Str::limit($plan->description, 40) }}</td>
                                <td>{{ $plan->trial_days ?? 7 }}</td>
                                <td>
                                    @if($plan->is_popular)
                                    <span class="crm-badge crm-badge--success">Yes</span>
                                    @else
                                    <span class="crm-badge crm-badge--secondary">No</span>
                                    @endif
                                </td>
                                <td>
                                    @if($plan->is_active)
                                    <span class="crm-badge crm-badge--success">Yes</span>
                                    @else
                                    <span class="crm-badge crm-badge--secondary">No</span>
                                    @endif
                                </td>
                                <td>{{ $plan->subscriptions_count }}</td>
                                <td>
                                    <div class="crm-btn-group">
                                        <a href="{{ route('plans.edit', $plan) }}" class="btn btn-sm btn-warning">Edit</a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="9" class="crm-datatable-empty"><span class="crm-datatable-empty-icon">📦</span><br>No plans yet.</td></tr>
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
    if ($('#plans-table tbody tr').length && !$('#plans-table tbody tr').first().find('.crm-datatable-empty').length) {
        $('#plans-table').DataTable({
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
