@php
$prefix = Request::route()->getPrefix();
$route = Route::current()->getName();

if (str_contains($prefix, 'patient')) {
    $guard = 'patient';
}
$user = DB::table($guard . 's')
    ->where('id', Auth::guard($guard)->user()->id)
    ->first();
@endphp

<nav class="sidebar sidebar-offcanvas" id="sidebar">

    <ul class="nav">

        <li class="nav-item {{ $route == 'patient.dashboard' ? 'active' : '' }} ">
            <a class="nav-link" href="{{ route('patient.dashboard') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard </span>
            </a>
        </li>
        <li class="border-top my-3"></li>
        <li  class="nav-item {{ $route === 'patient.sales_order.create'   ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('patient.sales_order.create') }}">
                <i class="mdi mdi-test-tube menu-icon"></i>
                <span class="menu-title">Quick Booking</span>
            </a>
        </li>
        <li  class="nav-item {{ $route === 'patient.sales_invoice.index'  ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('patient.sales_invoice.index') }}">
                <i class="mdi mdi-test-tube menu-icon"></i>
                <span class="menu-title">Booking</span>
            </a>
        </li>
        <li  class="nav-item {{ $route === 'patient.test_queue.index'  ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('patient.test_queue.index') }}">
                <i class="mdi mdi-test-tube menu-icon"></i>
                <span class="menu-title">Test Queue</span>
            </a>
        </li>



        <li class="border-top my-3"></li>


        <li class="nav-item {{ $route == 'patient.patient.index' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('patient.patient.index') }}">
                <i class="mdi mdi-package menu-icon"></i>
                <span class="menu-title">Patient</span>
            </a>
        </li>




        <li class="nav-item {{ strcmp($route , 'patient.associate.index')==0 ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('patient.associate.index') }}">
                <i class="mdi mdi-package menu-icon"></i>
                <span class="menu-title">Associate</span>
            </a>
        </li>
        <li class="nav-item {{ $route == 'patient.referral_doctor.index' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('patient.referral_doctor.index') }}">
                <i class="mdi mdi-package menu-icon"></i>
                <span class="menu-title">Referral Doctor</span>
            </a>
        </li>
        <li class="border-top my-3"></li>
        <li class="nav-item"> <a class="nav-link" href="{{ route('patient.report.collection')}}">
            <i class="mdi mdi-package menu-icon"></i>
            <span class="menu-title">Collection Report</span>
            </a></li>

        <li class="border-top my-3"></li>
        <li class="nav-item {{ $route == 'patient.password.reset' ? 'active' : '' }}">
             <a class="nav-link" href="{{ route('patient.password.reset', Session::has('token') ? Session::get('token'):'' ) }}">
            <i class="mdi mdi-package menu-icon"></i>
            <span class="menu-title">Change Password</span>
            </a></li>
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
</nav>
