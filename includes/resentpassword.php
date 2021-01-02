<?php 
include "../core/init.php";

// if (!isset($_SESSION['keys'])) {
    //  header('location: '.LOGIN.'');
    // exit();
// }

if (isset($_POST['key']) == 'email') {
    
    $email = $users->test_input($_POST['email']);
    $sql= $db->query("SELECT user_id,username,approval,chat FROM users WHERE email='{$email}' ");
    $row= $sql->fetch_assoc();

    if ($sql->num_rows > 0) {
        $datetime= date('Y-m-d H-i-s');
        $db->query("UPDATE users SET last_login = '$datetime'  WHERE user_id= $row[user_id] AND email= '$email' ");
        $db->query("UPDATE users SET counts_login=counts_login + 1 WHERE user_id= $row[user_id] AND email= '$email' ");
        $db->query("UPDATE users SET chat = 'on' WHERE user_id= $row[user_id] AND email= '$email' ");
        $_SESSION['key'] = $row['user_id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['approval'] = $row['approval'];
        $_SESSION['chat'] = $row['chat'];
        exit ('<div class="alert alert-success alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>Success Sent Your Password in email Go Check it</strong> </div>');
    }else{
        exit ('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>Sorry we couldn\'t find you Please Try Again or Sign up...!!!</strong> </div>');
    }
    $users->forgotUsernameCountsTodelete('users',
          array('forgotUsernameCounts' => 'forgotUsernameCounts +1', ),$row['user_id']);
  } 

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>welcome</title>
    <link href="<?php echo BASE_URL ;?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL ;?>assets/icon/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <script src="<?php echo BASE_URL ;?>assets/icon/fontawesome_5_4/js/all.js"></script>

    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
    integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous"> -->
    <style>
    body {
        font-family: 'Montserrat', sans-serif;
        background: #f6f5f7;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 20px 0 50px;
    }

    .login-wrap{
        width:100%;
        margin:auto;
        max-width:525px;
        min-height:770px;
        padding: inherit;
        position:relative;
        /* background:url(https://raw.githubusercontent.com/khadkamhn/day-01-login-form/master/img/bg.jpg) no-repeat center; */
        /* this is act like it in direction of css folder background:url(../../assets/image/bg.jpg) */
        background:url(../assets/image/bg.jpg) no-repeat center;
        box-shadow:0 12px 15px 0 rgba(0,0,0,.24),0 17px 50px 0 rgba(0,0,0,.19);
    }

    .login-html{
        width:100%;
        height:100%;
        position:absolute;
        /* padding:90px 70px 50px 70px; */
        background:rgba(40,57,101,.9);
    }


    h1 {
        font-weight: bold;
        margin: 0;
        /* font-size: 15px; */
    }

    p {
        font-size: 14px;
        font-weight: 100;
        line-height: 20px;
        letter-spacing: .5px;
        margin: 20px 0 30px;
    }

    span {
        font-size: 12px;
    }

    a {
        color: #333;
        font-size: 14px;
        text-decoration: none;
        margin: 15px 0;
    }

    .form-container {
        position: relative;
        /* margin-top: 2%; */
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        font-size: small;
        color:#f0ffff
    }

    .form-container input {
        background: rgb(238, 238, 238);
        border: none;
        padding: 15px 15px;
        margin: 10px 0;
        width: 100%;
        border-radius: 10px;
        outline: none;
        height: 45px
    }
    .form-container a {
        color:#f0ffff
    }

    .lockscreen-credentials {
       margin-left: 78px;
    }

    .lockscreen-item {
        border-radius: 4px;
        padding: 0;
        position: relative;
        margin: 50px auto 30px auto;
        width: 300px;
    }
    .input-group-text{
        margin-top: 9px;
        border: none;
    }
   
     /* User image */

    .lockscreen-image {
        border-radius: 50%;
        position: absolute;
        left: -10px;
        top: -20px;
        z-index: 10;
    }
    #white .lockscreen-image>img {
        border-radius: 50%;
        background: #fff;
        padding: 5px;
        width: 100px;
        height: 100px;
    }

    #green .lockscreen-image>img {
        border-radius: 50%;
        background: rgb(27, 168, 22);
        padding: 5px;
        width: 100px;
        height: 100px;
    }
    #green .input-group-text{
        background-color: rgb(27, 168, 22);
    }
    #green .text-muted {
        color: #f3f6f9!important;
    }
    #red .lockscreen-image>img {
        border-radius: 50%;
        background: rgb(240, 94, 94);
        padding: 5px;
        width: 100px;
        height: 100px;
    }
    #red .input-group-text{
        background-color: #f05e5e;
    }
    #red .text-muted {
        color: #f3f6f9!important;
    }

    </style>
