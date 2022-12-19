<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Video Rental</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">

    <!-- Bootstrap core CSS -->
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href={{ mix('/css/main.css') }} rel="stylesheet">
    <link rel="stylesheet" type="text/css" href={{ mix('/css/slick.css') }}>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    @yield('head_scripts')
</head>
<body>
<!--Main Navigation-->
<header>

    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
        <div class="container">


            <!-- Collapse -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Links -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <!-- Left -->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link waves-effect" href="{{ route('home-page') }}">Home
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link waves-effect" href="{{ route('categories') }}">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link waves-effect" href="{{ route('all-products') }}">Products</a>
                    </li>
                </ul>
            </div>
            @auth
                <ul class="navbar-nav nav-flex-icons">
                    <li class="nav-item">
                        <a href="{{ route('shopping-cart') }}" class="nav-link waves-effect">
                            Cart
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('profile') }}" class="nav-link waves-effect">
                            {{ auth()->user()->name }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a  href="{{ route('logout') }}" class="nav-link waves-effect"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>

                    </li>
                </ul>
            @else
                <ul class="navbar-nav nav-flex-icons">
                    <li class="nav-item">
                        <a href="{{ route('shopping-cart') }}" class="nav-link waves-effect" target="_blank">
                            Cart
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href={{ route('login') }} class="nav-link waves-effect target="_blank">
                        Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href={{ route('register') }} class="nav-link border border-light rounded waves-effect target="_blank">
                        Register
                        </a>
                    </li>
                </ul>
            @endauth
        </div>
    </nav>
    <!-- Navbar -->

</header>
<!--Main Navigation-->

<main class="py-4">
    @yield('content')
    <!--Footer-->
        <footer class="page-footer text-center font-small darken-2 mt-4 wow fadeIn">
            <hr class="my-4">
        </footer>
    @yield('footer_scripts')
</main>
<script>

    $(document).ready(function () {
        $(window).on('scroll', function () {
            var $nav = $(".navbar.fixed-top");
            console.log('here');
            $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
        });
    })
</script>
</body>
</html>
