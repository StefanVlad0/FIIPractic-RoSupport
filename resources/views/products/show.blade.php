@extends('layouts.master')

@section('title')
    {{ $product->description }}
@endsection

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/postStyles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ratingStyles.css') }}">
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
                    <p class="promoted">- {{ __('products_show.promoted') }} -</p>
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
                    <form action="{{ route('products.order', $product->id) }}" method="POST">
                        @csrf
                        <input type="hidden" id="quantity" name="quantity" value="0">
                        <button type="submit">{{ __('products_show.order') }}</button>
                    </form>
                </div>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
        <div class="post">
            <div class="add-review">
                <p>{{ __('products_show.add_review') }}</p>
                <div class="review-section stars" id="reviewStars">
                    @for ($i = 1; $i <= 5; $i++)
                        <i class="fa-regular fa-star" data-rating="{{ $i }}" onmouseover="fillReviewStars({{ $i }})" onmouseout="resetReviewStars()" onclick="submitReview({{ $i }})"></i>
                    @endfor
                </div>
                <div class="review-section">
                    <textarea name="content" id="reviewContent" rows="3" placeholder="{{ __('products_show.add_your_review') }}"></textarea>
                    <div id="reviewMessage" style="margin-top: 10px;"></div>
                </div>
            </div>
        </div>
        <div class="post">
            <div id="reviewsList">
                <h2>{{ __('products_show.reviews') }}</h2>
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
            document.getElementsByName('quantity')[0].value = quantity + 1;
            updateTotalPrice();
        }

        function decreaseQuantity() {
            var quantity = parseInt(quantityInput.value);
            if (quantity > 0) {
                quantityInput.value = quantity - 1;
                document.getElementsByName('quantity')[0].value = quantity - 1;
                updateTotalPrice();
            }
        }



        function updateTotalPrice() {
            var quantity = parseInt(quantityInput.value);
            totalPriceDisplay.textContent = quantity * price;
        }
    </script>

    <script>
        function submitReview(rating) {
            var content = $('#reviewContent').val().trim();

            if (!content) {
                content = null;
            }

            $.ajax({
                url: '{{ route("reviews.store") }}',
                type: 'POST',
                data: {
                    rating: rating,
                    content: content,
                    product_id: {{ $product->id }},
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#reviewMessage').text('Review submitted successfully');
                },
                error: function(error) {
                    $('#reviewMessage').text('Error submitting review. Please try again later.');
                }
            });
        }
    </script>

    <script>
        $(document).ready(function() {
            $.ajax({
                url: '{{ route("reviews.index", $product->id) }}',
                type: 'GET',
                dataType: 'json',
                success: function(reviews) {
                    reviews.forEach(function(review) {
                        var postedAt = new Date(review.created_at);
                        var formattedDate = postedAt.toLocaleDateString('en-US', {
                            day: 'numeric',
                            month: 'long',
                            year: 'numeric'
                        });

                        var starsHtml = '<div class="review-stars">';
                        for (var i = 1; i <= 5; i++) {
                            if (i <= review.rating) {
                                starsHtml += '<i class="fa-solid fa-star"></i>';
                            } else {
                                starsHtml += '<i class="fa-regular fa-star"></i>';
                            }
                        }

                        starsHtml += '</div>';

                        var reviewHtml = '<div class="review">' +
                            '<a href="/users/' + review.user.name + '">' +
                            '<div class="review-user-info">';

                        if (review.user.profile_image) {
                            reviewHtml += '<img src="/images/' + review.user.profile_image + '" alt="User Profile Image" class="profile-image" style="width: 35px; height: 35px; border-radius: 50%;">';
                        } else {
                            reviewHtml += '<i class="fas fa-user-circle" style="font-size: 30px;"></i>';
                        }


                        reviewHtml +=
                            '<p><strong>' + review.user.name + '</strong> </p>' +
                            '</div>' +
                            '</a>' +
                            '<p>' + starsHtml + '</p>' +
                            '<p>' + review.content + '</p>' +
                            '<p><strong>{{ __('products_show.posted_at') }}:</strong> ' + formattedDate + '</p>' +
                            '</div>';

                        $('#reviewsList').append(reviewHtml);

                    });
                },
                error: function(error) {
                    console.error('Error fetching reviews:', error);
                }
            });
        });
    </script>

@endsection


<script src="{{ asset('js/review.js') }}"></script>
