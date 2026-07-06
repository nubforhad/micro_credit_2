@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Loan Products</h4>

    <a href="{{ route('loan-product.create') }}" class="btn btn-primary">
        + Create Product
    </a>
</div>

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: "{{ session('success') }}",
        timer: 2000,
        showConfirmButton: false
    });
</script>
@endif

<div class="card shadow-sm">
    <div class="card-body">

        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Interest</th>
                    <th>Installment</th>
                    <th>Duration</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
            @foreach($products as $key => $product)
                <tr>
                    <td>{{ $products->firstItem() + $key }}</td>

                    <td>{{ $product->name }}</td>
                    <td>{{ $product->code }}</td>

                    <td>{{ $product->interest_rate }}%</td>
                    <td>{{ ucfirst($product->installment_type) }}</td>
                    <td>{{ $product->duration }}</td>

                    <td>
                        <span class="badge bg-{{ $product->status ? 'success' : 'danger' }}">
                            {{ $product->status ? 'Active' : 'Inactive' }}
                        </span>
                    </td>

                    <td class="text-nowrap">

                        <a href="{{ route('loan-product.show', $product->id) }}" class="btn btn-sm btn-info">
                            View
                        </a>

                        <a href="{{ route('loan-product.edit', $product->id) }}" class="btn btn-sm btn-warning">
                            Edit
                        </a>

                        <form action="{{ route('loan-product.destroy', $product->id) }}"
                              method="POST"
                              class="d-inline deleteForm">

                            @csrf
                            @method('DELETE')

                            <button class="btn btn-sm btn-danger">
                                Delete
                            </button>

                        </form>

                    </td>

                </tr>
            @endforeach
            </tbody>

        </table>

        <div class="mt-3">
            {{ $products->links() }}
        </div>

    </div>
</div>

<script>
document.querySelectorAll('.deleteForm').forEach(form => {
    form.addEventListener('submit', function(e){
        e.preventDefault();

        Swal.fire({
            title: 'Delete Product?',
            text: "This action cannot be undone",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Delete'
        }).then((result)=>{
            if(result.isConfirmed){
                form.submit();
            }
        });

    });
});
</script>

@endsection