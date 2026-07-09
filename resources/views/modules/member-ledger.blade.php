@extends('layouts.app') @section('content')

<div class="d-flex justify-content-between mb-3">
    <h4>{{ $member->name }} - Savings Ledger</h4>

    <a href="{{ route('savvings.member.summary') }}" class="btn btn-secondary"> Back </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>

                    <th>Date</th>

                    <th>Receipt</th>

                    <th>Type</th>

                    <th>Status</th>

                    <th>Amount</th>

                    <th>Balance</th>
                </tr>
            </thead>

            <tbody>
                @foreach($transactions as $key=>$item)

                <tr>
                    <td>{{ $key+1 }}</td>

                    <td>{{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}</td>

                    <td>{{ $item->receipt_no }}</td>

                    <td>
                        @if($item->type=='deposit')

                        <span class="badge bg-success"> Deposit </span>

                        @else

                        <span class="badge bg-danger"> Withdraw </span>

                        @endif
                    </td>

                    <td>
                        @if($item->status=='approved')

                        <span class="badge bg-success"> Approved </span>

                        @elseif($item->status=='pending')

                        <span class="badge bg-warning text-dark"> Pending </span>

                        @else

                        <span class="badge bg-danger"> Rejected </span>

                        @endif
                    </td>

                    <td>৳ {{ number_format($item->amount,2) }}</td>

                    <td>৳ {{ number_format($item->balance,2) }}</td>
                </tr>

                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
