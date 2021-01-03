<?php
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

if(isset($_POST['key'])){

if ($_POST['key'] == 'login') {
   
    $datetime= date('Y-m-d H-i-s'); // last_login 
    $email = $users->test_input($_POST['email']);
    $password =  $users->test_input($_POST['password']);

   if (strlen($password) < 3) {
        exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                   <button class="close" data-dismiss="alert" type="button">
                       <span>&times;</span>
                   </button>
                   <strong>Password is too short</strong> </div>');
   }else{
    $users->login($email, $password,$datetime);
    }
} 


if ($_POST['key'] == 'signup') {

    $datetime= date('Y-m-d H-i-s'); // last_login 
    $date_registry= date('Y-m-d'); // date_registry 
    $firstname =  $users->test_input($_POST['firstname']);
    $lastname = $users->test_input($_POST['lastname']);
    $username =  $users->test_input($_POST['username']);
    $email =  $users->test_input($_POST['email']);
    $password =  $users->test_input($_POST['password']);
    $verifypassword =  $users->test_input($_POST['verifypassword']);

    if(!preg_match("/^[a-zA-Z ]*$/", $firstname)){
       exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                   <button class="close" data-dismiss="alert" type="button">
                       <span>&times;</span>
                   </button>
                   <strong>Only letters and white space allowed</strong> </div>');
   }else if(!preg_match("/^[a-zA-Z ]*$/", $lastname)){
       exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                   <button class="close" data-dismiss="alert" type="button">
                       <span>&times;</span>
                   </button>
                   <strong>Only letters and white space allowed</strong> </div>');
   }else if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
           exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                   <button class="close" data-dismiss="alert" type="button">
                       <span>&times;</span>
                   </button>
                   <strong>Email invalid format</strong> </div>');
   }else if (strlen($username) > 10) {
        exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                   <button class="close" data-dismiss="alert" type="button">
                       <span>&times;</span>
                   </button>
                   <strong>Username must be between 6-10 character</strong> </div>');
   }else if (strlen($password) < 3) {
        exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                   <button class="close" data-dismiss="alert" type="button">
                       <span>&times;</span>
                   </button>
                   <strong>Password is too short</strong> </div>');
   }else if ($password != $verifypassword) {
        exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                   <button class="close" data-dismiss="alert" type="button">
                       <span>&times;</span>
                   </button>
                   <strong>Password Must eqaul to verification</strong> </div>');
   }else {

     $users->alreadyUseEmail('users',array(
          'username' => $username, 
           'email' => $email, 
     ), array(
           'firstname' => $firstname, 
           'lastname' => $lastname, 
           'username' => $username, 
           'email' => $email, 
           'password' => $password, 
           'register_as' => 'buyer', 
           'date_registry' => $date_registry, 
           'last_login' => $datetime, 
           'approval' => 'off', 
     ));

    } 

} 

}


