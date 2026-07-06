@extends('layouts.app')

@section('content')

<h4>Create Company</h4>

<form action="{{ route('company.store') }}" method="POST">
    @csrf

    <div class="mb-2">
        <label>Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-2">
        <label>Phone</label>
        <input type="text" name="phone" class="form-control">
    </div>

    <div class="mb-2">
        <label>Email</label>
        <input type="email" name="email" class="form-control">
    </div>

    <div class="mb-2">
        <label>Address</label>
        <textarea name="address" class="form-control"></textarea>
    </div>

    <button class="btn btn-success">Save</button>
</form>

@endsection