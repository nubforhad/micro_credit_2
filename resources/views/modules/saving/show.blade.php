@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Saving Details</h4>

    <a href="{{ route('saving.index') }}" class="btn btn-secondary">
        ← Back
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <p><b>Member:</b> {{ $saving->member->name }}</p>
        <p><b>Type:</b> {{ $saving->type }}</p>
        <p><b>Amount:</b> {{ $saving->amount }}</p>
        <p><b>Date:</b> {{ $saving->date }}</p>
        <p><b>Note:</b> {{ $saving->note }}</p>

    </div>
</div>

@endsection