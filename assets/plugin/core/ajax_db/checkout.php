<?php
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));
if(isset($_POST['cc-cvv'])){

if ($_POST['cc-cvv']) {

    $datetime= date('Y-m-d H-i-s');
    
    $user_id= $users->test_input($_POST['user_id']);
    $firstname= $users->test_input($_POST['firstname']);
    $lastname= $users->test_input($_POST['lastname']);
    $username= $users->test_input($_POST['username']);
    $email= $users->test_input($_POST['email']);
    $address= $users->test_input($_POST['address']);
    $address2= $users->test_input($_POST['address2']);
    $country= $users->test_input($_POST['country']);
    $state= $users->test_input($_POST['state']);
    $zip= $users->test_input($_POST['zip']);
    $shipping= $users->test_input($_POST['shipping']);
    $save_information_to_use_it= $users->test_input($_POST['save_information_to_use_it']);
    $paymentMethod= $users->test_input($_POST['paymentMethod']);
    $cc_name_payment= $users->test_input($_POST['cc-name']);
    $cc_number_payment= $users->test_input($_POST['cc-number']);
    $cc_expiration_payment= $users->test_input($_POST['cc-expiration']);
    $cc_cvv_payment= $users->test_input($_POST['cc-cvv']);

	$users->Postsjobscreates('checkout_payment',array( 

        'firstname' => $firstname,
        'lastname' => $lastname,
        'username' => $username,
        'email' => $email,
        'address' => $address,
        'address2' => $address2,
        'country' => $country,
        'state' => $state,
        'zip' => $zip,
        'shipping' => $shipping,
        'save_information_to_use_it' => $save_information_to_use_it,
        'paymentMethod' => $paymentMethod,
        'cc_name_payment' => $cc_name_payment,
        'cc_number_payment' => $cc_number_payment,
        'cc_expiration_payment' => $cc_expiration_payment,
        'cc_cvv_payment' => $cc_cvv_payment,
        'user_id3' => $user_id,
        'datetime' => $datetime,

        
    ));


    }
}


?>