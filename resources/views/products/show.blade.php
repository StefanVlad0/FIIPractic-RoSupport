@extends('layouts.master')

@section('title')
    {{ $product->description }}
@endsection

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/postStyles.css') }}">
@endsection

@section('content')
    <div class="posts-container">
        <div class="post" id="post-{{ $product->id }}">
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
                    <div class="info-section stars" onclick="window.location='{{ route('products.show', $product->id) }}'">
                        <span class="rating-number">{{ round($product->rating, 1) }}</span>
                        @for ($i = 0; $i < floor($product->rating); $i++)
                            <i class="fa-solid fa-star"></i>
                        @endfor
                        @if ($product->rating - floor($product->rating) >= 0.5)
                            <i class="fa-solid fa-star"></i>
                            @php $i++ @endphp
                        @endif
                        @while ($i++ < 5)
                            <i class="fa-regular fa-star"></i>
                        @endwhile
                    </div>
                </div>
                @if($product->is_promoted && $product->created_at->diffInHours() < 24)
                    <p class="promoted">- PROMOTED -</p>
                @endif
                <p>{{ $product->description }}</p>
                <div class="image-carousel" id="carousel-{{ $product->id }}">
                    @if($product->image1)
                        <img class="product-image" src="{{ asset('images/' . $product->image1) }}" alt="Post image 1">
                    @endif
                    @if($product->image2)
                        <img class="product-image" src="{{ asset('images/' . $product->image2) }}" alt="Post image 2" style="display: none;">
                    @endif
                    @if($product->image3)
                        <img class="product-image" src="{{ asset('images/' . $product->image3) }}" alt="Post image 3" style="display: none;">
                    @endif
                    <button class="prev navigation-button"><i class="fa-solid fa-arrow-left"></i></button>
                    <button class="next navigation-button"><i class="fa-solid fa-arrow-right"></i></button>
                </div>
                <div class="comments-section">
                    <div class="price"><strong>{{ $product->price }} lei</strong></div>
                    <div class="quantity-selector">
                        <button id="minus-btn" onclick="decreaseQuantity()">-</button>
                        <input type="text" id="quantity" value="0" readonly>
                        <button id="plus-btn" onclick="increaseQuantity()">+</button>
                    </div>
                    <div class="total-price">Total: <span id="total-price">0</span> lei</div>
                    <button onclick="window.location='{{ route('products.show', $product->id) }}'">Comanda</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/imageCarousel.js') }}"></script>
    <script>
        var price = {{ $product->price }};
        var quantityInput = document.getElementById('quantity');
        var totalPriceDisplay = document.getElementById('total-price');

        function increaseQuantity() {
            var quantity = parseInt(quantityInput.value);
            quantityInput.value = quantity + 1;
            updateTotalPrice();
        }

        function decreaseQuantity() {
            var quantity = parseInt(quantityInput.value);
            if (quantity > 0) {
                quantityInput.value = quantity - 1;
                updateTotalPrice();
            }
        }

        function updateTotalPrice() {
            var quantity = parseInt(quantityInput.value);
            totalPriceDisplay.textContent = quantity * price;
        }
    </script>
@endsection
