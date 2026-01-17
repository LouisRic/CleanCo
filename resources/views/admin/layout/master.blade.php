<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    @include('admin.layout.bootstrap')

    <style>
        html,body{
            height: 100%;
            overflow: hidden;
        }

        .layout-wrapper{
            display: flex;
            min-height: 100vh;
        }

        .sidebar-wrapper{
            height: 100vh;
        }

        .main-wrapper{
            flex-grow: 1;
            width: 100%;
            overflow-y: auto;
        }

        .sidebar{
            width: 240px;
            min-height: 100vh;
            background: #2d76c2;
            color: #fff;
            padding-top: 20px;
        }

        .sidebar-wrapper{
            position: fixed;
            top: 0;
            left: 0;
            width: 240px;
            height: 100vh;
            z-index: 1000;
        }

        .main-wrapper{
            margin-left: 240px;
            height: 100vh;
            overflow-y: auto;
        }

        .sidebar-logo{
            width: 100px;
            margin-bottom: 6px;
            opacity: 0.95;
        }

        .sidebar-link{
            display: block;
            padding: 12px 18px;
            text-decoration: none;
            font-weight: 500;
            background: #1e63a1;
            color: #fff;
        }

        .sidebar-link:hover{
            background: #145089;
        }

        .sidebar-link.active{
            background: #fff;
            color: #1e63a1;
        }

        .sidebar-link.active:hover{
            background: #fff;
            color: #1e63a1;
        }

        .sidebar-logout{
            display: block;
            padding: 12px 18px;
            background: #ff5858;
            color: #fff;
            margin-top: 20px;
            text-decoration: none;
        }

        .sidebar-logout:hover{
            background: #d94b4b;
        }

        .mobile-navbar{
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 56px;
            background: #2d76c2;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1100;
        }

        .hamburger-btn{
            position: absolute;
            left: 15px;
            background: transparent;
            border: none;
            font-size: 24px;
            color: #fff;
        }

        .mobile-title{
            font-size: 18px;
            font-weight: 600;
            color: #fff;
        }

        .content-wrapper{
            max-width: 100%;
            overflow-x: hidden;
        }

        .transaction-header{
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
        }

        .transaction-actions{
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .transaction-status{
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .transaction-buttons{
            display: flex;
            gap: 8px;
        }

        @media (max-width: 767.98px){

            html,body{
                overflow: hidden;
            }

            .transaction-header{
                flex-direction: column;
                align-items: stretch;
            }

            .transaction-actions{
                flex-direction: column;
                align-items: stretch;
            }

            .transaction-status{
                justify-content: center;
            }

            .transaction-buttons{
                flex-direction: column;
            }

            .transaction-buttons .btn{
                width: 100%;
            }

            .layout-wrapper{
                display: block;
                height: 100vh;
            }

            .sidebar-wrapper{
                position: fixed;
                top: 56px;
                left: 0;
                width: 240px;
                height: calc(100vh - 56px);
                transform: translateX(-100%);
                transition: transform 0.3s ease;
                z-index: 1050;
                overflow-y: auto;
            }

            .sidebar-wrapper.show{
                transform: translateX(0);
            }

            .main-wrapper{
                margin-left: 0 !important;
                padding-top: 56px;
                height: calc(100vh - 56px);
                overflow-y: auto;
            }

            .content-wrapper{
                padding: 12px !important;
            }

            .mobile-table-wrapper{
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            table{
                font-size: 13px;
                white-space: nowrap;
            }

            th,td{
                padding: 8px 10px;
            }

            h2{
                font-size: 18px;
            }
        }
    </style>

</head>

<body>

    <div class="mobile-navbar d-md-none">
        <button class="hamburger-btn" id="toggleSidebar">☰</button>
        <div class="mobile-title">CleanCo</div>
    </div>

    <div class="layout-wrapper">

        <div class="sidebar-wrapper">
            @if (!isset($noSidebar) || !$noSidebar)
            @include('admin.layout.sidebar')
            @endif
        </div>

        <div class="main-wrapper">
            @include('admin.layout.header')

            <div class="content-wrapper" style="padding:20px;">
                @yield('content')
            </div>

        </div>
    </div>

    @include('admin.layout.scripts')
    @yield('scripts')

    <script>
        const sidebar = document.querySelector('.sidebar-wrapper');
        const toggleBtn = document.getElementById('toggleSidebar');

        if (toggleBtn) {
            toggleBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                sidebar.classList.toggle('show');
            });
        }

        document.addEventListener('click', function(event) {
            if (sidebar && sidebar.classList.contains('show')) {
                if (!sidebar.contains(event.target) && !toggleBtn.contains(event.target)) {
                    sidebar.classList.remove('show');
                }
            }
        });
    </script>

</body>

</html>