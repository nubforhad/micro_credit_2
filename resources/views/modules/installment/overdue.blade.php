@extends('layouts.app')

@section('content')

<h4 class="mb-3">Overdue Installments</h4>

{{-- SEARCH --}}
<div class="card mb-3">
    <div class="card-body">
        <form method="GET" class="d-flex gap-2">
            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   class="form-control"
                   placeholder="Search Loan No / Member No">

            <button class="btn btn-primary">Search</button>

            <a href="{{ route('installment.overdue') }}" class="btn btn-secondary">
                Reset
            </a>
        </form>
    </div>
</div>

{{-- TABLE --}}
<div class="card">
<div class="card-body">

<table class="table table-bordered table-hover">

    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Loan No</th>
            <th>Member</th>
            <th>Due Date</th>
            <th>Days Late</th>
            <th>Amount</th>
            <th>Paid</th>
            <th>Remaining</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>

        @forelse($overdues as $key => $item)

        @php
            $daysLate = \Carbon\Carbon::parse($item->due_date)->diffInDays(now());
            $remaining = $item->amount - $item->paid_amount;
        @endphp

        <tr>

            <td>{{ $overdues->firstItem() + $key }}</td>

            <td>{{ $item->loan->loan_no ?? 'N/A' }}</td>

            <td>
                {{ $item->loan->member->name ?? 'N/A' }}
                <br>
                <small>{{ $item->loan->member->member_no ?? '' }}</small>
            </td>

            @php
                $days = \Carbon\Carbon::parse($item->due_date)
                    ->startOfDay()
                    ->diffInDays(now()->startOfDay());
            @endphp

            <td>
                {{ $days }} Days Late
            </td>

            <td>
                <span class="badge bg-danger">
                    {{ $daysLate }} Days Late
                </span>
            </td>

            <td>{{ number_format($item->amount,2) }}</td>

            <td>{{ number_format($item->paid_amount,2) }}</td>

            <td>
                <b class="text-danger">
                    {{ number_format($remaining,2) }}
                </b>
            </td>

            <td>
                <span class="badge bg-danger">
                    Overdue
                </span>
            </td>

            <td>

                {{-- PAYMENT --}}
                <form action="{{ route('installment.pay', $item->id) }}"
                      method="POST"
                      class="d-flex gap-1">

                    @csrf

                    <input type="number"
                           name="paid_amount"
                           class="form-control form-control-sm"
                           placeholder="Pay">

                    <button class="btn btn-success btn-sm">
                        Pay
                    </button>

                </form>

            </td>

        </tr>

        @empty

        <tr>
            <td colspan="10" class="text-center text-muted">
                No Overdue Found
            </td>
        </tr>

        @endforelse

    </tbody>

</table>

<div class="mt-3">
    {{ $overdues->appends(request()->query())->links() }}
</div>

</div>
</div>

@endsection