@extends('layouts.app')
@section('title', 'Plan Management')
@section('content')
<div class="row">
    <div class="col-12">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="card">
            <div class="card-header">
                <h4>Plan Management</h4>
                <div class="card-header-action">
                    <a href="{{ route('plans.create') }}" class="btn btn-primary">Add Plan</a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped">
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
                            @foreach($plans as $plan)
                            <tr>
                                <td>{{ $plan->name }}</td>
                                <td>{{ $plan->slug }}</td>
                                <td>₹ {{ $plan->getPriceMonthlyInr() }}</td>
                                <td>{{ Str::limit($plan->description, 40) }}</td>
                                <td>{{ $plan->trial_days ?? 7 }}</td>
                                <td>{{ $plan->is_popular ? 'Yes' : 'No' }}</td>
                                <td>{{ $plan->is_active ? 'Yes' : 'No' }}</td>
                                <td>{{ $plan->subscriptions_count }}</td>
                                <td><a href="{{ route('plans.edit', $plan) }}" class="btn btn-sm btn-warning">Edit</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
