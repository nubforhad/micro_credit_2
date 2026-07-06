@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Edit Center</h4>

    <a href="{{ route('center.index') }}" class="btn btn-secondary">
        ← Back
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('center.update', $center->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Area</label>
                <select name="area_id" class="form-control">
                    @foreach($areas as $area)
                        <option value="{{ $area->id }}"
                            {{ $center->area_id == $area->id ? 'selected' : '' }}>
                            {{ $area->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Center Name</label>
                <input type="text" name="name" value="{{ $center->name }}" class="form-control">
            </div>

            <div class="mb-3">
                <label>Code</label>
                <input type="text" name="code" value="{{ $center->code }}" class="form-control">
            </div>

            <div class="mb-3">
                <label>Meeting Day</label>
                <input type="text" name="meeting_day" value="{{ $center->meeting_day }}" class="form-control">
            </div>

            <div class="mb-3">
                <label>Meeting Time</label>
                <input type="time" name="meeting_time" value="{{ $center->meeting_time }}" class="form-control">
            </div>

            <div class="mb-3">
                <label>Address</label>
                <textarea name="address" class="form-control">{{ $center->address }}</textarea>
            </div>

            <button class="btn btn-primary">Update Center</button>

        </form>

    </div>
</div>

@endsection