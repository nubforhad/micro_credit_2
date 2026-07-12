@extends('layouts.app') @section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Reports Dashboard</h4>
</div>

{{-- FUND SUMMARY --}}

<h5 class="mb-3">Fund Summary</h5>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6>Current Fund Balance</h6>

                <h4>৳ {{ number_format($currentFund,2) }}</h4>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6>Total Credit</h6>

                <h4 class="text-success">৳ {{ number_format($totalCredit,2) }}</h4>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6>Total Debit</h6>

                <h4 class="text-danger">৳ {{ number_format($totalDebit,2) }}</h4>
            </div>
        </div>
    </div>
</div>

{{-- LOAN SUMMARY --}}

<h5 class="mb-3">Loan Summary</h5>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6>Total Loan</h6>

                <h4>৳ {{ number_format($totalLoanAmount,2) }}</h4>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6>Collection</h6>

                <h4 class="text-success">৳ {{ number_format($totalLoanCollection,2) }}</h4>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6>Running Loan</h6>

                <h4>{{ $activeLoan }}</h4>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6>Closed Loan</h6>

                <h4>{{ $closedLoan }}</h4>
            </div>
        </div>
    </div>
</div>

{{-- SAVINGS SUMMARY --}}

<h5 class="mb-3">Savings Summary</h5>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6>Total Deposit</h6>

                <h4 class="text-success">৳ {{ number_format($totalSavingDeposit,2) }}</h4>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6>Total Withdraw</h6>

                <h4 class="text-danger">৳ {{ number_format($totalSavingWithdraw,2) }}</h4>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6>Savings Balance</h6>

                <h4>৳ {{ number_format($savingBalance,2) }}</h4>
            </div>
        </div>
    </div>
</div>

{{-- DPS SUMMARY --}}

<h5 class="mb-3">DPS Summary</h5>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6>Running DPS</h6>

                <h4>{{ $activeDps }}</h4>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6>Completed DPS</h6>

                <h4>{{ $completedDps }}</h4>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6>DPS Collection</h6>

                <h4>৳ {{ number_format($totalDpsCollection,2) }}</h4>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6>Maturity Paid</h6>

                <h4>৳ {{ number_format($totalMaturityPaid,2) }}</h4>
            </div>
        </div>
    </div>
</div>

{{-- INCOME EXPENSE --}}

<h5 class="mb-3">Income Expense</h5>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6>Total Income</h6>

                <h4 class="text-success">৳ {{ number_format($totalIncome,2) }}</h4>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6>Total Expense</h6>

                <h4 class="text-danger">৳ {{ number_format($totalExpense,2) }}</h4>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6>Net Profit</h6>

                <h4>৳ {{ number_format($netProfit,2) }}</h4>
            </div>
        </div>
    </div>
</div>

@endsection
