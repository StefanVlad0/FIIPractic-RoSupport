@extends('layouts.master')

@section('title')
    Homepage
@endsection

@section('head')
    <link rel="stylesheet" href="{{ asset('css/postStyles.css') }}">
@endsection

@section('content')
<h2>Hello, {{ \Illuminate\Support\Facades\Auth::user()->name }}!</h2>


<div class="posts-container">
    <a href="{{ route('posts.create') }}" class="post">
        @if(\Illuminate\Support\Facades\Auth::user()->profile_image)
            <div class="create-post-container">
                <img src="{{ asset('images/' . \Illuminate\Support\Facades\Auth::user()->profile_image) }}" alt="User profile image" style="width: 35px; height: 35px; border-radius: 50%;">
                <div class="create-post">
                    Create a post
                </div>
            </div>
        @else
            <div class="create-post-container">
                <div>
                    <i class="fas fa-user-circle user-icon" style="font-size: 30px;"></i>
                </div>
                <div class="create-post">
                    Create a post
                </div>
            </div>
        @endif
    </a>
@foreach($posts as $post)
        <div class="post">
            <div class="post-votes">
                <i class="fas fa-up-long vote-icon"></i>
                <div class="likes">{{ $post->likes }}</div>
                <i class="fas fa-down-long vote-icon"></i>
            </div>
            <div>
                <a href="{{ route('users.show', $post->user->name) }}" class="user-info">
                    @if($post->user->profile_image)
                        <img src="{{ asset('images/' . $post->user->profile_image) }}" alt="User profile image" style="width: 35px; height: 35px; border-radius: 50%;">
                    @else
                        <div>
                            <i class="fas fa-user-circle user-icon" style="font-size: 30px;"></i>
                        </div>
                    @endif
                    <span><strong>{{ $post->user->name }}</strong></span>
                </a>

                <h3>{{ $post->title }}</h3>
                <p>{{ $post->description }}</p>
                @if($post->image)
                    <img src="{{ asset('images/' . $post->image) }}" alt="Post image">
                @endif
                <div class="comments-section">
                    <i class="far fa-message message-icon"></i>
                    <span class="comments-count">0 Comments</span>
                </div>
            </div>
        </div>
@endforeach
</div>
@endsection
