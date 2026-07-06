@extends('layouts.app')

@section('content')

<h4>Company Details</h4>

<div class="card p-3">
    <p><b>Name:</b> {{ $company->name }}</p>
    <p><b>Phone:</b> {{ $company->phone }}</p>
    <p><b>Email:</b> {{ $company->email }}</p>
    <p><b>Address:</b> {{ $company->address }}</p>
</div>

<a href="{{ route('company.index') }}" class="btn btn-secondary mt-2">
    Back
</a>

@endsection