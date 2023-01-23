
@php
$prefix = Request::route()->getPrefix();
$route = Route::current()->getName();

$guards = array_keys(config('auth.guards'));
 // dd($guards);
function getGuardName_nav($guards)
{
    foreach ($guards as $guard) {
        if (Auth::guard($guard)->check()) {
            return $guard;
        }
    }
}
$guard = getGuardName_nav($guards);
$user = Auth::guard($guard)->user();

@endphp

@if ($guard == 'employee')
@include('layouts.partials._employee_navbar')
@elseif($guard == 'patient')
@include('layouts.partials._patient_navbar')
@elseif($guard == 'admin')
@include('layouts.partials._admin_navbar')
@else
@include('layouts.partials._developer_navbar')
@endif


  </nav>
