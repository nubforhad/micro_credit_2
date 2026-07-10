@extends('layouts.app') @section('content')

<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <h4 class="mb-0">Loan List</h4>

    <a href="{{ route('loan.create') }}" class="btn btn-primary">
        <i class="bx bx-plus"></i>
        Create Loan
    </a>
</div>

@if(session('success'))

<script>
    Swal.fire({
        icon: "success",

        title: "Success",

        text: "{{session('success')}}",

        timer: 2000,

        showConfirmButton: false,
    });
</script>

@endif

<div class="card shadow-sm border-0">
    <div class="card-body p-2 p-md-3">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-nowrap">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>

                        <th>Loan No</th>

                        <th>Member</th>

                        <th>Product</th>

                        <th>Amount</th>

                        <th>Interest</th>

                        <th>Total Payable</th>

                        <th>Status</th>

                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($loans as $key=>$loan)

                    <tr>
                        <td>{{ $loans->firstItem()+$key }}</td>

                        <td>{{$loan->loan_no}}</td>

                        <td>{{$loan->member->name ?? 'N/A'}}</td>

                        <td>{{$loan->loanProduct->name ?? 'N/A'}}</td>

                        <td>৳ {{number_format($loan->amount,2)}}</td>

                        <td>{{$loan->loanProduct->interest_rate ?? 0}}%</td>

                        <td>৳ {{number_format($loan->total_payable,2)}}</td>

                        <td>
                            @php $statusClass=[ 'approved'=>'success', 'pending'=>'warning', 'rejected'=>'danger',
                            'running'=>'primary', 'closed'=>'success' ]; @endphp

                            <span class="badge bg-{{$statusClass[$loan->status] ?? 'secondary'}}">
                                {{ucfirst($loan->status)}}
                            </span>
                        </td>

                        <td>
                            <div class="d-flex flex-wrap gap-1">
                                <a href="{{route('loan.show',$loan->id)}}" class="btn btn-sm btn-info">
                                    <i class="bx bx-show"></i>
                                </a>

                                @if($loan->status=='pending')

                                <a href="{{route('loan.edit',$loan->id)}}" class="btn btn-sm btn-warning">
                                    <i class="bx bx-edit"></i>
                                </a>

                                <form action="{{route('loan.approve',$loan->id)}}" method="POST" class="approveForm">
                                    @csrf @method('PUT')

                                    <button class="btn btn-sm btn-success">
                                        <i class="bx bx-check-circle"></i>
                                    </button>
                                </form>

                                <form action="{{route('loan.destroy',$loan->id)}}" method="POST" class="deleteForm">
                                    @csrf @method('DELETE')

                                    <button class="btn btn-sm btn-danger">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </form>

                                @elseif($loan->status=='running')

                                <form action="{{route('loan.close',$loan->id)}}" method="POST">
                                    @csrf @method('PUT')

                                    <button class="btn btn-sm btn-dark">Close Loan</button>
                                </form>

                                @elseif($loan->status=='closed')

                                <span class="badge bg-success p-2"> Closed </span>

                                @endif
                            </div>
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-3">{{$loans->links()}}</div>
    </div>
</div>

<script>
    document.querySelectorAll(".approveForm").forEach((form) => {
        form.addEventListener("submit", function (e) {
            e.preventDefault();

            Swal.fire({
                title: "Approve Loan?",

                text: "Installments will be generated automatically.",

                icon: "question",

                showCancelButton: true,

                confirmButtonColor: "#198754",

                confirmButtonText: "Yes Approve",
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    document.querySelectorAll(".deleteForm").forEach((form) => {
        form.addEventListener("submit", function (e) {
            e.preventDefault();

            Swal.fire({
                title: "Delete Loan?",

                text: "This action cannot be undone.",

                icon: "warning",

                showCancelButton: true,

                confirmButtonColor: "#dc3545",

                confirmButtonText: "Delete",
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>

@endsection
