@extends('layouts.app') @section('content') @if(session('success'))

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

<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <h4 class="mb-0">Company List</h4>

    <a href="{{ route('company.create') }}" class="btn btn-primary">
        <i class="bx bx-plus"></i>

        Add Company
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>

                        <th>Name</th>

                        <th>Phone</th>

                        <th>Email</th>

                        <th width="220">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($companies as $key => $company)

                    <tr>
                        <td>{{ $companies->firstItem() + $key }}</td>

                        <td>{{ $company->name }}</td>

                        <td>{{ $company->phone }}</td>

                        <td>{{ $company->email }}</td>

                        <td>
                            <div class="d-flex gap-1 flex-wrap">
                                <a href="{{ route('company.show',$company->id) }}" class="btn btn-sm btn-info">
                                    <i class="bx bx-show"></i>

                                    View
                                </a>

                                <a href="{{ route('company.edit',$company->id) }}" class="btn btn-sm btn-warning">
                                    <i class="bx bx-edit"></i>

                                    Edit
                                </a>

                                <form
                                    action="{{ route('company.destroy',$company->id) }}"
                                    method="POST"
                                    class="deleteForm"
                                >
                                    @csrf @method('DELETE')

                                    <button type="submit" class="btn btn-sm btn-danger deleteBtn">
                                        <i class="bx bx-trash"></i>

                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    @empty

                    <tr>
                        <td colspan="5" class="text-center text-muted">No Company Found</td>
                    </tr>

                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">{{ $companies->links() }}</div>
    </div>
</div>

@endsection
