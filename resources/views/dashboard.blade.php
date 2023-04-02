@include('header')
@extends('header')
@push('title')
    <title>Dashboard</title>
@endpush
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






@include('footer')
