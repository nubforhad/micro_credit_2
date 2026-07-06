@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Create Member</h4>

    <a href="{{ route('member.index') }}" class="btn btn-secondary">
        ← Back
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('member.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Center</label>
                <select name="center_id" class="form-control" required>
                    <option value="">Select Center</option>
                    @foreach($centers as $center)
                        <option value="{{ $center->id }}">
                            {{ $center->name }} ({{ $center->area->name ?? '' }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Member Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Father Name</label>
                <input type="text" name="father_name" class="form-control">
            </div>

            <div class="mb-3">
                <label>Mother Name</label>
                <input type="text" name="mother_name" class="form-control">
            </div>

            <div class="mb-3">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control">
            </div>

            <div class="mb-3">
                <label>NID</label>
                <input type="text" name="nid" class="form-control">
            </div>

            <div class="mb-3">
                <label>Address</label>
                <textarea name="address" class="form-control"></textarea>
            </div>

            <hr>

            <h5>Nominee Info</h5>

            <div class="mb-3">
                <label>Nominee Name</label>
                <input type="text" name="nominee_name" class="form-control">
            </div>

            <div class="mb-3">
                <label>Relation</label>
                <input type="text" name="nominee_relation" class="form-control">
            </div>

            <div class="mb-3">
                <label>Nominee Phone</label>
                <input type="text" name="nominee_phone" class="form-control">
            </div>

            <button class="btn btn-success">
                Save Member
            </button>

        </form>

    </div>
</div>

@endsection