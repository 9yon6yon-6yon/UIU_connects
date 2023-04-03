<section class="homepage d-flex">
<div class="sidemenu bg-light d-flex justify-content-center">
    <div class="sidemenu-icon-container">
        <a href="{{ route('user.dashboard') }}">Home</a>
         {{-- <a href="{{ url('/user') }}">Search</a> --}}
        <a href="{{route('user.posts') }}">Posts</a>
        <a href="{{ route('user.settings') }}">Settings</a> 
    </div>
</div>
