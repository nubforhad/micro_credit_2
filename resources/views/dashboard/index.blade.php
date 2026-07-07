@extends('layouts.app')

@section('content')

<h4 class="mb-3">Microfinance Dashboard</h4>

<div class="row">

    <div class="col-md-3">
        <div class="card text-white bg-primary mb-3">
            <div class="card-body">
                <h5>Total Loans</h5>
                <h3>{{ $totalLoan }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-white bg-success mb-3">
            <div class="card-body">
                <h5>Active Loans</h5>
                <h3>{{ $activeLoan }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-white bg-warning mb-3">
            <div class="card-body">
                <h5>Total Collection</h5>
                <h3>{{ number_format($totalCollection, 2) }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-white bg-danger mb-3">
            <div class="card-body">
                <h5>Overdue Installments</h5>
                <h3>{{ $overdue }}</h3>
            </div>
        </div>
    </div>

</div>

<div class="row mt-3">

    <div class="col-md-3">
        <div class="card text-dark bg-light mb-3">
            <div class="card-body">
                <h5>Today Due</h5>
                <h3>{{ $dueToday }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-dark bg-light mb-3">
            <div class="card-body">
                <h5>Total Loan Amount</h5>
                <h3>{{ number_format($totalLoanAmount, 2) }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-dark bg-light mb-3">
            <div class="card-body">
                <h5>Total Overdue Count</h5>
                <h3>{{ number_format($overdueCount, 2) }}</h3>
            </div>
        </div>
    </div>

</div>

@endsection