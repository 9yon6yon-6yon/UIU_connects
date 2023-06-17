@include('header')
@extends('header')
@push('title')
    <title>Chat</title>
@endpush

@include('nav-bar')

<div class="container">
    <div class="message-right-area d-flex" style="justify-content:center; ">
        <div class="chat-list-area" style="margin:20px;height: 700px;width:300px;">
            <div class="chat-heading text-center">
                <h3>Message</h3>
                <hr>
                <div class="all-chats">
                    <div id="friends"></div>
                </div>
            </div>
        </div>
        <div class="send-message-area " style="height: 700px;">
            <div class="send-chat-inner-area  d-flex flex-column justify-content-end ">
                <div class="sent-chat" style="overflow-y: scroll;">
                    <div id="messages">
                        @if (Session::has('chats'))
                            @foreach (Session::get('chats') as $chat)
                                @if ($chat->sender_id == Session::get('$user_id'))
                                <div class="sent-message-right">
                                    <div class="col-auto">
                                        <small class="text-muted">{{ $chat->created_at }}</small>
                                    </div>
                                
                                       
                                  
                                    <h3>{{ $chat->message }}</h3> <img src="{{ asset('storage/files/' . $chat->image_path) }}"
                                            alt="User Image" class="rounded-circle" style="width: 30px;">
                                </div>
                            @else
                                <div class="sent-message-left">
                                 
                                      
                                    <div class="col-auto">
                                        <small class="text-muted">{{ $chat->created_at }}</small>
                                    </div> <img src="{{ asset('storage/files/' . $chat->image_path) }}"
                                            alt="User Image" class="rounded-circle" style="width: 30px;">
                                    <h3>{{ $chat->message }}</h3> 
                                
                                </div>
                            @endif
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="message-input ">
                    <form action="{{ route('chat.store') }}" method="post">
                        @csrf
                        <input class="w-100" type="text" placeholder="Type Message Here" id="message-input"
                            name="message">
                        <input type="hidden" name="receiver_id" value="{{ Session::get('$receiver_id') }}">
                        <button class="btn btn-primary" id="send-button">Send</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="active-users-area"
            style="margin-top:20px;margin-left:50px;height: 700px;width:300px;  overflow-y: scroll;">

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
                var cardHtml =
                    '<div class="single-chat d-flex align-items-center" onclick="window.location=\'' +
                    '{{ route('chat.show', ['id' => ':id']) }}'.replace(':id', friends.user_id) + '\'">' +
                    '<div class="name-and-message">' +
                    '<h4>' + friends.userName + '</h4>' +
                    '<p>Click to enter chat</p>' +
                    '<p>' + friends.email + '</p>' +
                    '</div>' +
                    '</div>';
                document.getElementById('friends').innerHTML += cardHtml;
            });
            // href="{{ route('chat.show', ['id' => ':id']) }}'.replace(':id', friends.user_id) + '"

            response.active_users.forEach(function(user) {
                var userHtml = '<div>' +
                    '<p>' + user.userName + ' <span class="status-dot ' + (user.status === 'active' ?
                        'active' : '') + '"></span></p>' +

                    '</div>';
                document.getElementById('active_users').innerHTML += userHtml;
            });


        }
    };
</script>
@include('footer')
