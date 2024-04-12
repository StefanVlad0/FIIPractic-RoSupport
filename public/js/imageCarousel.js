$(document).ready(function() {
    $('.next').click(function() {
        var currentImage = $('.product-image:visible');
        var nextImage = currentImage.next('.product-image');

        if(nextImage.length == 0) {
            nextImage = $('.product-image:first');
        }

        currentImage.hide();
        nextImage.show();
    });

    $('.prev').click(function() {
        var currentImage = $('.product-image:visible');
        var prevImage = currentImage.prev('.product-image');

        if(prevImage.length == 0) {
            prevImage = $('.product-image:last');
        }

        currentImage.hide();
        prevImage.show();
    });
});
