@extends('layouts.app') @section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Users</h4>

    <a href="{{ route('users.create') }}" class="btn btn-primary"> Add User </a>
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

@endif

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>

                    <th>Name</th>

                    <th>Email</th>

                    <th>Role</th>

                    <th width="150">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($users as $key=>$user)

                <tr>
                    <td>{{ $key+1 }}</td>

                    <td>{{ $user->name }}</td>

                    <td>{{ $user->email }}</td>

                    <td>
                        @foreach($user->roles as $role)

                        <span class="badge bg-success"> {{ $role->name }} </span>

                        @endforeach
                    </td>

                    <td>
                        <a href="{{ route('users.edit',$user->id) }}" class="btn btn-sm btn-warning"> Edit </a>

                        <form action="{{ route('users.destroy',$user->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')

                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete User?')">
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
