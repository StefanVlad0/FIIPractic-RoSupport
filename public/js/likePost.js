$(document).ready(function() {
    $('.post-votes button').on('click', function(e) {
        console.log("Ai apasat butonul!");
        var url = $(this).data('href');
        var token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: url,
            method: 'POST',
            data: {_token: token},
            success: function(response) {
                if(response.liked) {
                    alert('Ai dat like la postare!');
                } else {
                    alert('Ai retras like-ul de la postare!');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
                alert('A apărut o eroare!');
            }

        });
    });
});
