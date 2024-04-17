@extends('layouts.master')

@section('title')
    {{ __('register.register') }}
@endsection

@section('head')
    <link rel="stylesheet" href="{{ asset('css/loginFormStyles.css') }}">
@endsection

@section('content')
<div class="login-form-container">
    <h2>{{ __('register.register') }}</h2>
    <form action="/register" method="POST">
        @csrf
        <label for="name">Username</label>
        <input type="text" id="name" name="name">
        <label for="email">Email</label>
        <input type="email" id="email" name="email">
        <label for="password">{{ __('register.password') }}</label>
        <input type="password" id="password" name="password">
        <label for="password_confirmation">{{ __('register.confirm_password') }}</label>
        <input type="password" id="password_confirmation" name="password_confirmation">
        <button type="submit">{{ __('register.register') }}</button>
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
@endsection
