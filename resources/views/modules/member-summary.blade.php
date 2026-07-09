 @extends('layouts.app') @section('content')

<h4 class="mb-3">Member Savings Summary</h4>

<form method="GET" class="mb-3">
    <div class="input-group">
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            class="form-control"
            placeholder="Search Member No / Name"
        />

        <button class="btn btn-dark">Search</button>
    </div>
</form>
<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Member</th>
                    <th>Member No</th>
                    <th>Total Deposit</th>
                    <th>Approved Withdraw</th>
                    <th>Pending Withdraw</th>
                    <th>Rejected Withdraw</th>
                    <th>Balance</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($members as $key=>$member)

                <tr>
                    <td>{{ $members->firstItem()+$key }}</td>

                    <td>{{ $member->name }}</td>

                    <td>{{ $member->member_no }}</td>

                    <td>৳ {{ number_format($member->total_deposit ?? 0,2) }}</td>

                    <td>৳ {{ number_format($member->total_withdraw ?? 0,2) }}</td>

                    <td>৳ {{ number_format($member->pending_withdraw ?? 0,2) }}</td>

                    <td>৳ {{ number_format($member->rejected_withdraw ?? 0,2) }}</td>

                    <td>৳ {{ number_format( ($member->total_deposit ?? 0) - ($member->total_withdraw ?? 0), 2) }}</td>
                    <td> <a href="{{ route('savvings.member.ledger',$member->id) }}"  class="btn btn-info btn-sm">
                             <i class="bx bx-book"></i>
                            Ledger
                        </a>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>

        {{ $members->appends(request()->query())->links() }}
    </div>
</div>

@endsection
