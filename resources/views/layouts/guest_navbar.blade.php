<nav class="navbar navbar-expand-md navbar-dark bd-navbar">
    <div class="container text-light">
        <a class="navbar-brand" href="#"><img src="{{ asset('images/logo.png')}}" alt="logo" style="width:5rem; "></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class=" navbar-collapse justify-content-end-lg " id="main_nav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item active"> <a class="nav-link  " href="#">Home </a> </li>
                <li class="nav-item"><a class="nav-link" href="#"> About </a></li>
                <li class="nav-item dropdown" id="myDropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"> Login</a>
                    <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end">
                        {{-- <li> <a class="dropdown-item" href="{{ route('patient.login') }}"> Patient Login </a></li>
                        <li> <a class="dropdown-item" href="{{ route('doctor.login') }}"> Doctor Login </a></li> --}}
                        <li> <a class="dropdown-item" href="{{ route('admin.login') }}"> Admin Login </a></li>
                        <li> <a class="dropdown-item" href="{{ route('employee.login') }}"> Employee Login </a></li>
                        <li> <a class="dropdown-item" href="{{ route('patient.login') }}"> Patient Login </a></li>
                        {{-- <li> <a class="dropdown-item" href="{{ route('refferer.login') }}"> Refferer Login </a>
                        </li>
                        <li> <a class="dropdown-item" href="{{ route('collectioncentre.login') }}"> Collection-Centre
                                Login </a></li>
                        <li> <a class="dropdown-item" href="{{ route('opd.login') }}"> OPD Login </a></li> --}}


                    </ul>
                </li>
            </ul>
        </div>
        <!-- navbar-collapse.// -->
    </div>
    <!-- container-fluid.// -->
</nav>
