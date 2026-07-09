<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Micro Credit ERP</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

<style>
    body{

margin:0;

background:#f5f7fb;

font-family:sans-serif;

}

.wrapper{

display:flex;

}

.sidebar{

width:260px;

background:#0d6efd;

min-height:100vh;

position:fixed;

left:0;

top:0;

overflow-y:auto;

transition:.3s;

z-index:999;

}

.sidebar-header{

display:flex;

justify-content:space-between;

align-items:center;

padding:20px;

color:white;

border-bottom:1px solid rgba(255,255,255,.2);

}

.sidebar a{

display:block;

padding:14px 20px;

color:white;

text-decoration:none;

}

.sidebar a:hover{

background:#084298;

}

.main{

margin-left:260px;

width:100%;

}

.topbar{

height:70px;

background:white;

display:flex;

justify-content:space-between;

align-items:center;

padding:0 20px;

box-shadow:0 2px 5px rgba(0,0,0,.1);

}

.content{

padding:20px;

}

.card{

border:none;

border-radius:12px;

box-shadow:0 5px 15px rgba(0,0,0,.08);

}

.sidebar-overlay{

display:none;

position:fixed;

left:0;

top:0;

width:100%;

height:100%;

background:rgba(0,0,0,.5);

z-index:998;

}

@media(max-width:992px){

.sidebar{

left:-260px;

}

.sidebar.show{

left:0;

}

.main{

margin-left:0;

}

.sidebar-overlay.show{

display:block;

}

.topbar{

padding:10px;

}

.content{

padding:15px;

}

}
</style>


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