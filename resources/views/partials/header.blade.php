
<style>
    .topbar{
    height:70px;
    background:#fff;
    border-bottom:1px solid #e5e7eb;
    position:sticky;
    top:0;
    z-index:100;
}

.dropdown-toggle::after{
    display:none;
}

.dropdown-menu{
    border-radius:12px;
}

.dropdown-item{
    padding:10px 15px;
}

.dropdown-item:hover{
    background:#f5f7fa;
}

@media(max-width:768px){

    .topbar h5{
        font-size:18px;
    }

}
</style>

<div class="topbar d-flex justify-content-between align-items-center px-3">

    <!-- Mobile Menu -->
    <button class="btn btn-primary d-lg-none" id="openSidebar">
        <i class='bx bx-menu'></i>
    </button>

    <!-- Page Title -->
     <a href="{{ route('dashboard')}}"> <h5 class="m-0 fw-bold">Micro Credit</h5> </a>

    <!-- User Dropdown -->
    <div class="dropdown">

        <a href="#"
           class="d-flex align-items-center text-decoration-none dropdown-toggle"
           data-bs-toggle="dropdown"
           aria-expanded="false">

            <div class="rounded-circle bg-primary text-white d-flex justify-content-center align-items-center"
                 style="width:40px;height:40px;">

                <i class='bx bx-user fs-4'></i>

            </div>

        </a>

        <ul class="dropdown-menu dropdown-menu-end shadow border-0" style="min-width:250px;">

            <li class="text-center p-3 border-bottom">

                <div class="rounded-circle bg-primary text-white d-flex justify-content-center align-items-center mx-auto mb-2"
                     style="width:70px;height:70px;">

                    <i class='bx bx-user fs-1'></i>

                </div>

                <h6 class="mb-0">{{ auth()->user()->name }}</h6>

                <small class="text-muted">{{ auth()->user()->email }}</small>

            </li>

            <li>

                <a class="dropdown-item" href="#">
                    <i class='bx bx-user me-2'></i>
                    My Profile
                </a>

            </li>

            <li>

                <a class="dropdown-item" href="#">
                    <i class='bx bx-lock me-2'></i>
                    Change Password
                </a>

            </li>

            <li><hr class="dropdown-divider"></li>

            <li>

                <a class="dropdown-item text-danger"
                   href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">

                    <i class='bx bx-log-out me-2'></i>
                    Logout

                </a>

                <form id="logout-form"
                      action="{{ route('logout') }}"
                      method="POST"
                      class="d-none">
                    @csrf
                </form>

            </li>

        </ul>

    </div>

</div>