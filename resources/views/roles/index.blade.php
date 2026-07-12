@extends('layouts.app') @section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Roles Management</h4>

    <a href="{{ route('roles.create') }}" class="btn btn-primary"> Add Role </a>
</div>

@if(session('success'))

<script>
    Swal.fire({
        icon: "success",

        title: "Success",

        text: "{{ session('success') }}",

        timer: 2000,

        showConfirmButton: false,
    });
</script>

@endif @if(session('error'))

<script>
    Swal.fire({
        icon: "error",

        title: "Error",

        text: "{{ session('error') }}",
    });
</script>

@endif

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>

                    <th>Role Name</th>

                    <th>Permissions</th>

                    <th width="180">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($roles as $key=>$role)

                <tr>
                    <td>{{ $key+1 }}</td>

                    <td>
                        <span class="badge bg-primary"> {{ $role->name }} </span>
                    </td>

                    <td>
                        @foreach($role->permissions as $permission)

                        <span class="badge bg-secondary"> {{ $permission->name }} </span>

                        @endforeach
                    </td>

                    <td>
                        <a href="{{ route('roles.edit',$role->id) }}" class="btn btn-sm btn-warning"> Edit </a>

                        <form action="{{ route('roles.destroy',$role->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')

                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete Role?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
