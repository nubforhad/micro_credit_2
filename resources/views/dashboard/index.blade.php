 @extends('layouts.app')

@section('content')

<style>
    .dashboard-card {
        border: none;
        border-radius: 16px;
        overflow: hidden;
        transition: 0.35s ease;
        position: relative;
    }

    .dashboard-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.15) !important;
    }

    .card-icon {
        width: 55px;
        height: 55px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(4px);
    }

    .stat-title {
        font-size: 13.5px;
        opacity: 0.9;
        letter-spacing: 0.3px;
    }

    .stat-number {
        font-size: 24px;
        font-weight: 700;
        margin-top: 4px;
    }

    .bg-gradient-primary { background: linear-gradient(135deg, #2563eb, #1d4ed8); }
    .bg-gradient-success { background: linear-gradient(135deg, #16a34a, #15803d); }
    .bg-gradient-warning { background: linear-gradient(135deg, #f59e0b, #d97706); }
    .bg-gradient-danger  { background: linear-gradient(135deg, #dc2626, #991b1b); }
    .bg-gradient-info    { background: linear-gradient(135deg, #0891b2, #0e7490); }
    .bg-gradient-purple  { background: linear-gradient(135deg, #7c3aed, #6d28d9); }
    .bg-gradient-teal    { background: linear-gradient(135deg, #0d9488, #0f766e); }
    .bg-gradient-orange  { background: linear-gradient(135deg, #ea580c, #c2410c); }

    .mini-stat-card {
        border-radius: 16px;
        border: 1px solid #eef1f5;
        transition: 0.3s ease;
    }

    .mini-stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.08) !important;
    }

    .mini-icon-box {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
    }

    .welcome-box {
        background: linear-gradient(135deg, #1e293b, #334155);
        border-radius: 18px;
        padding: 22px 28px;
        color: #fff;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
    }

    .welcome-box h3 {
        font-weight: 700;
        margin-bottom: 4px;
    }

    .welcome-box p {
        opacity: 0.85;
        margin-bottom: 0;
        font-size: 14px;
    }

    .role-badge {
        background: rgba(255,255,255,0.15);
        padding: 6px 16px;
        border-radius: 50px;
        font-size: 13px;
        font-weight: 600;
    }

    .section-heading {
        font-size: 17px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .section-heading i {
        color: #2563eb;
    }

    .table thead th {
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        color: #64748b;
        border-bottom: 2px solid #f1f5f9;
    }

    .table tbody tr {
        transition: 0.2s;
    }

    .table tbody tr:hover {
        background: #f8fafc;
    }

    .badge-status {
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 12.5px;
        font-weight: 600;
    }
</style>

<!-- WELCOME BOX -->
<div class="welcome-box mb-4 mt-2">
    <div>
        <h3>Micro Credit Dashboard</h3>
        <p>Welcome back, <strong>{{ auth()->user()->name }}</strong> 👋</p>
    </div>
    <div class="role-badge">
        <i class="bx bx-user-circle me-1"></i>
        {{ auth()->user()->getRoleNames()->first() ?? 'User' }}
    </div>
</div>

<!-- STAT CARDS ROW 1 -->
<div class="row g-3">
    <div class="col-xl-3 col-md-6">
        <div class="card dashboard-card text-white bg-gradient-primary shadow">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-title">Total Members</div>
                        <div class="stat-number">{{ $totalMember }}</div>
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
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-title">Running Loan</div>
                        <div class="stat-number">{{ $runningLoan }}</div>
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
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-title">Total Collection</div>
                        <div class="stat-number">৳ {{ number_format($totalCollection,2) }}</div>
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
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-title">Overdue</div>
                        <div class="stat-number">{{ $overdue }}</div>
                    </div>
                    <div class="card-icon">
                        <i class="bx bx-error-circle"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- STAT CARDS ROW 2 -->
<div class="row g-3 mt-1">
    <div class="col-xl-3 col-md-6">
        <div class="card dashboard-card text-white bg-gradient-purple shadow">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-title">Total Fund</div>
                        <div class="stat-number">{{ $totalFund }}</div>
                    </div>
                    <div class="card-icon">
                        <i class="bx bx-briefcase"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card dashboard-card text-white bg-gradient-teal shadow">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-title">Total Balance</div>
                        <div class="stat-number">৳ {{ number_format($totalBalance,2) }}</div>
                    </div>
                    <div class="card-icon">
                        <i class="bx bx-wallet-alt"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card dashboard-card text-white bg-gradient-info shadow">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-title">Today Receive</div>
                        <div class="stat-number">৳ {{ number_format($todayReceive,2) }}</div>
                    </div>
                    <div class="card-icon">
                        <i class="bx bx-calendar-plus"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card dashboard-card text-white bg-gradient-orange shadow">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-title">Total Payment</div>
                        <div class="stat-number">{{ $todayPayment }}</div>
                    </div>
                    <div class="card-icon">
                        <i class="bx bx-transfer"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MINI STAT CARDS -->
<div class="row g-3 mt-1">
    <div class="col-xl-3 col-md-6">
        <div class="card mini-stat-card shadow-sm">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="mini-icon-box bg-primary bg-opacity-10 text-primary">
                    <i class="bx bx-wallet"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1" style="font-size:13px;">Total Loan Amount</h6>
                    <h5 class="fw-bold mb-0">৳ {{ number_format($totalLoanAmount,2) }}</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card mini-stat-card shadow-sm">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="mini-icon-box bg-success bg-opacity-10 text-success">
                    <i class="bx bx-calendar-check"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1" style="font-size:13px;">Today's Collection</h6>
                    <h5 class="fw-bold mb-0">৳ {{ number_format($todayCollection,2) }}</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card mini-stat-card shadow-sm">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="mini-icon-box bg-warning bg-opacity-10 text-warning">
                    <i class="bx bx-save"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1" style="font-size:13px;">Total Savings</h6>
                    <h5 class="fw-bold mb-0">৳ {{ number_format($savingAmount,2) }}</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card mini-stat-card shadow-sm">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="mini-icon-box bg-info bg-opacity-10 text-info">
                    <i class="bx bx-bar-chart-alt-2"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1" style="font-size:13px;">DPS Collection</h6>
                    <h5 class="fw-bold mb-0">৳ {{ number_format($dpsCollection,2) }}</h5>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- RECENT LOAN -->
<div class="card shadow-sm mt-4" style="border-radius:16px; border:none;">
    <div class="card-header bg-white d-flex justify-content-between align-items-center" style="border-radius:16px 16px 0 0;">
        <div class="section-heading mb-0">
            <i class="bx bx-history"></i>
            Recent Loan
        </div>
        <a href="{{ route('loan.index') }}" class="btn btn-sm btn-outline-primary rounded-pill">
            View All <i class="bx bx-right-arrow-alt"></i>
        </a>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
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
                        <td>{{ $loop->iteration }}</td>
                        <td class="fw-semibold">{{ $loan->loan_no ?? 'N/A' }}</td>
                        <td>{{ $loan->member->name ?? 'N/A' }}</td>
                        <td>৳ {{ number_format($loan->amount,2) }}</td>
                        <td>
                            @if($loan->status == 'running')
                                <span class="badge-status bg-success bg-opacity-10 text-success">
                                    <i class="bx bx-check-circle"></i> Running
                                </span>
                            @else
                                <span class="badge-status bg-secondary bg-opacity-10 text-secondary">
                                    {{ $loan->status }}
                                </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">
                            <i class="bx bx-inbox fs-2 d-block mb-2"></i>
                            No Loan Found
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection