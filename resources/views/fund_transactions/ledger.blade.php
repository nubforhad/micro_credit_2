@extends('layouts.app')

@section('content')

<div class="container-fluid">

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="mb-0">
                <i class="fas fa-book me-2"></i>
                Fund Ledger
            </h4>
            <small class="text-muted">
                Loan, Savings, DPS & Fund Transactions
            </small>
        </div>

        <div>
            <button onclick="window.print()" class="btn btn-primary">
                <i class="fas fa-print"></i> Print
            </button>
        </div>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Error Message --}}
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    {{-- Summary Cards --}}
    <div class="row mb-4">

        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">

                    <small class="text-muted">
                        Current Fund Balance
                    </small>

                    <h3 class="text-success mt-2">
                        ৳ {{ number_format($currentBalance,2) }}
                    </h3>

                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">

                    <small class="text-muted">
                        Today's Credit
                    </small>

                    <h3 class="text-primary mt-2">
                        ৳ {{ number_format($todayCredit,2) }}
                    </h3>

                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">

                    <small class="text-muted">
                        Today's Debit
                    </small>

                    <h3 class="text-danger mt-2">
                        ৳ {{ number_format($todayDebit,2) }}
                    </h3>

                </div>
            </div>
        </div>

    </div>

    {{-- Filter --}}
    <div class="card shadow-sm mb-4">

        <div class="card-header">

            <strong>
                Search Filter
            </strong>

        </div>

        <div class="card-body">

            <form method="GET"
                  action="{{ route('fund.ledger') }}">

                <div class="row">

                    <div class="col-md-3 mb-3">

                        <label>
                            From Date
                        </label>

                        <input
                            type="date"
                            name="from_date"
                            class="form-control"
                            value="{{ request('from_date') }}">

                    </div>

                    <div class="col-md-3 mb-3">

                        <label>
                            To Date
                        </label>

                        <input
                            type="date"
                            name="to_date"
                            class="form-control"
                            value="{{ request('to_date') }}">

                    </div>

                    <div class="col-md-3 mb-3">

                        <label>
                            Transaction Type
                        </label>

                        <select
                            name="type"
                            class="form-select">

                            <option value="">
                                All
                            </option>

                            <option value="loan_disbursement"
                                {{ request('type')=='loan_disbursement'?'selected':'' }}>
                                Loan Disbursement
                            </option>

                            <option value="loan_collection"
                                {{ request('type')=='loan_collection'?'selected':'' }}>
                                Loan Collection
                            </option>

                            <option value="saving_deposit"
                                {{ request('type')=='saving_deposit'?'selected':'' }}>
                                Saving Deposit
                            </option>

                            <option value="saving_withdraw"
                                {{ request('type')=='saving_withdraw'?'selected':'' }}>
                                Saving Withdraw
                            </option>

                            <option value="dps_deposit"
                                {{ request('type')=='dps_deposit'?'selected':'' }}>
                                DPS Deposit
                            </option>

                            <option value="dps_maturity"
                                {{ request('type')=='dps_maturity'?'selected':'' }}>
                                DPS Maturity
                            </option>

                            <option value="income"
                                {{ request('type')=='income'?'selected':'' }}>
                                Income
                            </option>

                            <option value="expense"
                                {{ request('type')=='expense'?'selected':'' }}>
                                Expense
                            </option>

                        </select>

                    </div>

                    <div class="col-md-3 mb-3">

                        <label>
                            Fund Account
                        </label>

                        <select
                            name="fund_account_id"
                            class="form-select">

                            <option value="">
                                All Fund
                            </option>

                            @foreach($fundAccounts as $account)

                                <option
                                    value="{{ $account->id }}"
                                    {{ request('fund_account_id')==$account->id?'selected':'' }}>

                                    {{ $account->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                </div>

                <div class="mt-2">

                    <button
                        class="btn btn-success">

                        <i class="fas fa-search"></i>

                        Search

                    </button>

                    <a href="{{ route('fund.ledger') }}"
                       class="btn btn-secondary">

                        Reset

                    </a>

                </div>

            </form>

        </div>

    </div>

    {{-- Ledger Table --}}
    <div class="card shadow-sm">

        <div class="card-header">

            <strong>
                Fund Transaction Ledger
            </strong>

        </div>

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-bordered table-hover mb-0">

                    <thead class="table-dark">

                    <tr>

                        <th width="70">
                            #
                        </th>

                        <th>
                            Date
                        </th>

                        <th>
                            Fund
                        </th>

                        <th>
                            Type
                        </th>

                        <th>
                            DR/CR
                        </th>

                        <th class="text-end">
                            Amount
                        </th>

                        <th class="text-end">
                            Balance
                        </th>

                        <th>
                            Remarks
                        </th>

                    </tr>

                    </thead>

                    <tbody>

                                            @forelse($transactions as $key => $transaction)

                    <tr>

                        <td>
                            {{ $transactions->firstItem() + $key }}
                        </td>

                        <td>
                            {{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d-m-Y') }}
                        </td>

                        <td>
                            {{ $transaction->fundAccount->name ?? '-' }}
                        </td>

                        <td>

                            @switch($transaction->type)

                                @case('loan_collection')
                                    <span class="badge bg-success">
                                        Loan Collection
                                    </span>
                                    @break

                                @case('loan_disbursement')
                                    <span class="badge bg-danger">
                                        Loan Disbursement
                                    </span>
                                    @break

                                @case('saving_deposit')
                                    <span class="badge bg-primary">
                                        Saving Deposit
                                    </span>
                                    @break

                                @case('saving_withdraw')
                                    <span class="badge bg-warning text-dark">
                                        Saving Withdraw
                                    </span>
                                    @break

                                @case('dps_deposit')
                                    <span class="badge bg-info text-dark">
                                        DPS Deposit
                                    </span>
                                    @break

                                @case('dps_maturity')
                                    <span class="badge bg-secondary">
                                        DPS Maturity
                                    </span>
                                    @break

                                @case('income')
                                    <span class="badge bg-success">
                                        Income
                                    </span>
                                    @break

                                @case('expense')
                                    <span class="badge bg-danger">
                                        Expense
                                    </span>
                                    @break

                                @default
                                    <span class="badge bg-dark">
                                        {{ ucfirst(str_replace('_',' ',$transaction->type)) }}
                                    </span>

                            @endswitch

                        </td>

                        <td>

                            @if($transaction->dr_cr=='credit')

                                <span class="badge bg-success">
                                    Credit
                                </span>

                            @else

                                <span class="badge bg-danger">
                                    Debit
                                </span>

                            @endif

                        </td>

                        <td class="text-end">

                            @if($transaction->dr_cr=='credit')

                                <span class="text-success fw-bold">

                                    + {{ number_format($transaction->amount,2) }}

                                </span>

                            @else

                                <span class="text-danger fw-bold">

                                    - {{ number_format($transaction->amount,2) }}

                                </span>

                            @endif

                        </td>

                        <td class="text-end fw-bold">

                            {{ number_format($transaction->balance_after,2) }}

                        </td>

                        <td>

                            {{ $transaction->remarks ?? '-' }}

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="8"
                            class="text-center text-muted py-4">

                            No transaction found.

                        </td>

                    </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        @if($transactions->hasPages())

        <div class="card-footer">

            {{ $transactions->withQueryString()->links() }}

        </div>

        @endif

    </div>

</div>



<style>

@media print{

    .btn,
    form,
    nav,
    .pagination,
    .card-header{

        display:none !important;

    }

    body{

        background:#fff;

    }

    .card{

        border:none !important;

        box-shadow:none !important;

    }

}

.table td{

    vertical-align:middle;

}

.card{

    border-radius:10px;

}

.badge{

    font-size:13px;

}

</style>
@endsection

 