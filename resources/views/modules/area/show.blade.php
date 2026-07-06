@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Area Details</h4>

    <a href="{{ route('area.index') }}" class="btn btn-secondary">
        ← Back
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <p><b>Branch:</b> {{ $area->branch->name }}</p>
        <p><b>Area Name:</b> {{ $area->name }}</p>
        <p><b>Code:</b> {{ $area->code }}</p>
        <p><b>Note:</b> {{ $area->note }}</p>

    </div>
</div>

@endsection