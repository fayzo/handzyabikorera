
$(document).ready(function() {
  
  $(document).on('click','#messages-dropdown-menu',function () {
      
        getmessages = function () {
        var getmessage1=1;

        $.ajax({
                    url: 'core/ajax_db/handmade_cart.php',
                    method: 'POST',
                    dataType: 'text',
                    data: {
                        showMessage1: getmessage1,
                    }, success: function (response) {
                        $("#messages-menu-view").html(response);
                        console.log(response);
                    }
                });
            }

            var timer= setInterval(getmessages, 500);
            getmessages();
            clearInterval(timer);

        });

    
});
