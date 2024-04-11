@extends('layouts.master')

@section('title')
    {{ $user->name }}'s profile
@endsection

@section('head')
    <link rel="stylesheet" href="{{ asset('css/profileStyles.css') }}">
@endsection

@section('content')
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
    </div>
@endsection
