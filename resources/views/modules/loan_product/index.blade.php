 @extends('layouts.app') @section('content')

<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <h4 class="mb-0">Loan Products</h4>

    <a href="{{ route('loan-product.create') }}" class="btn btn-primary">
        <i class="bx bx-plus"></i>
        Create Product
    </a>
</div>

@if(session('success'))

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

<div class="card shadow-sm border-0">
    <div class="card-body p-2 p-md-3">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-nowrap">
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
                    @foreach($products as $key=>$product)

                    <tr>
                        <td>{{$products->firstItem()+$key}}</td>

                        <td>{{$product->name}}</td>

                        <td>{{$product->code}}</td>

                        <td>{{$product->interest_rate}}%</td>

                        <td>{{ucfirst($product->installment_type)}}</td>

                        <td>{{$product->duration}}</td>

                        <td>
                            <span class="badge bg-{{$product->status?'success':'danger'}}">
                                {{$product->status?'Active':'Inactive'}}
                            </span>
                        </td>

                        <td>
                            <div class="d-flex flex-wrap gap-1">
                                <a href="{{route('loan-product.show',$product->id)}}" class="btn btn-sm btn-info">
                                    <i class="bx bx-show"></i>
                                </a>

                                <a href="{{route('loan-product.edit',$product->id)}}" class="btn btn-sm btn-warning">
                                    <i class="bx bx-edit"></i>
                                </a>

                                <form
                                    action="{{route('loan-product.destroy',$product->id)}}"
                                    method="POST"
                                    class="deleteForm"
                                >
                                    @csrf @method('DELETE')

                                    <button class="btn btn-sm btn-danger">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-3">{{$products->links()}}</div>
    </div>
</div>

<script>
    document.querySelectorAll(".deleteForm").forEach((form) => {
        form.addEventListener("submit", function (e) {
            e.preventDefault();

            Swal.fire({
                title: "Delete Product?",

                text: "This action cannot be undone",

                icon: "warning",

                showCancelButton: true,

                confirmButtonColor: "#dc3545",

                cancelButtonColor: "#6c757d",

                confirmButtonText: "Delete",
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>

@endsection
