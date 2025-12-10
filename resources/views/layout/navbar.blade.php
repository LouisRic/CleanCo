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
                    <a class="nav-link" href="{{ route('home') }}" style="font-weight: 500;">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('service') }}" style="font-weight: 500;">Our Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact') }}" style="font-weight: 500;">Contact</a>
                </li>
            </ul>

            <div class="d-flex gap-2">
                <button class="btn-secondary">Login</button>
                <button class="btn-primary">Register</button>
            </div>
        </div>
    </div>
</nav>
