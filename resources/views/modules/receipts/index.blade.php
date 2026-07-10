@extends('layouts.app') @section('content')

<div class="d-flex justify-content-between mb-3">
    <h4>DPS Payment Receipt</h4>

    <button onclick="window.print()" class="btn btn-dark">Print Receipt</button>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="text-center mb-4">
            <h3>Your Company Name</h3>

            <h5>DPS Payment Receipt</h5>

            <hr />
        </div>

        <div class="row">
            <div class="col-md-6">
                <p>
                    <strong>Receipt No:</strong>

                    {{$receipt->receipt_no}}
                </p>

                <p>
                    <strong>Member Name:</strong>

                    {{$payment->account->member->name}}
                </p>

                <p>
                    <strong>Member No:</strong>

                    {{$payment->account->member->member_no}}
                </p>
            </div>

            <div class="col-md-6">
                <p>
                    <strong>DPS Account:</strong>

                    {{$payment->account->account_no}}
                </p>

                <p>
                    <strong>DPS Plan:</strong>

                    {{$payment->account->plan->name}}
                </p>

                <p>
                    <strong>Date:</strong>

                    {{$payment->payment_date}}
                </p>
            </div>
        </div>

        <table class="table table-bordered mt-4">
            <tr>
                <th>Installment No</th>

                <td>{{$payment->installment_no}}</td>
            </tr>

            <tr>
                <th>Amount</th>

                <td>{{number_format($payment->amount,2)}}</td>
            </tr>

            <tr>
                <th>Payment Method</th>

                <td>{{$payment->payment_method}}</td>
            </tr>

            <tr>
                <th>Note</th>

                <td>{{$payment->note}}</td>
            </tr>
        </table>

        <div class="row mt-5">
            <div class="col-md-6 text-center">
                <br /><br />

                _____________________

                <br />

                Customer Signature
            </div>

            <div class="col-md-6 text-center">
                <br /><br />

                _____________________

                <br />

                Authorized Signature
            </div>
        </div>
    </div>
</div>

@endsection
