@extends('layouts.app')
@section('title', $broadcast->name)
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header"><h4>{{ $broadcast->name }}</h4></div>
            <div class="card-body">
                <p><strong>Status:</strong> {{ $broadcast->status }}</p>
                <p><strong>Recipients:</strong> {{ $broadcast->recipients_count }}</p>
                <p><strong>Message:</strong></p>
                <p>{{ $broadcast->message }}</p>
                <a href="{{ route('broadcasts.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
</div>
@endsection
