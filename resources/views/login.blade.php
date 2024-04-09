@include('navbar')

<div class="login-form-container">
    <h2>Login</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <label for="name">Username</label>
        <input type="text" id="name" name="name" required autofocus>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Login</button>
    </form>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
