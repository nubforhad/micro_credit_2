@extends('layouts.app') @section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Savvings Details</h4>

    <div>
        <a href="{{ route('savvings.index') }}" class="btn btn-secondary"> ← Back </a>
        <a href="{{ route('savvings.receipt',$savving->id) }}" class="btn btn-success" target="_blank">
            <i class="bx bx-printer"></i>
            Print Receipt
        </a>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="text-center mb-4">
            <h3>{{ config('app.name') }}</h3>

            <h5>Savvings Receipt</h5>
        </div>

        <hr />

        <div class="row">
            <div class="col-md-6">
                <p>
                    <strong> Receipt No: </strong>

                    {{ $savving->receipt_no }}
                </p>

                <p>
                    <strong> Member Name: </strong>

                    {{ $savving->member->name ?? 'N/A' }}
                </p>

                <p>
                    <strong> Member No: </strong>

                    {{ $savving->member->member_no ?? 'N/A' }}
                </p>
            </div>

            <div class="col-md-6">
                <p>
                    <strong> Date: </strong>

                    {{ \Carbon\Carbon::parse($savving->date)->format('d M, Y') }}
                </p>

                <p>
                    <strong> Transaction Type: </strong>

                    @if($savving->type=='deposit')

                    <span class="badge bg-success"> Deposit </span>

                    @else

                    <span class="badge bg-danger"> Withdraw </span>

                    @endif
                </p>

                <p>
                    <strong> Payment Method: </strong>

                    {{ $savving->payment_method }}
                </p>
            </div>
        </div>

        <hr />

        <div class="text-center">
            <h4>Amount</h4>

            <h2 class="text-primary">৳ {{ number_format($savving->amount,2) }}</h2>
        </div>

        <hr />

        <p>
            <strong> Note: </strong>

            {{ $savving->note ?? 'N/A' }}
        </p>

        <p>
            <strong> Created By: </strong>

            {{ $savving->creator->name ?? 'Admin' }}
        </p>

        <div class="row mt-5">
            <div class="col-md-6 text-center">
                _____________________

                <br />

                Customer Signature
            </div>

            <div class="col-md-6 text-center">
                _____________________

                <br />

                Authorized Signature
            </div>
        </div>
    </div>
</div>

<style>
    @media print {
        .btn,
        .sidebar,
        .navbar {
            display: none !important;
        }

        .card {
            box-shadow: none !important;

            border: none !important;
        }
    }
</style>

@endsection
