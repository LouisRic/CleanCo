<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container-fluid">
        <!-- Logo Section -->
        <!-- Logo Section -->
        <a href="{{ route('home') }}" class="d-flex align-items-center gap-2" style="text-decoration:none;">
            <img src="{{ asset('images/Logo.svg') }}" alt="CleanCo Logo" class="logo-img" style="height:40px;">
            <span style="font-weight:600; font-size:20px; color:#333;">CleanCo</span>
        </a>

        <!-- Toggler for mobile view -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="d-flex ms-auto align-items-center gap-3">
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('profile.show') }}" class="{{ request()->is('profile*') ? 'active' : '' }}"
                        style="display:inline-flex; align-items:center; gap:8px; border-radius:50%; transition:all .25s ease; text-decoration:none;">

                        <span class="profile-name" style="text-decoration:none; color:#333;">
                            {{ Auth::user()->name }}
                        </span>
                        <img src="{{ auth()->user()->photo ? asset('storage/' . auth()->user()->photo) : asset('images/default-avatar.png') }}"
                            alt="profile"
                            style="
                 width:48px;
                 height:48px;
                 border-radius:50%;
                 object-fit:cover;
                 cursor:pointer;
                 transition:all .25s ease;
             "
                            onmouseover="this.style.transform='scale(1.08)'; this.style.boxShadow='0 0 0 3px rgba(78,143,199,.6)'"
                            onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none'">
                    </a>

                </div>
            </div>
        </div>
    </div>
</nav>
