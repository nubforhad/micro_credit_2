@extends('layouts.app') @section('content')

<h4 class="mb-3">Create User</h4>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('users.store') }}">
            @csrf

            <div class="mb-3">
                <label> Name </label>

                <input type="text" name="name" class="form-control" required />
            </div>

            <div class="mb-3">
                <label> Email </label>

                <input type="email" name="email" class="form-control" required />
            </div>

            <div class="mb-3">
                <label> Password </label>

                <input type="password" name="password" class="form-control" required />
            </div>

            <div class="mb-3">
                <label> Role </label>

                <select name="role" class="form-control" required>
                    <option value="">Select Role</option>

                    @foreach($roles as $role)

                    <option value="{{ $role->name }}">{{ $role->name }}</option>

                    @endforeach
                </select>
            </div>

            <button class="btn btn-primary">Save</button>
        </form>
    </div>
</div>

@endsection
