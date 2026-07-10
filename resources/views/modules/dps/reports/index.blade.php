@extends('layouts.app') @section('content') @if(session('success'))
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

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>DPS Statement Report</h4>

    @if(isset($account))
    <button onclick="window.print()" class="btn btn-success"><i class="bx bx-printer"></i> Print Statement</button>
    @endif
</div>

<div class="card shadow-sm mb-4">
    <div class="card-header bg-primary text-white">Search DPS Account</div>

    <div class="card-body">
        <form method="GET" action="{{ route('dps-reports.index') }}">
            <div class="row">
                <div class="col-md-10">
                    <input
                        type="text"
                        name="account_no"
                        class="form-control"
                        placeholder="Enter DPS Account Number"
                        value="{{ request('account_no') }}"
                        required
                    />
                </div>

                <div class="col-md-2">
                    <button class="btn btn-primary w-100">Search</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-6">
        <div class="card border-success">
            <div class="card-body">
                <h6>Total Collection</h6>

                <h3>{{ number_format($totalCollection,2) }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card border-primary">
            <div class="card-body">
                <h6>Total Maturity Paid</h6>

                <h3>{{ number_format($totalMaturity,2) }}</h3>
            </div>
        </div>
    </div>
</div>

@if(request('account_no')) @if($account)

<div id="printArea">
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">Member Information</div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <strong>Member Name</strong>

                    <br />

                    {{ $account->member->name }}
                </div>

                <div class="col-md-4">
                    <strong>Member No</strong>

                    <br />

                    {{ $account->member->member_no }}
                </div>

                <div class="col-md-4">
                    <strong>Mobile</strong>

                    <br />

                    {{ $account->member->mobile }}
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mt-3">
        <div class="card-header bg-info text-white">DPS Information</div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <strong>Account No</strong>

                    <br />

                    {{ $account->account_no }}
                </div>

                <div class="col-md-3">
                    <strong>Plan</strong>

                    <br />

                    {{ $account->plan->name }}
                </div>

                <div class="col-md-3">
                    <strong>Monthly DPS</strong>

                    <br />

                    {{ number_format($account->installment_amount,2) }}
                </div>

                <div class="col-md-3">
                    <strong>Status</strong>

                    <br />

                    @if($account->status=='running')
                    <span class="badge bg-success">Running</span>
                    @elseif($account->status=='completed')
                    <span class="badge bg-primary">Completed</span>
                    @else
                    <span class="badge bg-danger">{{ ucfirst($account->status) }}</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mt-3">
        <div class="card-header bg-success text-white">Installment History</div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>

                            <th>Date</th>

                            <th>Installment No</th>

                            <th>Amount</th>

                            <th>Payment Method</th>

                            <th>Note</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php $totalDeposit = 0; @endphp @forelse($account->payments as $payment) @php $totalDeposit +=
                        $payment->amount; @endphp

                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>{{ date('d-m-Y', strtotime($payment->payment_date)) }}</td>

                            <td>{{ $payment->installment_no }}</td>

                            <td>{{ number_format($payment->amount,2) }}</td>

                            <td>{{ $payment->payment_method }}</td>

                            <td>{{ $payment->note }}</td>
                        </tr>

                        @empty

                        <tr>
                            <td colspan="6" class="text-center text-danger">No Payment Found</td>
                        </tr>

                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-3">
            <div class="card border-primary">
                <div class="card-body text-center">
                    <h6>Total Deposit</h6>

                    <h4>{{ number_format($totalDeposit,2) }}</h4>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-success">
                <div class="card-body text-center">
                    <h6>Paid Installment</h6>

                    <h4>{{ $account->paid_installment }}</h4>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-warning">
                <div class="card-body text-center">
                    <h6>Due Installment</h6>

                    <h4>{{ $account->total_installment - $account->paid_installment }}</h4>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-danger">
                <div class="card-body text-center">
                    <h6>Total Installment</h6>

                    <h4>{{ $account->total_installment }}</h4>
                </div>
            </div>
        </div>
    </div>
</div>

@else

<div class="alert alert-danger">
    <strong>No DPS Account Found.</strong>
</div>

@endif @endif @endsection
