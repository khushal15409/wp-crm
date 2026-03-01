@extends('layouts.app')
@section('title', 'Edit Plan')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header"><h4>Edit Plan</h4></div>
            <div class="card-body">
                <form action="{{ route('plans.update', $plan) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="form-group"><label>Name</label><input type="text" name="name" class="form-control" value="{{ old('name', $plan->name) }}" required></div>
                    <div class="form-group"><label>Slug</label><input type="text" name="slug" class="form-control" value="{{ old('slug', $plan->slug) }}" required></div>
                    <div class="form-group"><label>Price</label><input type="number" name="price" step="0.01" class="form-control" value="{{ old('price', $plan->price) }}" required></div>
                    <div class="form-group"><label>Interval</label><select name="interval" class="form-control"><option value="month" {{ $plan->interval === 'month' ? 'selected' : '' }}>Month</option><option value="year" {{ $plan->interval === 'year' ? 'selected' : '' }}>Year</option></select></div>
                    <div class="form-group"><label>Lead limit</label><input type="number" name="lead_limit" class="form-control" value="{{ old('lead_limit', $plan->lead_limit) }}" min="0"></div>
                    <div class="form-group"><label>Broadcast limit</label><input type="number" name="broadcast_limit" class="form-control" value="{{ old('broadcast_limit', $plan->broadcast_limit) }}" min="0"></div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="is_active" value="1" class="custom-control-input" id="is_active" {{ $plan->is_active ? 'checked' : '' }}>
                            <label class="custom-control-label" for="is_active">Active</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('plans.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
