@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Loan Product Details</h4>

    <a href="{{ route('loan-product.index') }}" class="btn btn-secondary">
        ← Back
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <p><b>Name:</b> {{ $loan_product->name }}</p>
        <p><b>Code:</b> {{ $loan_product->code }}</p>
        <p><b>Interest Rate:</b> {{ $loan_product->interest_rate }}%</p>
        <p><b>Interest Type:</b> {{ $loan_product->interest_type }}</p>
        <p><b>Installment Type:</b> {{ $loan_product->installment_type }}</p>
        <p><b>Duration:</b> {{ $loan_product->duration }}</p>
        <p><b>Processing Fee:</b> {{ $loan_product->processing_fee }}</p>
        <p><b>Insurance Fee:</b> {{ $loan_product->insurance_fee }}</p>
        <p><b>Late Fee:</b> {{ $loan_product->late_fee }}</p>
        <p><b>Min Amount:</b> {{ $loan_product->min_amount }}</p>
        <p><b>Max Amount:</b> {{ $loan_product->max_amount }}</p>

        <p><b>Description:</b> {{ $loan_product->description }}</p>

    </div>
</div>

@endsection