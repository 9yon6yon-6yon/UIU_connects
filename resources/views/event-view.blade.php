@include('header')
@extends('header')
@push('title')
    <title>Event</title>
@endpush

@include('nav-bar')

<div class="container">
  <div class="row">
      <div class="col-lg-12">
          <div class="user-post-container">
              <div class="card">
                  <div class="card-header">
                      <div class="row">
                          <div class="col-sm-8">
                              <h3>{{ $event->event_title }}</h3>
                          </div>
                          <div class="col-sm-4 text-right">
                              <small>Posted {{ $event->created_at}}</small>
                              <br>
                              <small>By {{ $personal_info->userName ?? 'Anonymous' }} ({{ $user->user_type }})</small>
                          </div>
                      </div>
                  </div>
                  <div class="card-body">
                      <p>{{ $event->event_details }}</p>
                  </div>
                  <div>
                      <img src="{{ asset('storage/files/' . $event->files) }}" alt="" width="720px" height="auto">
                  </div>
              </div>
              <br>
              @if (Session::get('$user_id') == $event->user_id)
              <div class="text-right">
                  <form action="{{ route('delete.p.event', ['id' => $event->event_id]) }}" method="post"
                      style="display: inline">
                      @csrf
                      @method('delete')
                      <button type="submit" class="btn btn-danger">Delete</button>
                  </form>
              </div>
              @endif
              <br>
          </div>
      </div>
  </div>
</div>

</section>






@include('footer')
