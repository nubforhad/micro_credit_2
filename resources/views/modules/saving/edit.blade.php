@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Edit Saving</h4>

    <a href="{{ route('saving.index') }}" class="btn btn-secondary">
        ← Back
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('saving.update', $saving->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- MEMBER --}}
            <div class="mb-3">
                <label>Member</label>
                <select name="member_id" class="form-control" required>
                    <option value="">Select Member</option>
                    @foreach($members as $member)
                        <option value="{{ $member->id }}"
                            {{ $saving->member_id == $member->id ? 'selected' : '' }}>
                            {{ $member->name }} ({{ $member->member_no }})
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- TYPE --}}
            <div class="mb-3">
                <label>Type</label>
                <select name="type" class="form-control">
                    <option value="deposit" {{ $saving->type == 'deposit' ? 'selected' : '' }}>
                        Deposit
                    </option>
                    <option value="withdraw" {{ $saving->type == 'withdraw' ? 'selected' : '' }}>
                        Withdraw
                    </option>
                </select>
            </div>

            {{-- AMOUNT --}}
            <div class="mb-3">
                <label>Amount</label>
                <input type="number" name="amount" value="{{ $saving->amount }}" class="form-control" required>
            </div>

            {{-- DATE --}}
            <div class="mb-3">
                <label>Date</label>
                <input type="date" name="date" value="{{ $saving->date }}" class="form-control" required>
            </div>

            {{-- NOTE --}}
            <div class="mb-3">
                <label>Note</label>
                <textarea name="note" class="form-control">{{ $saving->note }}</textarea>
            </div>

            {{-- BUTTON --}}
            <button class="btn btn-primary">
                Update Saving
            </button>

        </form>

    </div>
</div>

@endsection