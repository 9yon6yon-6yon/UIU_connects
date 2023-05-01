<section class="homepage d-flex">
    <div class="sidemenu bg-light d-flex justify-content-center">
        <div class="sidemenu-icon-container">
            <a href="{{ route('user.dashboard') }}" class="icon-link"> <img src="{{ asset('image/icons/home.png') }}" class="icon-home"></a>
            <a href="{{ route('user.search') }}" class="icon-link"><img src="{{ asset('image/icons/search.png') }}"
                    class="icon-contact-info"></a>
            <a href="{{ route('user.posts') }}" class="icon-link"><img src="{{ asset('image/icons/news-feed.png') }}"
                    class="icon-message"></a>
            <a href="{{ route('create-post') }}" class="icon-link"><img src="{{ asset('image/icons/create.png') }}"
                    class="icon-logout"></a>
            <a href="{{ route('chat.dashboard') }}" class="icon-link"><img src="{{ asset('image/icons/chat.png') }}" class="icon-logout"></a>
            <a href="{{ route('user.settings') }}" class="icon-link"><img src="{{ asset('image/icons/settings.png') }}"
                    class="icon-logout"></a>
            <a href="{{ route('user.profile.all', ['id' => Session::get('$user_id')]) }}" class="icon-link"><img
                    src="{{ asset('image/icons/profile.png') }}" class="icon-profile"></a>

        </div>
    </div>
