@include('header')
@extends('header')
@push('title')
    <title>Dashboard</title>
@endpush
<<<<<<< Updated upstream
<div class="container pt-3">
     @if (Auth::check())
        <p>Welcome, {{ auth()->user()->email }}</p>
    @else
        <p>Please log in to access the dashboard.</p>
    @endif
    <h1>User Profile</h1>
    <p>Email: {{ $user[0]->email }}</p>
    <p>Status: {{ $user[0]->status }}</p>

</div>
=======
@include('nav-bar')
<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
      <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Home</a>
      <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</a>
      <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</a>
    </div>
  </nav>
  <div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">...</div>
    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">...</div>
    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>
  </div>
>>>>>>> Stashed changes






@include('footer')
