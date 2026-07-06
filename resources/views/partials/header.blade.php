<div class="topbar d-flex justify-content-between align-items-center">

    <h5 class="m-0">Dashboard</h5>

    <div>
        <span class="me-3">{{ auth()->user()->name }}</span>

        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>

</div>