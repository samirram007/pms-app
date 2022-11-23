<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">


    <li class="nav-item {{ $route == 'employee.dashboard' ? 'active' : '' }} ">
        <a class="nav-link" href="{{ route('employee.dashboard') }}">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">Dashboard </span>
        </a>
    </li>
    <li class="border-top my-3"></li>
    <li class="nav-item {{ $route === 'employee.sales_order.create' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('employee.sales_order.create') }}">
            <i class="mdi mdi-test-tube menu-icon"></i>
            <span class="menu-title">Quick Booking</span>
        </a>
    </li>
    <li class="nav-item {{ $route === 'employee.sales_invoice.index' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('employee.sales_invoice.index') }}">
            <i class="mdi mdi-test-tube menu-icon"></i>
            <span class="menu-title">Booking</span>
        </a>
    </li>
    <li class="nav-item {{ $route === 'employee.test_queue.index' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('employee.test_queue.index') }}">
            <i class="mdi mdi-test-tube menu-icon"></i>
            <span class="menu-title">Test Queue</span>
        </a>
    </li>


    <li class="border-top my-3"></li>


    <li class="nav-item {{ $route == 'employee.patient.index' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('employee.patient.index') }}">
            <i class="mdi mdi-package menu-icon"></i>
            <span class="menu-title">Patient</span>
        </a>
    </li>




    <li class="nav-item {{ strcmp($route, 'employee.associate.index') == 0 ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('employee.associate.index') }}">
            <i class="mdi mdi-package menu-icon"></i>
            <span class="menu-title">Associate</span>
        </a>
    </li>
    <li class="nav-item {{ $route == 'employee.referral_doctor.index' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('employee.referral_doctor.index') }}">
            <i class="mdi mdi-package menu-icon"></i>
            <span class="menu-title">Referral Doctor</span>
        </a>
    </li>
    <li class="border-top my-3"></li>
    <li class="nav-item"> <a class="nav-link" href="{{ route('employee.report.collection') }}">
            <i class="mdi mdi-package menu-icon"></i>
            <span class="menu-title">Collection Report</span>
        </a></li>

    <li class="border-top my-3"></li>
    <li class="nav-item {{ $route == 'employee.password.reset' ? 'active' : '' }}">
        <a class="nav-link"
            href="{{ route('employee.password.reset', Session::has('token') ? Session::get('token') : '') }}">
            <i class="mdi mdi-package menu-icon"></i>
            <span class="menu-title">Change Password</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('employee.logout') }}">
            <i class="ti-power-off menu-icon"></i>

            <span class="menu-title">{{ __('Log Out') }}</span>
        </a>
        {{-- onclick="event.preventDefault(); this.closest('form').submit();">
            <form class="p-0 text-left" method="POST" action="{{ route('admin.logout') }}">
                @csrf
                  </form> --}}


    </li>
</ul>
