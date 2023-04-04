@include('header')
@extends('header')
@push('title')
    <title>UIU Connects</title>
@endpush
<header class="header-area">
    <nav class="navbar navbar-expand-lg main-menu">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('image/logo.png') }}"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                </ul>
                <a href="{{ route('user-login') }}"><button class="home-menu-btn btn-login">Login</button></a>
                <a href="{{ route('user-sign-up') }}"><button class="home-menu-btn">Sign Up</button></a>
            </div>
        </div>
    </nav>
    <div class="banner-area">
        <div class="banner-img">
            <img src="{{ asset('image/banner.png') }}" class="w-100" alt="">
        </div>
        <div class="banner-content">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="banner-text">
                            <h1>UIU Social Media <br> & Chat System</h1>
                            <p>It is a long established fact that a reader will be
                                distracted <br> by the readable
                                content of a page when It is
                                a long <br>established fact that a reader will be distracted <br>
                                by the readable content of a page.</p>
                            <a href="{{ route('user-login') }}"><button
                                    class="home-menu-btn banner-login-btn">Login</button></a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="right-illustration">
                            <img src="{{ asset('image/illustration.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>





@include('footer')
