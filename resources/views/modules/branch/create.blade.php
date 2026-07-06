@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Create Branch</h4>

    <a href="{{ route('branch.index') }}" class="btn btn-secondary">
        ← Back
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('branch.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Company</label>
                <select name="company_id" class="form-control" required>
                    <option value="">Select Company</option>
                    @foreach($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Branch Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Code</label>
                <input type="text" name="code" class="form-control">
            </div>

            <div class="mb-3">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control">
            </div>

            <div class="mb-3">
                <label>Address</label>
                <textarea name="address" class="form-control"></textarea>
            </div>

            <button class="btn btn-success">
                Save Branch
            </button>

        </form>

    </div>
</div>

@endsection