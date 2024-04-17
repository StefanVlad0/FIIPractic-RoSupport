@extends('layouts.master')

@section('title')
    {{ __('login.login') }}
@endsection

@section('head')
    <link rel="stylesheet" href="{{ asset('css/loginFormStyles.css') }}">
@endsection

@section('content')
<div class="login-form-container">
    <h2>{{ __('login.login') }}</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <label for="name">Username</label>
        <input type="text" id="name" name="name" required autofocus>

        <label for="password">{{ __('login.password') }}</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">{{ __('login.login') }}</button>
    </form>

    <p>{{ __('login.register_text') }} <a href="/register">{{ __('login.register') }}</a></p>

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
@endsection
