@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Member Details</h4>

    <a href="{{ route('member.index') }}" class="btn btn-secondary">
        ← Back
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <p><b>Member No:</b> {{ $member->member_no }}</p>
        <p><b>Name:</b> {{ $member->name }}</p>
        <p><b>Center:</b> {{ $member->center->name }}</p>
        <p><b>Phone:</b> {{ $member->phone }}</p>
        <p><b>NID:</b> {{ $member->nid }}</p>
        <p><b>Address:</b> {{ $member->address }}</p>

        <hr>

        <p><b>Nominee:</b> {{ $member->nominee_name }}</p>
        <p><b>Relation:</b> {{ $member->nominee_relation }}</p>
        <p><b>Nominee Phone:</b> {{ $member->nominee_phone }}</p>

    </div>
</div>


<div class="row mt-3">


<div class="col-md-4">

<div class="card shadow-sm border-success">

<div class="card-body">


<h6>
Total Deposit
</h6>


<h4 class="text-success">

৳ {{ number_format($totalDeposit,2) }}

</h4>


</div>

</div>

</div>





<div class="col-md-4">


<div class="card shadow-sm border-danger">


<div class="card-body">


<h6>
Total Withdraw
</h6>


<h4 class="text-danger">

৳ {{ number_format($totalWithdraw,2) }}

</h4>


</div>


</div>


</div>






<div class="col-md-4">


<div class="card shadow-sm border-primary">


<div class="card-body">


<h6>
Current Savvings Balance
</h6>


<h4 class="text-primary">

৳ {{ number_format($balance,2) }}

</h4>


</div>


</div>


</div>


</div>


@endsection