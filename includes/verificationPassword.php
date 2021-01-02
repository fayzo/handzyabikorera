<?php 
include "../core/init.php";

$sql= $db->query("SELECT user_id,firstname,lastname,email,username FROM users WHERE user_id= 1 ");
$row= $sql->fetch_assoc();


if(isset($_POST['key'])){

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
   
         $users->updateReal('users',array(
               'firstname' => $firstname, 
               'lastname' => $lastname, 
               'username' => $username, 
               'email' => $email, 
               'password' => $password, 
               'date_registry' => $date_registry, 
               'last_login' => $datetime, 
               'approval' => 'off', 
         ),array(
            'user_id' => $row['user_id']
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
    <link href="<?php echo BASE_URL;?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL;?>assets/css/login.css" rel="stylesheet">
</head>
<body>

<div class="login-wrap">
    <div class="login-html">
        <div id="responses"></div>
		<input id="tab-2" type="radio" name="tab" class="sign-up" checked><label for="tab-2" class="tab">Create a New Password</label>
		<div class="login-form">
			<div class="sign-up-htm">
                <div id="response"></div>
                <div class="row">
                    <div class="col-md-6 group">
                        <label for="user" class="label">Firtsname</label>
                        <input type="text" id="firstname" class="form-control input" value="<?php echo $row['firstname'];?>"  />
                    </div>
                    <div class="col-md-6 group">
					    <label for="user" class="label">Lastname</label>
                        <input type="text" id="lastname" class="form-control input" value="<?php echo $row['username'];?>" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 group">
                        <label for="user" class="label">Username</label>
                        <input id="username" type="text" class="form-control input" value="<?php echo $row['username'];?>" >
                    </div>
                    <div class="col-md-6 group">
                        <label for="pass" class="label">Email Address</label>
                        <input id="email" type="email" name="email"  class="form-control input" value="<?php echo $row['email'];?>" >
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 group">
                        <label for="pass" class="label">New Password</label>
                        <input name="password" id="password" type="text" class="form-control input" data-type="password">
                    </div>
                    <div class="col-md-6 group">
                        <label for="pass" class="label">Repeat Password</label>
                        <input name="verifypassword" id="verifypassword" class="form-control input" data-type="password">
                    </div>
                </div>
				<div class="group">
					<input onclick="javascript:signup('signup')" type="button" id="myBtn" class="button" value="Submit">
				</div>
				<div class="hr"></div>
				<div class="foot-lnk">
					<label for="tab-1">Be Our Member?</a>
				</div>
			</div>

		</div>
	</div>
</div>

<script src="<?php echo BASE_URL;?>assets/js/jquery.min.js"></script>
<script src="<?php echo BASE_URL;?>assets/js/popper.min.js"></script>
<script src="<?php echo BASE_URL;?>assets/js/bootstrap.min.js"></script>

<script>
    
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
                url: "verificationPassword.php",
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
                            // location.reload();
                            window.location = '../index.php';
                        }, 2000);
                    }else {
                        isEmptys(password) || isEmptys(verifypassword)
                        
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

    var inputSign = document.getElementById("verifypassword");

    inputSign.addEventListener("keyup", function(event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById("myBtn").click();
        }
    });

</script>
</body>
</html>