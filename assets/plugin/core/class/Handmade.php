<?php 

class Handmade extends Home {


    public function like_cart_item(){

        $mysqli= $this->database;
        $db_handle = $mysqli;
        if(!empty($_POST["actions"])) {
        switch($_POST["actions"]) {
        	case "add":
        		if(!empty($_POST["quantitys"])) {
        			$productByCode = $this->runQuery("SELECT * FROM craft WHERE code='" . $_POST["code"] . "'");
        			$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["photo_Title_main"], 'code'=>$productByCode[0]["code"], 'user_id'=>$_POST["user_id"], 'quantitys'=>$_POST["quantitys"], 'price'=>$productByCode[0]["price"], 'image'=>$productByCode[0]["photo"], 'craft_id'=>$productByCode[0]["craft_id"], 'user_id3'=>$productByCode[0]["user_id3"], 'categories'=>$productByCode[0]["categories_craft"]));
        			if(!empty($_SESSION["like_cart_item"])) {    
        				if(in_array($productByCode[0]["code"],array_keys($_SESSION["like_cart_item"]))) {
        					foreach($_SESSION["like_cart_item"] as $k => $v) {
        							if($productByCode[0]["code"] == $k) {
        								if(empty($_SESSION["like_cart_item"][$k]["quantitys"])) {
        									$_SESSION["like_cart_item"][$k]["quantitys"] = 0;
                                        }
                                        $_SESSION["like_cart_item"][$k]["quantitys"] += $_POST["quantitys"];
                                        
                                        foreach($_SESSION["like_cart_item"] as $k => $v) {
                                            $price = $_SESSION["like_cart_item"][$k]["price"]*$_SESSION["like_cart_item"][$k]["quantitys"];
                                            // var_dump($itemArray[$k]["food_id"],$itemArray[$k]["code"]);
                                            $this->updateQuery('craft_watchlist',array(
                                                'craft_id_list' => $_SESSION["like_cart_item"][$k]["craft_id"], 
                                                'user_id3_list' => $_POST["user_id"],  
                                                'categories'=> $_SESSION["like_cart_item"][$k]["categories"], 
                                                'price_watchlist'=> $price,  
                                                'status_craft' => '0',
                                            ),array(
                                                'food_id_list' => $_SESSION["like_cart_item"][$k]["craft_id"],
                                                'code_watchlist' => $_SESSION["like_cart_item"][$k]["code"],  
                                                'user_id3_list' => $_POST["user_id"],
                                             ));  
                                        }

        							}
        					}
        				} else {
                            foreach($itemArray as $k => $v) {
                                // var_dump($itemArray[$k]["food_id"],$itemArray[$k]["code"]);
                                $this->insertQuery('craft_watchlist',array(
                                    'craft_id_list' => $itemArray[$k]["craft_id"], 
                                    'user_id3_list' => $_POST["user_id"],  
                                    'code_watchlist' => $itemArray[$k]["code"],  
                                    'categories'=> $itemArray[$k]["categories"],  

                                    'photo_Title_main_list'=> $itemArray[$k]["name"],  
                                    'photo_list'=> $itemArray[$k]["image"],  
                                    'quantitys'=> $itemArray[$k]["quantitys"],  
                                    'unit_price'=> $itemArray[$k]["price"],  

                                    'price_watchlist'=> $itemArray[$k]["price"],  
                                    'status_craft' => '0',
                                ));  
                            }
        					$_SESSION["like_cart_item"] = array_merge($_SESSION["like_cart_item"],$itemArray);
        				}
        			} else {
                        foreach($itemArray as $k => $v) {
                            // var_dump($itemArray[$k]["food_id"],$itemArray[$k]["code"]);
                            $this->insertQuery('craft_watchlist',array(
                                'craft_id_list' => $itemArray[$k]["craft_id"], 
                                'user_id3_list' => $_POST["user_id"],  
                                'code_watchlist' => $itemArray[$k]["code"],  
                                'categories'=> $itemArray[$k]["categories"],  

                                'photo_Title_main_list'=> $itemArray[$k]["name"],  
                                'photo_list'=> $itemArray[$k]["image"],  
                                'quantitys'=> $itemArray[$k]["quantitys"],  
                                'unit_price'=> $itemArray[$k]["price"],  

                                'price_watchlist'=> $itemArray[$k]["price"],  
                                'status_craft' => '0',
                            ));  
                        }
        				$_SESSION["like_cart_item"] = $itemArray;
        			}
                }
             exit($this->Craft_showCart_itemSale());
                
        	break;
            case "remove":
                $productByCode = $this->runQuery("SELECT * FROM craft_watchlist WHERE code_watchlist='" . $_POST["code"] . "' AND user_id3_list='" . $_POST["user_id"] . "'");
                $itemArray = array($productByCode[0]["code_watchlist"]=>array('craft_watchlist_id'=>$productByCode[0]["craft_watchlist_id"], 'code'=>$productByCode[0]["code_watchlist"]));

        		if(!empty($_SESSION["like_cart_item"])) {
        			foreach($itemArray as $k => $v) {

                            $this->delete('craft_watchlist',array(
                                'craft_watchlist_id' =>  $itemArray[$k]["craft_watchlist_id"], 
                            ));

        					if($_POST["code"] == $k)
        						unset($_SESSION["like_cart_item"][$k]);				
        					if(empty($_SESSION["like_cart_item"]))
        						unset($_SESSION["like_cart_item"]);
        			}
                }
             exit($this->Craft_showCart_itemSale());
        	break;
        	case "empty":
        		unset($_SESSION["like_cart_item"]);
        	break;	
        }
        }
    }

     public function Craft_showCart_item(){

        if(isset($_SESSION["like_cart_item"])){
                $total_quantitys = 0;
                $total_price = 0;
            ?>	
            <table class="tbl-cart table table-responsive-sm table-hover table-bordered bg-light"  cellpadding="10" cellspacing="1">
            <thead class="main-active">
            <tr>
            <th style="text-align:left;">Name</th>
            <th style="text-align:left;">Code</th>
            <th style="text-align:right;" width="5%">quantitys</th>
            <th style="text-align:right;" width="10%">Unit Price</th>
            <th style="text-align:right;" width="10%">Price</th>
            <th style="text-align:center;" width="5%">Remove</th>
            </tr>	
             </thead>
            <tbody>
            <?php		
                foreach ($_SESSION["like_cart_item"] as $item){
                    $item_price = $item["quantitys"]*$item["price"];
            		?>
            				<tr>
            				<td><img src="<?php echo BASE_URL ;?>uploads/craft/<?php echo $item["image"]; ?>" height='80px' width='80px' class="cart-item-image" /> <span class="ml-3"><?php echo $item["name"]; ?></span></td>
            				<td><?php echo $item["code"]; ?></td>
            				<td style="text-align:right;"><?php echo $item["quantitys"]; ?></td>
            				<td  style="text-align:right;"><?php echo "$ ".number_format($item["price"]); ?></td>
            				<td  style="text-align:right;"><?php echo "$ ". number_format($item_price,2); ?></td>
            				<td style="text-align:center;">
                                <form method="post" id="form-craft-cartitem<?php echo $item['code']; ?>remove" >
                                    <input type="hidden" style="width:30px;" name="user_id" value="<?php echo $item['user_id']; ?>" />
                                    <input type="hidden" style="width:30px;" name="actions" value="remove" />
                                    <input type="hidden" style="width:30px;" name="code" value="<?php echo $item['code']; ?>" />
                                    <a href="javascript:void(0);" onclick="xxda('remove','<?php echo 'form-craft-cartitem'.$item['code'].'remove'; ?>','<?php echo $item['code']; ?>');"><img src="<?php echo BASE_URL_LINK ;?>image/product-images/icon-delete.png" alt="Remove Item" /></a> 
                                </form>
                                <!-- <a href="food.php?actions=remove&code=< ?php echo $item["code"]; ?>" class="btnRemoveactions"><img src="< ?php echo BASE_URL_LINK ;?>image/product-images/icon-delete.png" alt="Remove Item" /></a> -->
                            </td>
            				</tr>
            				<?php
            				$total_quantitys += $item["quantitys"];
            				$total_price += ($item["price"]*$item["quantitys"]);
            		}
            		?>
            
            <tr>
            <td colspan="2" align="right">Total:</td>
            <td align="right"><?php echo $total_quantitys; ?></td>
            <td align="right" colspan="2"><strong><?php echo "$ ".number_format($total_price, 2); ?></strong></td>
            <td></td>
            </tr>
            </tbody>
            </table>		

            <div class="order_total">
                <span class="text-muted h4">Order Total:</span><span class="h6 font-weight-bold ml-3"><?php echo "$ ".number_format($total_price); ?></span>
            </div>
              <?php
            } else {
            ?>
            <div class="no-records">Your Cart is Empty</div>
            <?php 
            } 
	}
	
    public function Craft_showCart_itemSale(){

        if(isset($_SESSION["like_cart_item"])){
                $total_quantitys = 0;
                $total_price = 0;
            // var_dump(count($_SESSION["like_cart_item"]));
            ?>	
            <table class="table table-responsive-sm table-hover table-bordered bg-light mb-0" id="foodshowcart">
             <thead class="main-active">
               <tr>
               <th style="text-align:center;">Products</th>
               <th style="text-align:center;">Price</th>
               <th style="text-align:center;">Remove</th>
			   </tr>	
			 </thead>
             <tbody>
            <?php		
                foreach ($_SESSION["like_cart_item"] as $item){
                    $item_price = $item["quantitys"]*$item["price"];
            		?>
            		<tr>
                    <td style="background: url('<?php echo BASE_URL ;?>uploads/craft/<?php echo $item["image"]; ?>')no-repeat center center;background-size:contain;height:80px;width:80px;position:relative">
                    <div style="position:absolute;bottom:0px;left:0px;background-color:#0000006e;color:white;width: 100%;"><?php
                    if (strlen($item["name"]) > 12) {
                      echo $item["name"] = substr($item["name"],0,12).'..';
                    }else{
                      echo $item["name"];
                    } ?></div>
                    </td>
            				<td align="right"><?php echo "$ ". number_format($item_price); ?></td>
            				<td align="center">
                                <form method="post" id="form-craft-cartitem<?php echo $item['code']; ?>remove" >
                                         <input type="hidden" style="width:30px;" name="user_id" value="<?php echo $item['user_id']; ?>" />
                                        <input type="hidden" style="width:30px;" name="actions" value="remove" />
                                        <input type="hidden" style="width:30px;" name="code" value="<?php echo $item['code']; ?>" />
                                        <a href="javascript:void(0);" onclick="xxda('remove','<?php echo 'form-craft-cartitem'.$item['code'].'remove'; ?>','<?php echo $item['code']; ?>');"><img src="<?php echo BASE_URL_LINK ;?>image/product-images/icon-delete.png" alt="Remove Item" /></a> 
                                </form>
                            </td>
            				</tr>
            				<?php
            				$total_quantitys += $item["quantitys"];
            				$total_price += ($item["price"]*$item["quantitys"]);
            		}
            		?>
            
            <tr>
            <td>Total:</td>
            <td align="left" colspan="2"><strong><?php echo "$ ".number_format($total_price); ?></strong></td>
            </tr>
            <tr>
                <td align="center" colspan="3"><a href="<?php echo SHOWCART;?>" class="btn btn-primary btn-block-lg">Proceed</a></li>
            </tr>		
            </tbody>
            </table>		
              <?php
            } else {
            ?>
             <div class="no-records"></div>
            <!-- <div class="no-records">Your Cart is Empty</div> -->
            <?php 
            } 
    }

    public function FoodshowCart_itemNavbar(){

        if(isset($_SESSION["like_cart_item"])){
                $total_quantitys = 0;
                $total_price = 0;
            // var_dump(count($_SESSION["like_cart_item"]));
            ?>
            <li>
            <span id="responseSubmitfooditerm"> </span>
            <div id="responseSubmitfooditermview">
            <div class="large-2">
            
            <table class="table table-responsive-sm table-hover table-bordered bg-light mb-0" id="foodshowcart">
             <thead class="main-active">
               <tr>
               <th style="text-align:center;">Products</th>
               <th style="text-align:center;">Price</th>
               <th style="text-align:center;">Remove</th>
			   </tr>	
			 </thead>
             <tbody>
            <?php		
                foreach ($_SESSION["like_cart_item"] as $item){
                    $item_price = $item["quantitys"]*$item["price"];
            		?>
            		<tr>
                    <td style="background: url('<?php echo BASE_URL ;?>uploads/craft/<?php echo $item["image"]; ?>')no-repeat center center;background-size:contain;height:80px;width:80px;position:relative">
                    <div style="position:absolute;bottom:0px;left:0px;background-color:#0000006e;color:white;width: 100%;"><?php
                    if (strlen($item["name"]) > 12) {
                      echo $item["name"] = substr($item["name"],0,12).'..';
                    }else{
                      echo $item["name"];
                    } ?></div>
                    </td>
            				<td align="right"><?php echo "$ ". number_format($item_price); ?></td>
            				<td align="center">
                                <form method="post" id="form-craft-cartitem<?php echo $item['code']; ?>remove" >
                                         <input type="hidden" style="width:30px;" name="user_id" value="<?php echo $item['user_id']; ?>" />
                                        <input type="hidden" style="width:30px;" name="actions" value="remove" />
                                        <input type="hidden" style="width:30px;" name="code" value="<?php echo $item['code']; ?>" />
                                        <a href="javascript:void(0);" onclick="xxda('remove','<?php echo 'form-craft-cartitem'.$item['code'].'remove'; ?>','<?php echo $item['code']; ?>');"><img src="<?php echo BASE_URL_LINK ;?>image/product-images/icon-delete.png" alt="Remove Item" /></a> 
                                </form>
                            </td>
            				</tr>
            				<?php
            				$total_quantitys += $item["quantitys"];
            				$total_price += ($item["price"]*$item["quantitys"]);
            		}
            		?>
            
            </tbody>
            </table>
            </div>
            
            <table class="table table-bordered bg-light mb-0">
            <tbody>
                <tr>
                    <td width="80px">Total:</td>
                    <td align="left" colspan="2"><strong><?php echo "$ ".number_format($total_price); ?></strong></td>
                </tr>		
                <tr>
                    <td align="center" colspan="3"><a href="<?php echo SHOWCART;?>" class="btn btn-primary btn-block-lg">Proceed</a></li>
                </tr>		
            </tbody>
            </table>
            </div>

            </li>		
              <?php
            } else {
            ?>
            <div class="no-records">Your Cart is Empty</div>
            <?php 
            } 
    }

    
    // THIS IS ON FOR THE MAIN HOME IT HAVE NAVBAR AS BLACK 
    public function craftList_homeNavbarblack($categories,$pages,$user_id){ ?>

                
        <div class="property-nav">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <nav class="main-menu">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="javascript:void(0)" onclick="craftCategories('Featured',1,<?php echo $user_id ; ?>);">Featured<span class="badge badge-primary"><?php echo $this->craftcountPOSTS('Featured');?></span></a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="javascript:void(0)" onclick="craftCategories('Arts',1,<?php echo $user_id ; ?>);">Arts<span class="badge badge-primary"><?php echo $this->craftcountPOSTS('Arts');?></span></a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="javascript:void(0)" onclick="craftCategories('Wood_Craft',1,<?php echo $user_id ; ?>);">Wood Craft<span class="badge badge-primary"><?php echo $this->craftcountPOSTS('Wood_Craft');?></span></a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="javascript:void(0)" onclick="craftCategories('Homeware',1,<?php echo $user_id ; ?>);">Homeware<span class="badge badge-primary"><?php echo $this->craftcountPOSTS('Homeware');?></span></a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="javascript:void(0)" onclick="craftCategories('Jewellery',1,<?php echo $user_id ; ?>);">Jewellery<span class="badge badge-primary"><?php echo $this->craftcountPOSTS('Jewellery');?></span></a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="javascript:void(0)" onclick="craftCategories('Clothing',1,<?php echo $user_id ; ?>);">Clothing<span class="badge badge-primary"><?php echo $this->craftcountPOSTS('Clothing');?></span></a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="javascript:void(0)" onclick="craftCategories('Shoes',1,<?php echo $user_id ; ?>);">Shoes<span class="badge badge-primary"><?php echo $this->craftcountPOSTS('Shoes');?></span></a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="javascript:void(0)" onclick="craftCategories('Accessories',1,<?php echo $user_id ; ?>);">Accessories<span class="badge badge-primary"><?php echo $this->craftcountPOSTS('Accessories');?></span></a></li>
                            </ul>
                        </nav>
                    </div>

                </div>
            </div>
        </div>

    <?php }

        
    public function craftcountPOSTS($categories)
    {
        $db =$this->database;
        if ($categories == 'Featured')  {
            # code...
            $sql= $db->query("SELECT COUNT(*) FROM craft ");
        }else {
            # code...
            $sql= $db->query("SELECT COUNT(*) FROM craft WHERE categories_craft ='$categories' ");
        }
        $row_post = $sql->fetch_array();
        $total_post= array_shift($row_post);
        $array= array(0,$total_post);
        $total_posts= array_sum($array);
        echo $total_posts;
    }


    public function handmade_list($categories,$pages,$user_id)
        {
            $pages= $pages;
            $categories= $categories;
            
            if($pages === 0 || $pages < 1){
                $showpages = 0 ;
            }else{
                $showpages = ($pages*10)-10;
            }
            $mysqli= $this->database;
            $query= $mysqli->query("SELECT * FROM craft H
                Left JOIN provinces P ON H. province = P. provincecode
                Left JOIN districts M ON H. districts = M. districtcode
                Left JOIN sectors T ON H. sector = T. sectorcode
                Left JOIN cells C ON H. cell = C. codecell
                Left JOIN vilages V ON H. village = V. CodeVillage 
                Left JOIN users U ON H. user_id3 = U. user_id 
                Left JOIN craft_watchlist W ON H. craft_id = W. craft_id_list 
            
            WHERE H. categories_craft ='$categories' ORDER BY rand(), H. created_on3 Desc Limit $showpages,10");
            
            if($categories == 'Featured'){
                $query= $mysqli->query("SELECT * FROM craft H
                Left JOIN provinces P ON H. province = P. provincecode
                Left JOIN districts M ON H. districts = M. districtcode
                Left JOIN sectors T ON H. sector = T. sectorcode
                Left JOIN cells C ON H. cell = C. codecell
                Left JOIN vilages V ON H. village = V. CodeVillage 
                Left JOIN users U ON H. user_id3 = U. user_id 
                Left JOIN craft_watchlist W ON H. craft_id = W. craft_id_list 
            
                ORDER BY rand(), H. created_on3 Desc Limit $showpages,10");
            
            }else{
                $query= $mysqli->query("SELECT * FROM craft H
                Left JOIN provinces P ON H. province = P. provincecode
                Left JOIN districts M ON H. districts = M. districtcode
                Left JOIN sectors T ON H. sector = T. sectorcode
                Left JOIN cells C ON H. cell = C. codecell
                Left JOIN vilages V ON H. village = V. CodeVillage 
                Left JOIN users U ON H. user_id3 = U. user_id 
                Left JOIN craft_watchlist W ON H. craft_id = W. craft_id_list 
            
                WHERE H. categories_craft ='$categories' ORDER BY rand(), H. created_on3 Desc Limit $showpages,10");
            
            } ?>
            <div id="house-hide" > 
            
            <div class="tab-content">
            <div class="active tab-pane" id="<?php echo $categories; ?>">
            
            <div class="row product_style_3">
            <?php if ($query->num_rows > 0) { 
                    
            while($craft= $query->fetch_array()) { 

            $likes= $this->likes($user_id,$craft['craft_id']); ?>

            <div class="col-md-4 col-sm-12">
                <div class="full product">
                <div class="product_img">
                    <div class="center"> <img src="<?php echo BASE_URL.'uploads/craft/'.$craft['photo'] ;?>" alt="#">

                    <?php if(isset($_SESSION['key_craft'])){ if($craft['user_id3_list'] != $user_id && $craft['craft_id_list'] != $craft['craft_id']  ){ ;?>
                            <div class="overlay_hover">
                                <form method="post" id="form-craft-cartitem<?php echo $craft['code']; ?>add">
                                    <div style="display:inline-flex;" >
                                        <input type="hidden" style="width:30px;" name="user_id" value="<?php echo $user_id; ?>" />
                                        <input type="hidden" style="width:30px;" name="actions" value="add" />
                                        <input type="hidden" style="width:30px;" name="code" value="<?php echo $craft['code']; ?>" />
                                        <input type="hidden" class="form-control form-control-sm text-center mr-2" style="width:30px;" name="quantitys" value="1" size="2" readonly/>
                                        <a class="add-bt" href="#" onclick="xxda('add','<?php echo 'form-craft-cartitem'.$craft['code'].'add'; ?>','<?php echo $craft['code']; ?>');" >+ Add to WatchList</a>
                                    </div>
                                </form>
                            </div>
                        <?php }else{ ;?>
                            <div class="overlay_hover">
                                <form method="post" id="form-craft-cartitem<?php echo $craft['code']; ?>remove" >
                                        <input type="hidden" style="width:30px;" name="user_id" value="<?php echo $craft['user_id3_list']; ?>" />
                                        <input type="hidden" style="width:30px;" name="craft_id" value="<?php echo $craft['craft_id']; ?>" />
                                        <input type="hidden" style="width:30px;" name="code" value="<?php echo $craft['code']; ?>" />
                                        <input type="hidden" style="width:30px;" name="actions" value="remove" />
                                        <a class="add-bt" href="#" onclick="xxda('remove','<?php echo 'form-craft-cartitem'.$craft['code'].'remove'; ?>','<?php echo $craft['code']; ?>');" >remove Watch-list</a> 
                                </form>
                            </div>
                        <?php } } ;?>
                    
                    <!-- <div class="overlay_hover"> <a class="add-bt" href="product_detail3.php">+ Add to cart</a> </div> -->
                    </div>
                </div>
                <div class="product_detail text_align_center">
                    <p class="product_price">$<?php echo  number_format($craft['price']); ?> <?php echo ($craft['price_discount'] != 0)?' <span class="old_price">$'. number_format($craft['price']).'</span>':'' ;?> </p>
                    <p class="product_descr"><?php echo $craft['code'] ;?></p>
                    <div style="display:inline-block" class="text-muted">
                        <span style="text-align:left"><?php echo $craft['quantity'] ;?> in stock</span>
                        <span style="text-align:right">$ <?php echo  number_format($craft['price']) ;?></span>
                    </div>
                    <div>
                    
                        <?php if($likes['like_on'] == $craft['craft_id']){ ?>
                            <span <?php if(isset($_SESSION['key_craft'])){ echo 'class="unlike-btn"'; }else{ echo 'id="login-please" data-login="1" '; } ?> style="font-size:20px;" data-craft="<?php echo $craft['craft_id']; ?>"  data-user="<?php echo $craft['user_id']; ?>">You <i style="color:red;" class="fa fa-heart"></i> Like It </span>
                        <?php }else{ ?>
                            <span <?php if(isset($_SESSION['key_craft'])){ echo 'class="like-btn text-danger"'; }else{ echo 'id="login-please" class="text-danger"  data-login="1" '; } ?> style="font-size:20px;" data-craft="<?php echo $craft['craft_id']; ?>"  data-user="<?php echo $craft['user_id']; ?>" ><i class="fa fa-heart-o" ></i></span>
                        <?php } ?>

                    </div>
                </div>
            </div>
            </div>

          <?php } ?>

           <!-- END timeline item -->
           <?php
                    
                    $query1= $mysqli->query("SELECT COUNT(*) FROM craft WHERE categories_craft ='$categories' ");
                    $row_Paginaion = $query1->fetch_array();
                    $total_Paginaion = array_shift($row_Paginaion);
                    $post_Perpages = $total_Paginaion/10;
                    $post_Perpage = ceil($post_Perpages); ?> 
            <!-- END timeline item -->
   

        <?php if($post_Perpage > 1){ ?>
         <nav>
             <ul class="pagination justify-content-center mt-3">
                 <?php if ($pages > 1) { ?>
                     <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="craftCategories('<?php echo $categories; ?>',<?php echo $pages-1; ?>,<?php echo $user_id ; ?>)">Previous</a></li>
                 <?php } ?>
                 <?php for ($i=1; $i <= $post_Perpage; $i++) { 
                         if ($i == $pages) { ?>
                      <li class="page-item active"><a href="javascript:void(0)"  class="page-link" onclick="craftCategories('<?php echo $categories; ?>',<?php echo $i; ?>,<?php echo $user_id ; ?>)" ><?php echo $i; ?> </a></li>
                      <?php }else{ ?>
                     <li class="page-item"><a href="javascript:void(0)"  class="page-link" onclick="craftCategories('<?php echo $categories; ?>',<?php echo $i; ?>,<?php echo $user_id ; ?>)" ><?php echo $i; ?> </a></li>
                 <?php } } ?>
                 <?php if ($pages+1 <= $post_Perpage) { ?>
                     <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="craftCategories('<?php echo $categories; ?>',<?php echo $pages+1; ?>,<?php echo $user_id ; ?>)">Next</a></li>
                 <?php } ?>
             </ul>
         </nav>
        <?php } 

          }else{
            echo ' <div class="col-md-12 col-lg-12"><div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>No Record</strong>
                </div></div>'; 
            }
        
    echo '
    </div>
    </div>
    </div>
    </div>';
        
     }

    public function handmade_like_list($pages,$user_id)
        {
            $pages= $pages;
            
            if($pages === 0 || $pages < 1){
                $showpages = 0 ;
            }else{
                $showpages = ($pages*10)-10;
            }
            $mysqli= $this->database;
            $query= $mysqli->query("SELECT * FROM craft H
                Left JOIN provinces P ON H. province = P. provincecode
                Left JOIN districts M ON H. districts = M. districtcode
                Left JOIN sectors T ON H. sector = T. sectorcode
                Left JOIN cells C ON H. cell = C. codecell
                Left JOIN vilages V ON H. village = V. CodeVillage 
                Left JOIN users U ON H. user_id3 = U. user_id 
                Left JOIN craft_watchlist W ON H. craft_id = W. craft_id_list 
                Left JOIN likes L ON H. craft_id = L. like_on 
    
            WHERE H. craft_id = L. like_on and L. like_by = $user_id ORDER BY rand() Desc Limit $showpages,10");
            ?>
    
            <div id="house-hide" > 
            
            <div class="tab-content">
            <div class="active tab-pane" id="#">
                
            <div class="row product_style_3">

            <?php if ($query->num_rows > 0) { ?>

            <?php while($craft= $query->fetch_array()) { 

            $likes= $this->likes($user_id,$craft['craft_id']); ?>

            <div class="col-md-4 col-sm-12">
                <div class="full product">
                <div class="product_img">
                    <div class="center"> <img src="<?php echo BASE_URL.'uploads/craft/'.$craft['photo'] ;?>" alt="#">

                    <?php if(isset($_SESSION['key_craft'])){ if($craft['user_id3_list'] != $user_id && $craft['craft_id_list'] != $craft['craft_id']  ){ ;?>
                            <div class="overlay_hover">
                                <form method="post" id="form-craft-cartitem<?php echo $craft['code']; ?>add">
                                    <div style="display:inline-flex;" >
                                        <input type="hidden" style="width:30px;" name="user_id" value="<?php echo $user_id; ?>" />
                                        <input type="hidden" style="width:30px;" name="actions" value="add" />
                                        <input type="hidden" style="width:30px;" name="code" value="<?php echo $craft['code']; ?>" />
                                        <input type="hidden" class="form-control form-control-sm text-center mr-2" style="width:30px;" name="quantitys" value="1" size="2" readonly/>
                                        <a class="add-bt" href="#" onclick="xxda('add','<?php echo 'form-craft-cartitem'.$craft['code'].'add'; ?>','<?php echo $craft['code']; ?>');" >+ Add to WatchList</a>
                                    </div>
                                </form>
                            </div>
                        <?php }else{ ;?>
                            <div class="overlay_hover">
                                <form method="post" id="form-craft-cartitem<?php echo $craft['code']; ?>remove" >
                                        <input type="hidden" style="width:30px;" name="user_id" value="<?php echo $craft['user_id3_list']; ?>" />
                                        <input type="hidden" style="width:30px;" name="craft_id" value="<?php echo $craft['craft_id']; ?>" />
                                        <input type="hidden" style="width:30px;" name="code" value="<?php echo $craft['code']; ?>" />
                                        <input type="hidden" style="width:30px;" name="actions" value="remove" />
                                        <a class="add-bt" href="#" onclick="xxda('remove','<?php echo 'form-craft-cartitem'.$craft['code'].'remove'; ?>','<?php echo $craft['code']; ?>');" >remove Watch-list</a> 
                                </form>
                            </div>
                        <?php } } ;?>
                    
                    <!-- <div class="overlay_hover"> <a class="add-bt" href="product_detail3.php">+ Add to cart</a> </div> -->
                    </div>
                </div>
                <div class="product_detail text_align_center">
                    <p class="product_price">$<?php echo  number_format($craft['price']); ?> <?php echo ($craft['price_discount'] != 0)?' <span class="old_price">$'. number_format($craft['price']).'</span>':'' ;?> </p>
                    <p class="product_descr"><?php echo $craft['code'] ;?></p>
                    <div style="display:inline-block" class="text-muted">
                        <span style="text-align:left"><?php echo $craft['quantity'] ;?> in stock</span>
                        <span style="text-align:right">$ <?php echo  number_format($craft['price']) ;?></span>
                    </div>
                    <div>
                    
                        <?php if($likes['like_on'] == $craft['craft_id']){ ?>
                            <span <?php if(isset($_SESSION['key_craft'])){ echo 'class="unlike-btn"'; }else{ echo 'id="login-please" data-login="1" '; } ?> style="font-size:20px;" data-craft="<?php echo $craft['craft_id']; ?>"  data-user="<?php echo $craft['user_id']; ?>">You <i style="color:red;" class="fa fa-heart"></i> Like It </span>
                        <?php }else{ ?>
                            <span <?php if(isset($_SESSION['key_craft'])){ echo 'class="like-btn text-danger"'; }else{ echo 'id="login-please" class="text-danger"  data-login="1" '; } ?> style="font-size:20px;" data-craft="<?php echo $craft['craft_id']; ?>"  data-user="<?php echo $craft['user_id']; ?>" ><i class="fa fa-heart-o" ></i></span>
                        <?php } ?>

                    </div>
                </div>
            </div>
            </div>

          <?php } ?>

           <!-- END timeline item -->
           <?php
                    
                    $query1= $mysqli->query("SELECT COUNT(*) FROM craft H Left JOIN likes L 
                    ON H. craft_id = L. like_on 
                    WHERE H. craft_id = L. like_on and L. like_by = $user_id  ");
                    
                    $row_Paginaion = $query1->fetch_array();
                    $total_Paginaion = array_shift($row_Paginaion);
                    $post_Perpages = $total_Paginaion/10;
                    $post_Perpage = ceil($post_Perpages); ?> 
            <!-- END timeline item -->
   

        <?php if($post_Perpage > 1){ ?>
         <nav>
             <ul class="pagination justify-content-center mt-3">
                 <?php if ($pages > 1) { ?>
                     <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="craftCategories('<?php echo $categories; ?>',<?php echo $pages-1; ?>,<?php echo $user_id ; ?>)">Previous</a></li>
                 <?php } ?>
                 <?php for ($i=1; $i <= $post_Perpage; $i++) { 
                         if ($i == $pages) { ?>
                      <li class="page-item active"><a href="javascript:void(0)"  class="page-link" onclick="craftCategories('<?php echo $categories; ?>',<?php echo $i; ?>,<?php echo $user_id ; ?>)" ><?php echo $i; ?> </a></li>
                      <?php }else{ ?>
                     <li class="page-item"><a href="javascript:void(0)"  class="page-link" onclick="craftCategories('<?php echo $categories; ?>',<?php echo $i; ?>,<?php echo $user_id ; ?>)" ><?php echo $i; ?> </a></li>
                 <?php } } ?>
                 <?php if ($pages+1 <= $post_Perpage) { ?>
                     <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="craftCategories('<?php echo $categories; ?>',<?php echo $pages+1; ?>,<?php echo $user_id ; ?>)">Next</a></li>
                 <?php } ?>
             </ul>
         </nav>
        <?php } 

    }else{
    echo ' <div class="col-md-12 col-lg-12"><div class="alert alert-danger alert-dismissible fade show text-center">
            <button class="close" data-dismiss="alert" type="button">
                <span>&times;</span>
            </button>
            <strong>No Record</strong>
        </div></div>'; 
    }

    echo '
    </div>
    </div>
    </div>
    </div>';
        
     }

    
    public function custtomer_reviews(){ ?>

    <div class="row">
        <div class="agent-carousel owl-carousel">
        <?php 
            $mysqli= $this->database;
            $result =$mysqli->query("SELECT * FROM users WHERE register_as ='Agent' ");

            while ($user= $result->fetch_array()) {
        ?>

        <div class="col-lg-3 single-agent" >

        <!-- Profile Image -->
        <div class="card bg-light sa-pic">
            <div class="card-header text-muted border-bottom-0 pl-2">
            Customer Reviews
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-7">
                
                  <h2 class="lead"><b><?php echo $user['firstname']." ".$user['lastname']; ?></b></h2>
                  <!-- <p class="text-muted text-sm"><b>About: </b> Web Designer / UX / Graphic Artist / Coffee Lover </p> -->
                  <ul class="mb-0 text-muted" style="list-style-type: none;">
                    <li class="small">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu sem tempor, 
                        varius quam at, luctus dui. 
                    </li>
                  </ul>
                </div>
                <div class="col-5 text-center single-agent-profile">
                    <div class="sa-picz">
                        <img src="<?php echo BASE_URL_LINK."image/img/quotations-button.png" ;?>" class="img-circle img-fluid">
                    </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <div class="text-right">
                    <i class="fa fa-star" style="color: #6a6f8c;" aria-hidden="true"></i>
                    <i class="fa fa-star" style="color: #6a6f8c;" aria-hidden="true"></i>
                    <i class="fa fa-star" style="color: #6a6f8c;" aria-hidden="true"></i>
                    <i class="fa fa-star-half-o" aria-hidden="true"></i>
              </div>
            </div>
        </div>
        </div>

    <?php  } ?>

        </div>
     </div>
     <div class="row">
        <div class="col-md-12">
            <div class="full review_bt_section">
                <div class="float-right">
                    <a class="bt_main" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="true" aria-controls="collapseExample">Leave a Review</a>
                </div>
            </div>

            <div class="full">

                <div id="collapseExample" class="full commant_box collapse">
                    <form accept-charset="UTF-8" action="index.html" method="post">
                        <input id="ratings-hidden" name="rating" type="hidden">
                        
                        <textarea class="shadow-form-control form-control animated" cols="50" id="new-review" name="comment" placeholder="Enter your review here..." required=""></textarea>
                        <input type="text" class="shadow-form-control form-control" id="name" name="name" placeholder="Your Name" required="" data-error="Please enter your name">
                        <input type="text" placeholder="Your Email" id="email" class="shadow-form-control form-control" name="name" required="" data-error="Please enter your email">

                        <div class="full_bt center">
                            <button class="bt_main" type="submit">Save</button>
                        </div>
                    </form>
                </div>

            </div>

        </div>

    </div>


<?php  }

    
}

$handmade = new Handmade();

?>