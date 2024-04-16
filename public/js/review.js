function fillReviewStars(count) {
    for (var i = 0; i < count; i++) {
        $('.review-section.stars .fa-star').eq(i).addClass('fa-solid');
    }
    $('#rating').val(count);
}

function resetReviewStars() {
    $('.review-section.stars .fa-star').removeClass('fa-solid');
    $('#rating').val(0);
}

