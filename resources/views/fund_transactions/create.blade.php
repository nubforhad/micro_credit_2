@extends('layouts.app') @section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Add Fund Transaction</h4>

    <a href="{{ route('fund.ledger') }}" class="btn btn-secondary"> Back </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('fund-transactions.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label> Fund Account </label>

                    <select name="fund_account_id" class="form-control" required>
                        <option value="">Select Fund</option>

                        @foreach($fundAccounts as $fund)

                        <option value="{{ $fund->id }}">
                            {{ $fund->name }} (Current: {{ number_format($fund->current_balance,2) }} )
                        </option>

                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label> Transaction Date </label>

                    <input
                        type="date"
                        name="transaction_date"
                        class="form-control"
                        value="{{ date('Y-m-d') }}"
                        required
                    />
                </div>

                <div class="col-md-6 mb-3">
                    <label> Transaction Type </label>

                    <select name="type" class="form-control" required>
                        <option value="">Select Type</option>

                        <option value="opening_balance">Opening Balance</option>

                        <option value="income">Income</option>

                        <option value="expense">Expense</option>

                        <option value="transfer">Transfer</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label> Transaction Mode </label>

                    <select name="dr_cr" class="form-control" required>
                        <option value="">Select</option>

                        <option value="credit">Receive (+)</option>

                        <option value="debit">Payment (-)</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label> Amount </label>

                    <input type="number" step="0.01" name="amount" class="form-control" required />
                </div>

                <div class="col-md-12 mb-3">
                    <label> Remarks </label>

                    <textarea name="remarks" class="form-control" rows="3"></textarea>
                </div>
            </div>

            <button class="btn btn-primary">Save Transaction</button>
        </form>
    </div>
</div>

@endsection
