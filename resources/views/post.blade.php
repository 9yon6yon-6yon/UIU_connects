@include('header')
@extends('header')
@push('title')
    <title>
        Post</title>
@endpush
<!-- Button trigger modal -->

@include('nav-bar')

<div class="home-right-side ">
    <div class="container-fluid">
        <div class="sticky-top">
            <nav class="navbar navbar-expand-lg navbar-light  bg-light">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarNav">
                        <ul class="navbar-nav ">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#"
                                    onclick="showSection('General')">General</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" onclick="showSection('Job')">Jobs</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" onclick="showSection('Event')">Events</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="user-post-container">

                    <div id="General-section" class="content-section">
                        @foreach ($posts as $post)
                            <div class="user-single-post-with-comment mb-3">
                                <div class="user-single-post-top">
                                    <div class="poster-name-with-picture d-flex align-items-center">
                                        <div class="poster-image">
                                            <img src="{{ asset('image/PosterAvatar.png') }}" alt="">
                                        </div>
                                        <div class="poster-details">
                                            <h4>{{ $post->post_title }}</h4>
                                            <small>{{ $post->created_at->diffForHumans() }}</small>
                                        </div>
                                    </div>
                                    <div class="poster-post">
                                        <p>{{ Str::limit($post->content, $limit = 200, $end = '...') }}
                                            @if (strlen($post->content) > 200)
                                                <a href="{{ route('view.p.post', ['id' => $post->post_id]) }}">See
                                                    more</a>
                                            @endif
                                        </p>

                                    </div>

                                    <div class="post-img">
                                        <img src="{{ asset('storage/files/' . $post->files) }}" alt="">
                                    </div>

                                    <hr>
                                    <div class="like-comment-area">
                                        <a href="{{ route('posts.upvote', $post->post_id) }}">
                                            <button type="submit"><img src="{{ asset('image/like.png') }}"
                                                    height="20px" alt="upvote"> {{ $post->upvotes }} </button>
                                        </a>
                                        <a href="{{ route('posts.downvote', $post->post_id) }}">
                                            <button type="submit"><img src="{{ asset('image/dislike.png') }}"
                                                    height="20px" alt="downvote"> -{{ $post->downvotes }}</button>
                                        </a>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div id="Job-section" class="content-section" style="display:none">
                        @foreach ($jobs as $post)
                            <div class="user-single-post-with-comment mb-3">
                                <div class="user-single-post-top">
                                    <div class="poster-name-with-picture d-flex align-items-center">
                                        <div class="poster-image">
                                            <img src="{{ asset('image/PosterAvatar.png') }}" alt="">
                                        </div>
                                        <div class="poster-details">
                                            <h4>{{ $post->job_title }}</h4>
                                            <small>{{ $post->created_at->diffForHumans() }}</small>
                                        </div>
                                    </div>
                                    <div class="poster-post">
                                        <p>{{ Str::limit($post->job_details, $limit = 200, $end = '...') }}
                                            @if (strlen($post->job_details) > 200)
                                                <a href="{{ route('view.p.job', ['id' => $post->job_id]) }}">See
                                                    more</a>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="post-img">
                                        <img src="{{ asset('storage/files/' . $post->files) }}" alt=""
                                            class="w-100">
                                    </div>
                                    <hr>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div id="Event-section" class="content-section" style="display:none">
                        @foreach ($events as $event)
                            <div class="user-single-post-with-comment mb-3">
                                <div class="user-single-post-top">
                                    <div class="poster-details d-flex justify-content-between">
                                        <div class="poster-name-with-picture d-flex align-items-center">
                                            <div class="poster-image">
                                                <img src="{{ asset('image/PosterAvatar.png') }}" alt="">
                                            </div>
                                            <div class="poster-details">
                                                <h4>{{ $event->event_title }}</h4>
                                                <small>{{ $event->created_at->diffForHumans() }}</small>
                                            </div>
                                        </div>
                                        <div class="event-date">
                                            <small>Event date: {{ $event->event_date }}</small>
                                        </div>
                                    </div>
                                    <div class="poster-post">
                                        <p>{{ Str::limit($event->event_details, $limit = 200, $end = '...') }}
                                            @if (strlen($event->event_details) > 200)
                                                <a href="{{ route('view.p.event', ['id' => $event->event_id]) }}">See
                                                    more</a>
                                            @endif
                                        </p>
                                    </div>

                                    <div class="post-img">
                                        <img src="{{ asset('storage/files/' . $event->files) }}" alt="">
                                    </div>
                                    <hr>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</section>

<script>
    const menuItems = document.querySelectorAll('.nav-item');
    menuItems.forEach(item => {
        item.addEventListener('click', () => {
            menuItems.forEach(item => item.querySelector('a').classList.remove('active'));
            item.querySelector('a').classList.add('active');
        });
    });

    function showSection(sectionName) {

        var contentSections = document.getElementsByClassName("content-section");
        for (var i = 0; i < contentSections.length; i++) {
            contentSections[i].style.display = "none";
        }
        var selectedSection = document.getElementById(sectionName + "-section");
        selectedSection.style.display = "block";
    }
</script>
@include('footer')
