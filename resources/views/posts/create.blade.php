@extends('layouts.master')

@section('title')
    {{ __('posts_create.create_post') }}
@endsection

@section('head')
    <link rel="stylesheet" href="{{ asset('css/createPostStyles.css') }}">
@endsection

@section('content')
    <div class="post-form-container">
        <h2>{{ __('posts_create.create_post') }}</h2>

        <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="description">{{ __('posts_create.description') }}</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="image">{{ __('posts_create.upload_image') }}</label>
                <input type="file" class="form-control-file" id="image" name="image">
            </div>
            <button type="submit" class="btn btn-primary">{{ __('posts_create.submit') }}</button>
        </form>
    </div>

@endsection
