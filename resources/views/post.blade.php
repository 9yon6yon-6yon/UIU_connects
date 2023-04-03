@include('header')
@extends('header')
@push('title')
    <title>Post</title>
@endpush
<!-- Button trigger modal -->

@include('nav-bar')
<div class="container pt-3">
    @foreach ($posts as $post)
        <h2>{{ $post->post_title }}</h2>
        <p>{{ $post->content }}</p>
        <img src="{{ $post->files }}" alt="Post Image">
        <small>{{ $post->created_at->diffForHumans() }}</small>
    @endforeach
    <button id="post-content" type="button" class="btn btn-outline-primary">
        Post
    </button>


 
</div>

@include('footer')
