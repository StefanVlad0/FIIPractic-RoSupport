@extends('layouts.master')

@section('title')
    Homepage
@endsection

@section('head')
    <link rel="stylesheet" href="{{ asset('css/postStyles.css') }}">
@endsection

@section('content')
<h2>Hello, {{ \Illuminate\Support\Facades\Auth::user()->name }}!</h2>
<a href="{{ route('posts.create') }}">Create post</a>

<div class="posts-container">
@foreach($posts as $post)
        <div class="post">
                <a href="{{ route('users.show', $post->user->name) }}" class="user-info">
                @if($post->user->profile_image)
                    <img src="{{ asset('images/' . $post->user->profile_image) }}" alt="User profile image" style="width: 35px; height: 35px; border-radius: 50%;">
                @else
                    <i class="fas fa-user-circle"></i>
                @endif
                <span><strong>{{ $post->user->name }}</strong></span>
                </a>

            <h3>{{ $post->title }}</h3>
            <p>{{ $post->description }}</p>
            @if($post->image)
                <img src="{{ asset('images/' . $post->image) }}" alt="Post image">
            @endif
        </div>
@endforeach
</div>
@endsection
