<div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
    <div class="brand-logo">
        <a href="/">
            <img src="{{asset('/assets/images/smart-farm.png')}}" class="logo-icon" alt="logo icon">
            <h5 class="logo-text">Greenhouse IoT</h5>
        </a>
    </div>

    <ul class="sidebar-menu">
        <li class="sidebar-header">MAIN NAVIGATION</li>
        <li>
            <a href="{{route("home")}}" class="waves-effect">
                <i class="zmdi zmdi-view-dashboard"></i> <span>Dashboard</span>
            </a>
        </li>
        <li>
            <a href="{{route("greenhouses.index")}}" class="waves-effect">
                <i class="zmdi zmdi-home"></i> <span>Manage Greenhouses</span>
            </a>
        </li>
        <li>
            <a href="{{route("user-management.index")}}" class="waves-effect">
                <i class="zmdi zmdi-accounts"></i> <span>Users</span>
            </a>
        </li>
        <li>
            <a href="{{route("user.settings")}}" class="waves-effect">
                <i class="zmdi zmdi-settings"></i> <span>Settings</span>
            </a>
        </li>
        <li>
            <a href="{{route("logout")}}" class="waves-effect">
                <i class="zmdi zmdi-sign-in"></i> <span>Logout</span>
            </a>
        </li>
    </ul>

</div>
