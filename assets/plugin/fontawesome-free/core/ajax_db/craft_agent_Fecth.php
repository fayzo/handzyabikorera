<?php
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

     if(isset($_REQUEST['categories'])) {  
        echo  $profile_craft_agent->craftList_agentHome($_REQUEST['categories'],$_REQUEST['pages'],$_REQUEST['user_id']); 
      }
      

      if(isset($_POST["actions"]) && !empty($_POST["actions"])){
        if ($_POST["actions"] == 'remove') {
            $craft_id= $_POST['craft_id'];
            
            $productByCode = $users->runQuery("SELECT * FROM craft_watchlist WHERE code_watchlist='" . $_POST["code"] . "' AND user_id3_list='" . $_POST["user_id"] . "'");
            $itemArray = array($productByCode[0]["code_watchlist"]=>array('craft_watchlist_id'=>$productByCode[0]["craft_watchlist_id"], 'code_watchlist'=>$productByCode[0]["code_watchlist"]));
          
            foreach( $itemArray as $k => $v) {
              if($_POST["code"] == $k)
                  unset($_SESSION["like_cart_item"][$k]);
                  
              if(empty($_SESSION["like_cart_item"]))
                  unset($_SESSION["like_cart_item"]);
            }

            $handmade->deleteHouse($craft_id);
         }
     }

?>