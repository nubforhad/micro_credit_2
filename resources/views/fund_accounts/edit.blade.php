@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Edit Fund Account</h4>

    <a href="{{ route('fund-accounts.index') }}" class="btn btn-secondary">
        Back
    </a>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('fund-accounts.update', $fundAccount->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="form-label">Fund Name <span class="text-danger">*</span></label>

                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="{{ old('name', $fundAccount->name) }}"
                        required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Fund Type</label>

                    <select name="type" class="form-select">

                        <option value="cash"
                            {{ old('type',$fundAccount->type)=='cash'?'selected':'' }}>
                            Cash
                        </option>

                        <option value="bank"
                            {{ old('type',$fundAccount->type)=='bank'?'selected':'' }}>
                            Bank
                        </option>

                        <option value="mobile_banking"
                            {{ old('type',$fundAccount->type)=='mobile_banking'?'selected':'' }}>
                            Mobile Banking
                        </option>

                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Opening Balance</label>

                    <input
                        type="number"
                        step="0.01"
                        name="opening_balance"
                        class="form-control"
                        value="{{ old('opening_balance',$fundAccount->opening_balance) }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Current Balance</label>

                    <input
                        type="number"
                        step="0.01"
                        name="current_balance"
                        class="form-control"
                        value="{{ old('current_balance',$fundAccount->current_balance) }}">
                </div>

                <div class="col-md-6 mb-3">

                    <div class="form-check mt-4">

                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="is_default"
                            value="1"
                            id="defaultFund"
                            {{ old('is_default',$fundAccount->is_default) ? 'checked' : '' }}>

                        <label class="form-check-label" for="defaultFund">
                            Default Fund Account
                        </label>

                    </div>

                </div>

                <div class="col-md-6 mb-3">

                    <div class="form-check mt-4">

                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="status"
                            value="1"
                            id="status"
                            {{ old('status',$fundAccount->status) ? 'checked' : '' }}>

                        <label class="form-check-label" for="status">
                            Active
                        </label>

                    </div>

                </div>

                <div class="col-md-12 mb-3">

                    <label class="form-label">
                        Remarks
                    </label>

                    <textarea
                        name="remarks"
                        rows="4"
                        class="form-control">{{ old('remarks',$fundAccount->remarks) }}</textarea>

                </div>

            </div>

            <button class="btn btn-success">
                Update Fund Account
            </button>

            <a href="{{ route('fund-accounts.index') }}"
               class="btn btn-secondary">
                Cancel
            </a>

        </form>

    </div>
</div>

@endsection