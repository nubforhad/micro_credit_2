@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <h4>Savvings Summary</h4>

    <a href="{{ route('savvings.index') }}" class="btn btn-primary">
        Back
    </a>

</div>
<form method="GET" class="mb-4">

<div class="row">


    <div class="col-md-3">

        <label>
            From Date
        </label>

        <input 
            type="date"
            name="from_date"
            value="{{ request('from_date') }}"
            class="form-control"
        >

    </div>



    <div class="col-md-3">

        <label>
            To Date
        </label>

        <input 
            type="date"
            name="to_date"
            value="{{ request('to_date') }}"
            class="form-control"
        >

    </div>



    <div class="col-md-3">

        <label>
            Quick Filter
        </label>

        <select name="filter" class="form-control">

            <option value="">
                Select
            </option>


            <option value="today"
            {{ request('filter')=='today'?'selected':'' }}>
                Today
            </option>


        </select>


    </div>



    <div class="col-md-3 mt-4">

        <button class="btn btn-dark">
            Filter
        </button>


        <a href="{{ route('savvings.summary') }}"
           class="btn btn-secondary">

            Reset

        </a>

    </div>


</div>

</form>
<div class="row">

    <div class="col-md-4 mb-3">

        <div class="card border-success shadow">

            <div class="card-body text-center">

                <h6>Total Approved Deposit</h6>

                <h3 class="text-success">

                    ৳ {{ number_format($totalApprovedDeposit,2) }}

                </h3>

            </div>

        </div>

    </div>

    <div class="col-md-4 mb-3">

        <div class="card border-primary shadow">

            <div class="card-body text-center">

                <h6>Total Approved Withdraw</h6>

                <h3 class="text-primary">

                    ৳ {{ number_format($totalApprovedWithdraw,2) }}

                </h3>

            </div>

        </div>

    </div>

    <div class="col-md-4 mb-3">

        <div class="card border-warning shadow">

            <div class="card-body text-center">

                <h6>Total Pending Withdraw</h6>

                <h3 class="text-warning">

                    ৳ {{ number_format($totalPendingWithdraw,2) }}

                </h3>

            </div>

        </div>

    </div>

    <div class="col-md-4 mb-3">

        <div class="card border-danger shadow">

            <div class="card-body text-center">

                <h6>Total Rejected Withdraw</h6>

                <h3 class="text-danger">

                    ৳ {{ number_format($totalRejectedWithdraw,2) }}

                </h3>

            </div>

        </div>

    </div>

    <div class="col-md-4 mb-3">

        <div class="card border-dark shadow">

            <div class="card-body text-center">

                <h6>Current Savings Balance</h6>

                <h3 class="text-dark">

                    ৳ {{ number_format($currentBalance,2) }}

                </h3>

            </div>

        </div>

    </div>

</div>

@endsection