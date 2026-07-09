@extends('layouts.app')

@section('content')

<h4 class="mb-3">
    Withdraw Request
</h4>

<div class="card shadow-sm">

    <div class="card-body">

        <table class="table table-bordered table-striped">

            <thead class="table-dark">

                <tr>

                    <th>#</th>
                    <th>Member</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th width="180">Action</th>

                </tr>

            </thead>

            <tbody>

                @forelse($requests as $key=>$item)

                <tr>

                    <td>
                        {{ $requests->firstItem()+$key }}
                    </td>

                    <td>

                        {{ $item->member->name }}

                        <br>

                        <small class="text-muted">
                            {{ $item->member->member_no }}
                        </small>

                    </td>

                    <td>

                        ৳ {{ number_format($item->amount,2) }}

                    </td>

                    <td>

                        {{ $item->date }}

                    </td>

                    <td>

                        @if($item->status=='pending')

                            <span class="badge bg-warning">
                                Pending
                            </span>

                        @elseif($item->status=='approved')

                            <span class="badge bg-success">
                                Approved
                            </span>

                        @else

                            <span class="badge bg-danger">
                                Rejected
                            </span>

                        @endif

                    </td>

                    <td>

                        @if($item->status=='pending')

                        <div class="d-flex gap-2">

                            <form action="{{ route('savvings.withdraw.approve',$item->id) }}" method="POST">

                                @csrf
                                @method('PUT')

                                <button class="btn btn-success btn-sm">

                                    Approve

                                </button>

                            </form>

                            <form action="{{ route('savvings.withdraw.reject',$item->id) }}" method="POST">

                                @csrf
                                @method('PUT')

                                <button
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Reject this request?')">

                                    Reject

                                </button>

                            </form>

                        </div>

                        @else

                        <span class="text-muted">
                            Processed
                        </span>

                        @endif

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="6" class="text-center">

                        No Withdraw Request Found

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

        {{ $requests->links() }}

    </div>

</div>

@endsection