@extends('layouts.master')

@section('title')
    {{ $user->name }}'s profile
@endsection

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/profileStyles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/postStyles.css') }}">
@endsection

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="profile-container">
        <div class="profile-info">
            <div class="profile-details">
                <?php if($user->profile_image): ?>
                <img src="<?php echo e(asset('images/' . $user->profile_image)); ?>" alt="Profile Image" class="profile-image">
                <?php else: ?>
                <i class="fas fa-circle-user profile-icon"></i>
                <?php endif; ?>
                <div class="details">
                    <h2>{{ $user->name }}</h2>
                    <p>Email: {{ $user->email }}</p>
                </div>
            </div>
            <p style="align-self:flex-start;">Biography:</p>
            <div class="profile-bio-container">
                <div class="profile-bio">
                    <p>{{ $user->bio ?? 'No biography' }}</p>
                </div>
            </div>
            @if($user->id !== auth()->id())
                <a href="{{ route('message.create', ['name' => $user->name]) }}" class="message-button">Send message</a>
            @endif
        </div>
        @foreach($user->posts()->orderBy('created_at', 'desc')->get() as $post)
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
