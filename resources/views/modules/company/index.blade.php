@extends('layouts.app')

@section('content')

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: "{{ session('success') }}",
        timer: 2000,
        showConfirmButton: false
    });
</script>
@endif

<div class="d-flex justify-content-between mb-3">
    <h4>Company List</h4>

    <a href="{{ route('company.create') }}" class="btn btn-primary">
        + Add Company
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<table class="table table-bordered">
    <thead>
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Action</th>
    </tr>
    </thead>

    <tbody>
    @foreach($companies as $key => $company)
        <tr>
            <td>{{ $companies->firstItem() + $key }}</td>
            <td>{{ $company->name }}</td>
            <td>{{ $company->phone }}</td>
            <td>{{ $company->email }}</td>
            <td>
                <a href="{{ route('company.show', $company->id) }}" class="btn btn-sm btn-info">View</a>

                <a href="{{ route('company.edit', $company->id) }}" class="btn btn-sm btn-warning">Edit</a>

                 <form action="{{ route('company.destroy', $company->id) }}" method="POST" class="deleteForm d-inline">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-sm btn-danger deleteBtn">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $companies->links() }}

@endsection