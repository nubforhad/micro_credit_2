@extends('layouts.app') @section('content')

<h4 class="mb-3">Create Role</h4>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('roles.store') }}">
            @csrf

            <div class="mb-3">
                <label> Role Name </label>

                <input type="text" name="name" class="form-control" placeholder="Example: Loan Officer" required />
            </div>

            <label class="mb-2"> Select Permissions </label>

            <div class="row">
                @foreach($permissions as $permission)

                <div class="col-md-3 mb-2">
                    <div class="form-check">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="permissions[]"
                            value="{{ $permission->name }}"
                        />

                        <label class="form-check-label"> {{ $permission->name }} </label>
                    </div>
                </div>

                @endforeach
            </div>

            <button class="btn btn-success mt-3">Save Role</button>
        </form>
    </div>
</div>

@endsection
