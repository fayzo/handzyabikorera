<?php
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

if(isset($_POST['key'])){

if ($_POST['key'] == 'image') {
	$rowID = $db->real_escape_string($_POST['id']);
	$sql = $db->query("SELECT user_id, username, profile_img , cover_img FROM users WHERE user_id=' $rowID'");
	$data = $sql->fetch_array();
	$jsonArrays = array(
		'user_id' => $data['user_id'],
		'username' => $data['username'],
		'profile_image' => $data['profile_img'],
		'cover_image' => $data['cover_img'],
	);
	exit(json_encode($jsonArrays));
}


    if($_POST['key'] == 'career'){

    $id= $users->test_input($_POST['id']);
    $firstname= $users->test_input($_POST['firstname']);
    $lastname= $users->test_input($_POST['lastname']);
    $email = $users->test_input($_POST['email']);
    $telephone = $users->test_input($_POST['telephone']);
    $twitter = $users->test_input($_POST['twitter']);
    $facebook = $users->test_input($_POST['facebook']);
    $instagram = $users->test_input($_POST['instagram']);

    if(!preg_match("/^[a-zA-Z ]*$/", $firstname)){
        exit('<p style="color:red;">Only letters and white space allowed</p>');
    }else if(!preg_match("/^[a-zA-Z ]*$/", $lastname)){
        exit('<p style="color:red;">Only letters and white space allowed</strong> </p>');
    }else if (strlen($firstname) > 20) {
         exit('<p style="color:red;">Firstname must be between 2-20 character</p>');
    }else if (strlen($lastname) < 2) {
         exit('<p style="color:red;"> Lastname is too short</p>');
    }else if (strlen($email) < 4) {
         exit('<p style="color:red;"> Your email is too short</p>');
    }else if (strlen($telephone) < 2) {
         exit('<p style="color:red;"> telephone is too short</p>');
    }else{
        $date= date('Y-m-d H-i-s');

        $users->update('users',array(
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'telephone' => $telephone,
            'twitter' => $twitter,
            'facebook' => $facebook,
            'instagram' => $instagram,
            'last_profile_edit' => $date,
        ),array('user_id' => $id));

      }
   }
   
//    business admin 

    if($_POST['key'] == 'business_details'){

    $id= $users->test_input($_POST['id']);
    $name= $users->test_input($_POST['name']);
    $email= $users->test_input($_POST['email']);
    $phone = $users->test_input($_POST['phone']);
    $twitter = $users->test_input($_POST['twitter']);
    $facebook = $users->test_input($_POST['facebook']);
    $instagram = $users->test_input($_POST['instagram']);
    $google = $users->test_input($_POST['google']);
    $address = $users->test_input($_POST['address']);

    if(!preg_match("/^[a-zA-Z ]*$/", $name)){
        exit('<p style="color:red;">Only letters and white space allowed</p>');
    }else if(!preg_match("/^[a-zA-Z ]*$/", $name)){
        exit('<p style="color:red;">Only letters and white space allowed</strong> </p>');
    }else if (strlen($email) < 4) {
         exit('<p style="color:red;"> Your email is too short</p>');
    }else if (strlen($phone) < 2) {
         exit('<p style="color:red;"> telephone is too short</p>');
    }else{
        // $users->Postsjobscreates('business_contact',array(
        $users->update('business_contact',array(
        
        'business_name' => $name,
        'phone_business' => $phone,	
        'email_business' => $email,	
        'twitter_business' => $twitter,	
        'facebook_business' => $facebook,	
        'instagram_business' => $instagram,	
        'google_plus_business' => $google,	
        'address_business' => $address,	

        ),array('business_id' => $id));

      }
   }
   
    if($_POST['key'] == 'aboutme'){

    $location= $users->test_input($_POST['location']);
    $skills= $users->test_input($_POST['skills']);
    $notes= $users->test_input($_POST['notes']);
    $id= $users->test_input($_POST['id']);
    $date= date('Y-m-d H-i-s');
	
	if(empty($location)|| empty($skills)|| empty($notes)){
		exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong> Try to Fill In</strong></div>');
    }else{
        $users->update('users',array(
            'location' => $location,
            'skills' => $skills,
            'notes' => $notes,
            'last_profile_edit' => $date,
        ),array('user_id' => $id));

      }
   }

   
}
?>