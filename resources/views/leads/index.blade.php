@extends('layouts.app')
@section('title', 'Leads')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Leads</h4>
                <div class="card-header-action">
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
                    <table class="table table-striped">
                        <thead>
                            <tr><th>Phone</th><th>Name</th><th>Stage</th><th>Source</th>@if(auth()->user()->hasRole('super_admin'))<th>Organization</th>@endif<th>Updated</th><th>Action</th></tr>
                        </thead>
                        <tbody>
                            @foreach($leads as $lead)
                            <tr>
                                <td>{{ $lead->phone }}</td>
                                <td>{{ $lead->name ?? '—' }}</td>
                                <td><span class="badge badge-info">{{ $lead->stage }}</span></td>
                                <td>{{ $lead->source }}</td>
                                @if(auth()->user()->hasRole('super_admin'))<td>{{ $lead->organization->name ?? '—' }}</td>@endif
                                <td>{{ $lead->updated_at->format('M d, Y') }}</td>
                                <td><a href="{{ route('leads.show', $lead) }}" class="btn btn-sm btn-info">View</a> <a href="{{ route('leads.edit', $lead) }}" class="btn btn-sm btn-warning">Edit</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @if($leads->hasPages())<div class="card-footer">{{ $leads->links() }}</div>@endif
        </div>
    </div>
</div>
@endsection
