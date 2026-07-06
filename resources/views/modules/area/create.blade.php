@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Create Area</h4>

    <a href="{{ route('area.index') }}" class="btn btn-secondary">
        ← Back
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('area.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Branch</label>
                <select name="branch_id" class="form-control" required>
                    <option value="">Select Branch</option>
                    @foreach($branches as $branch)
                        <option value="{{ $branch->id }}">
                            {{ $branch->name }} ({{ $branch->company->name ?? '' }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Area Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Code</label>
                <input type="text" name="code" class="form-control">
            </div>

            <div class="mb-3">
                <label>Note</label>
                <textarea name="note" class="form-control"></textarea>
            </div>

            <button class="btn btn-success">Save Area</button>

        </form>

    </div>
</div>

@endsection