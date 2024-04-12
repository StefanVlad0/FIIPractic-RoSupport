@extends('layouts.master')

@section('title')
    Create Post
@endsection

@section('head')
    <link rel="stylesheet" href="{{ asset('css/createPostStyles.css') }}">
@endsection

@section('content')
    <div class="post-form-container">
        <h2>Create a new post</h2>

        <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="image">Upload Image</label>
                <input type="file" class="form-control-file" id="image" name="image">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

@endsection
