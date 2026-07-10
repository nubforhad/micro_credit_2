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

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>DPS Maturity List</h4>

    <a href="{{route('dps-maturities.create')}}" class="btn btn-primary">
        <i class="bx bx-plus"></i>

        New Maturity
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>

                        <th>Account No</th>

                        <th>Member</th>

                        <th>Plan</th>

                        <th>Total Deposit</th>

                        <th>Profit</th>

                        <th>Maturity Amount</th>

                        <th width="150">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($accounts as $account) @php $totalDeposit = $account->installment_amount *
                    $account->total_installment; $profit = ($totalDeposit * $account->plan->interest_rate) /100;
                    $maturity = $totalDeposit + $profit; @endphp

                    <tr>
                        <td>{{$loop->iteration}}</td>

                        <td>{{$account->account_no}}</td>

                        <td>{{$account->member->name}}</td>

                        <td>{{$account->plan->name}}</td>

                        <td>{{number_format($totalDeposit,2)}}</td>

                        <td>{{number_format($profit,2)}}</td>

                        <td>{{number_format($maturity,2)}}</td>

                        <td>
                            <form action="{{route('dps-maturities.store')}}" method="POST">
                                @csrf

                                <input type="hidden" name="dps_account_id" value="{{$account->id}}" />

                                <button
                                    type="submit"
                                    class="btn btn-success btn-sm"
                                    onclick="return confirm('Confirm Maturity Payment?')"
                                >
                                    <i class="bx bx-money"></i>

                                    Pay Maturity
                                </button>
                            </form>
                        </td>
                    </tr>

                    @empty

                    <tr>
                        <td colspan="8" class="text-center text-danger">No Completed DPS Found</td>
                    </tr>

                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
