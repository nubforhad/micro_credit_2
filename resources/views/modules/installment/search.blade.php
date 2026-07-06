@extends('layouts.app')

@section('content')

<div class="card mb-3">
    <div class="card-body">

        <form method="GET" action="{{ route('installment.search.result') }}" class="d-flex gap-2">

            <input type="text"
                   name="search"
                   class="form-control"
                   placeholder="Search by Loan No or Member No">

            <button class="btn btn-primary">
                Search
            </button>

        </form>

    </div>
</div>

@if(isset($installments))

<div class="card">
<div class="card-body">

<table class="table table-bordered">

    <thead class="table-dark">
        <tr>
            <th>Loan No</th>
            <th>Member No</th>
            <th>Member Name</th>
            <th>Installment</th>
            <th>Due</th>
            <th>Amount</th>
            <th>Paid</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>

        @foreach($installments as $item)
        <tr>

            <td>{{ $item->loan->loan_no }}</td>

            <td>{{ $item->loan->member->member_no }}</td>

            <td>{{ $item->loan->member->name }}</td>

            <td>{{ $item->installment_no }}</td>

            <td>{{ $item->due_date }}</td>

            <td>{{ $item->amount }}</td>

            <td>{{ $item->paid_amount }}</td>

            <td>
                <span class="badge bg-{{ $item->status=='paid'?'success':($item->status=='partial'?'warning':'danger') }}">
                    {{ ucfirst($item->status) }}
                </span>
            </td>

            <td>

                @if($item->status != 'paid')

                <form action="{{ route('installment.pay', $item->id) }}" method="POST" class="d-flex gap-2">
                    @csrf

                    <input type="number" name="paid_amount" class="form-control form-control-sm" placeholder="Pay">

                    <button class="btn btn-success btn-sm">
                        Pay
                    </button>

                </form>

                @else
                    <span class="text-success">Done</span>
                @endif

            </td>

        </tr>
        @endforeach

    </tbody>

</table>

</div>
</div>

@endif

@endsection