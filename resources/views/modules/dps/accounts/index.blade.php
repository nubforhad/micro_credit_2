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
    <h4>DPS Accounts</h4>

    <a href="{{route('dps-accounts.create')}}" class="btn btn-primary"> Open New DPS </a>
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

                    <th>Installment</th>

                    <th>Paid</th>

                    <th>Maturity Date</th>

                    <th>Status</th>

                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($accounts as $account)

                <tr>
                    <td>{{$loop->iteration}}</td>

                    <td>{{$account->account_no}}</td>

                    <td>{{$account->member->name}}</td>

                    <td>{{$account->plan->name}}</td>

                    <td>{{$account->installment_amount}}</td>

                    <td>{{$account->paid_installment}} / {{$account->total_installment}}</td>

                    <td>{{$account->maturity_date}}</td>

                    <td>
                        @if($account->status=='running')

                        <span class="badge bg-success"> Running </span>

                        @elseif($account->status=='completed')

                        <span class="badge bg-primary"> Completed </span>

                        @else

                        <span class="badge bg-danger"> Closed </span>

                        @endif
                    </td>

                    <td>
                        <form action="{{route('dps-accounts.destroy',$account->id)}}" method="POST">
                            @csrf @method('DELETE')

                            <button class="btn btn-danger btn-sm" onclick="return confirm('Delete Account?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
