@extends('layouts.app')
@section('title', 'Add Lead')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header"><h4>Add Lead (Manual)</h4></div>
            <div class="card-body">
                <form action="{{ route('leads.store') }}" method="POST">
                    @csrf
                    <div class="form-group"><label>Organization</label><select name="organization_id" class="form-control" required>@foreach($organizations as $org)<option value="{{ $org->id }}">{{ $org->name }}</option>@endforeach</select></div>
                    <div class="form-group"><label>Phone</label><input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required></div>
                    <div class="form-group"><label>Name</label><input type="text" name="name" class="form-control" value="{{ old('name') }}"></div>
                    <div class="form-group"><label>Email</label><input type="email" name="email" class="form-control" value="{{ old('email') }}"></div>
                    <div class="form-group"><label>Stage</label><select name="stage" class="form-control">@foreach(['new','contacted','qualified','proposal','closed_won','closed_lost'] as $s)<option value="{{ $s }}">{{ ucfirst(str_replace('_',' ',$s)) }}</option>@endforeach</select></div>
                    <div class="form-group"><label>Notes</label><textarea name="notes" class="form-control" rows="2">{{ old('notes') }}</textarea></div>
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('leads.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
