@extends('layouts.app')
@section('title', 'Subscriptions')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header"><h4>Subscriptions</h4></div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr><th>Organization</th><th>Plan</th><th>Starts</th><th>Ends</th><th>Status</th></tr>
                        </thead>
                        <tbody>
                            @foreach($subscriptions as $sub)
                            <tr>
                                <td>{{ $sub->organization->name }}</td>
                                <td>{{ $sub->plan->name }}</td>
                                <td>{{ $sub->starts_at->format('M d, Y') }}</td>
                                <td>{{ $sub->ends_at->format('M d, Y') }}</td>
                                <td><span class="badge badge-{{ $sub->status === 'active' ? 'success' : 'secondary' }}">{{ $sub->status }}</span></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @if($subscriptions->hasPages())<div class="card-footer">{{ $subscriptions->links() }}</div>@endif
        </div>
    </div>
</div>
@endsection
