@extends('layouts.app') @section('content')

<style>
    .dashboard-card {
        border: none;

        border-radius: 15px;

        overflow: hidden;

        transition: 0.3s;
    }

    .dashboard-card:hover {
        transform: translateY(-5px);
    }

    .card-icon {
        width: 55px;

        height: 55px;

        border-radius: 50%;

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 28px;

        background: rgba(255, 255, 255, 0.25);
    }

    .stat-title {
        font-size: 14px;

        opacity: 0.9;
    }

    .stat-number {
        font-size: 25px;

        font-weight: 700;
    }

    .bg-gradient-primary {
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
    }

    .bg-gradient-success {
        background: linear-gradient(135deg, #16a34a, #15803d);
    }

    .bg-gradient-warning {
        background: linear-gradient(135deg, #f59e0b, #d97706);
    }

    .bg-gradient-danger {
        background: linear-gradient(135deg, #dc2626, #991b1b);
    }

    .bg-gradient-info {
        background: linear-gradient(135deg, #0891b2, #0e7490);
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold">Micro Credit Dashboard</h3>

        <p class="text-muted mb-0">Welcome back, Admin</p>
    </div>
</div>

<!-- STAT CARDS -->

<div class="row g-3">
    <div class="col-xl-3 col-md-6">
        <div class="card dashboard-card text-white bg-gradient-primary shadow">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <div class="stat-title">Total Members</div>

                        <div class="stat-number">{{$totalMember}}</div>
                    </div>

                    <div class="card-icon">
                        <i class="bx bx-group"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card dashboard-card text-white bg-gradient-success shadow">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <div class="stat-title">Running Loan</div>

                        <div class="stat-number">{{$runningLoan}}</div>
                    </div>

                    <div class="card-icon">
                        <i class="bx bx-credit-card"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card dashboard-card text-white bg-gradient-warning shadow">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <div class="stat-title">Total Collection</div>

                        <div class="stat-number">{{number_format($totalCollection,2)}}</div>
                    </div>

                    <div class="card-icon">
                        <i class="bx bx-money"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card dashboard-card text-white bg-gradient-danger shadow">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <div class="stat-title">Overdue</div>

                        <div class="stat-number">{{$overdue}}</div>
                    </div>

                    <div class="card-icon">
                        <i class="bx bx-error-circle"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mt-1">
    <div class="col-xl-3 col-md-6">
        <div class="card dashboard-card text-white bg-gradient-primary shadow">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <div class="stat-title">Total Fund</div>

                        <div class="stat-number">{{$totalFund}}</div>
                    </div>

                    <div class="card-icon">
                        <i class="bx bx-group"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card dashboard-card text-white bg-gradient-success shadow">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <div class="stat-title">Total Blance</div>

                        <div class="stat-number">{{$totalBalance}}</div>
                    </div>

                    <div class="card-icon">
                        <i class="bx bx-credit-card"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card dashboard-card text-white bg-gradient-warning shadow">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <div class="stat-title">Today Receive</div>

                        <div class="stat-number">{{number_format($todayReceive,2)}}</div>
                    </div>

                    <div class="card-icon">
                        <i class="bx bx-money"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card dashboard-card text-white bg-gradient-danger shadow">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <div class="stat-title">Total  Payment</div>

                        <div class="stat-number">{{$todayPayment}}</div>
                    </div>

                    <div class="card-icon">
                        <i class="bx bx-error-circle"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
</div>

<!-- SECOND ROW -->

<div class="row g-3 mt-1">
    <div class="col-xl-3 col-md-6">
        <div class="card shadow-sm dashboard-card">
            <div class="card-body">
                <h6 class="text-muted">Total Loan Amount</h6>

                <h4 class="fw-bold">৳ {{number_format($totalLoanAmount,2)}}</h4>

                <i class="bx bx-wallet fs-2 text-primary"></i>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card shadow-sm dashboard-card">
            <div class="card-body">
                <h6 class="text-muted">Today's Collection</h6>

                <h4 class="fw-bold">৳ {{number_format($todayCollection,2)}}</h4>

                <i class="bx bx-calendar-check fs-2 text-success"></i>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card shadow-sm dashboard-card">
            <div class="card-body">
                <h6 class="text-muted">Total Savings</h6>

                <h4 class="fw-bold">৳ {{number_format($savingAmount,2)}}</h4>

                <i class="bx bx-save fs-2 text-warning"></i>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card shadow-sm dashboard-card">
            <div class="card-body">
                <h6 class="text-muted">DPS Collection</h6>
                <h4 class="fw-bold">৳ {{number_format($dpsCollection,2)}}</h4>
                <i class="bx bx-bar-chart fs-2 text-info"></i>
            </div>
        </div>
    </div>
</div>

<!-- RECENT LOAN -->

<div class="card shadow-sm mt-4">
    <div class="card-header bg-white">
        <h5 class="mb-0">Recent Loan</h5>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Loan No</th>
                        <th>Member</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($recentLoans as $loan)

                    <tr>
                        <td>{{$loop->iteration}}</td>

                        <td>{{$loan->loan_no ?? 'N/A'}}</td>

                        <td>{{$loan->member->name ?? 'N/A'}}</td>

                        <td>৳ {{number_format($loan->amount,2)}}</td>

                        <td>
                            @if($loan->status=='running')

                            <span class="badge bg-success"> Running </span>

                            @else

                            <span class="badge bg-secondary"> {{$loan->status}} </span>

                            @endif
                        </td>
                    </tr>
                    @empty

                    <tr>
                        <td colspan="5" class="text-center">No Loan Found</td>
                    </tr>

                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
