@extends('layouts.app') @section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Fund Ledger</h4>

    <a href="{{ route('fund-transactions.create') }}" class="btn btn-primary">
        <i class="bx bx-plus"></i>
        Add Transaction
    </a>
</div>

@if(session('success'))

<script>
    Swal.fire({
        icon: "success",
        title: "Success",
        text: "{{ session('success') }}",
        timer: 2000,
        showConfirmButton: false,
    });
</script>

@endif

<!-- Summary -->

<div class="row mb-3">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6>Total Receive</h6>

                <h3 class="text-success">{{ number_format($totalCredit,2) }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6>Total Payment</h6>

                <h3 class="text-danger">{{ number_format($totalDebit,2) }}</h3>
            </div>
        </div>
    </div>
</div>

<!-- Filter -->

<div class="card mb-3 shadow-sm">
    <div class="card-body">
        <form method="GET">
            <div class="row">
                <div class="col-md-4">
                    <label> From Date </label>

                    <input type="date" name="from_date" class="form-control" value="{{ request('from_date') }}" />
                </div>

                <div class="col-md-4">
                    <label> To Date </label>

                    <input type="date" name="to_date" class="form-control" value="{{ request('to_date') }}" />
                </div>

                <div class="col-md-3">
                    <label> Type </label>

                    <select name="type" class="form-control">
                        <option value="">All</option>

                        <option value="loan_disbursement">Loan Disbursement</option>

                        <option value="loan_collection">Loan Collection</option>

                        <option value="saving_deposit">Saving Deposit</option>

                        <option value="saving_withdraw">Saving Withdraw</option>

                        <option value="dps_deposit">DPS Deposit</option>

                        <option value="dps_maturity">DPS Maturity</option>

                        <option value="income">Income</option>

                        <option value="expense">Expense</option>
                    </select>
                </div>

                <div class="col-md-1 mt-4">
                    <button class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Ledger Table -->

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Date</th>

                        <th>Fund</th>

                        <th>Type</th>

                        <th>Receive</th>

                        <th>Payment</th>

                        <th>Balance</th>

                        <th>Remarks</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($transactions as $item)

                    <tr>
                        <td>{{ $item->transaction_date->format('d-m-Y') }}</td>

                        <td>{{ $item->fundAccount->name ?? '' }}</td>

                        <td>{{ ucwords(str_replace('_',' ',$item->type)) }}</td>

                        <td class="text-success">
                            @if($item->dr_cr == 'credit') {{ number_format($item->amount,2) }} @endif
                        </td>

                        <td class="text-danger">
                            @if($item->dr_cr == 'debit') {{ number_format($item->amount,2) }} @endif
                        </td>

                        <td>{{ number_format($item->balance_after,2) }}</td>

                        <td>{{ $item->remarks }}</td>
                    </tr>

                    @empty

                    <tr>
                        <td colspan="7" class="text-center">No Transaction Found</td>
                    </tr>

                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $transactions->links() }}
    </div>
</div>

@endsection
