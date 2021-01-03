$(document).ready(function () {
    $(document).on('click', '.like-btn', function () {
        var craft_id = $(this).data('craft');
        var user_id = $(this).data('user');
        var likescounter = $(this).find('.likescounter');
        var counter = likescounter.text();
        var button = $(this);

        $.ajax({
            url: 'core/ajax_db/likes',
            method: 'POST',
            dataType: 'text',
            data: {
                like: craft_id,
                user_id: user_id,
            }, success: function (response) {
                likescounter.show();
                button.addClass('unlike-btn');
                button.removeClass('like-btn');
                counter++;
                likescounter.text(counter++);
                button.find('.fa-heart-o').addClass('fa-heart').css('color', 'red');
                button.find('.fa-heart').removeClass('fa-heart-o');

                // location.reload();

                // console.log(response);
            }
        });
    });
});

$(document).ready(function () {
    $(document).on('click', '.unlike-btn', function () {
        var craft_id = $(this).data('craft');
        var user_id = $(this).data('user');
        var likescounter = $(this).find('.likescounter');
        var counter = likescounter.text();
        var button = $(this);

        $.ajax({
            url: 'core/ajax_db/likes',
            method: 'POST',
            dataType: 'text',
            data: {
                unlike: craft_id,
                user_id: user_id,
            }, success: function (response) {
                likescounter.show();
                button.addClass('like-btn');
                button.removeClass('unlike-btn');
                counter--;
                if (counter === 0) {
                    likescounter.hide();
                } else {
                    likescounter.text(counter--);
                }
                button.find('.fa-heart').addClass('fa-heart-o').css('color', '#007bff');
                button.find('.fa-heart-o').removeClass('fa-heart');

                // console.log(response);
            }
        });
    });
});