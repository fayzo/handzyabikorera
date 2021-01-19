<?php 
include "core/init.php";

if (isset($_GET['username']) == true && empty($_GET['username']) == false) {
    # code...
    $username= $users->test_input($_GET['username']);
    $uprofileId= $home->usersNameId($username);
	$profileData= $home->userData($uprofileId['user_id']);

   	if ($users->loggedin() == true) {
        $user_id= $_SESSION['key_craft'];
        // $user= $home->userData($_SESSION['key_craft']);
        // $businessDetails= $home->businessData('1');
        // $notific= $notification->getNotificationCount($user_id);
        // $Exit_msg= $notification->getTotal_msgCountExit($user_id);

        // $jobs= $home->jobsData($_SESSION['key_craft']);
        // $fundraisingV= $home->fundraisingData($_SESSION['key_craft']);

    }else{
        $user_id= $profileData['user_id'];
        // $businessDetails= $home->businessData('1');
	}

	$user= $home->userData($user_id);
	
    if (!isset($profileData['user_id'])) {
        # code...
        header('Location: '.LOGIN.'');
    }
}else{

        # code...
        $username= $users->test_input('craft');
        $uprofileId= $home->usersNameId($username);
        $profileData= $home->userData($uprofileId['user_id']);

        if ($users->loggedin() == true) {
            $user_id= $_SESSION['key_craft'];
            $user= $home->userData($_SESSION['key_craft']);
            // $businessDetails= $home->businessData('1');
            // $Exit_msg= $notification->getTotal_msgCountExit($user_id);
            // $notific= $notification->getNotificationCount($user_id);

            if(empty($_SESSION["like_cart_item"])) {
                $productByCode = $users->runQuery("SELECT * FROM craft_watchlist WHERE user_id3_list= $user_id and item_purchased_on = 'off' ");
                if (!empty($productByCode[0]["code_watchlist"])) {
                    # code...
                    $itemArray=[];
                    foreach($productByCode as $k => $v) {
                        # code...
                        $itemArray += array($productByCode[$k]["code_watchlist"]=>array('name'=>$productByCode[$k]["photo_Title_main_list"], 'code'=>$productByCode[$k]["code_watchlist"], 'user_id'=>$productByCode[$k]["user_id3_list"], 'quantitys'=>$productByCode[$k]["quantitys"], 'price'=> $productByCode[$k]["price_watchlist"]/$productByCode[$k]["quantitys"], 'image'=>$productByCode[$k]["photo_list"], 'craft_id'=>$productByCode[$k]["craft_id_list"], 'user_id3'=>$productByCode[$k]["user_id3_list"], 'categories'=>$productByCode[$k]["categories"]));
                    }
                    $_SESSION["like_cart_item"] = $itemArray;
                    // var_dump($itemArray);
                    // var_dump($_SESSION["like_cart_item"]);
                }
            }

        }else{
            $user_id= $profileData['user_id'];
            // $businessDetails= $home->businessData('1');
        }

        $user= $home->userData($user_id);
        
        if (!isset($profileData['user_id'])) {
            # code...
            header('Location: '.LOGIN.'');
        }


}

echo $handmade->like_cart_item(); 
?>
