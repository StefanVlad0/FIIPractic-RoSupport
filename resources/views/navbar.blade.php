<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-EXAMPLE" crossorigin="anonymous" />
<script src="https://kit.fontawesome.com/bc0b04e785.js" crossorigin="anonymous"></script>
<script src="{{ asset('js/drawer.js') }}"></script>



<nav class="navbar">
    <div class="container">
        <div class="logo">RoSupport</div>
        <ul class="nav-links">
            <li><a href="{{ url('/') }}">Home</a></li>
        </ul>
        <div class="login-logout">
            @if(Auth::check())
                <div id="drawerToggle" onclick="toggleDrawer()">
                    <i class="fas fa-user-circle"></i>
                </div>
                <div id="drawer" style="display: none;">
                    <a href="{{ route('users.show', ['name' => Auth::user()->name]) }}">View Profile</a>
                    <a href="{{ route('logout') }}">Edit Profile</a>
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
