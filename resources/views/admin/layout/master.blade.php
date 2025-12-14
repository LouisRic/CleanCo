<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @include('admin.layout.bootstrap')

    <!-- Style buat Side Bar -->
    <style>
        .sidebar-logo {
            width: 100px;
            height: auto;
            margin-bottom: 6px;
            opacity: 0.95;
        }

        .sidebar {
            width: 240px;
            min-height: 100vh;
            background: #2d76c2;
            color: #fff;
            padding-top: 20px;
        }

        .sidebar-link {
            display: block;
            padding: 12px 18px;
            text-decoration: none;
            font-weight: 500;
            border-radius: 0;
            background: #1e63a1;
            color: #ffffff;
        }

        .sidebar-link:hover {
            background: #145089;
        }

        .sidebar-link.active {
            background: #ffffff;
            color: #1e63a1;
        }

        /* kalau active, hover tidak ubah warna */
        .sidebar-link.active:hover {
            background: #ffffff;
            color: #1e63a1;
        }

        .sidebar-logout {
            display: block;
            padding: 12px 18px;
            text-decoration: none;
            font-weight: 500;
            border-radius: 0;
            background: #ff5858;
            color: #ffffff;
            margin-top: 20px;
        }

        .sidebar-logout:hover {
            background: #d94b4b;
        }
    </style>
    <script src="{{ asset('js/profile.js') }}"></script>

</head>

<body>

    <div style="display: flex;">

        <!-- Side Bar -->
        @if (!isset($noSidebar) || !$noSidebar)
            @include('admin.layout.sidebar')
        @endif
        @include('admin.layout.sidebar')

        <div style="flex-grow: 1;">

            <!-- Header -->
            @include('admin.layout.header')

            <div style="padding: 20px;">
                @yield('content')
            </div>

        </div>
        @include('admin.layout.scripts')
        @yield('scripts')

    </div>

</body>

</html>
