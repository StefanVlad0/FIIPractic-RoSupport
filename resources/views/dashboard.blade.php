@extends('layouts.master')

@section('title')
    Homepage
@endsection

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/postStyles.css') }}">
@endsection

@section('content')

    <div class="navigation">
        <a href="{{ url('/products') }}">Products</a>
        <a href="{{ url('/') }}" class="activeButton">Posts</a>
    </div>

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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


@foreach($posts as $post)
        <div class="post">
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
                    <div class="post-votes">
                        <button data-href="{{ route('posts.like', $post->id) }}">
                            <i class="fa-regular fa-heart vote-icon {{ $post->isLikedBy(\Illuminate\Support\Facades\Auth::user()) ? 'liked fa-solid' : '' }}"></i>
                        </button>

                        <div class="likes" id="likes-{{ $post->id }}">{{ $post->likes }}</div>
                    </div>
                    <div>
                        <i class="far fa-message message-icon"></i>
                        <span class="comments-count">0 Comments</span>
                    </div>
                </div>
            </div>
        </div>
@endforeach
</div>

<script src="{{ asset('js/likePost.js') }}"></script>
@endsection
