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
                $TotalcodeByCode = $users->runQuery("SELECT COUNT(*) AS Totalcode  FROM craft_watchlist WHERE user_id3_list=$user_id ");
                if (!empty($productByCode[0]["code_watchlist"])) {
                    # code...
                    $n = $TotalcodeByCode[0]['Totalcode'];
                    $i=0; 
                    $itemArray=[];
                    while ($i < $n) {
                        # code...
                        $itemArray += array($productByCode[$i]["code_watchlist"]=>array('name'=>$productByCode[$i]["photo_Title_main_list"], 'code'=>$productByCode[$i]["code_watchlist"], 'user_id'=>$productByCode[$i]["user_id3_list"], 'quantitys'=>$productByCode[$i]["quantitys"], 'price'=> $productByCode[$i]["price_watchlist"]/$productByCode[$i]["quantitys"], 'image'=>$productByCode[$i]["photo_list"], 'craft_id'=>$productByCode[$i]["craft_id_list"], 'user_id3'=>$productByCode[$i]["user_id3_list"], 'categories'=>$productByCode[$i]["categories"]));
                        $i++;
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
