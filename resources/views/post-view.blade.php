@include('header')
@extends('header')
@push('title')
    <title>View post</title>
@endpush
@include('nav-bar')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            @if (Session::has('success'))
                <p class="alert alert-success">{{ Session::get('success') }}</p>
            @elseif(Session::has('error'))
                <p class="alert alert-warning">{{ Session::get('error') }}</p>
            @endif
            <div class="user-post-container">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-8">
                                <h3>{{ $post->post_title }}</h3>
                            </div>
                            <div class="col-sm-4 text-right">
                                <small>Posted {{ $post->created_at }}</small>
                                <br>
                                <small>By {{ $personal_info->userName ?? 'Anonymous' }} ({{ $user->user_type }})</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>{{ $post->content }}</p>
                    </div>
                    <div>
                        <img src="{{ asset('storage/files/' . $post->files) }}" alt="" width="720px"
                            height="auto">
                    </div>
                    <hr>
                    <div class="like-comment-area">
                        <a href="{{ route('posts.upvote', $post->post_id) }}">
                            <button type="submit"><img src="{{ asset('image/like.png') }}" height="20px"
                                    alt="upvote"> {{ $post->upvotes }} </button>
                        </a>
                        <a href="{{ route('posts.downvote', $post->post_id) }}">
                            <button type="submit"><img src="{{ asset('image/dislike.png') }}" height="20px"
                                    alt="downvote"> -{{ $post->downvotes }}</button>
                        </a>
                    </div>
                    <hr>
                </div>
                <br>

                <h4>Comments</h4>
                <hr>
                @foreach ($comments as $comment)
                    <div class="card">
                        <div class="card-body">
                            <p>{{ $comment->c_details }}</p>
                            <small>Commented {{ $comment->created_at }} by
                                {{ $comment->userName }}</small>
                        </div>
                    </div>
                    <br>
                @endforeach
                <hr>
                @if (Session::get('$user_id') == $post->user_id)
                    <div class="text-right">
                        <a href="{{ route('edit.p.post', ['id' => $post->post_id]) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('delete.p.post', ['id' => $post->post_id]) }}" method="post"
                            style="display: inline">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                    <br>
                    <h5>Add a Comment</h5>
                    <form action="{{ route('add.comment', ['id' => $post->post_id]) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control" name="c_details" placeholder="Type your comment here"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" style="background-color:green">Submit</button>
                    </form>
            </div>
            @endif
        </div>
    </div>
</div>


</section>


@include('footer')
