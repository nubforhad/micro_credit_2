@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Edit Loan</h4>

    <a href="{{ route('loan.index') }}" class="btn btn-secondary">
        ← Back
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('loan.update', $loan->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- MEMBER --}}
            <div class="mb-3">
                <label>Member</label>
                <select name="member_id" class="form-control" required>
                    @foreach($members as $member)
                        <option value="{{ $member->id }}"
                            {{ $loan->member_id == $member->id ? 'selected' : '' }}>
                            {{ $member->name }} ({{ $member->member_no ?? '' }})
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- LOAN PRODUCT --}}
            <div class="mb-3">
                <label>Loan Product</label>
                <select name="loan_product_id" id="loan_product" class="form-control" required>
                    <option value="">Select Product</option>

                    @foreach($products as $product)
                        <option value="{{ $product->id }}"
                            {{ $loan->loan_product_id == $product->id ? 'selected' : '' }}
                            data-interest="{{ $product->interest_rate }}"
                            data-type="{{ $product->interest_type }}"
                            data-installment="{{ $product->installment_type }}"
                            data-duration="{{ $product->duration }}"
                            data-processing="{{ $product->processing_fee }}"
                            data-insurance="{{ $product->insurance_fee }}"
                            data-late="{{ $product->late_fee }}"
                            data-min="{{ $product->min_amount }}"
                            data-max="{{ $product->max_amount }}">

                            {{ $product->name }} ({{ $product->code }})
                        </option>
                    @endforeach

                </select>
            </div>

            <div class="row">

                {{-- AMOUNT --}}
                <div class="col-md-6 mb-3">
                    <label>Loan Amount</label>
                    <input type="number" name="amount"
                        value="{{ $loan->amount }}"
                        class="form-control"
                        required>
                </div>

                {{-- START DATE --}}
                <div class="col-md-6 mb-3">
                    <label>Start Date</label>
                    <input type="date" name="start_date"
                        value="{{ $loan->start_date }}"
                        class="form-control">
                </div>

            </div>

            {{-- PRODUCT INFO PREVIEW --}}
            <div class="card p-3 mb-3 bg-light">
                <h6>Loan Product Info</h6>

                <p>Interest Rate: <span id="interest">-</span>%</p>
                <p>Interest Type: <span id="type">-</span></p>
                <p>Installment: <span id="installment">-</span></p>
                <p>Duration: <span id="duration">-</span></p>
                <p>Processing Fee: <span id="processing">-</span></p>
                <p>Insurance Fee: <span id="insurance">-</span></p>
                <p>Late Fee: <span id="late">-</span></p>
                <p>Min Amount: <span id="min">-</span></p>
                <p>Max Amount: <span id="max">-</span></p>
            </div>

            {{-- NOTE --}}
            <div class="mb-3">
                <label>Note</label>
                <textarea name="note" class="form-control">{{ $loan->note }}</textarea>
            </div>

            <button class="btn btn-primary">
                Update Loan
            </button>

        </form>

    </div>
</div>

{{-- JS --}}
<script>
function updateProductInfo() {
    let select = document.getElementById('loan_product');
    let option = select.options[select.selectedIndex];

    if (!option) return;

    document.getElementById('interest').innerText = option.dataset.interest || '-';
    document.getElementById('type').innerText = option.dataset.type || '-';
    document.getElementById('installment').innerText = option.dataset.installment || '-';
    document.getElementById('duration').innerText = option.dataset.duration || '-';
    document.getElementById('processing').innerText = option.dataset.processing || '-';
    document.getElementById('insurance').innerText = option.dataset.insurance || '-';
    document.getElementById('late').innerText = option.dataset.late || '-';
    document.getElementById('min').innerText = option.dataset.min || '-';
    document.getElementById('max').innerText = option.dataset.max || '-';
}

document.getElementById('loan_product').addEventListener('change', updateProductInfo);

// auto load on edit page
updateProductInfo();
</script>

@endsection