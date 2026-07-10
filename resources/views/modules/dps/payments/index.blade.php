@extends('layouts.app') @section('content') @if(session('success'))

<script>
    Swal.fire({
        icon: "success",

        title: "Success",

        text: "{{session('success')}}",

        timer: 2000,

        showConfirmButton: false,
    });
</script>

@endif

<div class="d-flex justify-content-between mb-3">
    <h4>DPS Collection History</h4>

    <a href="{{route('dps-payments.create')}}" class="btn btn-primary"> New Collection </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>

                    <th>Account</th>

                    <th>Member</th>

                    <th>Installment No</th>

                    <th>Amount</th>

                    <th>Method</th>

                    <th>Date</th>
                </tr>
            </thead>

            <tbody>
                @foreach($payments as $payment)

                <tr>
                    <td>{{$loop->iteration}}</td>

                    <td>{{$payment->account->account_no}}</td>

                    <td>{{$payment->account->member->name}}</td>

                    <td>{{$payment->installment_no}}</td>

                    <td>{{$payment->amount}}</td>

                    <td>{{$payment->payment_method}}</td>

                    <td>{{$payment->payment_date}}</td>
                </tr>

                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
