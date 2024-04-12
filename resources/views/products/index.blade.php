@extends('layouts.master')

@section('title')
    Products
@endsection

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/postStyles.css') }}">
@endsection

@section('content')
    <h2>Hello, {{ \Illuminate\Support\Facades\Auth::user()->name }}!</h2>

    <div class="posts-container">
        @foreach($products as $product)
            <div class="post">
                <div>
                    <div class="product-info">
                        <div class="info-section">
                            <a href="{{ route('users.show', $product->user->name) }}" class="user-info">
                                @if($product->user->profile_image)
                                    <img src="{{ asset('images/' . $product->user->profile_image) }}" alt="User profile image" style="width: 35px; height: 35px; border-radius: 50%;">
                                @else
                                    <div>
                                        <i class="fas fa-user-circle user-icon" style="font-size: 30px;"></i>
                                    </div>
                                @endif
                                <span><strong>{{ $product->user->name }}</strong></span>
                            </a>
                        </div>
                        <div class="info-section stars">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                    </div>
                    <p>{{ $product->description }}</p>
                    @if($product->image1)
                        <img src="{{ asset('images/' . $product->image1) }}" alt="Post image">
                    @endif
                    <div class="comments-section">
                        <button>Comanda</button>
                    </div>
                </div>
            </div>
        @endforeach
    <div>

@endsection
