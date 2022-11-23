<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">


    <li class="nav-item {{ $route == 'employee.dashboard' ? 'active' : '' }} ">
        <a class="nav-link" href="{{ route('employee.dashboard') }}">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">Dashboard </span>
        </a>
    </li>
    <li class="border-top my-3"></li>
</ul>
