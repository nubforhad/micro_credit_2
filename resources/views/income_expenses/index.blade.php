@extends('layouts.app') @section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Income Expense List</h4>

    <a href="{{ route('income-expenses.create') }}" class="btn btn-primary"> Add Transaction </a>
</div>

@if(session('success'))

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

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>

                        <th>Date</th>

                        <th>Type</th>

                        <th>Category</th>

                        <th>Amount</th>

                        <th>Payment</th>

                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($items as $item)

                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $item->date->format('d-m-Y') }}</td>

                        <td>
                            @if($item->type=='income')

                            <span class="badge bg-success"> Income </span>

                            @else

                            <span class="badge bg-danger"> Expense </span>

                            @endif
                        </td>

                        <td>{{ $item->category }}</td>

                        <td>{{ number_format($item->amount,2) }}</td>

                        <td>{{ $item->payment_method }}</td>

                        <td>
                            <a href="{{ route('income-expenses.edit',$item->id) }}" class="btn btn-sm btn-warning">
                                Edit
                            </a>

                            <form
                                action="{{ route('income-expenses.destroy',$item->id) }}"
                                method="POST"
                                style="display: inline"
                            >
                                @csrf @method('DELETE')

                                <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>

                    @empty

                    <tr>
                        <td colspan="7" class="text-center">No Data Found</td>
                    </tr>

                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $items->links() }}
    </div>
</div>

@endsection
