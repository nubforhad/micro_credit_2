@extends('layouts.app') @section('content')

<h4 class="mb-3">Create Fund Account</h4>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('fund-accounts.store') }}">
            @csrf

            <div class="mb-3">
                <label>Name</label>

                <input type="text" name="name" class="form-control" placeholder="Main Cash" required />
            </div>

            <div class="mb-3">
                <label>Opening Balance</label>

                <input type="number" step="0.01" name="opening_balance" class="form-control" value="0" required />
            </div>

            <div class="mb-3">
                <label>Type</label>

                <select name="type" class="form-control" required>
                    <option value="cash">Cash</option>

                    <option value="bank">Bank</option>

                    <option value="mobile_banking">Mobile Banking</option>

                    <option value="other">Other</option>
                </select>
            </div>

            <div class="mb-3">
                <label> Remarks </label>

                <textarea name="remarks" class="form-control"></textarea>
            </div>

            <button class="btn btn-primary">Save</button>
        </form>
    </div>
</div>

@endsection
