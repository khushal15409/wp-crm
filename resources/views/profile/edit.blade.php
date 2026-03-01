@extends('layouts.app')
@section('title', 'Profile')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header"><h4>Profile</h4></div>
            <div class="card-body">
                @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf @method('PUT')
                    <div class="form-group"><label>Name</label><input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required></div>
                    <div class="form-group"><label>Email</label><input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required></div>
                    <div id="password" class="form-group"><label>New password (leave blank to keep)</label><input type="password" name="password" class="form-control"></div>
                    <div class="form-group"><label>Confirm new password</label><input type="password" name="password_confirmation" class="form-control"></div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
