@include('header')
@extends('header')
@push('title')
    <title>Settings</title>
@endpush


@include('nav-bar')
<div class="log-out-info-area d-flex align-items-center">
    <div class="container">
        <div class="log-out-content d-flex">
            <div class="left d-flex align-items-center justify-content-center">
                <div class="icon-img">
                    <img src="{{ asset('image/icon-img.png')}}" alt="" />
                </div>
            </div>
            <div class="right d-flex align-items-center justify-content-center">
                <div class="right-content">
                    @if(Session::has('error'))
                    <p class="alert alert-warning">{{ Session::get('error') }}</p>
                    @elseif(Session::has('success'))
                    <p class="alert alert-success">{{ Session::get('success') }}</p>
                    @endif
                    @if (Session::has('$user_email'))
                        <a href="{{ route('user.offline', ['id' => Session::get('$user_id')]) }}"><button
                            class="w-100 btn-1 btn-with-bg text-white" style="background-color:#F68B1F; color: white;border:none;">Status</button></a><br />
                    @endif
                            <br>
                    <a href="{{ route('user.logout') }}"><button class="w-100 btn-1 btn-with-bg text-white" style="background-color:#F68B1F; color: white;border:none;">Log
                            Out</button></a><br />

                </div>
            </div>
        </div>
    </div>
</div>
</div>


@include('footer')
