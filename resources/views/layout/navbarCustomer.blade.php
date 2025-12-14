<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container-fluid">
        <!-- Logo Section -->
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
            <img src="{{ asset('images/Logo.svg') }}" alt="CleanCo Logo" class="logo-img">
            CleanCo
        </a>

        <!-- Toggler for mobile view -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="d-flex ms-auto align-items-center gap-3">
                <div>
                    <i class="bi bi-bell bell-icon" role="button" aria-label="Notifications"></i>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <img src="{{ asset('images/profile-image.jpg') }}" alt="Profile" class="profile-image">
                    <span class="profile-name">{{ Auth::user()->name }}</span>
                </div>
            </div>
        </div>
    </div>
</nav>
