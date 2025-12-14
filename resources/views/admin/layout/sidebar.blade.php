<div class="sidebar">

    {{-- Logo --}}
    <div style="text-align:center;margin-bottom:24px;">
        <h3 style="margin:0;font-size:22px;font-weight:bold;">CleanCo</h3>
    </div>

    <div class="menu" style="display:flex;flex-direction:column;">

        {{-- Dashboard --}}
        <a href="{{ url('/admin/dashboard') }}"
            class="sidebar-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
            📊 {{ __('admin.dashboard') }}
        </a>

        {{-- Customer Data --}}
        <a href="{{ route('customers.index') }}"
            class="sidebar-link {{ request()->is('admin/customers*') ? 'active' : '' }}">
            👥 {{ __('admin.customers') }}
        </a>

        {{-- Services --}}
        <a href="{{ route('services.index') }}"
            class="sidebar-link {{ request()->is('admin/services*') ? 'active' : '' }}">
            🧺 {{ __('admin.services') }}
        </a>

        {{-- Transactions --}}
        <a href="{{ route('transactions.index') }}"
            class="sidebar-link {{ request()->is('admin/transactions*') ? 'active' : '' }}">
            🛒 {{ __('admin.transactions') }}
        </a>

        {{-- Reports --}}
        <a href="{{ route('reports.index') }}"
            class="sidebar-link {{ request()->is('admin/reports*') ? 'active' : '' }}">
            📄 {{ __('admin.reports') }}
        </a>

        {{-- Logout --}}
        <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
            class="sidebar-logout">
            🚪 {{ __('admin.logout') }}
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>

    </div>
</div>
