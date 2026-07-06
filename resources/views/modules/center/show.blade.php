@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Center Details</h4>

    <a href="{{ route('center.index') }}" class="btn btn-secondary">
        ← Back
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <p><b>Area:</b> {{ $center->area->name }}</p>
        <p><b>Center Name:</b> {{ $center->name }}</p>
        <p><b>Code:</b> {{ $center->code }}</p>
        <p><b>Meeting Day:</b> {{ $center->meeting_day }}</p>
        <p><b>Meeting Time:</b> {{ $center->meeting_time }}</p>
        <p><b>Address:</b> {{ $center->address }}</p>

    </div>
</div>

@endsection