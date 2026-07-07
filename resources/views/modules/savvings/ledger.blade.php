@extends('layouts.app')

@section('content')


<div class="d-flex justify-content-between mb-3">


<h4>
Savvings Ledger
</h4>


<a href="{{ route('member.index') }}"
class="btn btn-secondary">

Back

</a>


</div>




<div class="card shadow-sm">

<div class="card-body">


<div class="mb-4">


<h5>
Member Information
</h5>


<p>
<b>Name:</b>
{{ $member->name }}
</p>


<p>
<b>Member No:</b>
{{ $member->member_no }}
</p>


</div>




<table class="table table-bordered table-hover">


<thead class="table-dark">


<tr>

<th>
Date
</th>


<th>
Receipt
</th>


<th>
Type
</th>


<th>
Deposit
</th>


<th>
Withdraw
</th>


<th>
Balance
</th>


</tr>


</thead>



<tbody>


@foreach($transactions as $item)


<tr>


<td>

{{ \Carbon\Carbon::parse($item->date)->format('d M,Y') }}

</td>



<td>

{{ $item->receipt_no }}

</td>




<td>


@if($item->type=='deposit')

<span class="badge bg-success">

Deposit

</span>


@else

<span class="badge bg-danger">

Withdraw

</span>


@endif


</td>




<td>


@if($item->type=='deposit')

{{ number_format($item->amount,2) }}

@else

-

@endif


</td>




<td>


@if($item->type=='withdraw')

{{ number_format($item->amount,2) }}

@else

-

@endif


</td>




<td>


{{ number_format($item->balance,2) }}


</td>



</tr>



@endforeach



</tbody>


</table>




</div>

</div>



@endsection