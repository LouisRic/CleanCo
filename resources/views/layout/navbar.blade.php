<nav class="navbar navbar-expand-lg navbar-custom">

    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
            <img src="{{ asset('images/Logo.svg') }}" alt="CleanCo Logo" class="logo-img">
            CleanCo
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto gap-4">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}" style="font-weight: 500;">
                        {{ __('navbar.home') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('service') }}" style="font-weight: 500;">
                        {{ __('navbar.services') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact') }}" style="font-weight: 500;">
                        {{ __('navbar.contact') }}
                    </a>
                </li>
            </ul>

            <div class="d-flex gap-2 align-items-center">
                <div class="dropdown">
                    <button class="btn dropdown-toggle border-0 bg-transparent" type="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{ strtoupper(app()->getLocale()) }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item {{ app()->getLocale() == 'en' ? 'active' : '' }}"
                                href="{{ route('change.lang', 'en') }}">
                                English (EN)
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ app()->getLocale() == 'id' ? 'active' : '' }}"
                                href="{{ route('change.lang', 'id') }}">
                                Indonesia (ID)
                            </a>
                        </li>
                    </ul>
                </div>

                @guest
                <a href="{{ route('login') }}">
                    <button class="btn-secondary">
                        {{ __('navbar.login') }}
                    </button>
                </a>

                <a href="{{ route('register') }}">
                    <button class="btn-primary">
                        {{ __('navbar.register') }}
                    </button>
                </a>
                @endguest

                @auth
                @if (Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}">
                    <button class="btn-primary">
                        {{ __('navbar.admin_dashboard') }}
                    </button>
                </a>
                @else
                <a href="{{ route('customer.dashboard') }}">
                    <button class="btn-primary">
                        {{ __('navbar.my_dashboard') }}
                    </button>
                </a>
                @endif

                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button class="btn-secondary">
                        {{ __('navbar.logout') }}
                    </button>
                </form>
                @endauth

            </div>

        </div>
    </div>
</nav>