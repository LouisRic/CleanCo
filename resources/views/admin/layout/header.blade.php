<div style="width:100%; background:white; padding:12px 20px; border-bottom:1px solid #ddd; display:flex; 
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
        <img src="https://i.pravatar.cc/50?img=5" 
             alt="profile" 
             style="width:48px; height:48px; border-radius:50%; object-fit:cover; border:2px solid #ccc;">
    </div>

</div>
