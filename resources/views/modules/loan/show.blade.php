@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Loan Details</h4>

    <a href="{{ route('loan.index') }}" class="btn btn-secondary">
        ← Back
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        {{-- BASIC INFO --}}
        <div class="row">

            <div class="col-md-6">
                <p><b>Loan No:</b> {{ $loan->loan_no }}</p>
                <p><b>Member:</b> {{ $loan->member->name ?? 'N/A' }}</p>
                <p><b>Product:</b> {{ $loan->loanProduct->name ?? 'N/A' }}</p>
                <p><b>Amount:</b> {{ number_format($loan->amount, 2) }}</p>
            </div>

            <div class="col-md-6">
                <p><b>Total Payable:</b> {{ number_format($loan->total_payable, 2) }}</p>

                <p>
                    <b>Status:</b>
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
                </p>

                <p><b>Start Date:</b> {{ $loan->start_date ?? 'N/A' }}</p>
            </div>

        </div>

        <hr>

        {{-- LOAN PRODUCT INFO --}}
        <h5>Loan Product Information</h5>

        <div class="row">

            <div class="col-md-4">
                <p><b>Interest Rate:</b> {{ $loan->loanProduct->interest_rate ?? 0 }}%</p>
            </div>

            <div class="col-md-4">
                <p><b>Interest Type:</b> {{ ucfirst($loan->loanProduct->interest_type ?? '-') }}</p>
            </div>

            <div class="col-md-4">
                <p><b>Installment Type:</b> {{ ucfirst($loan->loanProduct->installment_type ?? '-') }}</p>
            </div>

            <div class="col-md-4">
                <p><b>Duration:</b> {{ $loan->loanProduct->duration ?? '-' }} Months/Weeks</p>
            </div>

            <div class="col-md-4">
                <p><b>Processing Fee:</b> {{ $loan->loanProduct->processing_fee ?? 0 }}</p>
            </div>

            <div class="col-md-4">
                <p><b>Insurance Fee:</b> {{ $loan->loanProduct->insurance_fee ?? 0 }}</p>
            </div>

        </div>

        <hr>

        {{-- NOTE --}}
        <p><b>Note:</b> {{ $loan->note ?? 'N/A' }}</p>

    </div>
</div>

@endsection