 @extends('layouts.app')

@section('content')


<div class="d-flex justify-content-between align-items-center mb-3">

    <h4>
        Add Income / Expense
    </h4>


    <a href="{{ route('income-expenses.index') }}"
       class="btn btn-secondary">

        Back

    </a>

</div>



@if($errors->any())

<div class="alert alert-danger">

<ul class="mb-0">

@foreach($errors->all() as $error)

<li>
{{ $error }}
</li>

@endforeach

</ul>

</div>

@endif





<div class="card shadow-sm">

<div class="card-body">


<form action="{{ route('income-expenses.store') }}"
      method="POST">


@csrf



<div class="row">


{{-- Type --}}

<div class="col-md-6 mb-3">

<label class="form-label">
Type
</label>


<select name="type"
        class="form-select"
        required>


<option value="">
Select Type
</option>


<option value="income"
{{ old('type')=='income'?'selected':'' }}>
Income
</option>


<option value="expense"
{{ old('type')=='expense'?'selected':'' }}>
Expense
</option>


</select>


</div>





{{-- Category --}}

<div class="col-md-6 mb-3">

<label class="form-label">
Category
</label>


<input type="text"
       name="category"
       class="form-control"
       value="{{ old('category') }}"
       placeholder="Example: Office Rent"
       required>


</div>







{{-- Amount --}}

<div class="col-md-6 mb-3">


<label class="form-label">
Amount
</label>


<input type="number"
       step="0.01"
       name="amount"
       class="form-control"
       value="{{ old('amount') }}"
       required>


</div>







{{-- Date --}}

<div class="col-md-6 mb-3">


<label class="form-label">
Date
</label>


<input type="date"
       name="date"
       class="form-control"
       value="{{ old('date',date('Y-m-d')) }}"
       required>


</div>







{{-- Payment Method --}}

<div class="col-md-6 mb-3">


<label class="form-label">
Payment Method
</label>


<select name="payment_method"
        class="form-select">


<option value="Cash">
Cash
</option>


<option value="Bank">
Bank
</option>


<option value="bKash">
bKash
</option>


<option value="Nagad">
Nagad
</option>


<option value="Rocket">
Rocket
</option>


</select>


</div>








{{-- Note --}}

<div class="col-md-12 mb-3">


<label class="form-label">
Note
</label>


<textarea
name="note"
class="form-control"
rows="4"
placeholder="Optional note">{{ old('note') }}</textarea>


</div>






</div>





<button class="btn btn-success">

Save Transaction

</button>



<a href="{{ route('income-expenses.index') }}"
class="btn btn-secondary">

Cancel

</a>



</form>


</div>

</div>



@endsection