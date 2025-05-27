<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AromaCare  - Home</title>
    <link rel="icon" href="{{ asset('user') }}/img/Fevicon.png" type="image/png">
    <link rel="stylesheet" href="{{ asset('user') }}/vendors/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('user') }}/vendors/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('user') }}/vendors/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="{{ asset('user') }}/vendors/owl-carousel/owl.theme.default.min.css">
    <link rel="stylesheet" href="{{ asset('user') }}/vendors/owl-carousel/owl.carousel.min.css">
    @stack('css')


    <link rel="stylesheet" href="{{ asset('user') }}/css/style.css">

    <style>
        .brand-name {
            color: #333;
            font-weight: bold font-size: 1.12rem;
            margin-left: 0.94rem;
            max-width: 170px;
        }
    </style>

</head>

<body>
    <header class="header_area">
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container">
                    <a class="navbar-brand logo_h" href="/">
                        <svg class="brand-icon" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid"
                            width="30" height="33" viewBox="0 0 30 33">
                            <g fill="none" fill-rule="evenodd">
                                <path class="logo-fill-blue" fill="#7DBCFF" d="M0 4v25l8 4V0zM22 4v25l8 4V0z"></path>
                                <path class="logo-fill-grey" fill="#D3D3D3" d="M11 4v25l8 4V0z"></path>
                            </g>
                        </svg>
                        <span class="brand-name text-truncate">AromaCare </span>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav ml-auto mr-auto">
                            <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                                <a class="nav-link" href="/">Home</a>
                            </li>
                            <li
                                class="nav-item submenu dropdown {{ Request::is('category*') || Request::is('checkout*') || Request::is('cart*') ? 'active' : '' }}">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-haspopup="true" aria-expanded="false">Shop</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item {{ Request::is('category*') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('landing.category') }}">Shop Category</a>
                                    </li>
                                    @auth('pelanggan')
                                        <li class="nav-item {{ Request::is('cart*') ? 'active' : '' }}">
                                            <a class="nav-link" href="/cart">Shopping Cart</a>
                                        </li>
                                        <li class="nav-item {{ Request::is('checkout*') ? 'active' : '' }}">
                                            <a class="nav-link" href="/checkout">Shopping Checkout</a>
                                        </li>
                                    @endauth
                                </ul>
                            </li>
                            <li class="nav-item {{ Request::is('contact') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('landing.contact') }}">Contact</a>
                            </li>
                        </ul>
                        @auth('pelanggan')
                            @php
                                $user = auth('pelanggan')->user();
                            @endphp

                            <ul class="nav-shop">
                                <li class="nav-item">
                                    <button>
                                        <a href="{{ route('pelanggan.cart') }}" class="ti-shopping-cart text-black-50"></a>
                                        <span class="nav-shop__circle">{{ count($user->keranjangs) }}</span>
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <a class="button button-header" href="#">Buy Now</a>
                                </li>
                            </ul>
                        @endauth

                        @auth('pelanggan')
                            <a class=" button button-header" href="{{ route('pelanggan.profile') }}">Lihat Profile</a>
                        @endauth
                        @guest('pelanggan')
                            <a class="button button-header" href="{{ route('login.guest') }}">Login</a>
                        @endguest
                    </div>
                </div>
            </nav>
        </div>
    </header>