if (isset($_REQUEST['login_id']) && !empty($_REQUEST['login_id'])) {
    $login_id= $_REQUEST['login_id']; 
    
    ?>

    <div class="house-popup">
        
    <div class="wrap6" id="disabler">
        <div class="wrap6Pophide" onclick="togglePopup ( )" ></div>
        <span class="col-sm-12 col-md-3  colose">
            <button class="close-imagePopup"><i class="fa fa-times" aria-hidden="true"></i></button>
        </span>
        <div class="img-popup-wrap" id="popupEnd" style="max-width: 409px;">
            <div class="img-popup-body" >
    
           <div class="card card-primary card-outline card-tabs">
              <div class="card-header p-0 pt-1 border-bottom-0">
                 <button class="btn btn-success btn-sm  float-right d-md-block d-lg-none"  onclick="togglePopup ( )">close</button>
                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active"  data-toggle="pill" href="#login" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">
                        Login</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#signup" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">
                        Sign-up</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-three-tabContent">
                  <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                    <div class="login-card-body">
                        <p class="login-box-msg">Sign in to start your session</p>

                            <div class="input-group mb-3">
                            <input type="email" class="form-control" name="usernameoremail" id="usernameoremail" placeholder="Username Or Email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                <span class="fa fa-envelope"></span>
                                </div>
                            </div>
                            </div>
                            <div class="input-group mb-3">
                            <input type="password" class="form-control" name="passwordlogin" id="passwordlogin" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                <span class="fa fa-lock"></span>
                                </div>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-12">
                                <span id="response"></span>
                            </div>
                            <div class="col-8">
                                <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-4">
                                <button onclick="javascript:manage('login')" type="button" id="myBtn" class="btn btn-primary btn-block">Sign In</button>
                            </div>
                            <!-- /.col -->
                            </div>
                        <p class="mb-1">
                            <a href="forgot-password.html">I forgot my password</a>
                        </p>
                    </div> <!-- /.login-card-body -->
                  </div> <!-- /.lOGIN -->

                  <div class="tab-pane fade" id="signup" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                    
                    <div class="register-card-body">
                    <p class="login-box-msg">Register a new membership</p>

                        <div class="input-group mb-3">
                        <input type="text" class="form-control"  id="firstname" placeholder="Firstname">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fa fa-user"></span>
                            </div>
                        </div>
                        </div>
                        <div class="input-group mb-3">
                        <input type="text" class="form-control" id="lastname" placeholder="Lastname">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fa fa-user"></span>
                            </div>
                        </div>
                        </div>
                        <div class="input-group mb-3">
                        <input type="text" class="form-control" id="username" placeholder="Username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fa fa-user"></span>
                            </div>
                        </div>
                        </div>
                        <div class="input-group mb-3">
                        <input type="email" class="form-control" id="email" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fa fa-envelope"></span>
                            </div>
                        </div>
                        </div>
                        <div class="input-group mb-3">
                        <input type="text" class="form-control" id="password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fa fa-lock"></span>
                            </div>
                        </div>
                        </div>
                        <div class="input-group mb-3">
                        <input type="text" class="form-control" id="verifypassword" placeholder="Retype password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fa fa-lock"></span>
                            </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-12">
                            <span id="responseSignup"></span>
                        </div>
                        <div class="col-8">
                            <div class="icheck-primary">
                            <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                            <label for="agreeTerms">
                            I agree to the <a href="#">terms</a>
                            </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button  onclick="javascript:signup('signup')" type="button" class="btn btn-primary btn-block">Register</button>
                        </div>
                        <!-- /.col -->
                        </div>

                  </div>
                </div>
              </div>
              <!-- /.card-BODY -->
            </div> <!-- /.card -->

            
        </div><!-- img-popup-body -->
        </div><!-- tweet-show-popup-box -->
    </div> <!-- Wrp4 -->
</div> <!-- apply-popup" -->
<!-- <script src="< ?php echo BASE_URL;?>assets/js/jquery.min.js"></script> -->
<script>
    
function manage(key) {
        var email = $("#usernameoremail");
        var password = $("#passwordlogin");
        //   use 1 or second method to validaton
        if (isEmpty(email) && isEmpty(password)) {
            //    alert("complete register");
            $.ajax({
                url: "core/ajax_db/login",
                method: "POST",
                dataType: "text",
                data: {
                    key: key,
                    email: email.val(),
                    password: password.val(),
                },
                success: function(response) {
                    $("#responses").html(response);
                    console.log(response);
                    if (response.indexOf('SUCCESS') >= 0) {
                        setInterval(() => {
                            $(".house-popup").hide();
                        }, 1500);
                        setInterval(() => {
                            location.reload();
                        }, 2000);
                    } else if (response.indexOf('Fail') >= 0) {
                        lockscreenfail();
                        isEmptys(password);
                    } else {
                       isEmptys(email) || isEmptys(password) 
                    }
                }
            });
        }
    }

    function lockscreenfail() { 
          $.ajax({
            url: "core/ajax_db/lockscreen_add",
            method: "POST",
            dataType: "text",
            data: {
                login_id: '1',
            },
            success: function(response) {
                    $(".popupTweet").html(response);
                    $(".close-imagePopup").click(function () {
                        $(".house-popup").hide();
                    });
                }
        });
    }

    function signup(key) {
        var firstname = $("#firstname");
        var lastname = $("#lastname");
        // var date = $("#date");
        var username = $("#username");
        var email = $("#email");
        var password = $("#password");
        var verifypassword = $("#verifypassword");
        //   use 1 or second method to validaton
        if (isEmpty(firstname) && isEmpty(lastname) && 
         isEmpty(username) && isEmpty(email) && isEmpty(password) && 
         isEmpty(verifypassword)) {
            //    alert("complete register");
            $.ajax({
                url: "core/ajax_db/login",
                method: "POST",
                dataType: "text",
                data: {
                    key: key,
                    firstname: firstname.val(),
                    lastname: lastname.val(),
                    username: username.val(),
                    email: email.val(),
                    password: password.val(),
                    verifypassword: verifypassword.val(),
                },
                success: function(response) {
                    $("#responseSignup").html(response);
                    console.log(response);
                    if (response.indexOf('SUCCESS') >= 0) {
                        setInterval(() => {
                            window.location = 'includes/login';
                        }, 2000);
                    } else {
                        isEmptys(firstname) || isEmptys(lastname) || 
                        isEmptys(username) || isEmptys(email) || isEmptys(password) ||
                        isEmptys(verifypassword)
                    }
                }
            });
        }
    }

    function isEmpty(caller) {
        if (caller.val() == "") {
            caller.css("border", "1px solid red");
            return false;
        } else {
            caller.css("border", "1px solid green");
        }
        return true;
    }

    function isEmptys(caller) {
        if (caller.val() != "") {
            caller.css("border", "1px solid red");
            return false;
        }
        return true;
    }

    // this is trigger button on enter

    var inputLogin = document.getElementById("passwordlogin");
    var inputSign = document.getElementById("verifypassword");

    inputLogin.addEventListener("keyup", function(event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById("myBtn").click();
        }
    });

</script>

<?php } 