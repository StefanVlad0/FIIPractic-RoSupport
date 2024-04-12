<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-EXAMPLE" crossorigin="anonymous" />
<script src="https://kit.fontawesome.com/bc0b04e785.js" crossorigin="anonymous"></script>
<script src="{{ asset('js/drawer.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<nav class="navbar">
    <div class="container">
        <div class="logo">RoSupport</div>
        <ul class="nav-links">
            <li><a href="{{ url('/') }}">Home</a></li>
        </ul>
        <div class="login-logout">
            @if(Auth::check())
                @php
                    $profileImage = Auth::user()->profile_image;
                @endphp
                <div class="notifications">
                    <i class="fa-solid fa-bell"></i>
                </div>
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
                    <a href="{{ route('users.show', ['name' => Auth::user()->name]) }}">View Profile</a>
                    <a href="{{ route('profile.edit') }}">Edit Profile</a>
                    <a href="{{ route('referral') }}">Referral</a>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
               document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}">Login</a>
            @endif
        </div>
    </div>
</nav>

<script src="{{ asset('js/chatDrawer.js') }}"></script>

