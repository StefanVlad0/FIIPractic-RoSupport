@extends('layouts.master')

@section('title')
    Messenger
@endsection

@section('head')
    <link rel="stylesheet" href="{{ asset('css/messageStyles.css') }}">
@endsection

@section('content')

    <div class="message-frame">
        <div class="receiver-name">
            @if($receiver->profile_image)
                <img src="{{ asset('images/' . $receiver->profile_image) }}" alt="Profile Image" class="profile-image">
            @else
                <i class="fas fa-circle-user profile-icon"></i>
            @endif
            <h2>{{ $receiver->name }}</h2>
        </div>

        <div class="message-container">
            @foreach ($messages as $message)
                <div class="{{ $message->sender_id == auth()->id() ? 'message-right' : 'message-left' }}">
                    <p>{{ $message->content }}</p>
                </div>
            @endforeach
        </div>
    </div>

<div class="message-form">
    <form method="POST" action="/message/{{ $receiver->name }}" style="display: flex;">
        @csrf
        <textarea name="content" class="message-input" style="flex-grow: 1;"></textarea>
        <button type="submit"><i class="fas fa-paper-plane"></i></button>
    </form>
</div>

@endsection
