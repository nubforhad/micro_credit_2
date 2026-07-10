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

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Create DPS Maturity</h4>

    <a href="{{route('dps-maturities.index')}}" class="btn btn-secondary"> Back </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{route('dps-maturities.store')}}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label"> Select DPS Account </label>

                <select name="dps_account_id" id="account" class="form-control" required>
                    <option value="">Select Account</option>

                    @foreach($accounts as $account)

                    <option
                        value="{{$account->id}}"
                        data-member="{{$account->member->name}}"
                        data-memberno="{{$account->member->member_no}}"
                        data-plan="{{$account->plan->name}}"
                        data-installment="{{$account->installment_amount}}"
                        data-total="{{$account->total_installment}}"
                        data-interest="{{$account->plan->interest_rate}}"
                    >
                        {{$account->account_no}} - {{$account->member->name}}
                    </option>

                    @endforeach
                </select>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label> Member Name </label>

                    <input type="text" id="member" class="form-control" readonly />
                </div>

                <div class="col-md-6 mb-3">
                    <label> Member No </label>

                    <input type="text" id="member_no" class="form-control" readonly />
                </div>

                <div class="col-md-6 mb-3">
                    <label> DPS Plan </label>

                    <input type="text" id="plan" class="form-control" readonly />
                </div>

                <div class="col-md-6 mb-3">
                    <label> Total Deposit </label>

                    <input type="text" id="deposit" class="form-control" readonly />
                </div>

                <div class="col-md-6 mb-3">
                    <label> Profit </label>

                    <input type="text" id="profit" class="form-control" readonly />
                </div>

                <div class="col-md-6 mb-3">
                    <label> Maturity Amount </label>

                    <input type="text" id="maturity" class="form-control" readonly />
                </div>
            </div>

            <div class="mb-3">
                <label> Paid Date </label>

                <input type="date" name="paid_date" value="{{date('Y-m-d')}}" class="form-control" />
            </div>

            <div class="mb-3">
                <label> Note </label>

                <textarea name="note" class="form-control"></textarea>
            </div>

            <button class="btn btn-success">Pay Maturity</button>
        </form>
    </div>
</div>

<script>
    document.getElementById("account").addEventListener("change", function () {
        let option = this.options[this.selectedIndex];

        let installment = parseFloat(option.dataset.installment);

        let total = parseFloat(option.dataset.total);

        let interest = parseFloat(option.dataset.interest);

        let deposit = installment * total;

        let profit = (deposit * interest) / 100;

        let maturity = deposit + profit;

        document.getElementById("member").value = option.dataset.member;

        document.getElementById("member_no").value = option.dataset.memberno;

        document.getElementById("plan").value = option.dataset.plan;

        document.getElementById("deposit").value = deposit.toFixed(2);

        document.getElementById("profit").value = profit.toFixed(2);

        document.getElementById("maturity").value = maturity.toFixed(2);
    });
</script>

@endsection
