@extends('layouts.app')
@section('title', 'Permissions')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header"><h4>Permissions (view only)</h4></div>
            <div class="card-body">
                @foreach($permissions as $group => $items)
                <h6 class="text-uppercase">{{ $group }}</h6>
                <ul class="list-unstyled mb-3">@foreach($items as $p)<li>{{ $p->name }}</li>@endforeach</ul>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
