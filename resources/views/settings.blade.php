@include('header')
@extends('header')
@push('title')
    <title>Settings</title>
@endpush
<!-- Button trigger modal -->

@include('nav-bar')
<div class="log-out-info-area d-flex align-items-center">
    <div class="container">
        <div class="log-out-content d-flex">
            <div class="left d-flex align-items-center justify-content-center">
                <div class="icon-img">
                    <img src="images/icon-img.png" alt="" />
                </div>
            </div>
            <div class="right d-flex align-items-center justify-content-center">
                <div class="right-content">
                    @if (Session::has('$user_email'))
                                    
                        <a href="{{ route('user.offline', ['id' =>  Session::get('$user_id')]) }}"><button
                                class="w-100 btn-1 btn-with-bg text-white">Offline</button></a><br />
                    @endif
                </div>
                <div class="right-content">
                    <a href="{{ route('user.logout') }}"><button class="w-100 btn-1 btn-with-bg text-white">Log
                            Out</button></a><br />

                </div>
            </div>

        </div>
    </div>

</div>


@include('footer')
