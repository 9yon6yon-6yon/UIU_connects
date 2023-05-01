@include('header')
@extends('header')
@push('title')
    <title>Search</title>
@endpush


@include('nav-bar')

<div class="container">
    <div class="message-right-area d-flex" style="justify-content:center; ">
        <div class="chat-list-area" style="margin:20px;height: 700px;width:300px;  overflow-y: scroll;">
            <div class="chat-heading text-center">
                <h3>Message</h3>
                <hr>
            </div>
            <div class="all-chats">

                <div id="friends"></div>
            </div>
        </div>
        <div class="send-message-area " style="height: 700px;">
            <div class="send-chat-inner-area  d-flex flex-column justify-content-end ">
                <div class="sent-chat">
                    <div id="messages"></div>
                </div>
                <div class="message-input ">
                    <input class="w-100" type="text" placeholder="Type Message Here">
                </div>
            </div>
        </div>
        <div class="active-users-area" style="margin-top:20px;margin-left:50px;height: 700px;width:300px;  overflow-y: scroll;">

            <h3>Active</h3>
            <hr>
            <div id="active_users"></div>
        </div>
    </div>

</div>
</section>
<script>
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "{{ route('chat.dashboard') }}");
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
    xhr.send();

    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            document.getElementById('friends').innerHTML = '';
            document.getElementById('active_users').innerHTML = '';
            response.friends.forEach(function(friends) {
                var cardHtml = '<div class="single-chat d-flex align-items-center ">' +
                    '<div class="name-and-message">' +
                    '<h4>' + friends.userName + '</h4>' +
                    '<p>Click to enter chat</p>' +
                    '<p>' + friends.email + '</p>' +
                    '</div>' +
                    ' </div>';
                document.getElementById('friends').innerHTML += cardHtml;
            });

            response.active_users.forEach(function(user) {
                var userHtml = '<div>' +
                    '<p>' + user.userName + ' <span class="status-dot ' + (user.status === 'active' ? 'active' : '') + '"></span></p>' +
               
                    '</div>';
                document.getElementById('active_users').innerHTML += userHtml;
            });


        }
    };
</script>
@include('footer')
