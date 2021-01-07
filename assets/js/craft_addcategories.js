$(document).ready(function () {

    $(document).on('click', '#add_craft', function (e) {
        $('.progress-hidex').hide();
        $('.progress-hidec').hide();
        $('.progress-hidez').hide();
        e.stopPropagation();
        var craft_view = $(this).data('craft');

        $.ajax({
            url: 'core/ajax_db/craft_addcategories.php',
            method: 'POST',
            dataType: 'text',
            data: {
                craft_view: craft_view,
            }, success: function (response) {
                $(".popupTweet").html(response);
                $(".close-imagePopup").click(function () {
                    $(".craft-popup").hide();
                });
                console.log(response);
            }
        });
    });

    $(document).on('click', '#craft-readmore', function (e) {
        e.stopPropagation();
        var craft_id = $(this).data('craft');

        $.ajax({
            url: 'core/ajax_db/craft_readmore.php',
            method: 'POST',
            dataType: 'text',
            data: {
                craft_id: craft_id,
            }, success: function (response) {
                $(".popupTweet").html(response);
                $(".close-imagePopup").click(function () {
                    $(".craft-popup").hide();
                });
                console.log(response);
            }
        });
    });

    
    $(document).on('click', '#contacts_business', function (e) {

        e.stopPropagation();
        var contacts_business = $(this).data('contacts');

        $.ajax({
            url: 'core/ajax_db/contact',
            method: 'POST',
            dataType: 'text',
            data: {
                contacts_business: contacts_business,
            }, success: function (response) {
                $(".popupTweet").html(response);
                $(".close-imagePopup").click(function () {
                $(".house-popup").hide();
                });
                // console.log(response);
            }
        });
    });


    $(document).on('click', '#form-craft', function (e) {
        // event.preventDefault();
        e.stopPropagation();
        var title = $('#title');
        var authors = $('#authors');
        var additioninformation = $('#addition-information');
        var photo = $('#photo');
        var other_photo = $('#other-photo');
        var video = $('#video');
        var youtube = $('#youtube');
        var categories_craft = $('#categories_craft');
        var price = $('#price');
        var phone = $('#phone');
        var province = $('.provincecode');
        var districts = $('.districtcode');
        var sector = $('.sectorcode');
        var cell = $('.codecell');
        var village = $('.CodeVillage');
        var photo_Titleo0 = $('#photo-Titleo0');
        var photo_Title0 = $('#photo-Title0');
        var photo_Title1 = $('#photo-Title1');
        var photo_Title2 = $('#photo-Title2');
        var photo_Title3 = $('#photo-Title3');
        var photo_Title4 = $('#photo-Title4');
        var photo_Title5 = $('#photo-Title5');
        var code = $('#code');


        if (isEmpty(province) && isEmpty(districts) &&
            isEmpty(sector) && isEmpty(cell) && isEmpty(village) && isEmpty(authors) && isEmpty(phone) &&
            isEmpty(categories_craft) && isEmpty(code) && isEmpty(price) && isEmpty(additioninformation) && isEmpty(photo) &&
            isEmpty(other_photo) && isEmpty(photo_Titleo0) && isEmpty(photo_Title0) && isEmpty(photo_Title1) &&
            isEmpty(photo_Title2) && isEmpty(photo_Title3) && isEmpty(photo_Title4) && isEmpty(photo_Title5)) {

            var extensions3 = $('#photo').val().split('.').pop().toLowerCase();
            var extensions4 = $('#other-photo').val().split('.').pop().toLowerCase();

            if (jQuery.inArray(extensions3, ['gif', 'png', 'jpg', 'mp4', 'mp3', 'jpeg', 'bmp', 'pdf', 'doc', 'ppt', 'docx', 'xlsx', 'xls', 'zip']) == -1) {
                $("#responseSubmitfood").html('Invalid Image File').fadeIn();
                setInterval(function () {
                    $("#responseSubmitfood").fadeOut();
                }, 4000);
                $('#photo').val('');
                return false;
            } else if (jQuery.inArray(extensions4, ['gif', 'png', 'jpg', 'mp4', 'mp3', 'jpeg', 'bmp', 'pdf', 'doc', 'ppt', 'docx', 'xlsx', 'xls', 'zip']) == -1) {
                $("#responseSubmitfood").html('Invalid Image File').fadeIn();
                setInterval(function () {
                    $("#responseSubmitfood").fadeOut();
                }, 4000);
                $('#other-photo').val('');
                return false;
            } else {
                $.ajax({
                    url: 'core/ajax_db/craft_addcategories.php',
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    xhr: function () {
                        var xhr = new XMLHttpRequest();
                        xhr.upload.addEventListener('progress', function (e) {
                            var progress = Math.round((e.loaded / e.total) * 100);
                            $('.progress-hidex').show();
                            $('.progress-hidec').show();
                            $('.progress-hidez').show();
                            $('#prox').css('width', progress + '%');
                            $('#proc').css('width', progress + '%');
                            $('#proz').css('width', progress + '%');
                            $('#prox').html(progress + '%');
                            $('#proc').html(progress + '%');
                            $('#proz').html(progress + '%');
                        });

                        xhr.addEventListener('load', function (e) {
                            $('.progress-bar').removeClass('bg-info').addClass('bg-success').html('<span>upload completed  <span class="fa fa-check"></span></span>');
                        });
                        return xhr;
                    },
                    success: function (response) {
                        $("#responseSubmitfood").html(response).fadeIn();
                        setInterval(function () {
                            $("#responseSubmitfood").fadeOut();
                        }, 2000);
                        setInterval(function () {
                            // location.reload();
                        }, 2400);
                    }, error: function (response) {
                        $("#responseSubmitfood").html(response).fadeIn();
                        setInterval(function () {
                            $("#responseSubmitfood").fadeOut();
                        }, 3000);
                    }
                });
                return false;
            }
        }
    });
    

    $(document).on('click', '#submit_clientToAgent', function (e) {
        e.preventDefault();
        var form_id = $('#form_agentMessage');
        // e.stopPropagation();
        var name = $('#name_clientToAgent');
        var email = $('#email_clientToAgent');
        // var phone = $('#phone_clientToAgent');
        var message = $('#message_clientToAgent');
        
        if (isEmpty(message) && isEmpty(name) && isEmpty(email)) {
         
            $.ajax({
                    url: 'core/ajax_db/craft_readmore',
                    method: "POST",
                    data: form_id.serialize(),
                    success: function (response) {
                        $("#responseAgentMessage").html(response).fadeIn();
                        setInterval(function () {
                            $("#responseAgentMessage").fadeOut();
                        }, 2500);
                        setInterval(function () {
                            window.location.reload();
                            // location.reload();
                        }, 2800);
                    }, error: function (response) {
                        $("#responseAgentMessage").html(response).fadeIn();
                        setInterval(function () {
                            $("#responseAgentMessage").fadeOut();
                        }, 3000);
                    }
                });
                return false;
          
            }
    });

    $(document).on('click', '#customer_review_client', function (e) {
        e.preventDefault();
        var form_id = $('#form_Message');
        // e.stopPropagation();
        var name = $('#name_client');
        var email = $('#email_client');
        var message = $('#message_client');
        
        if (isEmpty(message) && isEmpty(name) && isEmpty(email) ) {
         
            $.ajax({
                    url: 'core/ajax_db/craft_readmore',
                    method: "POST",
                    data: form_id.serialize(),
                    success: function (response) {
                        $("#responseMessage").html(response).fadeIn();
                        setInterval(function () {
                            $("#responseMessage").fadeOut();
                        }, 2500);
                        setInterval(function () {
                            window.location.reload();
                            // location.reload();
                        }, 2800);
                    }, error: function (response) {
                        $("#responseMessage").html(response).fadeIn();
                        setInterval(function () {
                            $("#responseMessage").fadeOut();
                        }, 3000);
                    }
                });
                return false;
          
            }
    });


    
    $(document).on('click', '#newslatter_form_submit', function (e) {
        e.stopPropagation();
        var email = $('#newslatter_email_client');
        var form_id = $('#newslatter_form');

        
        if (isEmpty(email)) {
         
            $.ajax({
                    url: 'core/ajax_db/craft_readmore',
                    method: "POST",
                    data: form_id.serialize(),
                    success: function (response) {
                        $("#responseNewslatter").html(response).fadeIn();
                        setInterval(function () {
                            $("#responseNewslatter").fadeOut();
                        }, 3500);
                        setInterval(function () {
                            window.location.reload();
                            // location.reload();
                        }, 3800);
                    }, error: function (response) {
                        $("#responseNewslatter").html(response).fadeIn();
                        setInterval(function () {
                            $("#responseNewslatter").fadeOut();
                        }, 3000);
                    }
                });
                return false;
          
            }
    });


    $(document).on('click', '.imagefoodViewPopup', function (e) {
        e.stopPropagation();
        var food_id = $(this).data('fund');
        $.ajax({
            url: 'core/ajax_db/foodImageViewPopup.php',
            method: 'POST',
            dataType: 'text',
            data: {
                showpimage: food_id,
            }, success: function (response) {
                $(".popupTweet").html(response);
                $(".close-imagePopup").click(function () {
                    $(".img-popup").hide();
                });
                console.log(response);
            }
        });
    });
});