</head>

<body id=white>
    <div class="container login-wrap" id="container">
        <!-- <h1 class="mb-3">Menya.com</h1> -->

        <div class="form-container login-html">
        <div id="response"></div>
                <?php if(!empty($_SESSION['username'])){ ?>
                    <h4><?php echo $_SESSION['username'] ;?></h4>
                    <h5 style="margin-top:10px;">Enter Your Email to verify</h5>
                <?php }else{ ?>
                    <h5 style="margin-top:10px;">Enter Your Email to verify</h5>
                <?php } ?>
            <!-- START LOCK SCREEN ITEM -->
            <div class="lockscreen-item">
                <!-- lockscreen image -->
                <div class="lockscreen-image">
                <?php if(!empty($_SESSION['profile_img'])){ ?>
                    <img src="<?php echo BASE_URL."assets/image/user_default_image/".$_SESSION['profile_img'] ;?>" alt="User Image">
                <?php }else{ ?>
                    <img src="<?php echo BASE_URL.NO_PROFILE_IMAGE_URL; ?>" alt="User Image">
                <?php } ?>
                </div>
                <form class="lockscreen-credentials">
                    <div class="input-group">
                        <input type="text" id="email" class="form-control" placeholder="Your Email">
                        <div class="input-group-append">
                            <span class="input-group-text btn" onclick="lockscreen('email')" aria-label="Username"
                                aria-describedby="basic-addon1"><i class="fa fa-arrow-right text-muted"></i></span>
                        </div>
                    </div>
                </form>
                <p id="errors"></p>
                <!-- <p id="response"></p> -->
               
                <div class="text-center" style="margin-top:70px;">
                    <a href="logout.php">Sign in as a different User</a>
                </div>
            </div>

        </div>
    </div>

    <script src="<?php echo BASE_URL ;?>assets/js/jquery.min.js"></script>
    <script src="<?php echo BASE_URL ;?>assets/js/popper.min.js"></script>
    <script src="<?php echo BASE_URL ;?>assets/js/bootstrap.min.js"></script>
    
    <script>

    function lockscreen(key) {
        var email = $("#email");
        //   use 1 or second method to validaton
        if (isEmpty(email)) {
            //    alert("complete register");
            $.ajax({
                url: "resentpassword.php",
                method: "POST",
                dataType: "text",
                data: {
                    key: key,
                    email: email.val(),
                },
                success: function(response) {
                    $("#response").html(response);
                    console.log(response);
                    if (response.indexOf('Success') >= 0) {
                        setInterval(() => {
                            window.location = 'logout.php';
                            // location.reload();
                        }, 1500);
                    } else {
                        isEmptys(email);
                    }
                }
            });
        }
    }

    function isEmpty(caller) {
        if (caller.val() == "") {
            caller.css("border", "1px solid red");
            $('#error').html("Please fill in ...?").css("color", "red");
            $('body').attr("id", 'red');
            return false;
        } else {
            caller.css("border", "1px solid green");
            $('body').attr("id", 'green');
            $('#error').html("Success").css("color", "green");
        }
        return true;
    }

    function isEmptys(caller) {
        if (caller.val() != "") {
            caller.css("border", "1px solid red");
            $('#error').html("Please Try Again ...?").css("color", "red");
            $('body').attr("id", 'red');
            return false;
        }
        return true;
    }
    $('body').attr("id", 'white');
    </script>
    
</body>
</html>