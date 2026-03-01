@extends('layouts.app')
@section('title', 'Add User')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header"><h4>Add User</h4></div>
            <div class="card-body">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="form-group"><label>Name</label><input type="text" name="name" class="form-control" value="{{ old('name') }}" required></div>
                    <div class="form-group"><label>Email</label><input type="email" name="email" class="form-control" value="{{ old('email') }}" required></div>
                    <div class="form-group"><label>Password</label><input type="password" name="password" class="form-control" required></div>
                    <div class="form-group"><label>Password confirmation</label><input type="password" name="password_confirmation" class="form-control" required></div>
                    <div class="form-group"><label>Role</label><select name="role" id="role" class="form-control" required><option value="super_admin">Super Admin</option><option value="organization">Organization</option></select></div>
                    <div class="form-group" id="org-wrap"><label>Organization</label><select name="organization_id" class="form-control">@foreach($organizations as $org)<option value="{{ $org->id }}">{{ $org->name }}</option>@endforeach</select></div>
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