function contact_business(key) {
    var name_client_ = $("#name_client_0");
    var email_client_ = $("#email_client_0");
    var phone_client_ = $("#phone_client_0");
    var messages_client_ = $("#messages_client_0");
    //   use 1 or second method to validaton
    if (isEmpty(name_client_) && isEmpty(email_client_) && isEmpty(phone_client_) &&  isEmpty(messages_client_)
    ) {
        //    alert("complete register");
        $.ajax({
            url: 'core/ajax_db/contact',
            method: "POST",
            dataType: "text",
            data: {
                key: key,
                name_client_: name_client_.val(),
                email_client_: email_client_.val(),
                phone_client_: phone_client_.val(),
                messages_client_: messages_client_.val(),
            },
            success: function(response) {
                $("#responses").html(response);
                // console.log(response);
                if (response.indexOf('SUCCESS') >= 0) {
                    setInterval(() => {
                        window.location.reload();
                        // location.reload();
                    }, 1500);
                }else {
                   isEmptys(name_client_) || isEmptys(email_client_) 
                }
            }
        });
    }
}





function isEmpty(caller) {
    if (caller.val() == "") {
        caller.css("outline", "1px solid red");
        return false;
    } else {
        caller.css("outline", "1px solid green ");
    }
    return true;
}

function isEmptys(caller) {
    if (caller.val() != "") {
        caller.css("outline", "1px solid red");
        return false;
    }
    return true;
}
