@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Edit Area</h4>

    <a href="{{ route('area.index') }}" class="btn btn-secondary">
        ← Back
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('area.update', $area->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Branch</label>
                <select name="branch_id" class="form-control">
                    @foreach($branches as $branch)
                        <option value="{{ $branch->id }}"
                            {{ $area->branch_id == $branch->id ? 'selected' : '' }}>
                            {{ $branch->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Area Name</label>
                <input type="text" name="name" value="{{ $area->name }}" class="form-control">
            </div>

            <div class="mb-3">
                <label>Code</label>
                <input type="text" name="code" value="{{ $area->code }}" class="form-control">
            </div>

            <div class="mb-3">
                <label>Note</label>
                <textarea name="note" class="form-control">{{ $area->note }}</textarea>
            </div>

            <button class="btn btn-primary">Update Area</button>

        </form>

    </div>
</div>

@endsection