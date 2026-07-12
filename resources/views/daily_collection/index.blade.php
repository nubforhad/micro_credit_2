@extends('layouts.app') @section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Daily Collection Report</h4>

    <button onclick="window.print()" class="btn btn-dark">Print</button>
</div>

{{-- Date Filter --}}

<div class="card shadow-sm mb-3">
    <div class="card-body">
        <form method="GET" action="{{ route('daily-collection.index') }}">
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

{{-- Summary --}}

<div class="row mb-3">
    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6>Loan Collection</h6>

                <h4 class="text-primary">৳ {{ number_format($loanTotal,2) }}</h4>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6>Savings Deposit</h6>

                <h4 class="text-success">৳ {{ number_format($savingTotal,2) }}</h4>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6>DPS Collection</h6>

                <h4 class="text-warning">৳ {{ number_format($dpsTotal,2) }}</h4>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6>Total Collection</h6>

                <h4>৳ {{ number_format($grandTotal,2) }}</h4>
            </div>
        </div>
    </div>
</div>

{{-- Loan Collection --}}

<div class="card shadow-sm mb-3">
    <div class="card-header">
        <h5>Loan Collection</h5>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>

                        <th>Member</th>

                        <th>Receipt</th>

                        <th>Amount</th>

                        <th>Method</th>

                        <th>Collector</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($loanCollections as $row)

                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $row->member->name ?? '-' }}</td>

                        <td>{{ $row->receipt_no }}</td>

                        <td>৳ {{ number_format($row->amount,2) }}</td>

                        <td>{{ $row->payment_method }}</td>

                        <td>{{ $row->receiver->name ?? '-' }}</td>
                    </tr>

                    @empty

                    <tr>
                        <td colspan="6" class="text-center">No Loan Collection</td>
                    </tr>

                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Savings Collection --}}

<div class="card shadow-sm mb-3">
    <div class="card-header">
        <h5>Savings Deposit</h5>
    </div>

    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>

                    <th>Member</th>

                    <th>Receipt</th>

                    <th>Amount</th>

                    <th>Collector</th>
                </tr>
            </thead>

            <tbody>
                @forelse($savingCollections as $row)

                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $row->member->name }}</td>

                    <td>{{ $row->receipt_no }}</td>

                    <td>৳ {{ number_format($row->amount,2) }}</td>

                    <td>{{ $row->creator->name ?? '-' }}</td>
                </tr>

                @empty

                <tr>
                    <td colspan="5" class="text-center">No Savings Collection</td>
                </tr>

                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- DPS Collection --}}

<div class="card shadow-sm mb-3">
    <div class="card-header">
        <h5>DPS Collection</h5>
    </div>

    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>

                    <th>Member</th>

                    <th>Installment</th>

                    <th>Amount</th>
                </tr>
            </thead>

            <tbody>
                @forelse($dpsCollections as $row)

                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $row->member->name }}</td>

                    <td>{{ $row->installment_no }}</td>

                    <td>৳ {{ number_format($row->amount,2) }}</td>
                </tr>

                @empty

                <tr>
                    <td colspan="4" class="text-center">No DPS Collection</td>
                </tr>

                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
