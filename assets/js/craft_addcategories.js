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

    $(document).on('click', '#food-readmore', function (e) {
        e.stopPropagation();
        var food_id = $(this).data('food');

        $.ajax({
            url: 'core/ajax_db/food_readmores.php',
            method: 'POST',
            dataType: 'text',
            data: {
                food_id: food_id,
            }, success: function (response) {
                $(".popupTweet").html(response);
                $(".close-imagePopup").click(function () {
                    $(".food-popup").hide();
                });
                console.log(response);
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
