 @extends('layouts.app') @section('content')

<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <h4 class="mb-0">Area List</h4>

    <a href="{{ route('area.create') }}" class="btn btn-primary">
        <i class="bx bx-plus"></i>

        Create Area
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

                        <th>Branch</th>

                        <th>Area Name</th>

                        <th>Code</th>

                        <th width="230">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($areas as $key=>$area)

                    <tr>
                        <td>{{ $areas->firstItem()+$key }}</td>

                        <td>{{ $area->branch->name ?? 'N/A' }}</td>

                        <td>{{ $area->name }}</td>

                        <td>{{ $area->code }}</td>

                        <td>
                            <div class="d-flex flex-wrap gap-1">
                                <a href="{{ route('area.show',$area->id) }}" class="btn btn-sm btn-info">
                                    <i class="bx bx-show"></i>

                                    View
                                </a>

                                <a href="{{ route('area.edit',$area->id) }}" class="btn btn-sm btn-warning">
                                    <i class="bx bx-edit"></i>

                                    Edit
                                </a>

                                <form action="{{ route('area.destroy',$area->id) }}" method="POST" class="deleteForm">
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
                        <td colspan="5" class="text-center text-muted">No Area Found</td>
                    </tr>

                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">{{ $areas->links() }}</div>
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
