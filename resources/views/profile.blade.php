@include('header')
@extends('header')
@push('title')
    <title>Profile</title>
@endpush
@include('nav-bar')
<div class="profile-info-container">
    <div class="profile-user-info text-center">
        <img src="{{asset('images/contact-card.png')}}" alt="">
        <h2>Username</h2>
        <p>Student, UIU</p>
    </div>
    <div class="profile-inner-info-container d-flex justify-content-between">
        <div class="inner-info-left d-flex flex-column justify-content-between">
            <div class="inner-info-left-top">
                <div class="inner-info-left-heading">
                    <h4>About</h4><br>
                </div>
                <textarea name="" id="" cols="80" rows="5" class="w-100"></textarea>
            </div>
            <div class="inner-info-left-bottom">
                <div class="inner-info-left-heading">
                    <h4>Quick Contacts</h4><br>
                    <div class="profile-phone">
                        <img src="{{ asset('image/profile-phone.png') }}" alt="">
                        <input type="text">
                    </div>
                    <div class="profile-message">
                        <img src="{{ asset('image/profile-message.png') }}" alt="">
                        <input type="text">
                    </div>
                </div>
            </div>

        </div>
        <div class="inner-info-right">
            <div class="inner-info-right-heading">
                <h4>Information</h4>
            </div>
            <div class="inner-info-right-middle">
                <input type="text" placeholder="DD-MM-YYYY">
                <input type="text" placeholder="Institution">
                <input type="text" placeholder="Current CGPA">
                <input type="text" placeholder="Interests">
                <input type="text" placeholder="Languages">
                <input type="text" placeholder="Nationality">
                <input type="text" placeholder="Others">
            </div>
            <div class="inner-info-right-buttons">
                <button>Save</button>
                <button>Generate Cv</button>
            </div>
        </div>
    </div>
</div>


</section>




@include('footer')
