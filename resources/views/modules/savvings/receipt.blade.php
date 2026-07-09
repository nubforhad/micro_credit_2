@extends('layouts.app') @section('content')

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-body">
            <div class="text-center">
                <h2>{{ config('app.name') }}</h2>

                <h4>SAVVINGS RECEIPT</h4>
            </div>

            <hr />

            <table class="table table-bordered">
                <tr>
                    <th width="40%">Receipt No</th>

                    <td>{{ $savving->receipt_no }}</td>
                </tr>

                <tr>
                    <th>Member Name</th>

                    <td>{{ $savving->member->name ?? '' }}</td>
                </tr>

                <tr>
                    <th>Member No</th>

                    <td>{{ $savving->member->member_no ?? '' }}</td>
                </tr>

                <tr>
                    <th>Transaction Type</th>

                    <td>
                        @if($savving->type=='deposit')

                        <span class="badge bg-success"> Deposit </span>

                        @else

                        <span class="badge bg-danger"> Withdraw </span>

                        @endif
                    </td>
                </tr>

                <tr>
                    <th>Amount</th>

                    <td>
                        <h4>৳ {{ number_format($savving->amount,2) }}</h4>
                    </td>
                </tr>

                <tr>
                    <th>Payment Method</th>

                    <td>{{ $savving->payment_method }}</td>
                </tr>

                <tr>
                    <th>Date</th>

                    <td>{{ \Carbon\Carbon::parse($savving->date)->format('d M,Y') }}</td>
                </tr>

                <tr>
                    <th>Received By</th>

                    <td>{{ $savving->creator->name ?? 'Admin' }}</td>
                </tr>
            </table>

            <div class="row mt-5">
                <div class="col-6 text-center">
                    _________________

                    <br />

                    Customer Signature
                </div>

                <div class="col-6 text-center">
                    _________________

                    <br />

                    Authorized Signature
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    window.print();
</script>

@endsection
