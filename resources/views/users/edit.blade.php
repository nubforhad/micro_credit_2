@extends('layouts.app') @section('content')

<h4>Edit User</h4>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('users.update',$user->id) }}">
            @csrf @method('PUT')

            <div class="mb-3">
                <label> Name </label>

                <input type="text" name="name" value="{{ $user->name }}" class="form-control" />
            </div>

            <div class="mb-3">
                <label> Email </label>

                <input type="email" name="email" value="{{ $user->email }}" class="form-control" />
            </div>

            <div class="mb-3">
                <label> Role </label>

                <select name="role" class="form-control">
                    @foreach($roles as $role)

                    <option value="{{ $role->name }}" @if($user->
                        hasRole($role->name)) selected @endif > {{ $role->name }}
                    </option>

                    @endforeach
                </select>
            </div>

            <button class="btn btn-success">Update</button>
        </form>
    </div>
</div>

@endsection
