@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Loan Installments</h4>
</div>

{{-- 🔍 SEARCH BOX --}}
<div class="card mb-3 shadow-sm">
    <div class="card-body">

        <form method="GET" action="{{ route('installment.index') }}" class="d-flex gap-2">

            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   class="form-control"
                   placeholder="Search by Loan No or Member No">

            <button class="btn btn-primary">
                Search
            </button>

            <a href="{{ route('installment.index') }}" class="btn btn-secondary">
                Reset
            </a>

        </form>

    </div>
</div>

{{-- SUCCESS MESSAGE --}}
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

{{-- ERROR MESSAGE --}}
@if(session('error'))
<script>
Swal.fire({
    icon: 'error',
    title: 'Error',
    text: "{{ session('error') }}",
    timer: 2000,
    showConfirmButton: false
});
</script>
@endif

{{-- TABLE --}}
<div class="card shadow-sm">
    <div class="card-body">

        <table class="table table-bordered table-hover align-middle">

            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Loan No</th>
                    <th>Member</th>
                    <th>Installment No</th>
                    <th>Due Date</th>
                    <th>Amount</th>
                    <th>Paid</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

            @forelse($installments as $key => $item)
                <tr>

                    <td>{{ $installments->firstItem() + $key }}</td>

                    <td>{{ $item->loan->loan_no ?? 'N/A' }}</td>

                    <td>
                        {{ $item->loan->member->name ?? 'N/A' }}
                        <br>
                        <small class="text-muted">
                            {{ $item->loan->member->member_no ?? '' }}
                        </small>
                    </td>

                    <td>{{ $item->installment_no }}</td>

                    <td>
                        {{ \Carbon\Carbon::parse($item->due_date)->format('d M, Y') }}
                    </td>

                    <td>{{ number_format($item->amount, 2) }}</td>

                    <td>{{ number_format($item->paid_amount, 2) }}</td>

                    <td>
                        @php
                            $statusColor = [
                                'paid' => 'success',
                                'partial' => 'warning',
                                'unpaid' => 'danger'
                            ];
                        @endphp

                        <span class="badge bg-{{ $statusColor[$item->status] ?? 'secondary' }}">
                            {{ ucfirst($item->status) }}
                        </span>
                    </td>

                    <td>

                        @if($item->status != 'paid')

                        <form action="{{ route('installment.pay', $item->id) }}"
                              method="POST"
                              class="d-flex gap-2">

                            @csrf

                            <input type="number"
                                   name="paid_amount"
                                   class="form-control form-control-sm"
                                   placeholder="Pay Amount"
                                   required>

                            <button class="btn btn-success btn-sm">
                                Pay
                            </button>

                        </form>

                        @else
                            <span class="text-success fw-bold">Completed</span>
                        @endif

                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center text-muted">
                        No Installments Found
                    </td>
                </tr>
            @endforelse

            </tbody>

        </table>

        {{-- PAGINATION --}}
        <div class="mt-3">
            {{ $installments->appends(request()->query())->links() }}
        </div>

    </div>
</div>

@endsection