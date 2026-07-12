@extends('layouts.app') @section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Cash Book Report</h4>
</div>

{{-- Date Filter --}}

<div class="card shadow-sm mb-3">
    <div class="card-body">
        <form method="GET" action="{{ route('cash-book.index') }}">
            <div class="row">
                <div class="col-md-4">
                    <label class="form-label"> Date </label>

                    <input type="date" name="date" class="form-control" value="{{ $date }}" />
                </div>

                <div class="col-md-2 mt-4">
                    <button class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Summary Cards --}}

<div class="row mb-3">
    <div class="col-md-3">
        <div class="card shadow-sm border-start border-primary">
            <div class="card-body">
                <h6>Opening Balance</h6>

                <h4>৳ {{ number_format($openingBalance,2) }}</h4>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-start border-success">
            <div class="card-body">
                <h6>Total Credit</h6>

                <h4 class="text-success">৳ {{ number_format($credit,2) }}</h4>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-start border-danger">
            <div class="card-body">
                <h6>Total Debit</h6>

                <h4 class="text-danger">৳ {{ number_format($debit,2) }}</h4>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-start border-dark">
            <div class="card-body">
                <h6>Closing Balance</h6>

                <h4>৳ {{ number_format($closingBalance,2) }}</h4>
            </div>
        </div>
    </div>
</div>

{{-- Transaction Table --}}

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>

                        <th>Date</th>

                        <th>Fund</th>

                        <th>Type</th>

                        <th>Debit</th>

                        <th>Credit</th>

                        <th>Balance</th>

                        <th>Remarks</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($transactions as $transaction)

                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $transaction->transaction_date->format('d-m-Y') }}</td>

                        <td>{{ $transaction->fundAccount->name ?? '-' }}</td>

                        <td>
                            @if($transaction->dr_cr=='credit')

                            <span class="badge bg-success"> {{ ucfirst($transaction->type) }} </span>

                            @else

                            <span class="badge bg-danger"> {{ ucfirst($transaction->type) }} </span>

                            @endif
                        </td>

                        <td>
                            @if($transaction->dr_cr=='debit') ৳ {{ number_format($transaction->amount,2) }} @else -
                            @endif
                        </td>

                        <td>
                            @if($transaction->dr_cr=='credit') ৳ {{ number_format($transaction->amount,2) }} @else -
                            @endif
                        </td>

                        <td>৳ {{ number_format($transaction->balance_after,2) }}</td>

                        <td>{{ $transaction->remarks }}</td>
                    </tr>

                    @empty

                    <tr>
                        <td colspan="8" class="text-center">No Transaction Found</td>
                    </tr>

                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
