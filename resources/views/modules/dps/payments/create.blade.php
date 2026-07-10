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
    <h4>DPS Collection</h4>

    <a href="{{route('dps-payments.index')}}" class="btn btn-secondary"> Back </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{route('dps-payments.store')}}" method="POST">
            @csrf

            <div class="mb-3">
                <label> DPS Account </label>

                <select name="dps_account_id" id="account" class="form-control" required>
                    <option value="">Select Account</option>

                    @foreach($accounts as $account)

                    <option value="{{$account->id}}" data-amount="{{$account->installment_amount}}">
                        {{$account->account_no}} - {{$account->member->name}} (Monthly {{$account->installment_amount}})
                    </option>

                    @endforeach
                </select>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label> Installment Amount </label>

                    <input type="number" id="amount" name="amount" class="form-control" readonly />
                </div>

                <div class="col-md-6 mb-3">
                    <label> Payment Date </label>

                    <input type="date" name="payment_date" value="{{date('Y-m-d')}}" class="form-control" required />
                </div>
            </div>

            <div class="mb-3">
                <label> Payment Method </label>

                <select name="payment_method" class="form-control">
                    <option value="Cash">Cash</option>

                    <option value="Bank">Bank</option>

                    <option value="bKash">bKash</option>

                    <option value="Nagad">Nagad</option>
                </select>
            </div>

            <div class="mb-3">
                <label> Note </label>

                <textarea name="note" class="form-control"></textarea>
            </div>

            <button class="btn btn-success">Collect Payment</button>
        </form>
    </div>
</div>

<script>
    document.getElementById("account").addEventListener("change", function () {
        let amount = this.options[this.selectedIndex].getAttribute("data-amount");

        document.getElementById("amount").value = amount;
    });
</script>

@endsection
