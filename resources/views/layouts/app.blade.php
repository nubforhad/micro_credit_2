<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Micro Credit ERP</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>

<body>

<div class="wrapper">

    @include('partials.sidebar')

    <div class="main">

        @include('partials.header')

        <div class="content">

            @yield('content')

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>

const open=document.getElementById('openSidebar');

const close=document.getElementById('closeSidebar');

const sidebar=document.getElementById('sidebar');

const overlay=document.getElementById('sidebarOverlay');

open.onclick=function(){

sidebar.classList.add('show');

overlay.classList.add('show');

}

close.onclick=function(){

sidebar.classList.remove('show');

overlay.classList.remove('show');

}

overlay.onclick=function(){

sidebar.classList.remove('show');

overlay.classList.remove('show');

}

</script> 

</body>

</html>