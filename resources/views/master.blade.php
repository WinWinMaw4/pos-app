<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @csrf
    <title>@yield('title',env('APP_NAME'))</title>
    <link rel="icon" href="{{asset('images/icon.png')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    @yield('head')
</head>
<body>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>

<nav class="navbar navbar-expand-lg navbar-light bg-white position-fixed top-0 w-100 shadow-sm" style="z-index: 5">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{route('pos.index')}}">
{{--            <img src="{{asset('images/logo.png')}}" height="50" class="logo" alt="">--}}
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                @guest()
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                @endguest

                @auth()
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-primary text-capitalize" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{auth()->user()->name}}
                            <img src="{{asset(auth()->user()->photo)}}" class="user-img rounded-circle border border-2 border-white shadow-sm" alt="">
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Edit Profile</a></li>
                            <li><a class="dropdown-item" href="#">Change Password</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Log Out</a></li>
                        </ul>
                    </li>
                @endauth
            </ul>

        </div>
    </div>
</nav>
<div class="py-4 mb-2"></div>

<div class="container-fluid ">
    <div class="row">
        <div class="col-12 col-md-3 col-lg-2 vh-100 bg-white shadow px-0 side-nav d-none d-md-block">
            <div class="list-group px-0  bg-warning">
                <a href="{{route('pos.index')}}" class="list-group-item list-group-item-action py-3">POS System</a>
                <a href="{{route('category.index')}}" class="list-group-item list-group-item-action py-3 d-flex justify-content-between align-items-start">
                    <div class="me-auto">
                        <div class="fw-bold">
                            <i class="fas fa-layer-group"></i>
                            Category
                        </div>
                    </div>
                    <span class="badge bg-primary rounded-pill">14</span>
                </a>
                <a href="{{route('item.index')}}" class="list-group-item list-group-item-action py-3 d-flex justify-content-between align-items-start">
                    <div class="me-auto">
                        <div class="fw-bold">
                            <i class="fa-solid fa-dice-d6"></i>
                            Items
                        </div>
                    </div>
                    <span class="badge bg-primary rounded-pill">14</span>
                </a>
                <a href="{{route('toDayInCome')}}" class="list-group-item list-group-item-action py-3 d-flex justify-content-between align-items-start">
                    <div class="me-auto">
                        <div class="fw-bold">
                            <i class="fa-solid fa-dollar "></i>
                            Incomes
                        </div>
                    </div>
{{--                    <span class="badge bg-primary rounded-pill">14</span>--}}
                </a>
                <a href="{{route('dashboardView')}}" class="list-group-item list-group-item-action py-3 d-flex justify-content-between align-items-start">
                    <div class="me-auto">
                        <div class="fw-bold">
                            <i class="fa-solid fa-grip "></i>
                            Dashboard
                        </div>
                    </div>
                    <span class="badge bg-primary rounded-pill">14</span>
                </a>
            </div>
        </div>

            @yield('content')
    </div>
</div>



{{--footer--}}
{{--<div class="py-3 px-2 bg-primary text-white " style="position: absolute;bottom: 0;width: 100%">--}}
{{--    <div class="container d-flex flex-column flex-md-row justify-content-center justify-content-md-between align-items-center ">--}}
{{--        <a class="navbar-brand" href="#">--}}
{{--            <img src="{{asset('images/logo.png')}}" height="50" class="logo" alt="">--}}
{{--        </a>--}}
{{--        <div class="social-icon my-4 my-md-0">--}}
{{--            <a href="#"  class=" text-decoration-none p-1 p-lg-2 rounded-circle text-center me-1" title="facebook">--}}
{{--                <i class="fab fa-facebook-f fa-fw fa-2x "></i>--}}
{{--            </a>--}}
{{--            <a href="#" class=" text-decoration-none p-1 p-lg-2 rounded-circle text-center me-1" title="github">--}}
{{--                <i class="fab fa-github fa-fw fa-2x "></i>--}}
{{--            </a>--}}
{{--            <a href="#" class=" text-decoration-none p-1 p-lg-2 rounded-circle text-center me-1" title="instagram">--}}
{{--                <i class="fab fa-instagram fa-fw fa-2x "></i>--}}
{{--            </a>--}}
{{--            <a href="#" class=" text-decoration-none p-1 p-lg-2 rounded-circle text-center me-1" title="codepen io">--}}
{{--                <i class="fab fa-codepen fa-fw fa-2x "></i>--}}
{{--            </a>--}}
{{--        </div>--}}

{{--        <span class="fw-lighter">--}}
{{--            &copy;{{ date('Y') }} WinWinMaw. All Rights Reversed.--}}
{{--       </span>--}}
{{--    </div>--}}
{{--</div>--}}

<script src="{{asset('js/app.js')}}"></script>
@stack('scripts')

@if(session('status'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            showCloseButton:true,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        Toast.fire({
            icon: 'success',
            title: '{{ session('status') }}'
        })
    </script>
@endif



</body>
</html>
