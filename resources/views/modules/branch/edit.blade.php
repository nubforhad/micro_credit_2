@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Edit Branch</h4>

    <a href="{{ route('branch.index') }}" class="btn btn-secondary">
        ← Back
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('branch.update', $branch->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Company</label>
                <select name="company_id" class="form-control">
                    @foreach($companies as $company)
                        <option value="{{ $company->id }}"
                            {{ $branch->company_id == $company->id ? 'selected' : '' }}>
                            {{ $company->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Branch Name</label>
                <input type="text" name="name" value="{{ $branch->name }}" class="form-control">
            </div>

            <div class="mb-3">
                <label>Code</label>
                <input type="text" name="code" value="{{ $branch->code }}" class="form-control">
            </div>

            <div class="mb-3">
                <label>Phone</label>
                <input type="text" name="phone" value="{{ $branch->phone }}" class="form-control">
            </div>

            <div class="mb-3">
                <label>Address</label>
                <textarea name="address" class="form-control">{{ $branch->address }}</textarea>
            </div>

            <button class="btn btn-primary">
                Update Branch
            </button>

        </form>

    </div>
</div>

@endsection