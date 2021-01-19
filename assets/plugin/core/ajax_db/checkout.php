<?php
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

// this is for annual report table in database

foreach($_SESSION["like_cart_item"] as $itemArray) {
    // var_dump($itemArray[$k]["food_id"],$itemArray[$k]["code"]);
    $users->insertQuery('annual_report_customers',array(
        'craft_id_list' => $itemArray["craft_id"], 
        'user_id3_list' => $itemArray["user_id"],  
        'code_watchlist' => $itemArray["code"],  
        'categories'=> $itemArray["categories"],  

        'photo_Title_main_list'=> $itemArray["name"],  
        'photo_list'=> $itemArray["image"],  
        'quantitys'=> $itemArray["quantitys"],  
        'unit_price'=> $itemArray["price"],  

        'price_watchlist'=> $itemArray["price"],  
        'status_craft' => '0',
        'item_purchased_on'=> 'off',  
    ));  
}

// this is for annual report table in database

if(isset($_POST['cc-cvv'])){

if ($_POST['cc-cvv']) {
    
    unset($_SESSION["like_cart_item"]);

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
    $phone= $users->test_input($_POST['phone']);
    $total_price= $users->test_input($_POST['total_price']);
    $total_quantity= $users->test_input($_POST['total_quantity']);

    $subect = $username.date("Y-m-d H:i:s").'_'.rand(10,1000);
    $replace = "_";
    $searching = " ";
    $item_purchased = str_replace($searching,$replace, $subect);

    $users->updateQuery('craft_watchlist',array(
        'item_purchased_list'=> $item_purchased,  
        'item_purchased_on'=> 'on',  
    ),array(
        'item_purchased_on'=> 'off',  
        'user_id3_list' => $user_id,
     ));  

    $users->updateQuery('annual_report_customers',array(
        'item_purchased_list'=> $item_purchased,  
        'item_purchased_on'=> 'on',  
    ),array(
        'item_purchased_on'=> 'off',  
        'user_id3_list' => $user_id,
     ));  

	$users->Postsjobscreates('checkout_payment',array( 

        'firstname' => $firstname,
        'lastname' => $lastname,
        'username' => $username,
        'email' => $email,
        'phone' => $phone,
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
        'item_purchased' => $item_purchased,
        'total_price' => $total_price,
        'total_quantity' => $total_quantity,
        'shipping_percentage' => rand(100,600),
        'datetime' => $datetime,
        
    ));


    }
}


?>