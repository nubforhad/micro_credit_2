@extends('layouts.app') @section('content')

<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <h4 class="mb-0">Branch List</h4>

    <a href="{{ route('branch.create') }}" class="btn btn-primary">
        <i class="bx bx-plus"></i>
        Create Branch
    </a>
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
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>

                        <th>Company</th>

                        <th>Branch Name</th>

                        <th>Code</th>

                        <th>Phone</th>

                        <th width="230">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($branches as $key => $branch)

                    <tr>
                        <td>{{ $branches->firstItem() + $key }}</td>

                        <td>{{ $branch->company->name ?? 'N/A' }}</td>

                        <td>{{ $branch->name }}</td>

                        <td>{{ $branch->code }}</td>

                        <td>{{ $branch->phone }}</td>

                        <td>
                            <div class="d-flex flex-wrap gap-1">
                                <a href="{{ route('branch.show',$branch->id) }}" class="btn btn-sm btn-info">
                                    <i class="bx bx-show"></i>

                                    View
                                </a>

                                <a href="{{ route('branch.edit',$branch->id) }}" class="btn btn-sm btn-warning">
                                    <i class="bx bx-edit"></i>

                                    Edit
                                </a>

                                <form
                                    action="{{ route('branch.destroy',$branch->id) }}"
                                    method="POST"
                                    class="deleteForm"
                                >
                                    @csrf @method('DELETE')

                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bx bx-trash"></i>

                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    @empty

                    <tr>
                        <td colspan="6" class="text-center text-muted">No Branch Found</td>
                    </tr>

                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">{{ $branches->links() }}</div>
    </div>
</div>

<script>
    document.querySelectorAll(".deleteForm").forEach((form) => {
        form.addEventListener("submit", function (e) {
            e.preventDefault();

            Swal.fire({
                title: "Are you sure?",

                text: "This data will be deleted permanently!",

                icon: "warning",

                showCancelButton: true,

                confirmButtonColor: "#d33",

                cancelButtonColor: "#3085d6",

                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>

@endsection
