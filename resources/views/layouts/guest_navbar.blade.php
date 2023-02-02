<nav class="navbar welcome-nav navbar-expand-lg sticky-top">
    <div class="container-fluid px-5">
        <a class="navbar-brand fw-bold" href="#">
            <img src="{{asset('images/logo.png')}}" alt="" srcset="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto text-center">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#home">{{__('Home')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#home">{{__('About-Us')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#contact">{{__('Contact')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#contact">{{__('Services')}}</a>
                </li>
                <li class="nav-item">
                    <button class="btn log-in bg-white w-100">LogIn</button>
                </li>
            </ul>

        </div>
    </div>
</nav>