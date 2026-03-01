@extends('layouts.app')
@section('title', 'Add Follow-up')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header"><h4>Add Follow-up</h4></div>
            <div class="card-body">
                <form action="{{ route('follow-ups.store') }}" method="POST">
                    @csrf
                    <div class="form-group"><label>Lead</label><select name="lead_id" class="form-control" required>@foreach($leads as $l)<option value="{{ $l->id }}">{{ $l->name ?? $l->phone }} ({{ $l->phone }})</option>@endforeach</select></div>
                    <div class="form-group"><label>Due at</label><input type="datetime-local" name="due_at" class="form-control" value="{{ old('due_at') }}" required></div>
                    <div class="form-group"><label>Notes</label><textarea name="notes" class="form-control" rows="2">{{ old('notes') }}</textarea></div>
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('follow-ups.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
