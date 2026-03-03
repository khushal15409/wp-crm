@extends('layouts.app')
@section('title', 'Leads')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card crm-datatable-card">
            <div class="card-header">
                <h4>Leads</h4>
                <div class="card-header-actions">
                    @if(auth()->user()->hasRole('super_admin'))
                    <a href="{{ route('leads.create') }}" class="btn btn-primary">Add Lead</a>
                    @endif
                    <form class="card-header-form d-inline" method="GET" action="{{ route('leads.index') }}">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search" value="{{ request('search') }}">
                            <select name="stage" class="form-control" style="max-width: 150px;">
                                <option value="">All stages</option>
                                @foreach(['new','contacted','qualified','proposal','closed_won','closed_lost'] as $s)
                                <option value="{{ $s }}" {{ request('stage') === $s ? 'selected' : '' }}>{{ ucfirst(str_replace('_',' ',$s)) }}</option>
                                @endforeach
                            </select>
                            <div class="input-group-btn"><button class="btn btn-primary"><i class="fas fa-search"></i></button></div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table id="leads-table" class="table table-striped crm-datatable">
                        <thead>
                            <tr>
                                <th>Phone</th>
                                <th>Name</th>
                                <th>Stage</th>
                                <th>Source</th>
                                @if(auth()->user()->hasRole('super_admin'))<th>Organization</th>@endif
                                <th>Updated</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($leads as $lead)
                            <tr>
                                <td>{{ $lead->phone }}</td>
                                <td>{{ $lead->name ?? '—' }}</td>
                                <td><span class="crm-badge crm-badge--info">{{ $lead->stage }}</span></td>
                                <td>{{ $lead->source }}</td>
                                @if(auth()->user()->hasRole('super_admin'))<td>{{ $lead->organization->name ?? '—' }}</td>@endif
                                <td>{{ $lead->updated_at->format('M d, Y') }}</td>
                                <td>
                                    <div class="crm-btn-group">
                                        <a href="{{ route('leads.show', $lead) }}" class="btn btn-sm btn-info">View</a>
                                        <a href="{{ route('leads.edit', $lead) }}" class="btn btn-sm btn-warning">Edit</a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="{{ auth()->user()->hasRole('super_admin') ? 7 : 6 }}" class="crm-datatable-empty"><span class="crm-datatable-empty-icon">👤</span><br>No leads found.</td></tr>
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
    if ($('#leads-table tbody tr').length && !$('#leads-table tbody tr').first().find('.crm-datatable-empty').length) {
        $('#leads-table').DataTable({
            order: [[-2, 'desc']],
            pageLength: 25,
            columnDefs: [{ orderable: false, searchable: false, targets: -1 }]
        });
    }
});
</script>
@endpush
@endsection
