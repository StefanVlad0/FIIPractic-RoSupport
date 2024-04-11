@extends('layouts.master')

@section('title')
    Invitation
@endsection

@section('head')
    <link rel="stylesheet" href="{{ asset('css/loginFormStyles.css') }}">
@endsection

@section('content')
    <h1>Ai fost invitat de către utilizatorul {{ $inviter->name }}</h1>

    <div class="login-form-container">
        <h2>Register</h2>
        <form action="/register" method="POST">
            @csrf
            <input type="hidden" name="inviter_id" value="{{ $inviter->id }}">
            <label for="name">Username</label>
            <input type="text" id="name" name="name">
            <label for="email">Email</label>
            <input type="email" id="email" name="email">
            <label for="password">Password</label>
            <input type="password" id="password" name="password">
            <label for="password_confirmation">Confirm password</label>
            <input type="password" id="password_confirmation" name="password_confirmation">
            <button type="submit">Register</button>
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
