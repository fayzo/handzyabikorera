<?php
include "core/init.php";

if ($users->loggedin() == false) {
    header('location: '.LOGIN.'');
}else if($users->loggedin() == true) {
    $user_id= $_SESSION['key_craft'];
    $user= $home->userData($_SESSION['key_craft']);
    // $businessDetails= $home->businessData('1');
    // $notific= $notification->getNotificationCount($user_id);
    // $Exit_msg= $notification->getTotal_msgCountExit($user_id);
}

// echo $house->housecart_item(); 
?>