<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <!-- Projects Route -->
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('project') ? 'active' : '' }}" href="{{ route('project') }}">
                <i class="mdi mdi-access-point menu-icon"></i> <!-- MDI icon for Projects -->
                <span class="menu-title">Projects</span>
            </a>
        </li>

        <!-- Roles Route -->
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('role', 'role.create', 'role.store', 'role.edit', 'role.update') ? 'active' : '' }}" href="{{ route('role') }}">
                <i class="mdi mdi-account-group menu-icon"></i>
                <span class="menu-title">Roles</span>
            </a>
        </li>
        

        <!-- Permissions Route -->
        <li class="nav-item">
            <a class="nav-link" href="">
                <i class="mdi mdi-lock menu-icon"></i> <!-- MDI icon for Permissions -->
                <span class="menu-title">Permissions</span>
            </a>
        </li>

        <!-- Role Permission Route -->
        <li class="nav-item">
            <a class="nav-link" href="">
                <i class="mdi mdi-key menu-icon"></i> <!-- MDI icon for Role Permission -->
                <span class="menu-title">Role Permission</span>
            </a>
        </li>

        <!-- User Permission Route -->
        <li class="nav-item">
            <a class="nav-link" href="">
                <i class="mdi mdi-account-key menu-icon"></i> <!-- MDI icon for User Permission -->
                <span class="menu-title">User Permission</span>
            </a>
        </li>

        <!-- Users Route -->
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('user', 'user.create', 'user.store', 'user.edit', 'user.update','user.view') ? 'active' : '' }}" href="{{route('user')}}">
                <i class="mdi mdi-account menu-icon"></i>
                <span class="menu-title">Users</span>
            </a>
        </li>

        <!-- Notifications Route -->
        <li class="nav-item">
            <a class="nav-link" href="">
                <i class="mdi mdi-bell menu-icon"></i> <!-- MDI icon for Notifications -->
                <span class="menu-title">Notifications</span>
            </a>
        </li>

        <!-- Reminders Route -->
        <li class="nav-item">
            <a class="nav-link" href="">
                <i class="mdi mdi-alarm menu-icon"></i> <!-- MDI icon for Reminders -->
                <span class="menu-title">Reminders</span>
            </a>
        </li>

        <!-- Shift Time Route -->
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('shift', 'shift.create', 'shift.store', 'shift.edit', 'shift.update') ? 'active' : '' }}" href="{{route('shift')}}">
                <i class="mdi mdi-clock menu-icon"></i> <!-- MDI icon for Shift Time -->
                <span class="menu-title">Shift Time</span>
            </a>
        </li>

        <!-- Attendances Route -->
        <li class="nav-item">
            <a class="nav-link" href="">
                <i class="mdi mdi-checkbox-marked-circle menu-icon"></i> <!-- MDI icon for Attendances -->
                <span class="menu-title">Attendances</span>
            </a>
        </li>
    </ul>
</nav>
