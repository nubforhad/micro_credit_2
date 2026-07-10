@extends('layouts.app') @section('content')

<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <h4 class="mb-0">Member List</h4>

    <a href="{{ route('member.create') }}" class="btn btn-primary">
        <i class="bx bx-plus"></i>

        Create Member
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

                        <th>Member No</th>

                        <th>Name</th>

                        <th>Center</th>

                        <th>Phone</th>

                        <th width="330">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($members as $key=>$member)

                    <tr>
                        <td>{{ $members->firstItem()+$key }}</td>

                        <td>{{ $member->member_no }}</td>

                        <td>{{ $member->name }}</td>

                        <td>{{ $member->center->name ?? 'N/A' }}</td>

                        <td>{{ $member->phone }}</td>

                        <td>
                            <div class="d-flex flex-wrap gap-1">
                                <a href="{{ route('member.show',$member->id) }}" class="btn btn-sm btn-info">
                                    <i class="bx bx-show"></i>

                                    View
                                </a>

                                <a href="{{ route('member.edit',$member->id) }}" class="btn btn-sm btn-warning">
                                    <i class="bx bx-edit"></i>

                                    Edit
                                </a>

                                <a href="{{ route('member.ledger',$member->id) }}" class="btn btn-sm btn-primary">
                                    <i class="bx bx-book"></i>

                                    Ledger
                                </a>

                                <a href="{{ route('savvings.ledger',$member->id) }}" class="btn btn-sm btn-secondary">
                                    <i class="bx bx-wallet"></i>

                                    Savvings Ledger
                                </a>

                                <form
                                    action="{{ route('member.destroy',$member->id) }}"
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
                        <td colspan="6" class="text-center text-muted">No Member Found</td>
                    </tr>

                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">{{ $members->links() }}</div>
    </div>
</div>

<script>
    document.querySelectorAll(".deleteForm").forEach((form) => {
        form.addEventListener("submit", function (e) {
            e.preventDefault();

            Swal.fire({
                title: "Are you sure?",

                text: "This member will be deleted permanently!",

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
