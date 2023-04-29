@include('header')
@extends('header')
@push('title')
    <title>Post</title>
@endpush
<!-- Button trigger modal -->

@include('nav-bar')

<div class="container pt-3">
    <form id="post-form" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="post-type">Post type:</label>
            <select id="post-type" class="form-control" onchange="updateFields()" name="post_type">
                <option value="event">Event</option>
                <option value="job">Job</option>
                <option value="general">General</option>
            </select>
        </div>
        <div class="form-group">
            <label for="post-title">Title:</label>
            <input type="text" class="form-control" id="post-title" name="title">
        </div>
        <div class="form-group">
            <label for="post-details">Details:</label>
            <input type="text" class="form-control" id="post-details" name="details">
        </div>
        <div class="form-group">
            <label for="post-files">Files/Images:</label>
            <input type="file" class="form-control" id="post-files" name="file">
        </div>
        <div class="form-group" id="event-date-group">
            <label for="event-date" id="event-date-label">Event date:</label>
            <input type="date" class="form-control" id="event-date" name="event_date">
        </div>
  
        <button type="submit" class="btn btn-primary" style="background-color:#F68B1F; color: white;border:none;">Submit</button>
    </form>

</div>
</section>

<script>
    var form = document.getElementById("post-form");
    var postTypeSelect = document.getElementById("post-type");

    postTypeSelect.addEventListener("change", function() {
        if (postTypeSelect.value === "general") {
            form.action = "{{ route('user.post') }}";
        } else if (postTypeSelect.value === "job") {
            form.action = "{{ route('jobs.store') }}";
        } else if (postTypeSelect.value === "event") {
            form.action = "{{ route('events.store') }}";
        }
    });

    function updateFields() {
        var postType = document.getElementById("post-type").value;
        var eventDateLabel = document.getElementById("event-date-label");
        var eventDateInput = document.getElementById("event-date");
       
        if (postType == "event") {
            eventDateLabel.style.display = "block";
            eventDateInput.style.display = "block";
          
        } else if (postType == "job") {
            eventDateLabel.style.display = "none";
            eventDateInput.style.display = "none";
          
        } else {
            eventDateLabel.style.display = "none";
            eventDateInput.style.display = "none";
           
        }
    }
</script>
@include('footer')
