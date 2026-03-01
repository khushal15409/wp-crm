@extends('layouts.app')
@section('title', 'Edit Lead')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header"><h4>Edit Lead</h4></div>
            <div class="card-body">
                <form action="{{ route('leads.update', $lead) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="form-group"><label>Phone</label><input type="text" name="phone" class="form-control" value="{{ old('phone', $lead->phone) }}" required></div>
                    <div class="form-group"><label>Name</label><input type="text" name="name" class="form-control" value="{{ old('name', $lead->name) }}"></div>
                    <div class="form-group"><label>Email</label><input type="email" name="email" class="form-control" value="{{ old('email', $lead->email) }}"></div>
                    <div class="form-group"><label>Stage</label><select name="stage" class="form-control">@foreach(['new','contacted','qualified','proposal','closed_won','closed_lost'] as $s)<option value="{{ $s }}" {{ $lead->stage === $s ? 'selected' : '' }}>{{ ucfirst(str_replace('_',' ',$s)) }}</option>@endforeach</select></div>
                    <div class="form-group"><label>Notes</label><textarea name="notes" class="form-control" rows="2">{{ old('notes', $lead->notes) }}</textarea></div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('leads.show', $lead) }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
