@extends('layouts.app') @section('content')

<h4>Edit Role</h4>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('roles.update',$role->id) }}">
            @csrf @method('PUT')

            <div class="mb-3">
                <label> Role Name </label>

                <input type="text" name="name" class="form-control" value="{{ $role->name }}" required />
            </div>

            <label> Permissions </label>

            <div class="row">
                @foreach($permissions as $permission)

                <div class="col-md-3 mb-2">
                    <div class="form-check">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="permissions[]"
                            value="{{ $permission->name }}"
                            @if($role->hasPermissionTo($permission->name)) checked @endif >

                        <label class="form-check-label"> {{ $permission->name }} </label>
                    </div>
                </div>

                @endforeach
            </div>

            <button class="btn btn-success mt-3">Update Role</button>
        </form>
    </div>
</div>

@endsection
