<div
    style="width:100%; background:white; padding:12px 20px; border-bottom:1px solid #ddd; display:flex; 
    justify-content:space-between; align-items:center; height:70px;">

    {{-- Left side: Page title --}}
    <div style="font-size:20px; font-weight:600; color:#333;">
        @yield('page_title', 'Dashboard')
    </div>

    {{-- Right side: User info --}}
    <div style="display:flex; align-items:center; gap:12px;">

        {{-- Name & Role --}}
        <div style="text-align:right;">
            <div style="font-size:16px; font-weight:600; color:#333;">
                {{ auth()->user()->name ?? 'User' }}
            </div>
            <div style="font-size:13px; color:#777;">
                {{ ucfirst(auth()->user()->role ?? 'admin') }}
            </div>
        </div>

        {{-- Profile Image --}}
        <a href="{{ route('profile.show') }}" style="display:inline-block; border-radius:50%; transition:all .25s ease;">
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
