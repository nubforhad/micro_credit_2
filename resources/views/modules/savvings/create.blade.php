@extends('layouts.app')

@section('content')


<div class="d-flex justify-content-between mb-3">

<h4>
Add Savvings
</h4>


<a href="{{ route('savvings.index') }}"
class="btn btn-secondary">

Back

</a>


</div>



<div class="card shadow-sm">

<div class="card-body">


<form action="{{ route('savvings.store') }}"
method="POST">

@csrf



<div class="mb-3">

<label>
Member
</label>


<select name="member_id"
class="form-control"
required>


<option value="">
Select Member
</option>


@foreach($members as $member)

<option value="{{ $member->id }}">

{{ $member->name }}
-
{{ $member->member_no }}

</option>

@endforeach


</select>


</div>




<div class="row">


<div class="col-md-6 mb-3">

<label>
Type
</label>


<select name="type"
class="form-control">


<option value="deposit">
Deposit
</option>


<option value="withdraw">
Withdraw
</option>


</select>


</div>




<div class="col-md-6 mb-3">


<label>
Amount
</label>


<input type="number"
name="amount"
class="form-control"
required>


</div>




<div class="col-md-6 mb-3">

<label>
Payment Method
</label>


<select name="payment_method"
class="form-control">


<option>
Cash
</option>

<option>
Bank
</option>

<option>
bKash
</option>

<option>
Nagad
</option>

<option>
Rocket
</option>


</select>


</div>




<div class="col-md-6 mb-3">

<label>
Date
</label>


<input type="date"
name="date"
value="{{ date('Y-m-d') }}"
class="form-control">


</div>


</div>




<div class="mb-3">

<label>
Note
</label>


<textarea name="note"
class="form-control"></textarea>


</div>




<button class="btn btn-success">

Save Savvings

</button>



</form>


</div>

</div>


@endsection