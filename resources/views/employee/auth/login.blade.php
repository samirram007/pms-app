{{-- <x-employee-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <h2 class="text-4xl font-bold text-center">Employee Login</h2>
        <form method="POST" action="{{ route('employee.login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('employee.password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('employee.password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ml-3">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-employee-guest-layout> --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/emp-login.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
    <style>
        ::-webkit-input-placeholder {
            color: #808800;
        }

        ::placeholder {
            color: aqua;
        }

        ::-ms-input-placeholder {
            color: red;
        }

        .form-control::placeholder {
            color: #0c003eea;
        }
    </style>

</head>

<body>
    <div class="body-bg">

        <div class="container">

            <div class="row d-flex justify-content-center">
                <div class="col-md-6 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <img src="/images/logo.png" class="emp-logo" alt="">
                            </div>
                            <br>
                            <h2 class="emp-login-head">Employee Login</h2>
                            <form method="POST" action="{{ route('employee.login') }}">

                                @csrf
                                <div class="row">
                                    <div class="form-group">
                                        <input placeholder="Email" type="email" name="email" :value="old('email')"
                                            required autofocus class="form-control bg-transparent">
                                    </div>
                                    <br><br><br>

                                    <div class="form-group">
                                        <input placeholder="Password" type="password" name="password" required
                                            autocomplete="current-password" class="form-control input bg-transparent ">
                                    </div>
                                </div>
                                <br>

                                <div class="text-center mb-5 mt-2">
                                    <button type="submit" class="btn btn-primary text-white w-100">Login</button>
                                </div>
                            </form>
                            {{-- <div class="row">
                                <div class="float-right ">
                                    <a href="">Admin Login</a>
                                </div>
                            </div> --}}
                            <br>
                            <div class="row d-flex text-center">
                                <div class="col-md-4">
                                    <i class="fab fa-facebook fa-3x"></i>
                                </div>
                                <div class="col-md-4">
                                    <i class="fab fa-instagram fa-3x"></i>
                                </div>
                                <div class="col-md-4">
                                    <i class="fab fa-google fa-3x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
