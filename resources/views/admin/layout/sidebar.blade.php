<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- sidebar brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <i class="fas fa-hotel"></i>
        </div>
        <div class="sidebar-brand-text mx-3">e-hotel</div>
    </a>

    <hr class="sidebar-divider my-0">

    <!-- dashboard -->
    <li class="nav-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- authorization -->
    <div class="sidebar-heading">
        Authorization
    </div>
    <!-- auth -->
    <li class="nav-item {{ Request::is('admin/group-user-admin*', 'admin/user-admin*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAuth" aria-expanded="true" aria-controls="collapseAuth">
            <i class="fas fa-fw fa-users-cog"></i>
            <span>Auth</span>
        </a>
        <div id="collapseAuth" class="collapse {{ Request::is('admin/group-user-admin*', 'admin/user-admin*') ? 'show' : '' }}" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ Request::is('admin/group-user-admin*') ? 'active' : '' }}" href="{{ route('admin.group-user-admin') }}"><i class="fas fa-users mr-2"></i>Group User Admin</a>
                <a class="collapse-item {{ Request::is('admin/user-admin*') ? 'active' : '' }}" href="{{ route('admin.user-admin') }}"><i class="fas fa-user mr-2"></i>User Admin</a>
            </div>
        </div>
    </li>
    <!-- setting -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSetting" aria-expanded="true" aria-controls="collapseSetting">
            <i class="fas fa-fw fa-cog"></i>
            <span>Setting</span>
        </a>
        <div id="collapseSetting" class="collapse" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="#"><i class="fas fa-cogs mr-2"></i>Authorization Setting</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Addons
    </div>

    <!-- divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <!-- sidebar toggler -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
