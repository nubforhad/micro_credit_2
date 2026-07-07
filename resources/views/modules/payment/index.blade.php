@extends('layouts.app')

@section('content')

<div class="container-fluid">

    {{-- PAGE HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3 class="fw-bold mb-0">
                <i class="bx bx-wallet text-primary"></i>
                Payment History
            </h3>
            <small class="text-muted">
                Loan Collection & Payment History
            </small>
        </div>

    </div>

    {{-- SUMMARY CARD --}}
    <div class="row mb-4">

        <div class="col-lg-3 col-md-6 mb-3">

            <div class="card border-0 shadow">

                <div class="card-body">

                    <h6 class="text-muted">
                        Today's Collection
                    </h6>

                    <h3 class="text-success fw-bold">
                        ৳ {{ number_format($payments->where('payment_date', now()->toDateString())->sum('amount'),2) }}
                    </h3>

                </div>

            </div>

        </div>

        <div class="col-lg-3 col-md-6 mb-3">

            <div class="card border-0 shadow">

                <div class="card-body">

                    <h6 class="text-muted">
                        Total Collection
                    </h6>

                    <h3 class="text-primary fw-bold">
                        ৳ {{ number_format($payments->sum('amount'),2) }}
                    </h3>

                </div>

            </div>

        </div>

        <div class="col-lg-3 col-md-6 mb-3">

            <div class="card border-0 shadow">

                <div class="card-body">

                    <h6 class="text-muted">
                        Total Payments
                    </h6>

                    <h3 class="text-dark fw-bold">

                        {{ $payments->total() }}

                    </h3>

                </div>

            </div>

        </div>

        <div class="col-lg-3 col-md-6 mb-3">

            <div class="card border-0 shadow">

                <div class="card-body">

                    <h6 class="text-muted">
                        This Month
                    </h6>

                    <h3 class="text-warning fw-bold">

                        ৳ {{ number_format($payments->whereBetween('payment_date',[now()->startOfMonth(),now()->endOfMonth()])->sum('amount'),2) }}

                    </h3>

                </div>

            </div>

        </div>

    </div>

    {{-- SEARCH --}}

    <div class="card shadow-sm mb-3">

        <div class="card-body">

            <form method="GET">

                <div class="row">

                    <div class="col-md-10">

                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               class="form-control"
                               placeholder="Search Receipt No / Loan No / Member No / Member Name">

                    </div>

                    <div class="col-md-2 d-grid">

                        <button class="btn btn-primary">

                            <i class="bx bx-search"></i>

                            Search

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

    {{-- TABLE --}}

    <div class="card shadow">

        <div class="card-body table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-dark">

                <tr>

                    <th>#</th>

                    <th>Receipt</th>

                    <th>Loan No</th>

                    <th>Member</th>

                    <th>Installment</th>

                    <th>Amount</th>

                    <th>Method</th>

                    <th>Date</th>

                    <th>Collector</th>

                    <th width="150">Action</th>

                </tr>

                </thead>

                <tbody>

                @forelse($payments as $key=>$payment)

                    <tr>

                        <td>{{ $payments->firstItem()+$key }}</td>

                        <td>

                            <span class="badge bg-primary">

                                {{ $payment->receipt_no }}

                            </span>

                        </td>

                        <td>{{ $payment->loan->loan_no }}</td>

                        <td>

                            {{ $payment->member->member_no }}

                            <br>

                            <small class="text-muted">

                                {{ $payment->member->name }}

                            </small>

                        </td>

                        <td>

                            #{{ $payment->installment->installment_no }}

                        </td>

                        <td>

                            <strong>

                                ৳ {{ number_format($payment->amount,2) }}

                            </strong>

                        </td>

                        <td>

                            @php

                                $color=[

                                    'Cash'=>'success',

                                    'Bank'=>'primary',

                                    'bKash'=>'warning',

                                    'Nagad'=>'danger',

                                    'Rocket'=>'info'

                                ];

                            @endphp

                            <span class="badge bg-{{ $color[$payment->payment_method] ?? 'secondary' }}">

                                {{ $payment->payment_method }}

                            </span>

                        </td>

                        <td>

                            {{ \Carbon\Carbon::parse($payment->payment_date)->format('d M Y') }}

                        </td>

                        <td>

                            {{ $payment->receiver->name ?? '-' }}

                        </td>

                        <td>

                            <a href="{{ route('loan.payment.show',$payment->id) }}"
                               class="btn btn-info btn-sm">

                                <i class="bx bx-show"></i>

                            </a>

                            <a href="{{ route('loan.payment.print',$payment->id) }}"   target="_blank"
                               class="btn btn-success btn-sm">

                                <i class="bx bx-printer"></i>

                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="10" class="text-center text-danger">

                            No Payment Found

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

    <div class="mt-3">

        {{ $payments->links() }}

    </div>

</div>

@endsection



