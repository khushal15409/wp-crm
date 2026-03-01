@extends('layouts.app')
@section('title', 'Roles')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header"><h4>Roles (view only)</h4></div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr><th>Name</th><th>Users</th></tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $role)
                            <tr><td>{{ $role->name }}</td><td>{{ $role->users_count }}</td></tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
