@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Loan List</h4>

    <a href="{{ route('loan.create') }}" class="btn btn-primary">
        + Create Loan
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
            @foreach($loans as $key => $loan)
                <tr>

                    <td>{{ $loans->firstItem() + $key }}</td>

                    <td>{{ $loan->loan_no }}</td>

                    <td>{{ $loan->member->name ?? 'N/A' }}</td>

                    {{-- LOAN PRODUCT --}}
                    <td>{{ $loan->loanProduct->name ?? 'N/A' }}</td>

                    <td>{{ number_format($loan->amount, 2) }}</td>

                    {{-- INTEREST FROM PRODUCT --}}
                    <td>
                        {{ $loan->loanProduct->interest_rate ?? 0 }}%
                    </td>

                    <td>
                        {{ number_format($loan->total_payable, 2) }}
                    </td>

                    {{-- STATUS --}}
                    <td>
                        @php
                            $statusClass = [
                                'approved' => 'success',
                                'pending'  => 'warning',
                                'rejected' => 'danger',
                                'running'  => 'primary',
                                'closed'   => 'success'
                            ];
                        @endphp

                        <span class="badge bg-{{ $statusClass[$loan->status] ?? 'secondary' }}">
                            {{ ucfirst($loan->status) }}
                        </span>
                    </td>

                    {{-- ACTION --}}
                    <td class="text-nowrap">

                        <a href="{{ route('loan.show', $loan->id) }}" class="btn btn-sm btn-info">
                            <i class="bx bx-show"></i>
                        </a>

                        @if($loan->status == 'pending')

                            <a href="{{ route('loan.edit', $loan->id) }}" class="btn btn-sm btn-warning">
                                <i class="bx bx-edit"></i>
                            </a>

                            {{-- APPROVE --}}
                            <form action="{{ route('loan.approve', $loan->id) }}"
                                method="POST"
                                class="d-inline approveForm">

                                @csrf
                                @method('PUT')

                                <button type="submit" class="btn btn-sm btn-success">
                                    <i class="bx bx-check-circle"></i>
                                </button>

                            </form>

                            {{-- DELETE --}}
                            <form action="{{ route('loan.destroy', $loan->id) }}"
                                method="POST"
                                class="d-inline deleteForm">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="bx bx-trash"></i>
                                </button>

                            </form>


                            
                        @elseif($loan->status == 'running')

                            <span class="badge bg-primary p-2">Running</span>

                        @elseif($loan->status == 'closed')

                            <span class="badge bg-success p-2">Closed</span>

                        @else

                            <span class="badge bg-secondary p-2">
                                {{ ucfirst($loan->status) }}
                            </span>

                        @endif


                        @if($loan->status == 'running')
                            <form action="{{ route('loan.close', $loan->id) }}" method="POST" class="mt-2">
                                @csrf
                                @method('PUT')

                                <button class="btn btn-dark btn-sm">
                                    Close Loan
                                </button>
                            </form>
                            @endif

                    </td>

                </tr>
            @endforeach
            </tbody>

        </table>

        <div class="mt-3">
            {{ $loans->links() }}
        </div>

    </div>
</div>

{{-- SWEET ALERT SCRIPT --}}
<script>

document.querySelectorAll('.approveForm').forEach(form => {

    form.addEventListener('submit', function(e){

        e.preventDefault();

        Swal.fire({
            title: 'Approve Loan?',
            text: "Installments will be generated automatically.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#198754',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, Approve'
        }).then((result)=>{

            if(result.isConfirmed){
                form.submit();
            }

        });

    });

});


document.querySelectorAll('.deleteForm').forEach(form => {

    form.addEventListener('submit', function(e){

        e.preventDefault();

        Swal.fire({
            title: 'Delete Loan?',
            text: "This action cannot be undone.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Delete'
        }).then((result)=>{

            if(result.isConfirmed){
                form.submit();
            }

        });

    });

});

</script>

@endsection