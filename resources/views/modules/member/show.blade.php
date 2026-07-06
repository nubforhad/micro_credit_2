@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Member Details</h4>

    <a href="{{ route('member.index') }}" class="btn btn-secondary">
        ← Back
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <p><b>Member No:</b> {{ $member->member_no }}</p>
        <p><b>Name:</b> {{ $member->name }}</p>
        <p><b>Center:</b> {{ $member->center->name }}</p>
        <p><b>Phone:</b> {{ $member->phone }}</p>
        <p><b>NID:</b> {{ $member->nid }}</p>
        <p><b>Address:</b> {{ $member->address }}</p>

        <hr>

        <p><b>Nominee:</b> {{ $member->nominee_name }}</p>
        <p><b>Relation:</b> {{ $member->nominee_relation }}</p>
        <p><b>Nominee Phone:</b> {{ $member->nominee_phone }}</p>

    </div>
</div>

@endsection