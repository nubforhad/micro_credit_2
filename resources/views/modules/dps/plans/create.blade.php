@extends('layouts.app') @section('content') @if(session('success'))

<script>
    Swal.fire({
        icon: "success",
        title: "Success",
        text: "{{ session('success') }}",
        timer: 2000,
        showConfirmButton: false,
    });
</script>

@endif

<div class="d-flex justify-content-between mb-3">
    <h4>Add DPS Plan</h4>

    <a href="{{ route('dps-plans.index') }}" class="btn btn-secondary"> Back </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('dps-plans.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label> Plan Name </label>

                <input type="text" name="name" class="form-control" placeholder="Example: DPS 5 Years" required />
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label> Duration (Month) </label>

                    <input type="number" name="duration_month" class="form-control" placeholder="60" required />
                </div>

                <div class="col-md-6 mb-3">
                    <label> Monthly Installment </label>

                    <input type="number" name="installment_amount" class="form-control" placeholder="1000" required />
                </div>

                <div class="col-md-6 mb-3">
                    <label> Interest Rate (%) </label>

                    <input
                        type="number"
                        step="0.01"
                        name="interest_rate"
                        class="form-control"
                        placeholder="8"
                        required
                    />
                </div>

                <div class="col-md-6 mb-3">
                    <label> Status </label>

                    <select name="status" class="form-control">
                        <option value="active">Active</option>

                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>

            <button class="btn btn-success">Save DPS Plan</button>
        </form>
    </div>
</div>

@endsection
