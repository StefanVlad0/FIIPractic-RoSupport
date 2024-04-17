@extends('layouts.master')

@section('title')
    {{ __('invitation.invitation') }}
@endsection

@section('head')
    <link rel="stylesheet" href="{{ asset('css/loginFormStyles.css') }}">
@endsection

@section('content')
    <h1>{{ __('invitation.invite') }} {{ $inviter->name }}</h1>

    <div class="login-form-container">
        <h2>{{ __('invitation.register') }}</h2>
        <form action="/register" method="POST">
            @csrf
            <input type="hidden" name="inviter_id" value="{{ $inviter->id }}">
            <label for="name">Username</label>
            <input type="text" id="name" name="name">
            <label for="email">Email</label>
            <input type="email" id="email" name="email">
            <label for="password">{{ __('invitation.password') }}</label>
            <input type="password" id="password" name="password">
            <label for="password_confirmation">{{ __('invitation.confirm_password') }}</label>
            <input type="password" id="password_confirmation" name="password_confirmation">
            <button type="submit">{{ __('invitation.register') }}</button>
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
