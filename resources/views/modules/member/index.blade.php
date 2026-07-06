@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Member List</h4>

    <a href="{{ route('member.create') }}" class="btn btn-primary">
        + Create Member
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
                    <th>Member No</th>
                    <th>Name</th>
                    <th>Center</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
            @foreach($members as $key => $member)
                <tr>
                    <td>{{ $members->firstItem() + $key }}</td>
                    <td>{{ $member->member_no }}</td>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->center->name ?? '' }}</td>
                    <td>{{ $member->phone }}</td>
                    <td>
                        <a href="{{ route('member.show', $member->id) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('member.edit', $member->id) }}" class="btn btn-sm btn-warning">Edit</a>

                        <form action="{{ route('member.destroy', $member->id) }}" method="POST" class="deleteForm d-inline">
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
            {{ $members->links() }}
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