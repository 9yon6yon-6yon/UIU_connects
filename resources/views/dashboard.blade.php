@include('header')
@extends('header')
@push('title')
    <title>Dashboard</title>
@endpush

@include('nav-bar')
welcome {{ Session::get('$user_email') }}
@include('footer')
