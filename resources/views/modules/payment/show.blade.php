@extends('layouts.app')

@section('content')

<div class="container-fluid">

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h3 class="fw-bold mb-1">
                <i class="bx bx-receipt text-primary"></i>
                Payment Details
            </h3>

            <small class="text-muted">
                Loan Collection Receipt Information
            </small>

        </div>

        <div>

            <a href="{{ route('loan.payment.index') }}" class="btn btn-secondary">

                <i class="bx bx-arrow-back"></i>

                Back

            </a>

             <a href="{{ route('loan.payment.print',$payment->id) }}"
                target="_blank"
                class="btn btn-primary">

                    <i class="bx bx-printer"></i>

                    Print Receipt

            </a>

        </div>

    </div>

    <div class="row">

        {{-- Receipt --}}
        <div class="col-lg-8">

            <div class="card shadow border-0">

                <div class="card-header bg-primary text-white">

                    <div class="d-flex justify-content-between">

                        <div>

                            <h4 class="mb-0 fw-bold">
                                MICRO CREDIT ERP
                            </h4>

                            <small>
                                Loan Payment Receipt
                            </small>

                        </div>

                        <div class="text-end">

                            <h5 class="mb-0">

                                {{ $payment->receipt_no }}

                            </h5>

                            <small>

                                {{ \Carbon\Carbon::parse($payment->payment_date)->format('d M Y') }}

                            </small>

                        </div>

                    </div>

                </div>

                <div class="card-body">

                    {{-- Member Information --}}

                    <div class="row mb-4">

                        <div class="col-md-6">

                            <div class="border rounded p-3 h-100">

                                <h6 class="text-primary fw-bold mb-3">

                                    <i class="bx bx-user"></i>

                                    Member Information

                                </h6>

                                <table class="table table-borderless mb-0">

                                    <tr>

                                        <th width="40%">Member No</th>

                                        <td>{{ $payment->member->member_no }}</td>

                                    </tr>

                                    <tr>

                                        <th>Name</th>

                                        <td>{{ $payment->member->name }}</td>

                                    </tr>

                                    <tr>

                                        <th>Phone</th>

                                        <td>{{ $payment->member->mobile ?? '-' }}</td>

                                    </tr>

                                </table>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="border rounded p-3 h-100">

                                <h6 class="text-success fw-bold mb-3">

                                    <i class="bx bx-wallet"></i>

                                    Loan Information

                                </h6>

                                <table class="table table-borderless mb-0">

                                    <tr>

                                        <th width="40%">Loan No</th>

                                        <td>{{ $payment->loan->loan_no }}</td>

                                    </tr>

                                    <tr>

                                        <th>Installment</th>

                                        <td>#{{ $payment->installment->installment_no }}</td>

                                    </tr>

                                    <tr>

                                        <th>Status</th>

                                        <td>

                                            <span class="badge bg-success">

                                                Paid

                                            </span>

                                        </td>

                                    </tr>

                                </table>

                            </div>

                        </div>

                    </div>

                    {{-- Payment Information --}}

                    <div class="card border">

                        <div class="card-header bg-light">

                            <strong>

                                Payment Information

                            </strong>

                        </div>

                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-6">

                                    <table class="table">

                                        <tr>

                                            <th width="45%">

                                                Receipt No

                                            </th>

                                            <td>

                                                {{ $payment->receipt_no }}

                                            </td>

                                        </tr>

                                        <tr>

                                            <th>

                                                Payment Date

                                            </th>

                                            <td>

                                                {{ \Carbon\Carbon::parse($payment->payment_date)->format('d M Y') }}

                                            </td>

                                        </tr>

                                        <tr>

                                            <th>

                                                Payment Method

                                            </th>

                                            <td>

                                                <span class="badge bg-primary">

                                                    {{ $payment->payment_method }}

                                                </span>

                                            </td>

                                        </tr>

                                    </table>

                                </div>

                                <div class="col-md-6">

                                    <table class="table">

                                        <tr>

                                            <th width="45%">

                                                Paid Amount

                                            </th>

                                            <td>

                                                <span class="fw-bold text-success fs-4">

                                                    ৳ {{ number_format($payment->amount,2) }}

                                                </span>

                                            </td>

                                        </tr>

                                        <tr>

                                            <th>

                                                Collected By

                                            </th>

                                            <td>

                                                {{ $payment->receiver->name ?? '-' }}

                                            </td>

                                        </tr>

                                        <tr>

                                            <th>

                                                Note

                                            </th>

                                            <td>

                                                {{ $payment->note ?? 'N/A' }}

                                            </td>

                                        </tr>

                                    </table>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        {{-- Summary Card --}}

        <div class="col-lg-4">

            <div class="card shadow border-0">

                <div class="card-body text-center">

                    <i class="bx bx-check-circle text-success"
                       style="font-size:80px;"></i>

                    <h3 class="text-success mt-3">

                        Payment Successful

                    </h3>

                    <hr>

                    <h6 class="text-muted">

                        Amount Received

                    </h6>

                    <h2 class="fw-bold text-primary">

                        ৳ {{ number_format($payment->amount,2) }}

                    </h2>

                    <hr>

                    <p class="mb-1">

                        Receipt No

                    </p>

                    <h5>

                        {{ $payment->receipt_no }}

                    </h5>

                    <hr>

                    <small class="text-muted">

                        Thank you for your payment.

                    </small>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection