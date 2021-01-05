<?php
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

	if (isset($_POST['key'])) {

		if ($_POST['key'] == 'viewORedit') {
			$conn =$db;
			$rowID = $conn->real_escape_string($_POST['rowID']);
			$sql = $conn->query("SELECT firstname, lastname, username, password,
			 email, telephone, location,twitter,instagram,facebook,skills,notes FROM users WHERE user_id='$rowID'");
			$data = $sql->fetch_array();
			$jsonArrays = array(
				'firstname'=> $data['firstname'], 
				'lastname'=> $data['lastname'], 
				'username'=> $data['username'], 
				'password'=> $data['password'],
				'email'=> $data['email'], 
				'telephone'=> $data['telephone'], 
				'location'=> $data['location'],
				'twitter'=> $data['twitter'],
				'instagram'=> $data['instagram'],
				'facebook'=> $data['facebook'],
				'skills'=> $data['skills'],
				'notes'=> $data['notes'],
			);
			
			exit(json_encode($jsonArrays));
		 }
	
		if ($_POST['key'] == 'image') {
        	$rowID = $db->real_escape_string($_POST['id']);
        	$sql = $db->query("SELECT user_id, username, profile_img FROM users WHERE user_id=' $rowID'");
        	$data = $sql->fetch_array();
        	$jsonArrays = array(
        		'user_id' => $data['user_id'],
        		'username' => $data['username'],
        		'profile_image' => $data['profile_img'],
        	);
        	exit(json_encode($jsonArrays));
		}

		// users approvel
		
		if ($_POST['key'] == 'on') {
			$conn =$db;
			$rowID = $db->real_escape_string($_POST['rowID']);
	 		$conn->query("UPDATE users SET approval='on' WHERE user_id='$rowID'");
			exit('success');
		}
		// users approvel

		if ($_POST['key'] == 'off') {
			$conn =$db;
			$rowID = $db->real_escape_string($_POST['rowID']);
	 		$conn->query("UPDATE users SET approval='off' WHERE user_id='$rowID'");
			exit('success');
		}

		// House approvel
		if ($_POST['key'] == 'approvalHouse') {
			$conn =$db;
			$rowID = $db->real_escape_string($_POST['rowID']);
	 		$conn->query("UPDATE house SET approval= '{$_POST["approval"]}' WHERE house_id='$rowID'");
			exit('success');
		}

		if ($_POST['key'] == 'deleteRow') {
			$conn =$db;
			$rowID = $db->real_escape_string($_POST['rowID']);
			$conn->query("DELETE FROM users WHERE user_id='$rowID'");
			exit('The Row Has Been Deleted!');
		}

		if ($_POST['key'] == 'deleteRowHouse') {
			$conn =$db;
			$house_id=$_POST['rowID'];
			$house->deleteHouse($house_id);
			exit('The Row Has Been Deleted!');
		}

		
		if ($_POST['key'] == 'update_Row') {
			$conn =$db;

			$rowID= $firstname= $lastname= $username= $password= $email= 
			$telephone= $location= $twitter= $instagram= $facebook= $skills= $notes = "";

			$rowID = $conn->real_escape_string($_POST['rowID']);
			$firstname  = $conn->real_escape_string($_POST['firstname']);
			$lastname  = $conn->real_escape_string($_POST['lastname']);
			$username  = $conn->real_escape_string($_POST['username']);
			$password  = $conn->real_escape_string($_POST['password']);
			$email  = $conn->real_escape_string($_POST['email']);
			$telephone  = $conn->real_escape_string($_POST['telephone']);
			$location  = $conn->real_escape_string($_POST['location']);
			$twitter  = $conn->real_escape_string($_POST['twitter']);
			$instagram  = $conn->real_escape_string($_POST['instagram']);
			$facebook  = $conn->real_escape_string($_POST['facebook']);
			$skills  = $conn->real_escape_string($_POST['skills']);
			$notes  = $conn->real_escape_string($_POST['notes']);

			$conn->query("UPDATE users SET 
			firstname ='$firstname',
			lastname ='$lastname',
			username ='$username',
			password ='$password',
			email ='$email',
			telephone ='$telephone',
			location ='$location',
			twitter ='$twitter',
			instagram ='$instagram',
			facebook ='$facebook',
			skills ='$skills',
			notes ='$notes'
			WHERE user_id='$rowID'");
			exit('success');
		}

			 
		//  Admin FOR EDIT, VIEW AND DELETE view message ande view request house

		if ($_POST['key'] == 'business_message_view') {
			$conn =$db;
			$rowID = $conn->real_escape_string($_POST['rowID']);
			$sql = $conn->query("SELECT message_id,name_client,email_client, phone_client, message_client FROM business_message WHERE message_id='$rowID'");
			$data = $sql->fetch_array();
			$jsonArrays = array(
				'message_id'=> $data['message_id'],
				'name_client'=> $data['name_client'],
				'email_client'=> $data['email_client'], 
				'phone_client'=> $data['phone_client'], 
				'message_client'=> $data['message_client'],
			);
			$notification->business_messageView($data['message_id']);
			exit(json_encode($jsonArrays));
		 }
			 
		//  Admin FOR EDIT, VIEW AND DELETE view message sent to AGENTS house

		if ($_POST['key'] == 'agent_message_view') {
			$conn =$db;
			$rowID = $conn->real_escape_string($_POST['rowID']);
			$sql = $conn->query("SELECT message_id,name_client,email_client, phone_client, message_client,user_id3 FROM agent_message WHERE message_id='$rowID'");
			$data = $sql->fetch_array();
			$jsonArrays = array(
				'message_id'=> $data['message_id'],
				'name_client'=> $data['name_client'],
				'email_client'=> $data['email_client'], 
				'phone_client'=> $data['phone_client'], 
				'message_client'=> $data['message_client'],
			);
			$notification->agent_messagesView($data['user_id3'],$data['message_id']);
			exit(json_encode($jsonArrays));
		 }
		 

		//  ADMIN HOUSE FOR EDIT, VIEW AND DELETE 

		if ($_POST['key'] == 'business_request_home') {
			$conn =$db;
			$rowID = $conn->real_escape_string($_POST['rowID']);
			$sql = $conn->query("SELECT name_client,email_client,phone,request_type,property_type,equipment,
			bedroom,bathroom,location,price,currency,datetime,message_request
			FROM business_request_home WHERE business_request_id='$rowID'");

			$data = $sql->fetch_array();
			$jsonArrays = array(
				'name'=> $data['name_client'],
				'email'=> $data['email_client'], 
				'phone'=> $data['phone'], 
				'request_type'=> $data['request_type'],
				'property_type'=> $data['property_type'],
				'equipment'=> $data['equipment'],
				'bedroom'=> $data['bedroom'],
				'bathroom'=> $data['bathroom'],
				'location'=> $data['location'],
				'price'=> $data['price'],
				'currency'=> $data['currency'],
				'datetime'=> $data['datetime'],
				'message_request'=> $data['message_request'],
			);
			
			exit(json_encode($jsonArrays));
		 }
		 
		 if ($_POST['key'] == 'business_message_delete') {
			$conn =$db;
			$rowID = $db->real_escape_string($_POST['rowID']);
			$conn->query("DELETE FROM business_message WHERE message_id='$rowID'");
			exit('The Row Has Been Deleted!');
		}
		 if ($_POST['key'] == 'business_request_delete') {
			$conn =$db;
			$rowID = $db->real_escape_string($_POST['rowID']);
			$conn->query("DELETE FROM business_request_home WHERE business_request_id='$rowID'");
			exit('The Row Has Been Deleted!');
		}

		 if ($_POST['key'] == 'agent_message_delete') {
			$conn =$db;
			$rowID = $db->real_escape_string($_POST['rowID']);
			$conn->query("DELETE FROM agent_message WHERE message_id='$rowID'");
			exit('The Row Has Been Deleted!');
		}

		 if ($_POST['key'] == 'client_subscribe_delete') {
			$conn =$db;
			$rowID = $db->real_escape_string($_POST['rowID']);
			$conn->query("DELETE FROM client_subscribe_email WHERE client_subscribe_id='$rowID'");
			exit('The Row Has Been Deleted!');
		}

		$db->close();
	}
// return true or false
// 	Expression      | empty($x)
// ----------------+--------
// $x = "";        | true    
// $x = null       | true    
// var $x;         | true    
// $x is undefined | true    
// $x = array();   | true    
// $x = false;     | true    
// $x = true;      | false   
// $x = 1;         | false   
// $x = 42;        | false   
// $x = 0;         | true    
// $x = -1;        | false   
// $x = "1";       | false   
// $x = "0";       | true    
// $x = "-1";      | false   
// $x = "php";     | false   
// $x = "true";    | false   
// $x = "false";   | false   
?>