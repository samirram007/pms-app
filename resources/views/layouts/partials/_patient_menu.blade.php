<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">


    {{-- <li class="nav-item {{ $route == 'patient.dashboard' ? 'active' : '' }} ">
        <a class="nav-link" href="{{ route('patient.dashboard') }}">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">Dashboard </span>
        </a>
    </li>
    <li class="border-top my-3"></li> --}}

    <li class="nav-item {{ $route === 'patient.sales_invoice.index' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('patient.sales_invoice.index') }}">
            <i class="mdi mdi-test-tube menu-icon"></i>
            <span class="menu-title">Booking</span>
        </a>
    </li>



    <li class="border-top my-3"></li>
    <li class="nav-item {{ $route == 'patient.password.reset' ? 'active' : '' }}">
        <a class="nav-link"
            href="{{ route('patient.password.reset', Session::has('token') ? Session::get('token') : '') }}">
            <i class="mdi mdi-package menu-icon"></i>
            <span class="menu-title">Change Password</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('patient.logout') }}">
            <i class="ti-power-off menu-icon"></i>

            <span class="menu-title">{{ __('Log Out') }}</span>
        </a>
        {{-- onclick="event.preventDefault(); this.closest('form').submit();">
            <form class="p-0 text-left" method="POST" action="{{ route('admin.logout') }}">
                @csrf
                  </form> --}}


    </li>
</ul>
