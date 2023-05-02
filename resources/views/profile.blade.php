@include('header')
@extends('header')
@push('title')
    <title>Profile</title>
@endpush
@push('style')
<link rel="stylesheet" href="{{asset('css/profile.css')}}">
@endpush
@include('nav-bar')

<div class="container">
    <section class="section about-section gray-bg" id="about">
        <div class="container">
            <div class="row align-items-center flex-row-reverse">
                <div class="col-lg-6">
                    <div class="about-text go-to">
                        <h3 class="dark-color">{{ $user->userName}}</h3>
                        <h6 class="theme-color lead"> {{ $user->email}}</h6>                        <div class="row about-list">
                            <div class="col-md-6">
                                <div class="media">
                                    <label>Birthday</label>
                                    <p>{{$user->dob}}</p>
                                </div>
                                <div class="media">
                                    <label>Nationality</label>
                                    <p>{{$user->nationality}}</p>
                                </div>
                                <div class="media">
                                    <label>Address</label>
                                    <p>{{$user->address}} </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="media">
                                    <label>E-mail</label>
                                    <p>{{$user->email}} </p>
                                </div>
                                <div class="media">
                                    <label>Phone</label>
                                    <p>{{$user->phone}} </p>
                                </div>
                              
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-avatar">
                        <img src="{{asset('storage/files/'.$user->image_path )}}" title="" alt="profile picture" width="600px" height="auto">
                    </div>
                </div>
            </div>
            <div class="counter">
                <div class="row">
                    <div class="col-6 col-lg-3">
                        <div class="count-data text-center">
                            <h6 class="count h2" >{{ count($posts)}}</h6>
                            <p class="m-0px font-w-600">Posts</p>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="count-data text-center">
                            <h6 class="count h2"  >{{ count($jobs)}}</h6>
                            <p class="m-0px font-w-600">Jobs Posted</p>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="count-data text-center">
                            <h6 class="count h2" >{{ count($events)}}</h6>
                            <p class="m-0px font-w-600">Events Posted</p>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="count-data text-center">
                            <h6 class="count h2">{{$applied}}</h6>
                            <p class="m-0px font-w-600">Job Apply</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

</section>




@include('footer')
