@extends('layouts.master')

@section('title')
    {{ $post->description }}
@endsection

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/postStyles.css') }}">
@endsection

@section('content')
    <div class="posts-container">
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
                        <span class="comments-count">{{ $post->comments->count() }} {{ $post->comments->count() === 1 ? 'Comment' : 'Comments' }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="post">
            <form action="{{ route('posts.comments.store', $post) }}" method="POST">
                @csrf
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <div class="form-group">
                    <label for="body">Add comment:</label><br>
                    <textarea class="form-control" id="body" name="body" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="post">
            <div class="comments">
            <h4>Comments:</h4>
                @php
                    $comments = $post->comments->sortByDesc('created_at');
                @endphp
                @if ($post->comments->count() > 0)
                    @foreach ($comments as $comment)
                        <div>
                            <a href="{{ route('users.show', $comment->user->name) }}" class="user-info">
                                @if($comment->user->profile_image)
                                    <img src="{{ asset('images/' . $comment->user->profile_image) }}" alt="User profile image" style="width: 35px; height: 35px; border-radius: 50%;">
                                @else
                                    <div>
                                        <i class="fas fa-user-circle user-icon" style="font-size: 30px;"></i>
                                    </div>
                                @endif
                                <strong><span class="comment-user">{{ $comment->user->name }}</span></strong>
                            </a>
                            <p style="margin-left: 45px;">{{ $comment->body }}</p>
                        </div>
                    @endforeach
                @else
                    <p>No comments yet.</p>
                @endif
            </div>
        </div>
    </div>

    <script src="{{ asset('js/likePost.js') }}"></script>
@endsection
