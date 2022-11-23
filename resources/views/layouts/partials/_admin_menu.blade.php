<ul class="nav">
    <li class="nav-item {{ $route == 'admin.dashboard' ? 'active' : '' }} ">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">Dashboard </span>
        </a>
    </li>
    <li class="border-top my-3"></li>
    <li
        class="nav-item {{ $route === 'admin.test.index' && strlen($route) == strlen('admin.test.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.test.index') }}">
            <i class="mdi mdi-test-tube menu-icon"></i>
            <span class="menu-title">Test</span>
        </a>
    </li>

    <li class="nav-item {{ $route == 'admin.package.index' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.package.index') }}">
            <i class="mdi mdi-package menu-icon"></i>
            <span class="menu-title">Packages</span>
        </a>
    </li>
    <li class="nav-item
    @if ($route == 'admin.test_group.index') {{ 'active' }} @endif ">

        <a class="nav-link" href="{{ route('admin.test_group.index') }}">
            <i class="mdi mdi-package menu-icon"></i>
            <span class="menu-title">Test Group </span>
        </a>
    </li>
    <li
        class="nav-item {{ $route === 'admin.test_category.index' && strlen($route) == strlen('admin.test_category.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.test_category.index') }}">
            <i class="mdi mdi-package menu-icon"></i>
            <span class="menu-title">Test Category</span>
        </a>
    </li>
    <li
        class="nav-item {{ $route === 'admin.test_unit.index' && strrev($route) == strrev('admin.test_unit.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.test_unit.index') }}">
            <i class="mdi mdi-package menu-icon"></i>
            <span class="menu-title">Test Unit</span>
        </a>
    </li>
    <li class="border-top my-3"></li>
    <li class="nav-item {{ $route == 'admin.lab_centre.index' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.lab_centre.index') }}">
            <i class="mdi mdi-package menu-icon"></i>
            <span class="menu-title">Lab Centre</span>
        </a>
    </li>
    <li class="nav-item {{ $route == 'admin.collection_centre.index' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.collection_centre.index') }}">
            <i class="mdi mdi-package menu-icon"></i>
            <span class="menu-title">Collection Centre</span>
        </a>
    </li>
    <li class="nav-item {{ $route == 'admin.employee.index' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.employee.index') }}">
            <i class="mdi mdi-package menu-icon"></i>
            <span class="menu-title">Employee</span>
        </a>
    </li>
    <li class="nav-item {{ $route == 'admin.doctor.index' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.doctor.index') }}">
            <i class="mdi mdi-package menu-icon"></i>
            <span class="menu-title">Doctor</span>
        </a>
    </li>
    <li class="nav-item {{ $route == 'admin.patient.index' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.patient.index') }}">
            <i class="mdi mdi-package menu-icon"></i>
            <span class="menu-title">Patient</span>
        </a>
    </li>
    <li class="nav-item {{ $route == 'admin.associate.index' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.associate.index') }}">
            <i class="mdi mdi-package menu-icon"></i>
            <span class="menu-title">Associate</span>
        </a>
    </li>
    <li class="nav-item {{ $route == 'admin.designation.index' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.designation.index') }}">
            <i class="mdi mdi-package menu-icon"></i>
            <span class="menu-title">Designation</span>
        </a>
    </li>
    <li class="nav-item {{ $route == 'admin.department.index' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.department.index') }}">
            <i class="mdi mdi-package menu-icon"></i>
            <span class="menu-title">Department</span>
        </a>
    </li>
    <li class="border-top my-3"></li>
    <li class="nav-item"> <a class="nav-link" href="{{ route('admin.report.collection') }}">Collection Report</a>
    </li>
    {{-- <li class="nav-item">
    <a class="nav-link collapsed " data-bs-toggle="collapse" href="#ui-report" aria-expanded="false" aria-controls="ui-report">
        <i class="icon-layout menu-icon"></i>
        <span class="menu-title">Report</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse " id="ui-report" style="">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="pages/ui-features/accordions.html">Accordions</a></li>
          <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Buttons</a></li>
          <li class="nav-item"> <a class="nav-link" href="pages/ui-features/badges.html">Badges</a></li>
          <li class="nav-item"> <a class="nav-link" href="pages/ui-features/breadcrumbs.html">Breadcrumbs</a></li>
          <li class="nav-item"> <a class="nav-link" href="pages/ui-features/dropdowns.html">Dropdowns</a></li>
          <li class="nav-item"> <a class="nav-link" href="pages/ui-features/modals.html">Modals</a></li>
          <li class="nav-item"> <a class="nav-link" href="pages/ui-features/progress.html">Progress bar</a></li>
          <li class="nav-item"> <a class="nav-link" href="pages/ui-features/pagination.html">Pagination</a></li>
          <li class="nav-item"> <a class="nav-link" href="pages/ui-features/tabs.html">Tabs</a></li>
          <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Typography</a></li>
          <li class="nav-item"> <a class="nav-link" href="pages/ui-features/tooltips.html">Tooltips</a></li>
        </ul>
      </div>
   </li> --}}
    <li class="border-top my-3"></li>
    <li class="nav-item {{ $route == 'admin.discount_type.index' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.discount_type.index') }}">
            <i class="mdi mdi-account-circle menu-icon"></i>
            <span class="menu-title">Discount</span>
        </a>
    </li>
    <li class="nav-item {{ $route == 'admin.payment_mode.index' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.payment_mode.index') }}">
            <i class="mdi mdi-account-circle menu-icon"></i>
            <span class="menu-title">Payment Mode</span>
        </a>
    </li>
    <li class="border-top my-3"></li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.logout') }}">
            <i class="ti-power-off menu-icon"></i>

            <span class="menu-title">{{ __('Log Out') }}</span>
        </a>
        {{-- onclick="event.preventDefault(); this.closest('form').submit();">
        <form class="p-0 text-left" method="POST" action="{{ route('admin.logout') }}">
            @csrf
              </form> --}}


    </li>
</ul>
