<?php 
include "../core/init.php";

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
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="<?php echo BASE_URL_LINK;?>dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL_LINK;?>dist/css/login.css" rel="stylesheet">
</head>
<body>

<div class="login-wrap">
    <div class="login-html">
        <div id="responses"></div>
		<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
		<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>
		<div class="login-form">
			<div class="sign-in-htm">
				<div class="group">
                    <label for="user" class="label">Username or Email</label>
                    <input type="text" class="input" name="usernameoremail" id="usernameoremail" placeholder="Username or Email " />
                </div>
				<div class="group">
                    <label for="pass" class="label">Password</label>
                    <input type="text" name="passwordlogin" id="passwordlogin"  class="input" placeholder="Password" />
				</div>
				<div class="group">
					<input id="check" type="checkbox" class="check" checked>
					<label for="check"><span class="icon"></span> Keep me Signed in</label>
				</div>
				<div class="group">
					<input id="myBtn" onclick="javascript:manage('login')" type="button" class="button" value="Sign In">
				</div>
				<div class="hr"></div>
				<div class="foot-lnk">
					<a href="resentpassword.php" class="forgot-password" >Forgot Password?</a>
				</div>
            </div>
			<div class="sign-up-htm">
                <div id="response"></div>
                <div class="row">
                    <div class="col-md-6 group">
                        <label for="user" class="label">Firtsname</label>
                        <input type="text" id="firstname" class="form-control input" placeholder="Firtsname" />
                    </div>
                    <div class="col-md-6 group">
					    <label for="user" class="label">Lastname</label>
                        <input type="text" id="lastname" class="form-control input" placeholder="Lastname" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 group">
                        <label for="user" class="label">Username</label>
                        <input id="username" type="text" class="form-control input">
                    </div>
                    <div class="col-md-6 group">
                        <label for="pass" class="label">Email Address</label>
                        <input id="email" type="email" name="email"  class="form-control input" >
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 group">
                        <label for="pass" class="label">Password</label>
                        <input name="password" id="password" type="text" class="form-control input" data-type="password">
                    </div>
                    <div class="col-md-6 group">
                        <label for="pass" class="label">Repeat Password</label>
                        <input name="verifypassword" id="verifypassword" class="form-control input" data-type="password">
                    </div>
                </div>
				<div class="group">
					<input onclick="javascript:signup('signup')" type="button" class="button" value="Sign Up">
				</div>
				<div class="hr"></div>
				<div class="foot-lnk">
					<label for="tab-1">Already Member?</a>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="<?php echo BASE_URL_LINK;?>dist/js/jquery.min.js"></script>
<script src="<?php echo BASE_URL_LINK;?>dist/js/popper.min.js"></script>
<script src="<?php echo BASE_URL_LINK;?>dist/js/bootstrap.min.js"></script>

<script>
    
function manage(key) {
        var email = $("#usernameoremail");
        var password = $("#passwordlogin");
        //   use 1 or second method to validaton
        if (isEmpty(email) && isEmpty(password)) {
            //    alert("complete register");
            $.ajax({
                url: "login.php",
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
                            window.location = '../';
                        }, 1000);
                    }else if (response.indexOf('Fail') >= 0) {
                        setInterval(() => {
                            window.location = 'lockscreen';
                        }, 2000);
                        isEmptys(password);
                    }else {
                       isEmptys(email) || isEmptys(password) 
                    }
                }
            });
        }
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
                url: "login.php",
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
                    $("#response").html(response);
                    console.log(response);
                    if (response.indexOf('SUCCESS') >= 0) {
                        setInterval(() => {
                            location.reload();
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
</body>
</html>