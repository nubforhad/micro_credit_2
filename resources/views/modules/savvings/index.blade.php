@extends('layouts.app') @section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Savvings List</h4>

    <a href="{{ route('savvings.create') }}" class="btn btn-primary"> + Add Savvings </a>
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
@if(session('error'))

<script>
Swal.fire({
    icon: "error",
    title: "Error",
    text: "{{ session('error') }}"
});
</script>

@endif 

<div class="card shadow-sm">
    <div class="card-body">
        <form method="GET" class="mb-3">
            <div class="input-group">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    class="form-control"
                    placeholder="Search Member No / Name / Receipt"
                />

                <button class="btn btn-dark">Search</button>
            </div>
        </form>

        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>

                    <th>Receipt No</th>

                    <th>Member</th>

                    <th>Type</th>

                    <th>Amount</th>

                    <th>Payment</th>

                    <th>Date</th>

                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse($savvings as $key=>$item)

                <tr>
                    <td>{{ $savvings->firstItem()+$key }}</td>

                    {{-- <td>{{ $item->receipt_no }}</td> --}}
                    <td>
                        <strong>{{ $item->receipt_no }}</strong>

                        <br>

                        @if($item->status == 'approved')
                            <small class="badge bg-success">Approved</small>

                        @elseif($item->status == 'pending')
                            <small class="badge bg-warning text-dark">Pending</small>

                        @elseif($item->status == 'rejected')
                            <small class="badge bg-danger">Rejected</small>
                        @endif
                    </td>

                    <td>
                        {{ $item->member->name ?? 'N/A' }}

                        <br />

                        <small> {{ $item->member->member_no ?? '' }} </small>
                    </td>

                    <td>
                        @if($item->type=='deposit')

                        <span class="badge bg-success"> Deposit </span>

                        @else

                        <span class="badge bg-danger"> Withdraw </span>

                        @endif
                    </td>

                    <td>{{ number_format($item->amount,2) }}</td>

                    <td>{{ $item->payment_method }}</td>

                    <td>{{ \Carbon\Carbon::parse($item->date)->format('d M,Y') }}</td>

                    <td>
                        <a href="{{ route('savvings.show',$item->id) }}" class="btn btn-sm btn-info">
                            <i class="bx bx-show"></i>
                        </a>

                        <a href="{{ route('savvings.edit',$item->id) }}" class="btn btn-sm btn-warning">
                            <i class="bx bx-edit"></i>
                        </a>

                        <form
                            action="{{ route('savvings.destroy',$item->id) }}"
                            method="POST"
                            class="d-inline deleteForm"
                        >
                            @csrf @method('DELETE')

                            <button class="btn btn-sm btn-danger">
                                <i class="bx bx-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>

                @empty

                <tr>
                    <td colspan="8" class="text-center">No Savvings Found</td>
                </tr>

                @endforelse
            </tbody>
        </table>

        <div class="mt-3">{{ $savvings->appends(request()->query())->links() }}</div>
    </div>
</div>

<script>
    document.querySelectorAll(".deleteForm").forEach((form) => {
        form.addEventListener("submit", function (e) {
            e.preventDefault();

            Swal.fire({
                title: "Delete?",
                text: "You cannot recover this data",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes Delete",
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>

@endsection
