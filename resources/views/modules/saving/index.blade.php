@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Savings List</h4>

    <a href="{{ route('saving.create') }}" class="btn btn-primary">
        + Add Saving
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
                    <th>Member</th>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
            @foreach($savings as $key => $saving)
                <tr>
                    <td>{{ $savings->firstItem() + $key }}</td>
                    <td>{{ $saving->member->name ?? '' }}</td>
                    <td>
                        <span class="badge bg-{{ $saving->type == 'deposit' ? 'success' : 'danger' }}">
                            {{ $saving->type }}
                        </span>
                    </td>
                    <td>{{ $saving->amount }}</td>
                    <td>{{ $saving->date }}</td>
                    <td>
                        <a href="{{ route('saving.show', $saving->id) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('saving.edit', $saving->id) }}" class="btn btn-sm btn-warning">Edit</a>

                        <form action="{{ route('saving.destroy', $saving->id) }}" method="POST" class="deleteForm d-inline">
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
            {{ $savings->links() }}
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