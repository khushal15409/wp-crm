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
            <li class="menu-header">Main</li>
            <li class="dropdown {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}" class="nav-link"><i
                        data-feather="monitor"></i><span>Dashboard</span></a>
            </li>

            @if($isSuperAdmin)
                <li class="menu-header">Admin</li>
                <li class="dropdown {{ request()->routeIs('organizations.*') ? 'active' : '' }}">
                    <a href="{{ route('organizations.index') }}" class="nav-link"><i
                            data-feather="briefcase"></i><span>Organizations</span></a>
                </li>
                <li class="dropdown {{ request()->routeIs('plans.*') ? 'active' : '' }}">
                    <a href="{{ route('plans.index') }}" class="nav-link"><i data-feather="package"></i><span>Plan
                            Management</span></a>
                </li>
                <li class="dropdown {{ request()->routeIs('subscriptions.*') ? 'active' : '' }}">
                    <a href="{{ route('subscriptions.index') }}" class="nav-link"><i
                            data-feather="credit-card"></i><span>Subscriptions</span></a>
                </li>
            @endif

            <li class="menu-header">CRM</li>
            <li class="dropdown {{ request()->routeIs('leads.*') ? 'active' : '' }}">
                <a href="{{ route('leads.index') }}" class="nav-link"><i data-feather="users"></i><span>Leads</span></a>
            </li>
            <!-- @if($isSuperAdmin)
                <li class="dropdown"><a href="{{ route('leads.create') }}" class="nav-link"><i
                            data-feather="user-plus"></i><span>Add Lead</span></a></li>
            @endif -->
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

            @if($isOrganization)
                <li class="dropdown {{ request()->routeIs('whatsapp-status.*') ? 'active' : '' }}">
                    <a href="{{ route('whatsapp-status.index') }}" class="nav-link"><i
                            data-feather="message-circle"></i><span>WhatsApp Status</span></a>
                </li>
            @endif

            @if(!$isSuperAdmin)
                <li class="dropdown {{ request()->routeIs('subscriptions.*') ? 'active' : '' }}">
                    <a href="{{ route('subscriptions.index') }}" class="nav-link"><i
                            data-feather="credit-card"></i><span>Subscription</span></a>
                </li>
            @endif

            @if($isSuperAdmin)
                <li class="menu-header">System</li>
                <li class="dropdown {{ request()->routeIs('settings.*') ? 'active' : '' }}">
                    <a href="{{ route('settings.index') }}" class="nav-link"><i data-feather="settings"></i><span>System
                            Settings</span></a>
                </li>
                <li class="dropdown {{ request()->routeIs('users.*') ? 'active' : '' }}">
                    <a href="{{ route('users.index') }}" class="nav-link"><i data-feather="users"></i><span>Users</span></a>
                </li>
                <li class="dropdown {{ request()->routeIs('roles.*') ? 'active' : '' }}">
                    <a href="{{ route('roles.index') }}" class="nav-link"><i
                            data-feather="shield"></i><span>Roles</span></a>
                </li>
                <li class="dropdown {{ request()->routeIs('permissions.*') ? 'active' : '' }}">
                    <a href="{{ route('permissions.index') }}" class="nav-link"><i
                            data-feather="lock"></i><span>Permissions</span></a>
                </li>
            @endif
        </ul>
    </aside>
</div>