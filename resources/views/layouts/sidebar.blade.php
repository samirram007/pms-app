@php
    $prefix = Request::route()->getPrefix();
    $route = Route::current()->getName();

    $guards = array_keys(config('auth.guards'));
    // dd($guards);
    function getGuardName($guards)
    {
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return $guard;
            }
        }
    }
    $guard = getGuardName($guards);
    $user = Auth::guard($guard)->user();


@endphp


<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('images/logo.png') }}" alt="PMS Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">PMS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            @if ($guard == 'employee')
                @include('layouts.partials._employee_menu')
            @elseif($guard == 'patient')
                @include('layouts.partials._patient_menu')
            @elseif($guard == 'admin')
                @include('layouts.partials._admin_menu')
            @else
                @include('layouts.partials._developer_menu')
            @endif

        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
