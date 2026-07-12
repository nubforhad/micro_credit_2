@extends('layouts.app')

@section('content')

<div class="text-center mt-5">

<h2>
403
</h2>

<h4>
You don't have permission to access this page.
</h4>

<a href="{{ route('dashboard') }}"
class="btn btn-primary mt-3">
Back Dashboard
</a>

</div>

@endsection