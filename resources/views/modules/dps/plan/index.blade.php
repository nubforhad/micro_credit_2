@extends('layouts.app') @section('content') @if(session('success'))

<script>
    Swal.fire({
        icon: "success",
        title: "Success",
        text: "{{session('success')}}",
        timer: 2000,
        showConfirmButton: false,
    });
</script>

@endif

<div class="d-flex justify-content-between mb-3">
    <h4>DPS Plans</h4>

    <a href="{{route('dps-plans.create')}}" class="btn btn-primary"> Add DPS Plan </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>

                    <th>Name</th>

                    <th>Duration</th>

                    <th>Installment</th>

                    <th>Interest</th>

                    <th>Status</th>

                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($plans as $plan)

                <tr>
                    <td>{{$loop->iteration}}</td>

                    <td>{{$plan->name}}</td>

                    <td>{{$plan->duration_month}} Month</td>

                    <td>{{$plan->installment_amount}}</td>

                    <td>{{$plan->interest_rate}} %</td>

                    <td>
                        @if($plan->status=='active')

                        <span class="badge bg-success"> Active </span>

                        @else

                        <span class="badge bg-danger"> Inactive </span>

                        @endif
                    </td>

                    <td>
                        <a href="{{route('dps-plans.edit',$plan->id)}}" class="btn btn-sm btn-warning"> Edit </a>

                        <form action="{{route('dps-plans.destroy',$plan->id)}}" method="POST" style="display: inline">
                            @csrf @method('DELETE')

                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this plan?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
