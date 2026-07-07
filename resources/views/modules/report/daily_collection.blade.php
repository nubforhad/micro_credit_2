@extends('layouts.app')

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3 class="fw-bold mb-1">
                <i class="bx bx-line-chart text-primary"></i>
                Daily Collection Report
            </h3>

            <small class="text-muted">
                View Daily Loan Collection Report
            </small>
        </div>

        <div>

            <button onclick="window.print()" class="btn btn-success">
                <i class="bx bx-printer"></i>
                Print
            </button>

        </div>

    </div>

    {{-- Filter --}}

    <div class="card shadow-sm border-0 mb-4">

        <div class="card-body">

            <form method="GET">

                <div class="row align-items-end">

                    <div class="col-md-4">

                        <label class="form-label fw-semibold">
                            Collection Date
                        </label>

                        <input
                            type="date"
                            name="date"
                            value="{{ $date }}"
                            class="form-control">

                    </div>

                    <div class="col-md-3">

                        <button class="btn btn-primary w-100">

                            <i class="bx bx-search"></i>

                            Search

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>


    {{-- Summary --}}

    <div class="row mb-4">

        <div class="col-lg-3">

            <div class="card border-0 shadow-sm">

                <div class="card-body text-center">

                    <i class="bx bx-wallet text-success"
                       style="font-size:45px"></i>

                    <h6 class="mt-2">
                        Total Collection
                    </h6>

                    <h3 class="text-success">

                        ৳ {{ number_format($totalCollection,2) }}

                    </h3>

                </div>

            </div>

        </div>

        <div class="col-lg-3">

            <div class="card border-0 shadow-sm">

                <div class="card-body text-center">

                    <i class="bx bx-receipt text-primary"
                       style="font-size:45px"></i>

                    <h6 class="mt-2">
                        Total Payments
                    </h6>

                    <h3>

                        {{ $payments->count() }}

                    </h3>

                </div>

            </div>

        </div>

        <div class="col-lg-3">

            <div class="card border-0 shadow-sm">

                <div class="card-body text-center">

                    <i class="bx bx-calendar text-warning"
                       style="font-size:45px"></i>

                    <h6 class="mt-2">

                        Report Date

                    </h6>

                    <h5>

                        {{ \Carbon\Carbon::parse($date)->format('d M Y') }}

                    </h5>

                </div>

            </div>

        </div>

    </div>


    {{-- Table --}}

    <div class="card shadow-sm border-0">

        <div class="card-header bg-primary text-white">

            <strong>

                Collection List

            </strong>

        </div>

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle mb-0">

                    <thead class="table-dark">

                    <tr>

                        <th>#</th>

                        <th>Receipt</th>

                        <th>Loan No</th>

                        <th>Member No</th>

                        <th>Member Name</th>

                        <th>Method</th>

                        <th>Amount</th>

                        <th>Collector</th>

                    </tr>

                    </thead>

                    <tbody>

                    @forelse($payments as $key=>$payment)

                        <tr>

                            <td>{{ $key+1 }}</td>

                            <td>

                                {{ $payment->receipt_no }}

                            </td>

                            <td>

                                {{ $payment->loan->loan_no }}

                            </td>

                            <td>

                                {{ $payment->member->member_no }}

                            </td>

                            <td>

                                {{ $payment->member->name }}

                            </td>

                            <td>

                                <span class="badge bg-info">

                                    {{ $payment->payment_method }}

                                </span>

                            </td>

                            <td class="fw-bold text-success">

                                ৳ {{ number_format($payment->amount,2) }}

                            </td>

                            <td>

                                {{ $payment->receiver->name ?? '-' }}

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="8" class="text-center py-5">

                                <i class="bx bx-folder-open"
                                   style="font-size:50px;color:#999;"></i>

                                <br>

                                No Collection Found

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                    @if($payments->count())

                        <tfoot class="table-light">

                        <tr>

                            <th colspan="6" class="text-end">

                                Grand Total

                            </th>

                            <th class="text-success">

                                ৳ {{ number_format($totalCollection,2) }}

                            </th>

                            <th></th>

                        </tr>

                        </tfoot>

                    @endif

                </table>

            </div>

        </div>

    </div>

</div>

@endsection