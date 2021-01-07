
     function viewORedits(rowID, type) {
            $.ajax({
                url: 'core/ajax_db/manage_admin_db',
                method: 'POST',
                dataType: 'json',
                data: {
                    key: 'viewORedit',
                    rowID: rowID
                }, success: function (response) {
                    if (type == "view") {
                        $("#showContent_admin").fadeIn();
                        $("#editContent_admin").fadeOut();
                        $("#profile_image_ADMIN").fadeOut();
                        $(".user_form").fadeOut();
                        $("#firstnameView").html(response.firstname);
                        $("#lastnameView").html(response.lastname);
                        $("#usernameView").html(response.username);
                        $("#passwordView").html(response.password);
                        $("#emailViewz").html(response.email);
                        $("#addressViewz").html(response.location);
                        $("#telephoneView").html(response.telephone);
                        $("#TwitterViewz").html(response.twitter);
                        $("#InstagramViewz").html(response.instagram);
                        $("#FacebookViewz").html(response.facebook);
                        $("#skillViewz").html(response.skills);
                        $("#NoteViewz").html(response.notes);
                        $("#locationViewz").html(response.location);
                        $("#button_admin").fadeOut();
                        $("#closeBtn1").fadeIn();
                    } else {
                        $("#editContent_admin").fadeIn();
                        $("#showContent_admin").fadeOut();
                        $("#profile_image_ADMIN").fadeOut();
                        $(".user_form").fadeOut();
                        $(".image").fadeOut();
                        $("#admin_editRowID").val(rowID);
                        $("#firstname_admin").val(response.firstname);
                        $("#lastname_admin").val(response.lastname);
                        $("#username_admin").val(response.username);
                        $("#password_admin").val(response.password);
                        $("#email_admin").val(response.email);
                        $("#telephone_admin").val(response.telephone);
                        $("#twitter_admin").val(response.twitter);
                        $("#facebook_admin").val(response.facebook);
                        $("#instagram_admin").val(response.instagram);
                        $("#skill_admin").val(response.skills);
                        $("#notes_admin").val(response.notes);
                        $("#location_admin").val(response.location);
                        $("#button_admin").attr('value', 'update').attr('onclick', "ajax_requests('update_Row')").fadeIn();
                        $("#closeBtn1").fadeIn();
                    }
                    $(".modal-title").html(response.firstname);
                    $("#manage_admin_form").modal('show');
                }
            });
        }

        
        function ajax_requests(key) {
            var editRowID = $("#admin_editRowID");
            var firstname = $("#firstname_admin");
            var lastname = $("#lastname_admin");
            var username = $("#username_admin");
            var password = $("#password_admin");
            var email = $("#email_admin");
            var telephone = $("#telephone_admin");
            var twitter = $("#twitter_admin");
            var facebook = $("#facebook_admin");
            var instagram = $("#instagram_admin");
            var location = $("#location_admin");
            var skill = $("#skill_admin");
            var notes = $("#notes_admin");

        $.ajax({
            url: 'core/ajax_db/manage_admin_db',
            method: "POST",
            dataType: "text",
            data: {
                key: key,
                rowID: editRowID.val(),
                firstname: firstname.val(),
                lastname: lastname.val(),
                email : email.val(),
                username : username.val(),
                password : password.val(),
                telephone : telephone.val(),
                twitter : twitter.val(),
                facebook : facebook.val(),
                instagram : instagram.val(),
                skills : skill.val(),
                notes : notes.val(),
                location : location.val(),

            },
                success: function (response) {
                       if (response != "success"){
                           alert('Fail');
                      } else {
                        $("#responseAdmins").html(response);

                        //    $("#firstname_admin"+editRowID.val()).html(firstname.val());
                        //    $("#lastname_admin"+editRowID.val()).html(lastname.val());
                        }
                   }
                });
            }

        
        function deleteRow(rowID,key) {
            if (confirm('Are you sure?')) {
                $.ajax({
                    url: 'core/ajax_db/manage_admin_db',
                    method: 'POST',
                    dataType: 'text',
                    data: {
                        key: key,
                        rowID: rowID
                    }, success: function (response) {
                        if (key == "deleteRow") {
                            $("#firstname"+rowID).parent().remove();
                            alert(response);
                        }else if (key == "deleteRowHouse") {
                            $("#house_n"+rowID).remove();
                            // $("#house_n"+rowID).last().remove();
                            $("#responseHouseD").html(response);

                        }
                        // setInterval(() => {
                        //     // window.location = '../index';
                        //     location.reload();
                        // }, 2500);
                    }
                });
            }
        }

        
        function approved(rowID,approval) {
            if (confirm('Are you sure??')) {
                $.ajax({
                    url: 'core/ajax_db/manage_admin_db',
                    method: 'POST',
                    dataType: 'text',
                    data: {
                        key: approval,
                        rowID: rowID
                    }, success: function (response) {
                        $("#approval"+rowID).html(approval);
                        alert(response);
                        // setInterval(() => {
                        //     // window.location = '../index';
                        //     location.reload();
                        // }, 2500);
                    }
                });
            }
        }
        
        function approvedHouses(rowID,approval) {
            if (confirm('Are you sure??')) {
                $.ajax({
                    url: 'core/ajax_db/manage_admin_db',
                    method: 'POST',
                    dataType: 'text',
                    data: {
                        key: 'approvalHouse',
                        approval: approval,
                        rowID: rowID
                    }, success: function (response) {
                        $("#approvalHouse"+rowID).html(approval);
                        alert(response);
                        // setInterval(() => {
                        //     // window.location = '../index';
                        //     location.reload();
                        // }, 2500);
                    }
                });
            }
        }

        $(document).on('click', '.update_profile_id', function () {
            $('#edit_profile_').val($(this).attr("id"));
            var t = $(this).attr("id");
            console.log(t);
            $.ajax({
                url: 'core/ajax_db/manage_admin_db',
                type: 'post',
                dataType: 'json',
                data: {
                    key: 'image',
                    id: t
                },
                success: function (response) {
                    $('#nameView4').html(response.username);
                    var userPicture = (response.profile_image) ? 'assets/image/users_profile_cover/' + response.profile_image
                        : 'assets/image/user_default_image/defaultprofileimage.png';
                    var userPictureURL = userPicture;
                    $('#imagePreview_').attr('src', userPictureURL);
                    $(".modal-title").html(response.username);
                    $("#manage_admin_form").modal('show');
                    $("#profile_image_ADMIN").fadeIn();
                    $("#showContent_admin").fadeOut();
                    $("#editContent_admin").fadeOut();
                    $("#closeBtn").fadeIn();
                    $("#button_admin").fadeOut();
                    // console.log(response);
                    console.log(userPictureURL);
                }
            });
        });


        // Request A property to business 

        
     function business_msg(rowID, type) {
        $.ajax({
            url: 'core/ajax_db/manage_admin_db',
            method: 'POST',
            dataType: 'json',
            data: {
                key: type,
                rowID: rowID
            }, success: function (response) {
                if (type == "business_message_view" || type == "agent_message_view") {
                    $("#business_message").fadeIn();
                    $("#business_request_home").fadeOut();
                    $("#name_messageView").html(response.name_client);
                    $("#Email_messageView").html(response.email_client);
                    $("#Phone_messageView").html(response.phone_client);
                    $("#Message_messageView").html(response.message_client);
                    $("#message-read-id").val(response.message_id);
                    $("#messageRead"+response.message_id).hide();
                    $("#closeBtn1").fadeIn();
                } else {
                    $("#business_request_home").fadeIn();
                    $("#business_message").fadeOut();
                    $("#name_clientReqView").html(response.name);
                    $("#email_clientReqView").html(response.email);
                    $("#phone_clientReqView").html(response.phone);
                    $("#request_type_clientReqView").html(response.request_type);
                    $("#property_clientReqView").html(response.property_type.replace(/_/g, " "));
                    $("#Equipment_clientReqView").html(response.equipment);
                    $("#Bedroom_clientReqView").html(response.bedroom);
                    $("#Bathroom_clientReqView").html(response.bathroom);
                    $("#Location_clientReqView").html(response.location);
                    $("#Price_clientReqView").html(Number(response.price).toLocaleString());
                    $("#Currency_clientReqView").html(response.currency);
                    $("#date_clientReqView").html(response.datetime);
                    $("#Message_clientReqView").html(response.message_request);
                    $("#closeBtn1").fadeIn();
                }
                $("#House_admin_message").modal('show');
            }
        });
    }

    function deleteRowHouse(rowID,type) {
        if (confirm('Are you sure?')) {
            $.ajax({
                url: 'core/ajax_db/manage_admin_db',
                method: 'POST',
                dataType: 'text',
                data: {
                    key: type,
                    rowID: rowID,
                }, success: function (response) {
                    if (type == "business_message_delete") {
                        $("#name_msg"+rowID).remove();
                        // $("#name_msg"+rowID).last().remove();
                        // $("#name_msg"+rowID).parent().remove();
                    }else if (type == "agent_message_view") {
                        $("#agent_msg"+rowID).remove();
                    }else if (type == "business_request_delete") {
                        $("#name_rq"+rowID).remove();
                    }else if (type == "client_subscribe_delete") {
                        $("#name_subscribe"+rowID).remove();
                    }
                    // setInterval(() => {
                    //     location.reload();
                    // }, 1500);
                }
            });
        }
    }


    function viewOReditHouses(rowID,type) {
            $.ajax({
                url: 'core/ajax_db/house_delete',
                method: 'POST',
                dataType: 'text',
                data: {
                    EditHouseAdmin: type,
                    rowID: rowID,
                }, success: function (response) {
                    $(".popupTweet").html(response);
                    $(".close-imagePopup").click(function () {
                        $(".house-popup").hide();
                    });
                    if (type == "business_message_delete") {
                        $("#name_msg"+rowID).remove();
                        // $("#name_msg"+rowID).last().remove();
                        // $("#name_msg"+rowID).parent().remove();
                    }
                }
            });
    }


    // CUSTOMER REVIEWS

    
    function viewOReditReviews(rowID, type) {
        $.ajax({
            url: 'core/ajax_db/customer_review_viewORedit',
            method: 'POST',
            dataType: 'json',
            data: {
                key: type,
                rowID: rowID
            }, success: function (response) {
                if (type == "viewORedit" || type == "agent_message_view") {

                    $("#showContent_admin_customer_review").fadeIn();
                    $("#editContent_admin_customer_review").fadeOut();
                    $("#nameView_review").html(response.name);
                    $("#emailViewz_review").html(response.email);
                    $("#messageViewz_review").html(response.message);
                    $("#closeBtn2").fadeIn();
                    $("#button_admin0").fadeOut();

                }else {
                    $("#editContent_admin_customer_review").fadeIn();
                    $("#showContent_admin_customer_review").fadeOut();
                    $("#editRowID_review").val(rowID);
                    $("#name_admin").val(response.name);
                    $("#email_admin0").val(response.email);
                    $("#message_admin").val(response.message);
                    $("#button_admin0").attr('value', 'update').attr('onclick', "ajax_requests_CUSTOMER_REVIEWS_('update_Row')").fadeIn();
                    $("#closeBtn2").fadeIn();
                    $("#button_admin0").fadeIn();

                }
                $(".modal-title").html(response.name);
                $("#manage_admin_form1").modal('show');
            }
        });
    }

    
    function ajax_requests_CUSTOMER_REVIEWS_(key) {
        var editRowID = $("#editRowID_review");
        var name = $("#name_admin");
        var email = $("#email_admin0");
        var message = $("#message_admin");

    $.ajax({
        url: 'core/ajax_db/customer_review_viewORedit',
        method: "POST",
        dataType: "text",
        data: {
            key: key,
            rowID: editRowID.val(),
            name: name.val(),
            email : email.val(),
            message : message.val(),
        },
            success: function (response) {
                if (response != "success"){
                       alert('Fail');
                } else {
                    $("#responseAdmins_review").html(response);

                }
                    // console.log(response);
               }
            });
        }

    
    function deleteRow_CUSTOMER_REVIEWS_(rowID,key) {
        if (confirm('Are you sure?')) {
            $.ajax({
                url: 'core/ajax_db/customer_review_viewORedit',
                method: 'POST',
                dataType: 'text',
                data: {
                    key: key,
                    rowID: rowID
                }, success: function (response) {
                    if (key == "deleteRow") {
                        $("#firstname"+rowID).parent().remove();
                        alert(response);
                    }else if (key == "deleteRowHouse") {
                        $("#reviews_n"+rowID).remove();
                        // $("#house_n"+rowID).last().remove();
                        $("#responseHouseD").html(response);

                    }
                    // setInterval(() => {
                    //     // window.location = '../index';
                    //     location.reload();
                    // }, 2500);
                }
            });
        }
    }

    
    function approvedReview_CUSTOMER_REVIEWS_(rowID,approval) {
        if (confirm('Are you sure??')) {
            $.ajax({
                url: 'core/ajax_db/customer_review_viewORedit',
                method: 'POST',
                dataType: 'text',
                data: {
                    key: approval,
                    rowID: rowID
                }, success: function (response) {
                    $("#approvalReview"+rowID).html(approval);
                    alert(response);
                    // setInterval(() => {
                    //     // window.location = '../index';
                    //     location.reload();
                    // }, 2500);
                }
            });
        }
    }
    
                
        
                