<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <a href="{{route('dashboard')}}">
            <h4>
                <i class="bx bx-layer"></i>
                Micro Credit
            </h4>
        </a>

        <button class="btn-close btn-close-white d-lg-none" id="closeSidebar"></button>
    </div>

    {{-- Dashboard --}}

    <a href="{{route('dashboard')}}">
        <i class="bx bxs-dashboard"></i>
        Dashboard
    </a>

    {{-- Organization --}}

    <div class="menu-title">Organization</div>

    @can('user.view')

    <a href="{{route('users.index')}}">
        <i class="bx bx-user"></i>

        Users
    </a>

    @endcan @can('role.view')

    <a href="{{route('roles.index')}}">
        <i class="bx bx-shield"></i>

        Roles
    </a>

    @endcan @can('company.view')

    <a href="{{route('company.index')}}">
        <i class="bx bx-buildings"></i>

        Company
    </a>

    @endcan @can('branch.view')

    <a href="{{route('branch.index')}}">
        <i class="bx bx-building-house"></i>

        Branch
    </a>

    @endcan @can('area.view')

    <a href="{{route('area.index')}}">
        <i class="bx bx-map"></i>

        Area
    </a>

    @endcan @can('center.view')

    <a href="{{route('center.index')}}">
        <i class="bx bx-sitemap"></i>

        Center
    </a>

    @endcan @can('member.view')

    <a href="{{route('member.index')}}">
        <i class="bx bx-group"></i>

        Members
    </a>

    @endcan {{-- Income Expense --}} @can('income.view')

    <a href="{{route('income-expenses.index')}}">
        <i class="bx bx-transfer-alt"></i>

        Income Expenses
    </a>

    @endcan {{-- Cash Book --}} @can('cashbook.view')

    <a href="{{route('cash-book.index')}}">
        <i class="bx bx-spreadsheet"></i>

        Cash Book
    </a>

    @endcan {{-- Daily Collection --}} @can('report.daily')

    <a href="{{route('daily-collection.index')}}">
        <i class="bx bx-collection"></i>

        Daily Collection
    </a>

    @endcan {{-- Reports --}} @can('report.dashboard')

    <a href="{{route('reports.dashboard')}}">
        <i class="bx bx-bar-chart"></i>

        Reports Dashboard
    </a>

    @endcan {{-- LOAN MANAGEMENT --}} @canany([ 'loan.view', 'loan.create', 'loan.collection', 'loan.payment.history',
    'loan.overdue', 'loan.report' ])

    <div class="menu-title">Loan Management</div>

    <div class="menu-group">
        <a class="menu-toggle">
            <i class="bx bx-credit-card"></i>

            Loan

            <i class="bx bx-chevron-down arrow"></i>
        </a>

        <div class="submenu">
            @can('loan.view')

            <a href="{{route('loan.index')}}">
                <i class="bx bx-file"></i>

                Loan List
            </a>

            @endcan @can('loan_product.view')

            <a href="{{route('loan-product.index')}}">
                <i class="bx bx-package"></i>

                Loan Product
            </a>

            @endcan @can('loan.collection')

            <a href="{{route('installment.index')}}">
                <i class="bx bx-money"></i>

                Installment
            </a>

            @endcan @can('loan.payment.history')

            <a href="{{route('loan.payment.index')}}">
                <i class="bx bx-history"></i>

                Payment History
            </a>

            @endcan @can('report.daily')

            <a href="{{route('report.daily.collection')}}">
                <i class="bx bx-bar-chart"></i>

                Daily Collection
            </a>

            @endcan @can('loan.overdue')

            <a href="{{route('installment.overdue')}}">
                <i class="bx bx-error"></i>

                Overdue
            </a>

            @endcan
        </div>
    </div>

    @endcanany {{-- SAVINGS MANAGEMENT --}} @canany([ 'saving.view', 'saving.deposit', 'saving.withdraw',
    'saving.summary' ])

    <div class="menu-title">Savings Management</div>

    <div class="menu-group">
        <a class="menu-toggle">
            <i class="bx bx-wallet"></i>

            Savings

            <i class="bx bx-chevron-down arrow"></i>
        </a>

        <div class="submenu">
            @can('saving.view')

            <a href="{{route('savvings.index')}}">
                <i class="bx bx-wallet-alt"></i>

                Savings
            </a>

            @endcan @can('saving.summary')

            <a href="{{route('savvings.summary')}}">
                <i class="bx bx-pie-chart"></i>

                Summary
            </a>

            @endcan @can('saving.view')

            <a href="{{route('savvings.member.summary')}}">
                <i class="bx bx-user-circle"></i>

                Member Summary
            </a>

            @endcan @can('saving.withdraw')

            <a href="{{route('savvings.withdraw.withreqs')}}">
                <i class="bx bx-money-withdraw"></i>

                Withdraw
            </a>

            @endcan
        </div>
    </div>

    @endcanany {{-- DPS MANAGEMENT --}} @canany([ 'dps.plan', 'dps.account', 'dps.collection', 'dps.maturity',
    'dps.report' ])

    <div class="menu-title">DPS Management</div>

    <div class="menu-group">
        <a class="menu-toggle">
            <i class="bx bx-calendar"></i>

            DPS

            <i class="bx bx-chevron-down arrow"></i>
        </a>

        <div class="submenu">
            @can('dps.plan')

            <a href="{{route('dps-plans.index')}}">
                <i class="bx bx-list-ul"></i>

                DPS Plans
            </a>

            @endcan @can('dps.account')

            <a href="{{route('dps-accounts.index')}}">
                <i class="bx bx-user-plus"></i>

                DPS Accounts
            </a>

            @endcan @can('dps.collection')

            <a href="{{route('dps-payments.index')}}">
                <i class="bx bx-collection"></i>

                DPS Collection
            </a>

            @endcan @can('dps.maturity')

            <a href="{{route('dps-maturities.index')}}">
                <i class="bx bx-check-circle"></i>

                DPS Maturity
            </a>

            @endcan @can('dps.report')

            <a href="{{route('dps-reports.index')}}">
                <i class="bx bx-line-chart"></i>

                DPS Reports
            </a>

            @endcan
        </div>
    </div>

    @endcanany {{-- ACCOUNT / FUND MANAGEMENT --}} @canany([ 'fund.account', 'fund.transaction', 'fund.ledger' ])

    <div class="menu-title">Account Management</div>

    <div class="menu-group">
        <a class="menu-toggle">
            <i class="bx bx-wallet"></i>

            Account

            <i class="bx bx-chevron-down arrow"></i>
        </a>

        <div class="submenu">
            @can('fund.ledger')

            <a href="{{route('fund.ledger1')}}">
                <i class="bx bx-book-content"></i>

                Fund Ledger
            </a>

            @endcan @can('fund.account')

            <a href="{{route('fund-accounts.index')}}">
                <i class="bx bx-briefcase"></i>

                Fund Account
            </a>

            @endcan @can('fund.transaction')

            <a href="{{route('fund-transactions.index')}}">
                <i class="bx bx-transfer"></i>

                Fund Transaction
            </a>

            @endcan
        </div>
    </div>

    @endcanany
</div>

<div class="sidebar-overlay" id="sidebarOverlay"></div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const sidebar = document.getElementById("sidebar");

        const overlay = document.getElementById("sidebarOverlay");

        const openBtn = document.getElementById("openSidebar");

        const closeBtn = document.getElementById("closeSidebar");

        if (openBtn) {
            openBtn.onclick = function () {
                sidebar.classList.add("active");

                overlay.classList.add("active");
            };
        }

        if (closeBtn) {
            closeBtn.onclick = function () {
                sidebar.classList.remove("active");

                overlay.classList.remove("active");
            };
        }

        if (overlay) {
            overlay.onclick = function () {
                sidebar.classList.remove("active");

                overlay.classList.remove("active");
            };
        }

        document.querySelectorAll(".menu-toggle").forEach(function (menu) {
            menu.onclick = function () {
                this.classList.toggle("active");

                let submenu = this.nextElementSibling;

                submenu.classList.toggle("show");
            };
        });
    });
</script>
