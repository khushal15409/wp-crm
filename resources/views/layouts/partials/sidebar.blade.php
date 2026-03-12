@php
    $user = auth()->user();
    $isSuperAdmin = $user && $user->hasRole('super_admin');
    $isOrganization = $user && $user->hasRole('organization');
@endphp
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand" style="height: 80px; line-height: 80px;">
            <a href="{{ route('dashboard') }}">
                <img alt="{{ config('app.name', 'WP-CRM') }}" src="{{ asset('front/images/logo.png') }}"
                    style="height: 80px; max-width: 100%; object-fit: contain;" />
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">CRM</li>
            <li class="dropdown {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}" class="nav-link"><i
                        data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown {{ request()->routeIs('leads.*') ? 'active' : '' }}">
                <a href="{{ route('leads.index') }}" class="nav-link"><i data-feather="users"></i><span>Leads</span></a>
            </li>
            <li class="dropdown {{ request()->routeIs('pipeline.*') ? 'active' : '' }}">
                <a href="{{ route('pipeline.index') }}" class="nav-link"><i
                        data-feather="trending-up"></i><span>Pipeline</span></a>
            </li>
            <li class="dropdown {{ request()->routeIs('follow-ups.*') ? 'active' : '' }}">
                <a href="{{ route('follow-ups.index') }}" class="nav-link"><i
                        data-feather="clock"></i><span>Follow-ups</span></a>
            </li>
            <li class="dropdown {{ request()->routeIs('broadcasts.*') ? 'active' : '' }}">
                <a href="{{ route('broadcasts.index') }}" class="nav-link"><i
                        data-feather="send"></i><span>Broadcasts</span></a>
            </li>
            <li class="dropdown {{ request()->routeIs('leads.*') ? 'active' : '' }}">
                <a href="{{ route('leads.index') }}" class="nav-link"><i data-feather="book"></i><span>Contacts</span></a>
            </li>

            <li class="menu-header">Billing</li>
            <li class="dropdown {{ request()->routeIs('subscriptions.*') ? 'active' : '' }}">
                <a href="{{ route('subscriptions.index') }}" class="nav-link"><i
                        data-feather="credit-card"></i><span>Billing</span></a>
            </li>

            <li class="menu-header">Settings</li>
            <li class="dropdown {{ request()->routeIs('settings.*') ? 'active' : '' }}">
                <a href="{{ $isSuperAdmin ? route('settings.index') : route('profile.edit') }}" class="nav-link"><i
                        data-feather="settings"></i><span>Settings</span></a>
            </li>
        </ul>
    </aside>
</div>
