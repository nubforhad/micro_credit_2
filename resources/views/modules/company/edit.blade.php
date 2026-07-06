@extends('layouts.app')

@section('content')

<h4>Edit Company</h4>

<form action="{{ route('company.update', $company->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-2">
        <label>Name</label>
        <input type="text" name="name" value="{{ $company->name }}" class="form-control">
    </div>

    <div class="mb-2">
        <label>Phone</label>
        <input type="text" name="phone" value="{{ $company->phone }}" class="form-control">
    </div>

    <div class="mb-2">
        <label>Email</label>
        <input type="email" name="email" value="{{ $company->email }}" class="form-control">
    </div>

    <div class="mb-2">
        <label>Address</label>
        <textarea name="address" class="form-control">{{ $company->address }}</textarea>
    </div>

    <button class="btn btn-primary">Update</button>
</form>

@endsection