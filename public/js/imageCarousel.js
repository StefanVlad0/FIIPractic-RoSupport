$(document).ready(function() {
    $('.next').click(function() {
        var carouselId = $(this).closest('.post').attr('id').replace('post-', 'carousel-');
        var currentImage = $('#' + carouselId + ' .product-image:visible');
        var nextImage = currentImage.next('.product-image');

        if(nextImage.length == 0) {
            nextImage = $('#' + carouselId + ' .product-image:first');
        }

        currentImage.hide();
        nextImage.show();
    });

    $('.prev').click(function() {
        var carouselId = $(this).closest('.post').attr('id').replace('post-', 'carousel-');
        var currentImage = $('#' + carouselId + ' .product-image:visible');
        var prevImage = currentImage.prev('.product-image');

        if(prevImage.length == 0) {
            prevImage = $('#' + carouselId + ' .product-image:last');
        }

        currentImage.hide();
        prevImage.show();
    });
});
