@extends('layouts.app') @section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Fund Accounts</h4>

    <a href="{{ route('fund-accounts.create') }}" class="btn btn-primary"> Add Fund Account </a>
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

                        <th>Name</th>

                        <th>Type</th>

                        <th>Opening Balance</th>

                        <th>Current Balance</th>

                        <th>Status</th>

                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($funds as $fund)

                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $fund->name }}</td>

                        <td>{{ ucfirst($fund->type) }}</td>

                        <td>{{ number_format($fund->opening_balance,2) }}</td>

                        <td>{{ number_format($fund->current_balance,2) }}</td>

                        <td>
                            @if($fund->status)

                            <span class="badge bg-success"> Active </span>

                            @else

                            <span class="badge bg-danger"> Inactive </span>

                            @endif
                        </td>

                        <td>
                            <a href="{{ route('fund-accounts.edit',$fund->id) }}" class="btn btn-sm btn-warning">
                                Edit
                            </a>

                            <form
                                action="{{ route('fund-accounts.destroy',$fund->id) }}"
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
                        <td colspan="7" class="text-center">No Fund Account Found</td>
                    </tr>

                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
