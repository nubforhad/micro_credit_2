<style>

*{
    box-sizing:border-box;
}


/* SIDEBAR */
.sidebar {

    width:260px;
    height:100vh;

    position:fixed;
    top:0;
    left:0;

    background:#1e293b;
    color:#fff;

    z-index:1000;

    overflow-y:auto;
    overflow-x:hidden;

    transition:0.3s ease;

}


/* Scrollbar */

.sidebar::-webkit-scrollbar{

    width:7px;

}


.sidebar::-webkit-scrollbar-thumb{

    background:#64748b;
    border-radius:10px;

}


.sidebar::-webkit-scrollbar-track{

    background:#0f172a;

}



/* HEADER */

.sidebar-header{

    height:70px;

    display:flex;
    align-items:center;
    justify-content:space-between;

    padding:15px;

    background:#1e293b;

    position:sticky;
    top:0;

    z-index:10;

}



.sidebar-header h4{

    margin:0;
    color:white;

}



/* MENU */

.sidebar a{

    display:flex;

    align-items:center;

    gap:12px;

    padding:13px 20px;

    color:white;

    text-decoration:none;

    font-size:15px;

    transition:0.2s;

}



.sidebar a i{

    font-size:20px;

}



.sidebar a:hover{

    background:#334155;

    color:white;

}



/* OVERLAY */

.sidebar-overlay{

    display:none;

    position:fixed;

    top:0;
    left:0;

    width:100%;
    height:100%;

    background:rgba(0,0,0,0.5);

    z-index:999;

}



/* MOBILE */

@media(max-width:991px){


    .sidebar{

        left:-260px;

    }


    .sidebar.active{

        left:0;

    }


    .sidebar-overlay.active{

        display:block;

    }


}



/* Desktop */

@media(min-width:992px){


    .sidebar{

        left:0;

    }


}


</style>



<!-- SIDEBAR -->

<div class="sidebar" id="sidebar">


    <div class="sidebar-header">

    <a href="{{ route('dashboard') }} ">
        <h4>
            Micro Credit
        </h4>
    </a>

        <button 
            class="btn-close btn-close-white d-lg-none" 
            id="closeSidebar">
        </button>


    </div>



    <a href="{{ route('dashboard') }}">
        <i class='bx bxs-dashboard'></i>
        Dashboard
    </a>



    <a href="{{ route('company.index') }}">
        <i class='bx bx-buildings'></i>
        Company
    </a>



    <a href="{{ route('branch.index') }}">
        <i class='bx bx-building-house'></i>
        Branch
    </a>



    <a href="{{ route('area.index') }}">
        <i class='bx bx-map'></i>
        Area
    </a>



    <a href="{{ route('center.index') }}">
        <i class='bx bx-home'></i>
        Center
    </a>



    <a href="{{ route('member.index') }}">
        <i class='bx bx-user'></i>
        Members
    </a>



    <a href="{{ route('saving.index') }}">
        <i class='bx bx-wallet'></i>
        Savings
    </a>



    <a href="{{ route('loan.index') }}">
        <i class='bx bx-credit-card'></i>
        Loan
    </a>



    <a href="{{ route('loan-product.index') }}">
        <i class='bx bx-package'></i>
        Loan Product
    </a>



    <a href="{{ route('installment.index') }}">
        <i class='bx bx-money'></i>
        Installment
    </a>



    <a href="{{ route('loan.payment.index') }}">
        <i class='bx bx-history'></i>
        Payment History
    </a>



    <a href="{{ route('report.daily.collection') }}">
        <i class='bx bx-line-chart'></i>
        Daily Collection
    </a>



    <a href="{{ route('installment.overdue') }}">
        <i class='bx bx-error-circle'></i>
        Overdue
    </a>



    <a href="{{ route('savvings.index') }}">
        <i class='bx bx-wallet-alt'></i>
        Savvings
    </a>



    <!-- <a href="{{ route('savvings.withdraw.request') }}">
        <i class='bx bx-money-withdraw'></i>
        Withdraw
    </a> -->

    <a href="{{ route('savvings.withdraw.withreqs') }}">
        <i class='bx bx-money-withdraw'></i>
        Withdraw
    </a>
 


</div>



<div class="sidebar-overlay" id="sidebarOverlay"></div>



<script>


document.addEventListener("DOMContentLoaded",function(){


    const sidebar = document.getElementById("sidebar");

    const overlay = document.getElementById("sidebarOverlay");

    const openBtn = document.getElementById("openSidebar");

    const closeBtn = document.getElementById("closeSidebar");



    // Open

    if(openBtn){

        openBtn.addEventListener("click",function(){

            sidebar.classList.add("active");

            overlay.classList.add("active");

        });

    }



    // Close

    if(closeBtn){

        closeBtn.addEventListener("click",function(){

            sidebar.classList.remove("active");

            overlay.classList.remove("active");

        });

    }



    // Overlay Close

    overlay.addEventListener("click",function(){

        sidebar.classList.remove("active");

        overlay.classList.remove("active");

    });



});


</script>