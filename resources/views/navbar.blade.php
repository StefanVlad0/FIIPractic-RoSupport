<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-EXAMPLE" crossorigin="anonymous" />
<script src="https://kit.fontawesome.com/bc0b04e785.js" crossorigin="anonymous"></script>
<script src="{{ asset('js/drawer.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<nav class="navbar">
    <div class="container">
        <div class="logo">RoSupport</div>
        <ul class="nav-links">
            <li><a href="{{ url('/') }}">{{ __('navbar.home') }}</a></li>
        </ul>

        <div class="login-logout">
            <div class="dropdown" onclick="toggleLanguageMenu()">
                <img id="flag" src="{{ app()->getLocale() == 'ro' ? asset('images/RO.png') : asset('images/US.png') }}" class="change-lang" style="width: 30px; height: 30px">
                <div id="language-menu" style="display: none;">
                    <a href="{{ route('setLanguage', ['lange' => 'ro']) }}">Română</a>
                    <a href="{{ route('setLanguage', ['lange' => 'en']) }}">English</a>
                </div>
            </div>


            @if(Auth::check())
                @php
                    $profileImage = Auth::user()->profile_image;
                    $unseenNotifications = DB::table('notifications')
                        ->where('user_id', Auth::id())
                        ->where('seen', false)
                        ->count();
                @endphp
                <div class="notifications" style="position: relative;" onclick="toggleNotificationDrawer()">
                    <i class="fa-solid fa-bell"></i>
                    @if($unseenNotifications > 0)
                        <div class="notification-dot"></div>
                    @endif
                </div>
                <div id="notificationDrawer" style="display: none;"></div>
                <div class="messenger" onclick="toggleMessengerDrawer()">
                    <i class="fa-solid fa-comments"></i>
                </div>
                <div id="messengerDrawer" style="display: none;"></div>
                <div class="points" onclick="window.location.href='/referral'">
                    {{ Auth::user()->points }} <i class="fas fa-coins"></i>
                </div>
                @if($profileImage)
                    <div id="drawerToggle" onclick="toggleDrawer()">
                        <img src="{{ asset('images/' . $profileImage) }}" alt="Profile Image" style="width: 35px; height: 35px; border-radius: 50%;">
                    </div>
                @else
                    <div id="drawerToggle" onclick="toggleDrawer()">
                        <i class="fas fa-user-circle" style="font-size: 30px;"></i>
                    </div>
                @endif
                <div id="drawer" style="display: none;">
                    <a href="{{ route('users.show', ['name' => Auth::user()->name]) }}">{{ __('navbar.view_profile') }}</a>
                    <a href="{{ route('profile.edit') }}">{{ __('navbar.edit_profile') }}</a>
                    <a href="{{ route('referral') }}">{{ __('navbar.referral') }}</a>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
               document.getElementById('logout-form').submit();">
                        {{ __('navbar.logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}">{{ __('navbar.login') }}</a>
            @endif
        </div>
    </div>
</nav>

<script src="{{ asset('js/chatDrawer.js') }}"></script>
<script src="{{ asset('js/notificationsDrawer.js') }}"></script>
<script src="{{ asset('js/toggleLanguage.js')}}"></script>
