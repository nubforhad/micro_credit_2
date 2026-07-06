@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Edit Loan Product</h4>

    <a href="{{ route('loan-product.index') }}" class="btn btn-secondary">
        ← Back
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('loan-product.update', $loan_product->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label>Name</label>
                    <input type="text" name="name" value="{{ $loan_product->name }}" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Code</label>
                    <input type="text" name="code" value="{{ $loan_product->code }}" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Interest Rate</label>
                    <input type="number" name="interest_rate" value="{{ $loan_product->interest_rate }}" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Installment Type</label>
                    <select name="installment_type" class="form-control">
                        <option value="weekly" {{ $loan_product->installment_type=='weekly'?'selected':'' }}>Weekly</option>
                        <option value="monthly" {{ $loan_product->installment_type=='monthly'?'selected':'' }}>Monthly</option>
                        <option value="daily" {{ $loan_product->installment_type=='daily'?'selected':'' }}>Daily</option>
                    </select>
                </div>

            </div>

            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control">{{ $loan_product->description }}</textarea>
            </div>

            <button class="btn btn-primary">
                Update
            </button>

        </form>

    </div>
</div>

@endsection