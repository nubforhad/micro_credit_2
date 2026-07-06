@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Center List</h4>

    <a href="{{ route('center.create') }}" class="btn btn-primary">
        + Create Center
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
                    <th>Area</th>
                    <th>Center Name</th>
                    <th>Meeting Day</th>
                    <th>Time</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
            @foreach($centers as $key => $center)
                <tr>
                    <td>{{ $centers->firstItem() + $key }}</td>
                    <td>{{ $center->area->name ?? '' }}</td>
                    <td>{{ $center->name }}</td>
                    <td>{{ $center->meeting_day }}</td>
                    <td>{{ $center->meeting_time }}</td>
                    <td>
                        <a href="{{ route('center.show', $center->id) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('center.edit', $center->id) }}" class="btn btn-sm btn-warning">Edit</a>

                        <form action="{{ route('center.destroy', $center->id) }}" method="POST" class="deleteForm d-inline">
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
            {{ $centers->links() }}
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