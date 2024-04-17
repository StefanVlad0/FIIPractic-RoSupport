@extends('layouts.master')

@section('title')
    {{ __('profile_edit.edit') }}
@endsection

@section('head')
    <link rel="stylesheet" href="{{ asset('css/loginFormStyles.css') }}">
@endsection

@section('content')
    <div class="login-form-container">
        <h2>{{ __('profile_edit.edit') }}</h2>

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" value="PUT">

            <label for="name">Username</label>
            <input type="text" id="name" name="name" value="{{ auth()->user()->name }}" required autofocus>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ auth()->user()->email }}" required>

            <label for="bio">Bio</label>
            <textarea id="bio" name="bio">{{ auth()->user()->bio }}</textarea>

            <label for="profile_image">{{ __('profile_edit.profile_image') }}</label>
            <input type="file" id="profile_image" name="profile_image">

            <label for="password">{{ __('profile_edit.password') }}</label>
            <input type="password" id="password" name="password">

            <label for="password_confirmation">{{ __('profile_edit.confirm_password') }}</label>
            <input type="password" id="password_confirmation" name="password_confirmation">

            <button type="submit">{{ __('profile_edit.update') }}</button>
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
