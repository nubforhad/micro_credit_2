@extends('layouts.app') @section('content')

<div class="d-flex justify-content-between mb-3">
    <h4>Edit DPS Plan</h4>

    <a href="{{route('dps-plans.index')}}" class="btn btn-secondary"> Back </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{route('dps-plans.update',$plan->id)}}" method="POST">
            @csrf @method('PUT')

            <div class="mb-3">
                <label> Plan Name </label>

                <input type="text" name="name" value="{{$plan->name}}" class="form-control" />
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label> Duration Month </label>

                    <input type="number" name="duration_month" value="{{$plan->duration_month}}" class="form-control" />
                </div>

                <div class="col-md-6 mb-3">
                    <label> Installment Amount </label>

                    <input
                        type="number"
                        name="installment_amount"
                        value="{{$plan->installment_amount}}"
                        class="form-control"
                    />
                </div>

                <div class="col-md-6 mb-3">
                    <label> Interest Rate </label>

                    <input type="number" name="interest_rate" value="{{$plan->interest_rate}}" class="form-control" />
                </div>

                <div class="col-md-6 mb-3">
                    <label> Status </label>

                    <select name="status" class="form-control">
                        <option value="active" {{$plan->status=='active'?'selected':''}}> Active</option>

                        <option value="inactive" {{$plan->status=='inactive'?'selected':''}}> Inactive</option>
                    </select>
                </div>
            </div>

            <button class="btn btn-success">Update DPS Plan</button>
        </form>
    </div>
</div>

@endsection
