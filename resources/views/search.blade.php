@include('header')
@extends('header')
@push('title')
    <title>Search</title>
@endpush


@include('nav-bar')
{{-- <div class="right-side">
    <div class="container" >
        <div class="info-container">
            <div class="search sticky-sm-top">
                <input type="text" placeholder="   Search here">
            </div>
            <div class="contact-card-area">
                <div class="container" id="product">
   
                        <div class="row row-cols-1 row-cols-md-3 g-4 ">
                            <div class="col">
                                <div class="card h-100">
                                    <img src="{{ asset('image/text-anyone.png') }}" class="card-img-top"
                                        alt="">
                                    <div class="card-body ">
                                        <div class="card-title">
                                            <h2 id="user-name"></h2>
                                        </div>
                                        <div class="about">
                                            <h4 id="type"></h4>
                                        </div>
                                    </div>
                                    <div class="card-footer ">
                                        <div class="quick-contact">
                                            <button class="about-button"><a href="#"> Quick contract</a></button>
                                            <button class="about-button"><a href="#"> About </a></button>
                                            <br>
                                            <img src="{{ asset('image/icons/quick-contact-message.png') }}"
                                                alt="">
                                            <br>
                                            <img src="{{ asset('image/icons/quick-contact-phone.png') }}"
                                                alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  --}}
<div class="right-side">
    <div class="container">
        <div class="info-container">
            <div class="search sticky-sm-top">
                <input type="text" placeholder="   Search here">
            </div>
            <div class="contact-card-area">

                <div class="container" id="product">

                </div>
                <div class="container" id="product">
                    <div class="">
                        <div class="row row-cols-1 row-cols-md-3 g-4 ">
                            <div class="col">
                                <div class="card h-100">
                                    <img src="images/text-anyone.png" class="card-img-top" alt="...">
                                    <div class="card-body ">
                                        <div class="card-title">
                                            <h2>User Name</h2>
                                            <p>Faculty, UIU </p>
                                        </div>

                                        <div class="about">
                                            <h4>About</h4>
                                            <p>This Text Section for Short <br>
                                                Biography of Student or Faculty</p>
                                        </div>
                                    </div>
                                    <div class="card-footer ">

                                        <div class="quick-contact">
                                            <button class="about-button">Quick contract </button>

                                            <button class="about-button">About </button>
                                            <br>
                                            <img src="images/icons/quick-contact-message.png" alt=""> <br>
                                            <img src="images/icons/quick-contact-phone.png" alt="">
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card h-100">
                                    <img src="images/my-profile-2.png" class="card-img-top" alt="...">
                                    <div class="card-body ">
                                        <div class="card-title">
                                            <h2>User Name</h2>
                                            <p>Faculty, UIU </p>
                                        </div>

                                        <div class="about">
                                            <h4>About</h4>
                                            <p>This Text Section for Short <br>
                                                Biography of Student or Faculty</p>
                                        </div>
                                    </div>
                                    <div class="card-footer ">

                                        <div class="quick-contact">
                                            <button class="about-button">Quick contract </button>
                                            <button class="about-button">About </button>
                                            <br>
                                            <img src="images/icons/quick-contact-message.png" alt=""> <br>
                                            <img src="images/icons/quick-contact-phone.png" alt="">
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card h-100">
                                    <img src="images/my-profile-3.png" class="card-img-top" alt="...">
                                    <div class="card-body ">
                                        <div class="card-title">
                                            <h2>User Name</h2>
                                            <p>Faculty, UIU </p>
                                        </div>

                                        <div class="about">
                                            <h4>About</h4>
                                            <p>This Text Section for Short <br>
                                                Biography of Student or Faculty</p>
                                        </div>
                                    </div>
                                    <div class="card-footer ">

                                        <div class="quick-contact">
                                            <button class="about-button">Quick contract </button>

                                            <button class="about-button">About </button>
                                            <br>
                                            <img src="images/icons/quick-contact-message.png" alt=""> <br>
                                            <img src="images/icons/quick-contact-phone.png" alt="">
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

@include('footer')
