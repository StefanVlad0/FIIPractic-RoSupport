@extends('layouts.master')

@section('title')
    Messenger
@endsection

@section('content')

    <div class="message-frame">
        <div class="receiver-name">
            <h2><i class="fas fa-circle-user"></i> {{ $receiver->name }}</h2>
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
    <form method="POST" action="/message/{{ $receiver->name }}">
        @csrf
        <textarea name="content" class="message-input"></textarea>
        <button type="submit">Trimite</button>
    </form>
</div>

@endsection
