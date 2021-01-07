<?php
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

	if (isset($_POST['key'])) {

		if ($_POST['key'] == 'viewORedit' || $_POST['key'] == 'Edit') {
			$conn =$db;
			$rowID = $conn->real_escape_string($_POST['rowID']);
			$sql = $conn->query("SELECT name_review,
            email_review, message_review FROM customers_reviews WHERE reviews_id='$rowID'");
			$data = $sql->fetch_array();
			$jsonArrays = array(
				'name'=> $data['name_review'], 
				'email'=> $data['email_review'], 
				'message'=> $data['message_review'], 
			);
			
			exit(json_encode($jsonArrays));
		 }
	
		if ($_POST['key'] == 'agent_message_view') {
			$conn =$db;
			$rowID = $conn->real_escape_string($_POST['rowID']);
			$sql = $conn->query("SELECT name_client,
            email_client, message_client FROM agent_message WHERE message_id='$rowID'");
			$data = $sql->fetch_array();
			$jsonArrays = array(
				'name'=> $data['name_client'], 
				'email'=> $data['email_client'], 
				'message'=> $data['message_client'], 
			);
			
			exit(json_encode($jsonArrays));
		 }
	
		// users approvel
		
		if ($_POST['key'] == 'on') {
			$conn =$db;
			$rowID = $db->real_escape_string($_POST['rowID']);
	 		$conn->query("UPDATE customers_reviews SET approval_Review='on' WHERE reviews_id='$rowID'");
			exit('success');
		}
		// users approvel

		if ($_POST['key'] == 'off') {
			$conn =$db;
			$rowID = $db->real_escape_string($_POST['rowID']);
	 		$conn->query("UPDATE customers_reviews SET approval_Review='off' WHERE reviews_id='$rowID'");
			exit('success');
		}

		if ($_POST['key'] == 'deleteRow') {
			$conn =$db;
			$rowID = $db->real_escape_string($_POST['rowID']);
			$conn->query("DELETE FROM customers_reviews WHERE reviews_id='$rowID'");
			exit('The Row Has Been Deleted!');
		}
		
		if ($_POST['key'] == 'update_Row') {
			$conn =$db;

			$rowID= $firstname= $lastname= $username= $password= $email= 
			$telephone= $location= $twitter= $instagram= $facebook= $skills= $notes = "";

			$rowID = $conn->real_escape_string($_POST['rowID']);
			$name  = $conn->real_escape_string($_POST['name']);
			$email  = $conn->real_escape_string($_POST['email']);
			$message = $conn->real_escape_string($_POST['message']);

			$quwery= $conn->query("UPDATE customers_reviews SET 
			name_review ='$name',
			email_review ='$email',
			message_review ='$message'
            WHERE reviews_id='$rowID'");
			exit('success');
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