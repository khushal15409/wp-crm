@extends('layouts.app')
@section('title', 'Create Broadcast')
@section('page_subtitle', 'Create and send a WhatsApp broadcast in three simple steps.')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header"><h4>Create Broadcast</h4></div>
            <div class="card-body">
                <div class="mb-4">
                    <div class="d-flex flex-wrap step-badges">
                        <span class="badge badge-primary">Step 1: Select Contacts</span>
                        <span class="badge badge-light">Step 2: Compose Message</span>
                        <span class="badge badge-light">Step 3: Review &amp; Send</span>
                    </div>
                </div>
                <form action="{{ route('broadcasts.store') }}" method="POST">
                    @csrf
                    @if(auth()->user()->hasRole('super_admin'))
                    <div class="form-group"><label>Organization</label><select name="organization_id" class="form-control" required>@foreach(\App\Models\Organization::where('is_active', true)->orderBy('name')->get() as $org)<option value="{{ $org->id }}">{{ $org->name }}</option>@endforeach</select></div>
                    @endif
                    <div class="form-group">
                        <label>Campaign Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                        <small class="text-muted">Use a name your team will recognize.</small>
                    </div>
                    <div class="form-group">
                        <label>Message</label>
                        <textarea name="message" class="form-control" rows="4" required>{{ old('message') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Delivery</label>
                        <select name="status" class="form-control">
                            <option value="draft">Draft</option>
                            <option value="scheduled">Scheduled</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('broadcasts.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
