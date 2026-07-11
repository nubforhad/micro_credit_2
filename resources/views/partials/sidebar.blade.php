<style>
    * {
        box-sizing: border-box;
    }

    .sidebar {
        width: 260px;

        height: 100vh;

        position: fixed;

        top: 0;

        left: 0;

        background: #1e293b;

        color: #fff;

        z-index: 1000;

        overflow-y: auto;

        transition: 0.3s ease;
    }

    .sidebar::-webkit-scrollbar {
        width: 6px;
    }

    .sidebar::-webkit-scrollbar-thumb {
        background: #64748b;

        border-radius: 10px;
    }

    .sidebar-header {
        height: 70px;

        display: flex;

        align-items: center;

        justify-content: space-between;

        padding: 15px;

        position: sticky;

        top: 0;

        background: #1e293b;

        z-index: 10;
    }

    .sidebar-header a {
        text-decoration: none;
    }

    .sidebar-header h4 {
        color: #fff;

        margin: 0;
    }

    .sidebar a {
        display: flex;

        align-items: center;

        gap: 12px;

        padding: 12px 20px;

        color: #fff;

        text-decoration: none;

        font-size: 15px;
    }

    .sidebar a:hover {
        background: #334155;
    }

    .sidebar a i {
        font-size: 20px;
    }

    /* SECTION */

    .menu-title {
        padding: 10px 20px;

        color: #94a3b8;

        font-size: 12px;

        text-transform: uppercase;
    }

    /* SUB MENU */

    .menu-toggle {
        cursor: pointer;
    }

    .menu-toggle .arrow {
        margin-left: auto;

        transition: 0.3s;
    }

    .menu-toggle.active .arrow {
        transform: rotate(180deg);
    }

    .submenu {
        display: none;

        background: #0f172a;
    }

    .submenu.show {
        display: block;
    }

    .submenu a {
        padding-left: 50px;

        font-size: 14px;
    }

    /* OVERLAY */

    .sidebar-overlay {
        display: none;

        position: fixed;

        top: 0;

        left: 0;

        width: 100%;

        height: 100%;

        background: rgba(0, 0, 0, 0.5);

        z-index: 999;
    }

    @media (max-width: 991px) {
        .sidebar {
            left: -260px;
        }

        .sidebar.active {
            left: 0;
        }

        .sidebar-overlay.active {
            display: block;
        }
    }

    @media (min-width: 992px) {
        .sidebar {
            left: 0;
        }
    }
</style>

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

    <a href="{{route('dashboard')}}">
        <i class="bx bxs-dashboard"></i>
        Dashboard
    </a>

    <div class="menu-title">Organization</div>

    <a href="{{route('company.index')}}">
        <i class="bx bx-buildings"></i>
        Company
    </a>

    <a href="{{route('branch.index')}}">
        <i class="bx bx-building-house"></i>
        Branch
    </a>

    <a href="{{route('area.index')}}">
        <i class="bx bx-map"></i>
        Area
    </a>

    <a href="{{route('center.index')}}">
        <i class="bx bx-home"></i>
        Center
    </a>

    <a href="{{route('member.index')}}">
        <i class="bx bx-group"></i>
        Members
    </a>

    <!-- LOAN -->

    <div class="menu-title">Loan Management</div>

    <div class="menu-group">
        <a class="menu-toggle">
            <i class="bx bx-credit-card"></i>

            Loan

            <i class="bx bx-chevron-down arrow"></i>
        </a>

        <div class="submenu">
            <a href="{{route('loan.index')}}">
                <i class="bx bx-file"></i>
                Loan List
            </a>

            <a href="{{route('loan-product.index')}}">
                <i class="bx bx-package"></i>
                Loan Product
            </a>

            <a href="{{route('installment.index')}}">
                <i class="bx bx-money"></i>
                Installment
            </a>

            <a href="{{route('loan.payment.index')}}">
                <i class="bx bx-history"></i>
                Payment History
            </a>

            <a href="{{route('report.daily.collection')}}">
                <i class="bx bx-bar-chart"></i>
                Daily Collection
            </a>

            <a href="{{route('installment.overdue')}}">
                <i class="bx bx-error"></i>
                Overdue
            </a>
        </div>
    </div>

    <!-- SAVINGS -->

    <div class="menu-title">Savings Management</div>

    <div class="menu-group">
        <a class="menu-toggle">
            <i class="bx bx-wallet"></i>

            Savings

            <i class="bx bx-chevron-down arrow"></i>
        </a>

        <div class="submenu">
            <a href="{{route('savvings.index')}}">
                <i class="bx bx-wallet-alt"></i>
                Savings
            </a>

            <a href="{{route('savvings.summary')}}">
                <i class="bx bx-pie-chart"></i>
                Summary
            </a>

            <a href="{{route('savvings.member.summary')}}">
                <i class="bx bx-user-circle"></i>
                Member Summary
            </a>

            <a href="{{route('savvings.withdraw.withreqs')}}">
                <i class="bx bx-money-withdraw"></i>
                Withdraw
            </a>
        </div>
    </div>

    <!-- DPS -->

    <div class="menu-title">DPS Management</div>

    <div class="menu-group">
        <a class="menu-toggle">
            <i class="bx bx-calendar"></i>

            DPS

            <i class="bx bx-chevron-down arrow"></i>
        </a>

        <div class="submenu">
            <a href="{{route('dps-plans.index')}}">
                <i class="bx bx-list-ul"></i>
                DPS Plans
            </a>

            <a href="{{route('dps-accounts.index')}}">
                <i class="bx bx-user-plus"></i>
                DPS Accounts
            </a>

            <a href="{{route('dps-payments.index')}}">
                <i class="bx bx-collection"></i>
                DPS Collection
            </a>

            <a href="{{route('dps-maturities.index')}}">
                <i class="bx bx-check-circle"></i>
                DPS Maturity
            </a>

            <a href="{{route('dps-reports.index')}}">
                <i class="bx bx-line-chart"></i>
                DPS Reports
            </a>
        </div>
    </div>
    <!-- Account -->

    <div class="menu-title">Account Management</div>

    <div class="menu-group">
        <a class="menu-toggle">
            <i class="bx bx-calendar"></i>

            Account

            <i class="bx bx-chevron-down arrow"></i>
        </a>

        <div class="submenu">
            <a href="{{route('fund.ledger')}}">
                <i class="bx bx-list-ul"></i>
                Fund ledger
            </a>

            <a href="{{route('fund-accounts.index')}}">
                <i class="bx bx-user-plus"></i>
               Fund Account
            </a>
 
        </div>
    </div>
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

        overlay.onclick = function () {
            sidebar.classList.remove("active");

            overlay.classList.remove("active");
        };

        document.querySelectorAll(".menu-toggle").forEach(function (menu) {
            menu.onclick = function () {
                this.classList.toggle("active");

                let submenu = this.nextElementSibling;

                submenu.classList.toggle("show");
            };
        });
    });
</script>
