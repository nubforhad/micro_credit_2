@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Create Center</h4>

    <a href="{{ route('center.index') }}" class="btn btn-secondary">
        ← Back
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('center.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Area</label>
                <select name="area_id" class="form-control" required>
                    <option value="">Select Area</option>
                    @foreach($areas as $area)
                        <option value="{{ $area->id }}">
                            {{ $area->name }} ({{ $area->branch->name ?? '' }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Center Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Code</label>
                <input type="text" name="code" class="form-control">
            </div>

            <div class="mb-3">
                <label>Meeting Day</label>
                <input type="text" name="meeting_day" class="form-control">
            </div>

            <div class="mb-3">
                <label>Meeting Time</label>
                <input type="time" name="meeting_time" class="form-control">
            </div>

            <div class="mb-3">
                <label>Address</label>
                <textarea name="address" class="form-control"></textarea>
            </div>

            <button class="btn btn-success">Save Center</button>

        </form>

    </div>
</div>

@endsection