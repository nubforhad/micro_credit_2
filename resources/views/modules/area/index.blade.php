@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Area List</h4>

    <a href="{{ route('area.create') }}" class="btn btn-primary">
        + Create Area
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
                    <th>Branch</th>
                    <th>Area Name</th>
                    <th>Code</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
            @foreach($areas as $key => $area)
                <tr>
                    <td>{{ $areas->firstItem() + $key }}</td>
                    <td>{{ $area->branch->name ?? '' }}</td>
                    <td>{{ $area->name }}</td>
                    <td>{{ $area->code }}</td>
                    <td>
                        <a href="{{ route('area.show', $area->id) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('area.edit', $area->id) }}" class="btn btn-sm btn-warning">Edit</a>

                        <form action="{{ route('area.destroy', $area->id) }}" method="POST" class="deleteForm d-inline">
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
            {{ $areas->links() }}
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