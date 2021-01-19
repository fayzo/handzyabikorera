$(document).ready(function() {
    
    $(document).on('click', '#form-checkout', function (e) {
        // event.preventDefault();
        e.stopPropagation();

        var cc_cvv = $('#cc-cvv');


        if (isEmpty(cc_cvv)){

                $.ajax({
                    url: 'core/ajax_db/checkout.php',
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        $("#responseSubmit").html(response).fadeIn();
                        setInterval(function () {
                            $("#responseSubmit").fadeOut();
                        }, 2000);
                        setInterval(function () {
                            // location.reload();
                            window.location = 'invoice_list';
                        }, 2400);
                    }, error: function (response) {
                        $("#responseSubmit").html(response).fadeIn();
                        setInterval(function () {
                            $("#responseSubmit").fadeOut();
                        }, 3000);
                    }
                });

                }
        });

        $(document).on('click', '#view_clients_order', function (e) {
            e.stopPropagation();
            var user = $(this).data('user');
            var order = $(this).data('order');
            var datetime = $(this).data('datetime');

            $.ajax({
                url: 'core/ajax_db/shipping_order',
                method: 'POST',
                dataType: 'text',
                data: {
                    user: user,
                    order: order,
                    datetime: datetime
                }, success: function (response) {
                    $(".popupTweet").html(response);
                    $(".close-imagePopup").click(function () {
                        $(".craft-popup").hide();
                    });
                    // console.log(response);
                }
            });
        });
});