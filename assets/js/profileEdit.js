
//  START OF UPLOAD IMAGE CONTENT
$(document).ready(function () {
    //If image edit link is clicked
    $("#edit_linkUpload").on('click', function (e) {
        e.preventDefault();
        $("#fileInput:hidden").trigger('click');
    });
 
    $("#fileInput").on('change', function () {
        var image = $('#fileInput').val();
        var img_ex = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

        //validate file type
        if (!img_ex.exec(image)) {
            alert('Please upload only .jpg/.jpeg/.png/.gif file.');
            $('#fileInput').val('');
            return false;
        } else {
            $("#picUploadForm").submit();
        }
    });

    //On ADMIN USERS CHANGE PHOTO select file to upload

    $("#edit_linkUpload_").on('click', function (e) {
        e.preventDefault();
        $("#fileInput_:hidden").trigger('click');
    });
    //On BUSINESS LOGO select file to upload

    $("#fileInput_").on('change', function () {
        var image = $('#fileInput_').val();
        var img_ex = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

        //validate file type
        if (!img_ex.exec(image)) {
            alert('Please upload only .jpg/.jpeg/.png/.gif file.');
            $('#fileInput_').val('');
            return false;
        } else {
            $("#picUploadForm_").submit();
        }
    });

});


function completeUpload(success, fileName) {
    if (success == $('#edit_profile').val()) {
        $('#imagePreview').attr("src", "");
        $('#imagePreview').attr("src", fileName);
        $('#fileInput').attr("value", fileName);
        console.log(success);
        console.log(fileName);

    } else if (success == $('#edit_profile_').val()) {
        //On ADMIN USERS CHANGE PHOTO select file to upload
        $('#imagePreview_').attr("src", "");
        $('#imagePreview_').attr("src", fileName);
        $('#fileInput_').attr("value", fileName);
        setInterval(() => {
            // window.location = '../index';
            location.reload();
        }, 1500);
        console.log(success);
        console.log(fileName);

    } else {
        alert('There was an error during file upload!');
    }
    return true;
}


function careers(key) {
    var id = $("#id_career");
    var firstname = $("#firstname");
    var lastname = $("#lastname");
    var email = $("#email");
    var telephone = $("#telephone");
    var twitter = $("#twitter");
    var facebook = $("#facebook");
    var instagram = $("#instagram");
        $.ajax({
            url: 'core/ajax_db/profileEditFectchimage',
            method: "POST",
            dataType: "text",
            data: {
                key: key,
                id: id.val(),
                firstname: firstname.val(),
                lastname: lastname.val(),
                email : email.val(),
                telephone : telephone.val(),
                twitter : twitter.val(),
                facebook : facebook.val(),
                instagram : instagram.val(),
            },
            success: function (response) {
                // console.log(response);
                if (response.indexOf('SUCCESS') >= 0) {
                    // setInterval(function() {
                    //     location.reload();
                    // }, 2000);
                    $("#respone-success").html(response);
                } else {
                    $("#response").html(response);
                }
            }
        });
}
    
function aboutMe(key) {
    var id = $('#id_aboutMe');
    var location = $('#location');
    var skills = $('#skills');
    var notes = $('#notes');

        $.ajax({
            url: 'core/ajax_db/profileEditFectchimage',
            method: "POST",
            dataType: "text",
            data: {
                key: key,
                id: id.val(),
                location: location.val(),
                skills: skills.val(),
                notes: notes.val(),
            },
            success: function (response) {
                // console.log(response);
                if (response.indexOf('SUCCESS') >= 0) {
                    // setInterval(function() {
                    //     location.reload();
                    // }, 2000);
                    $("#responses").html(response);
                } else {
                    $("#responses").html(response);
                }
            }
        });
    }
 
    // admin edit

    function business_details(key) {
        var id = $("#id_career");
        var name = $("#business_name");
        var email = $("#email_business");
        var phone = $("#phone_business");
        var twitter = $("#twitter");
        var facebook = $("#facebook");
        var instagram = $("#instagram");
        var google = $("#google");
        var address = $("#map_businesss");

            $.ajax({
                url: 'core/ajax_db/profileEditFectchimage',
                method: "POST",
                dataType: "text",
                data: {
                    key: key,
                    id: id.val(),
                    name: name.val(),
                    email: email.val(),
                    phone : phone.val(),
                    twitter : twitter.val(),
                    facebook : facebook.val(),
                    instagram : instagram.val(),
                    google : google.val(),
                    address : address.val(),
                },
                success: function (response) {
                    // console.log(response);
                    if (response.indexOf('SUCCESS') >= 0) {
                        // setInterval(function() {
                        //     location.reload();
                        // }, 2000);
                        $("#respone-success").html(response);
                    } else {
                        $("#respone-success").html(response);
                    }
                }
            });
    }
        