<?php 
 if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])){
       header('Location: ../../404.html');
 }

class Profile_craft_agent extends Handmade {

    // THIS IS ONE FOR THE ADMIN AND AGENT IT HAS NO BLACK IN IT

        public function craftList_agentNavbar($categories,$pages,$user_id){ ?>

        <div class="property-nav">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <nav class="main-menu">
                            <ul class="nav nav-pills">
                            <!-- <ul class="nav nav-pills"> -->
                                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="javascript:" onclick="craft_agentCategories('Featured',1,<?php echo $user_id ; ?>);">Featured<span class="badge badge-primary"><?php echo $this->Profile_craft_agentcountPOSTS('Featured',$user_id);?></span></a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="javascript:void(0)" onclick="craft_agentCategories('Arts',1,<?php echo $user_id ; ?>);">Arts<span class="badge badge-primary"><?php echo $this->Profile_craft_agentcountPOSTS('Arts',$user_id);?></span></a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="javascript:void(0)" onclick="craft_agentCategories('Wood_Craft',1,<?php echo $user_id ; ?>);">Wood Craft<span class="badge badge-primary"><?php echo $this->Profile_craft_agentcountPOSTS('Wood_Craft',$user_id);?></span></a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="javascript:void(0)" onclick="craft_agentCategories('Homeware',1,<?php echo $user_id ; ?>);">Homeware<span class="badge badge-primary"><?php echo $this->Profile_craft_agentcountPOSTS('Homeware',$user_id);?></span></a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="javascript:void(0)" onclick="craft_agentCategories('Jewellery',1,<?php echo $user_id ; ?>);">Jewellery<span class="badge badge-primary"><?php echo $this->Profile_craft_agentcountPOSTS('Jewellery',$user_id);?></span></a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="javascript:void(0)" onclick="craft_agentCategories('Clothing',1,<?php echo $user_id ; ?>);">Clothing<span class="badge badge-primary"><?php echo $this->Profile_craft_agentcountPOSTS('Clothing',$user_id);?></span></a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="javascript:void(0)" onclick="craft_agentCategories('Shoes',1,<?php echo $user_id ; ?>);">Shoes<span class="badge badge-primary"><?php echo $this->Profile_craft_agentcountPOSTS('Shoes',$user_id);?></span></a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="javascript:void(0)" onclick="craft_agentCategories('Accessories',1,<?php echo $user_id ; ?>);">Accessories<span class="badge badge-primary"><?php echo $this->Profile_craft_agentcountPOSTS('Accessories',$user_id);?></span></a></li>
                            </ul>
                        </nav>
                    </div>

                </div>
            </div>
        </div>

        <?php }

                    
    // THIS IS ONE FOR HOME IT HAVE BEST LAYOUT FOR HOUSE IT DOESN'T HAVE BANNER AND PRICE DISCOUNT

  
    public function craftList_agentHome($categories,$pages,$user_id)
        {
            $pages= $pages;
            $categories= $categories;
            
            if($pages === 0 || $pages < 1){
                $showpages = 0 ;
            }else{
                $showpages = ($pages*10)-10;
            }
            $mysqli= $this->database;

            if ($categories == 'Featured')  {

            $query= $mysqli->query("SELECT * FROM craft H
                Left JOIN provinces P ON H. province = P. provincecode
                Left JOIN districts M ON H. districts = M. districtcode
                Left JOIN sectors T ON H. sector = T. sectorcode
                Left JOIN cells C ON H. cell = C. codecell
                Left JOIN vilages V ON H. village = V. CodeVillage 
                Left JOIN users U ON H. user_id3 = U. user_id 
                Left JOIN craft_watchlist W ON H. craft_id = W. craft_id_list 
    
            WHERE H. user_id3 = $user_id ORDER BY rand(), H. created_on3 Desc Limit $showpages,10");
                # code...
            }else {
                # code...
                $query= $mysqli->query("SELECT * FROM craft H
                Left JOIN provinces P ON H. province = P. provincecode
                Left JOIN districts M ON H. districts = M. districtcode
                Left JOIN sectors T ON H. sector = T. sectorcode
                Left JOIN cells C ON H. cell = C. codecell
                Left JOIN vilages V ON H. village = V. CodeVillage 
                Left JOIN users U ON H. user_id3 = U. user_id 
                Left JOIN craft_watchlist W ON H. craft_id = W. craft_id_list 
    
                WHERE H. categories_craft ='$categories' and H. user_id3 = $user_id ORDER BY rand(), H. created_on3 Desc Limit $showpages,10");

            }
           ?>
    
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

                    <?php if(isset($_SESSION['key_craft'])){ 
                            
                            if($craft['user_id3_list'] != $user_id && $craft['craft_id_list'] != $craft['craft_id']  ){ 
                                
                                    if($_SESSION['key_craft'] == $craft['user_id3']   ){ ;?>
                                    <div class="overlay_hover">
                                        <form method="post" id="form-craft-cartitem<?php echo $craft['code']; ?>remove"  class="float-right" >
                                                <input type="hidden" style="width:30px;" name="user_id" value="<?php echo $craft['user_id3_list']; ?>" />
                                                <input type="hidden" style="width:30px;" name="craft_id" value="<?php echo $craft['craft_id']; ?>" />
                                                <input type="hidden" style="width:30px;" name="code" value="<?php echo $craft['code']; ?>" />
                                                <input type="hidden" style="width:30px;" name="actions" value="remove" />
                                                <button type="button"  onclick="xxda_prof_house_agent_delete('remove','<?php echo 'form-craft-cartitem'.$craft['code'].'remove'; ?>','<?php echo $craft['code']; ?>');"  class="btn btn-outline-danger btn-sm " ><i class="fa fa-trash" aria-hidden="true"></i> Remove</button> 
                                                <!-- onclick="xxda_prof_house_agent_delete -->
                                        </form>
                                    </div>
                                <?php }else{ ?>
                                    <div class="overlay_hover">
                                        <form method="post" id="form-craft-cartitem<?php echo $craft['code']; ?>add" class="float-right">
                                            <div style="display:inline-flex;" >
                                                <input type="hidden" style="width:30px;" name="user_id" value="<?php echo $_SESSION['key']; ?>" />
                                                <input type="hidden" style="width:30px;" name="actions" value="add" />
                                                <input type="hidden" style="width:30px;" name="code" value="<?php echo $craft['code']; ?>" />
                                                <input type="hidden" class="form-control form-control-sm text-center mr-2" style="width:30px;" name="quantitys" value="1" size="2" readonly/>
                                                <input type="button" onclick="xxda('add','<?php echo 'form-craft-cartitem'.$craft['code'].'add'; ?>','<?php echo $craft['code']; ?>');" value="Add to WatchList" class="btn btn-outline-success btn-sm " />
                                            </div>
                                        </form>
                                    </div>
                                <?php } ?>
                        <?php }else{ ?>
                        <div class="overlay_hover">
                                <form method="post" id="form-craft-cartitem<?php echo $craft['code']; ?>remove"  class="float-right" >
                                        <input type="hidden" style="width:30px;" name="user_id" value="<?php echo $craft['user_id3_list']; ?>" />
                                        <input type="hidden" style="width:30px;" name="craft_id" value="<?php echo $craft['craft_id']; ?>" />
                                        <input type="hidden" style="width:30px;" name="code" value="<?php echo $craft['code']; ?>" />
                                        <input type="hidden" style="width:30px;" name="actions" value="remove" />
                                        <button type="button"  onclick="xxda_watch_list_delete('remove','<?php echo 'form-craft-cartitem'.$craft['code'].'remove'; ?>','<?php echo $craft['code']; ?>');"  class="btn btn-outline-danger btn-sm " ><i class="fa fa-trash" aria-hidden="true"></i> Remove on <br> Watch-list</button> 
                                        <!-- onclick="xxda_prof_house_agent_delete -->
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
                    
                    $query1= $mysqli->query("SELECT COUNT(*) FROM craft WHERE categories_craft ='$categories' and user_id3 = $user_id ");
                    $row_Paginaion = $query1->fetch_array();
                    $total_Paginaion = array_shift($row_Paginaion);
                    $post_Perpages = $total_Paginaion/10;
                    $post_Perpage = ceil($post_Perpages); ?> 
            <!-- END timeline item -->
   

        <?php if($post_Perpage > 1){ ?>
         <nav>
             <ul class="pagination justify-content-center mt-3">
                 <?php if ($pages > 1) { ?>
                     <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="craft_agentCategories('<?php echo $categories; ?>',<?php echo $pages-1; ?>,<?php echo $user_id ; ?>)">Previous</a></li>
                 <?php } ?>
                 <?php for ($i=1; $i <= $post_Perpage; $i++) { 
                         if ($i == $pages) { ?>
                      <li class="page-item active"><a href="javascript:void(0)"  class="page-link" onclick="craft_agentCategories('<?php echo $categories; ?>',<?php echo $i; ?>,<?php echo $user_id ; ?>)" ><?php echo $i; ?> </a></li>
                      <?php }else{ ?>
                     <li class="page-item"><a href="javascript:void(0)"  class="page-link" onclick="craft_agentCategories('<?php echo $categories; ?>',<?php echo $i; ?>,<?php echo $user_id ; ?>)" ><?php echo $i; ?> </a></li>
                 <?php } } ?>
                 <?php if ($pages+1 <= $post_Perpage) { ?>
                     <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="craft_agentCategories('<?php echo $categories; ?>',<?php echo $pages+1; ?>,<?php echo $user_id ; ?>)">Next</a></li>
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

    
    public function Profile_craft_agentcountPOSTS($categories,$user_id)
    {
        $db =$this->database;
        if ($categories == 'Featured')  {
            # code...
            $sql= $db->query("SELECT COUNT(*) FROM craft WHERE  user_id3 = '$user_id' ");
        }else {
            # code...
            $sql= $db->query("SELECT COUNT(*) FROM craft WHERE categories_craft ='$categories'and user_id3 = '$user_id' ");
        }
        $row_post = $sql->fetch_array();
        $total_post= array_shift($row_post);
        $array= array(0,$total_post);
        $total_posts= array_sum($array);
        echo $total_posts;
    }

} 

$profile_craft_agent = new Profile_craft_agent();

/*
===========================================
         Notice
===========================================
# You are free to run the software as you wish
# You are free to help yourself study the source code and change to do what you wish
# You are free to help your neighbor copy and distribute the software
# You are free to help community create and distribute modified version as you wish

We promote Open Source Software by educating developers (Beginners)
use PHP Version 5.6.1 > 7.3.20  
===========================================
         For more information contact
=========================================== 
Kigali - Rwanda
Tel : (250)787384312 / (250)787384312
E-mail : shemafaysal@gmail.com

*/

?>