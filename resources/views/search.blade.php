@include('header')
@extends('header')
@push('title')
    <title>Search</title>
@endpush


@include('nav-bar')

<div class="container">
    <div class="right-side">
        <div class="info-container">
            <div class="search sticky-sm-top">
                <input type="text" placeholder="   Search here" onkeyup="searchUsers()" id="search-input">
            </div>
            <div class="container">

                <div class="row row-cols-1 row-cols-md-3 g-4" id="search-results">

                </div>
            </div>
        </div>
    </div>
</div>
</section>
<script>
    function searchUsers() {
        var searchKey = document.getElementById('search-input').value;
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var response = JSON.parse(this.responseText);

                document.getElementById('search-results').innerHTML = '';


                if (response.users.length > 0) {

                    response.users.forEach(function(user) {
                        var cardHtml = '<div class="col-md-4 mb-4">' +
                            '<div class="card shadow-sm h-100">' +
                            '<img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Profile Picture">' +
                            '<div class="card-body ">' +
                            '<div class="card-title">' +
                            '<h2>' + user.userName + '</h2>' +
                            '<p>' + user.email + '</p>' +
                            '<ul class="list-group list-group-flush">' +
                            '<li class="list-group-item">' +
                            '<strong>Date of Birth:</strong>' + '<p>' + user.dob + '</p>' +
                            '</li>' +
                            '<li class="list-group-item"><strong>Address:</strong>' + user.address +
                            '</li>' +
                            '<li class="list-group-item"><strong>Nationality:</strong> ' + user
                            .nationality + '</li>' +
                            '</ul>' +
                            '</div>' +
                            '<div class="card-footer">' +
                            '<a href="#" class="btn btn-primary follow-button" data-user-id="' + user.u_id +
                            '">Follow</a>' +
                            '</div>' +
                            '</div>' +
                            '</div>';

                        document.getElementById('search-results').innerHTML += cardHtml;
                    });
                }
            }
        };
        xhr.open('GET', '{{ route('user.search') }}?key=' + searchKey, true);
        xhr.send();
    }

    $(document).on('click', '.follow-button', function(e) {
        e.preventDefault();
        var userId = $(this).data('user-id');
        var xhr = new XMLHttpRequest();
        xhr.open('get', '{{ route('follow', ['id' => ':id']) }}'.replace(':id', userId));
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.setRequestHeader('X-CSRF-Token', '{{ csrf_token() }}');
        xhr.onreadystatechange = function() {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                var response = JSON.parse(this.responseText);
                if (response.success) {
                    $(e.target).html('Following');
                } else {
                    alert('Error following user');
                }
            } else if (this.readyState === XMLHttpRequest.DONE && this.status !== 200) {
                alert('Error following user');
            }
        };
        xhr.send(JSON.stringify({
            _token: '{{ csrf_token() }}'
        }));
    });
    
</script>

@include('footer')
