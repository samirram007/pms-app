<nav class=" bg-pink  navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start pl-3">
        <a class="navbar-brand brand-logo mr-5" href="{{ route('admin.dashboard') }}"><img
                src="{{ asset('skydash/images/logo.png') }}" class="mr-2" alt="logo" /></a>
        <a class="navbar-brand brand-logo-mini" href="{{ route('admin.dashboard') }}"><img
                src="{{ asset('skydash/images/logo.png') }}" alt="logo" /></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center d-none " type="button" data-toggle="minimize">
            <span class="icon-menu text-light"></span>
        </button>

        <ul class="navbar-nav navbar-nav-right">

            @php
                $prefix = Request::route()->getPrefix();
                $route = Route::current()->getName();

                if (str_contains($prefix, 'admin')) {
                    $guard = 'admin';
                }

                $user = DB::table($guard . 's')
                    ->where('id', Auth::guard($guard)->user()->id)
                    ->first();
            @endphp
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                    {{-- <img src="{{ !empty($user->image) ? url('upload/user_images/' . $user->image) : url('upload/no_image'. (($guard=="recruiter") ? '_provider':'') .'.jpg') }}"
                        alt="profile" /> --}}
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                    {{-- <a class="dropdown-item" href="{{ route('admin.profile') }}">
                        <i class="ti-settings text-primary"></i>
                        Profile
                    </a> --}}
                    <a class="dropdown-item" href="{{ route('admin.logout') }}">
                        <i class="ti-power-off text-primary"></i>
                        Logout
                    </a>
                </div>
            </li>
            {{-- <li class="nav-item nav-settings d-none d-lg-flex">
          <a class="nav-link" href="#">
            <i class="icon-ellipsis"></i>
          </a>
        </li> --}}
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="icon-menu text-light"></span>
        </button>
    </div>
</nav>
