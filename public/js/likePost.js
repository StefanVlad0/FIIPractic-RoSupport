$(document).ready(function() {
    $('.post-votes button').on('click', function(e) {
        var url = $(this).data('href');
        var token = $('meta[name="csrf-token"]').attr('content');
        var heartIcon = $(this).find('.vote-icon');
        var likesDiv = $(this).closest('.post').find('.likes');

        $.ajax({
            url: url,
            method: 'POST',
            data: {_token: token},
            success: function(response) {
                if(response.liked) {
                    heartIcon.addClass('liked fa-solid');
                    likesDiv.text(parseInt(likesDiv.text()) + 1);
                } else {
                    heartIcon.removeClass('liked fa-solid');
                    likesDiv.text(parseInt(likesDiv.text()) - 1);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
                alert('A apărut o eroare!');
            }
        });
    });
});
