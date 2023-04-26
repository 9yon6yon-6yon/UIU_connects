@include('header')
@extends('header')
@push('title')
    <title>Post</title>
@endpush
<!-- Button trigger modal -->

@include('nav-bar')

<div class="home-right-side ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="home-user-info sticky-sm-top">
                    <div class="info-header d-flex flex-column align-items-center ">
                        <div class="profile-pic-container"></div>
                        <div class="user-name text-center">
                            <h1>{{Session::get('$user_email')}}</h1>
                            <p>Student, UIU </p>
                        </div>
                        <div class="user-button">
                          <button class="post-btn">Post</button>
                            <button class="message-btn">Message</button>
                            <a href="{{route('user.profile.all',['id' => Session::get('$user_id')])}}"><button class="edit-profile-btn">Edit Profile</button></a>
                        </div>
                    </div>
                    <hr>
                    <div class="info-bottom">
                        <h4 class="about-heading">About</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam dolore adipisci iusto consectetur quae inventore dolores accusamus facilis ad? Vero!</p>
                        <h4 class="quick-contact">Quick Contacts</h4> <br>
                        <img src="{{asset('image/icons/quick-contact-message.png')}}" alt=""> <br>
                        <img src="{{asset('image/icons/quick-contact-phone.png')}}" alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="user-post-container">
                    <div class="user-single-post-with-comment mb-3">
                        <div class="user-single-post-top">
                            <div class="sticky-top">
                                <nav class="navbar navbar-expand-lg navbar-light  bg-light">
                                    <div class="container-fluid">
                                      
                                      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                        <span class="navbar-toggler-icon"></span>
                                      </button>
                                      <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarNav">
                                        <ul class="navbar-nav ">
                                          <li class="nav-item">
                                            <a class="nav-link active" aria-current="page" href="#">General</a>
                                          </li>
                                          <li class="nav-item">
                                            <a class="nav-link" href="#">Job</a>
                                          </li>
                                          <li class="nav-item">
                                            <a class="nav-link" href="#">Event</a>
                                          </li>
                                        </ul>
                                      </div>
                                    </div>
                                  </nav>
                            </div>
                            @foreach ($posts as $post)
                            <div class="poster-name-with-picture d-flex align-items-center">
                                <div class="poster-image">
                                    <img src="{{asset('image/PosterAvatar.png')}}" alt="">
                                </div>
                                <div class="poster-details">
                                    <h2>{{ $post->post_title }}</h2>
                                    <small>{{ $post->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                            <div class="poster-post">
                                <p>{{$post->content}}</p>
                            </div>   
                            <hr>
                            <div class="like-comment-area">
                                <form action="{{ route('posts.upvote', $post->post_id) }}" method="POST">
                                    @csrf
                                    <button type="submit"><img src="{{ asset('image/like.png') }}" height="20px" alt="upvote"> {{ $post->upvotes }} </button>
                                </form>
                                
                                <form action="{{ route('posts.downvote', $post->post_id) }}" method="POST">
                                    @csrf
                                    <button type="submit"><img src="{{ asset('image/dislike.png') }}" height="20px" alt="downvote"> {{ $post->downvotes }}</button>
                                </form>
                                <button><img src="{{asset('image/comment.png')}}" height="20px" alt=""> Comment</button>
                            </div>
                            <hr>
                            @endforeach
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div> 
</div>
</section>
@include('footer')
