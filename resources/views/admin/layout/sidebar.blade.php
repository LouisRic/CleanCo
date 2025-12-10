<div class="sidebar">

    {{-- Logo --}}
    <div style="text-align:center;margin-bottom:24px;">
        <h3 style="margin:0;font-size:22px;font-weight:bold;">CleanCo</h3>
    </div>

    <div class="menu" style="display:flex;flex-direction:column;">

        {{-- Dashboard --}}
        <a href="{{ url('/admin/dashboard') }}"
           class="sidebar-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
            📊 Dashboard
        </a>

        {{-- Customer Data --}}
        <a href="{{ url('/admin/customers') }}"
           class="sidebar-link {{ request()->is('admin/customers*') ? 'active' : '' }}">
            👥 Customer Data
        </a>

        {{-- Services --}}
        <a href="{{ route('services.index') }}"
           class="sidebar-link {{ request()->is('admin/services*') ? 'active' : '' }}">
            🧺 Services
        </a>

        {{-- Transactions --}}
        <a href="{{ route('transactions.index') }}"
           class="sidebar-link {{ request()->is('admin/transactions*') ? 'active' : '' }}">
            🛒 Transactions
        </a>

        {{-- Reports --}}
        <a href="{{ route('reports.index') }}"
           class="sidebar-link {{ request()->is('admin/reports*') ? 'active' : '' }}">
            📄 Reports
        </a>

        {{-- Logout --}}
        <a href="{{ url('/logout') }}" class="sidebar-logout">
            🚪 Logout
        </a>

    </div>
</div>
