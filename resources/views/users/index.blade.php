@extends('layouts.app')
@section('title', 'Users')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Users</h4>
                <div class="card-header-action">
                    <a href="{{ route('users.create') }}" class="btn btn-primary">Add User</a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr><th>Name</th><th>Email</th><th>Role</th><th>Organization</th></tr>
                        </thead>
                        <tbody>
                            @foreach($users as $u)
                            <tr>
                                <td>{{ $u->name }}</td>
                                <td>{{ $u->email }}</td>
                                <td>{{ $u->getRoleNames()->first() ?? '—' }}</td>
                                <td>{{ $u->organization->name ?? '—' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @if($users->hasPages())<div class="card-footer">{{ $users->links() }}</div>@endif
        </div>
    </div>
</div>
@endsection
