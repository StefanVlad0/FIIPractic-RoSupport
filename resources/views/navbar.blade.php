<link rel="stylesheet" href="{{ asset('css/styles.css') }}">

<nav class="navbar">
    <div class="container">
        <div class="logo">RoSupport</div>
        <ul class="nav-links">
            <li><a href="{{ url('/') }}">Home</a></li>
        </ul>
        <div class="login-logout">
            @if(Auth::check())
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>
            @endif
        </div>
    </div>
</nav>
