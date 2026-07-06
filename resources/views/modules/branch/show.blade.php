@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Branch Details</h4>

    <a href="{{ route('branch.index') }}" class="btn btn-secondary">
        ← Back
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <p><b>Company:</b> {{ $branch->company->name }}</p>
        <p><b>Branch Name:</b> {{ $branch->name }}</p>
        <p><b>Code:</b> {{ $branch->code }}</p>
        <p><b>Phone:</b> {{ $branch->phone }}</p>
        <p><b>Address:</b> {{ $branch->address }}</p>

    </div>
</div>

@endsection