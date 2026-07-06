<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Micro Credit 2</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
        }

        .sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            background: #111827;
            color: #fff;
            transition: 0.3s;
        }

        .sidebar a {
            color: #cbd5e1;
            display: block;
            padding: 12px 20px;
            text-decoration: none;
        }

        .sidebar a:hover {
            background: #1f2937;
            color: #fff;
        }

        .main {
            margin-left: 260px;
            padding: 20px;
        }

        .topbar {
            background: #fff;
            padding: 10px 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

@include('partials.sidebar')

<div class="main">

    @include('partials.header')

    <div class="content">
        @yield('content')
    </div>

    @include('partials.footer')

</div>

@include('partials.scripts')

</body>
</html>