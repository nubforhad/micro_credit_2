@extends('layouts.app') @section('content') @if($errors->any())

<script>
    Swal.fire({
        icon: "error",

        title: "Validation Error",

        html: `


    @foreach($errors->all() as $error)

        <div>{{ $error }}</div>

    @endforeach


    `,
    });
</script>

@endif

<div class="d-flex justify-content-between mb-3">
    <h4>Open DPS Account</h4>

    <a href="{{route('dps-accounts.index')}}" class="btn btn-secondary"> Back </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{route('dps-accounts.store')}}" method="POST">
            @csrf

            <div class="mb-3">
                <label> Member </label>

                <select name="member_id" class="form-control" required>
                    <option value="">Select Member</option>

                    @foreach($members as $member)

                    <option value="{{$member->id}}">{{$member->name}} - {{$member->member_no}}</option>

                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label> DPS Plan </label>

                <select name="dps_plan_id" class="form-control" required>
                    <option value="">Select Plan</option>

                    @foreach($plans as $plan)

                    <option value="{{$plan->id}}">{{$plan->name}} - {{$plan->installment_amount}} Monthly</option>

                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label> Start Date </label>

                <input type="date" name="start_date" value="{{date('Y-m-d')}}" class="form-control" required />
            </div>

            <button class="btn btn-success">Open DPS Account</button>
        </form>
    </div>
</div>

@endsection
