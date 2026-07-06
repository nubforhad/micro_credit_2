@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Create Loan Product</h4>

    <a href="{{ route('loan-product.index') }}" class="btn btn-secondary">
        ← Back
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('loan-product.store') }}" method="POST">
            @csrf

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Code</label>
                    <input type="text" name="code" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Interest Rate (%)</label>
                    <input type="number" name="interest_rate" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Interest Type</label>
                    <select name="interest_type" class="form-control">
                        <option value="flat">Flat</option>
                        <option value="declining">Declining</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Installment Type</label>
                    <select name="installment_type" class="form-control">
                        <option value="weekly">Weekly</option>
                        <option value="monthly">Monthly</option>
                        <option value="daily">Daily</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Duration</label>
                    <input type="number" name="duration" class="form-control">
                </div>

                <div class="col-md-4 mb-3">
                    <label>Processing Fee</label>
                    <input type="number" name="processing_fee" class="form-control">
                </div>

                <div class="col-md-4 mb-3">
                    <label>Insurance Fee</label>
                    <input type="number" name="insurance_fee" class="form-control">
                </div>

                <div class="col-md-4 mb-3">
                    <label>Late Fee</label>
                    <input type="number" name="late_fee" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Min Amount</label>
                    <input type="number" name="min_amount" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Max Amount</label>
                    <input type="number" name="max_amount" class="form-control">
                </div>

            </div>

            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control"></textarea>
            </div>

            <button class="btn btn-success">
                Save Product
            </button>

        </form>

    </div>
</div>

@endsection