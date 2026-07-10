@extends('layouts.app') @section('content')

<div class="d-flex justify-content-between mb-3">
    <h4>DPS Due Installment</h4>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>

                    <th>Account No</th>

                    <th>Member</th>

                    <th>Plan</th>

                    <th>Total Installment</th>

                    <th>Paid</th>

                    <th>Due Installment</th>

                    <th>Due Amount</th>

                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse($accounts as $account)

                <tr>
                    <td>{{$loop->iteration}}</td>

                    <td>{{$account->account_no}}</td>

                    <td>{{$account->member->name}}</td>

                    <td>{{$account->plan->name}}</td>

                    <td>{{$account->total_installment}}</td>

                    <td>{{$account->paid_installment}}</td>

                    <td>
                        <span class="badge bg-danger"> {{$account->due_installment}} Month </span>
                    </td>

                    <td>{{number_format($account->due_amount,2)}}</td>

                    <td>
                        <a href="{{route('dps-payments.create')}}" class="btn btn-success btn-sm"> Collect </a>
                    </td>
                </tr>

                @empty

                <tr>
                    <td colspan="9" class="text-center">No Due Found</td>
                </tr>

                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
