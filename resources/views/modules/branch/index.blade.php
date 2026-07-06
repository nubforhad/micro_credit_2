@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Branch List</h4>

    <a href="{{ route('branch.create') }}" class="btn btn-primary">
        + Create Branch
    </a>
</div>

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

<div class="card shadow-sm">
    <div class="card-body">

        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Company</th>
                    <th>Branch Name</th>
                    <th>Code</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
            @foreach($branches as $key => $branch)
                <tr>
                    <td>{{ $branches->firstItem() + $key }}</td>
                    <td>{{ $branch->company->name ?? '' }}</td>
                    <td>{{ $branch->name }}</td>
                    <td>{{ $branch->code }}</td>
                    <td>{{ $branch->phone }}</td>
                    <td>
                        <a href="{{ route('branch.show', $branch->id) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('branch.edit', $branch->id) }}" class="btn btn-sm btn-warning">Edit</a>

                        <form action="{{ route('branch.destroy', $branch->id) }}" method="POST" class="deleteForm d-inline">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-sm btn-danger">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="mt-3">
            {{ $branches->links() }}
        </div>

    </div>
</div>

<script>
document.querySelectorAll('.deleteForm').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: "Are you sure?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
</script>

@endsection