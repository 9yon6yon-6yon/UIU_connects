@include('header')
@extends('header')
@push('title')
    <title>Dashboard</title>
@endpush

@include('nav-bar')
<div class="container">{{ $user[0]->email }}
    </div>

</section>
@include('footer')
