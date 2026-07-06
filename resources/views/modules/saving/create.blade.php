@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Add Saving</h4>

    <a href="{{ route('saving.index') }}" class="btn btn-secondary">
        ← Back
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('saving.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Member</label>
                <select name="member_id" class="form-control" required>
                    <option value="">Select Member</option>
                    @foreach($members as $member)
                        <option value="{{ $member->id }}">
                            {{ $member->name }} ({{ $member->member_no }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Type</label>
                <select name="type" class="form-control">
                    <option value="deposit">Deposit</option>
                    <option value="withdraw">Withdraw</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Amount</label>
                <input type="number" name="amount" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Date</label>
                <input type="date" name="date" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Note</label>
                <textarea name="note" class="form-control"></textarea>
            </div>

            <button class="btn btn-success">
                Save Transaction
            </button>

        </form>

    </div>
</div>

@endsection