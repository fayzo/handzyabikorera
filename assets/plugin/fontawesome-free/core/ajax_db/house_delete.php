<?php 
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

if (isset($_POST['available']) && !empty($_POST['available'])) {
    $user_ids= $_SESSION['key'];
	$house_id= $_POST['house_id'];
	$user_id= $_POST['user_id'];
    $available= $_POST['available'];
    $discount_change= $_POST['discount_change'];
	$discount_price= $_POST['discount_price'];
	$price= $_POST['price'];
	$banner= $_POST['banner'];
    $house->update_house($banner,$available,$discount_change,$discount_price,$price,$house_id);
}

if (isset($_POST['deleteTweetHome']) && !empty($_POST['deleteTweetHome'])) {
	$house_id= $_POST['deleteTweetHome'];
    $house->deleteHouse($house_id);
}

if (isset($_POST['property_type']) && !empty($_POST['property_type'])) {
	$house_id= $_POST['house_id'];
	$user_id= $_POST['user_id'];
    $available= $_POST['available_'];
	$discount_price= $_POST['discount_price'];
	$price= $_POST['price'];
	$equipment= $_POST['equipment'];
	$text= $_POST['text'];
    $property_type= $_POST['property_type'];
    
    $house->update('house',array(
        'buy' => $available,
        'price_discount' => $discount_price,
        'price' => $price,
        'equipment' => $equipment,
        'text' => $text,
        'categories_house' => $property_type,
    ),array(
        'house_id' => $house_id,
    ));
}

if (isset($_POST['EditHouseAdmin']) && !empty($_POST['EditHouseAdmin'])) {
    // $house->deleteHouse($house_id); 
    $craft_id= $_POST['rowID'];
    $mysqli= $db;
    $query= $mysqli->query("SELECT * FROM craft WHERE craft_id = $craft_id ");
    $houses = $query->fetch_array();
    ?>

<div class="house-popup">
        
        <div class="wrap6" id="disabler">
            <div class="wrap6Pophide" onclick="togglePopup ( )" ></div>
            <span class="col-12 col-md-3  colose">
                <button class="close-imagePopup"><i class="fa fa-times" aria-hidden="true"></i></button>
            </span>
            <div class="img-popup-wrap" id="popupEnd" style="max-width: 409px;">
                <div class="img-popup-body">

                <div class="card">
                    <div class="card-header">
                        <button class="btn btn-success btn-sm  float-right d-md-block d-lg-none"  onclick="togglePopup ( )">close</button>
                        <p class="card-text">Edit Property</p>
                    </div>
                    <div class="card-body">
                        <span id="responseSubmithouse"></span>
                        <div class="form-row">
                            <div class="col-12 mb-2">
                                <label for="authors">Property</label>
                                <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon2"><i class="fa fa-home mr-1" aria-hidden="true"></i></span>
                                </div>
                                    <select class="form-control" name="property_type_" id="property_type_<?php echo $houses["house_id"];?>" onchange="getPropertyTypeHide(this)">
                                    <option  value=""><?php echo $houses["categories_craft"];?></option>
                                    <option value="Arts">Arts</option>
                                    <option value="Wood_Craft">Wood Craft</option>
                                    <option value="Homeware">Homeware</option>
                                    <option value="Jewellery">Jewellery</option>
                                    <option value="Clothing">Clothing</option>
                                    <option value="Shoes">Shoes</option>
                                    <option value="Accessories">Accessories</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                    Property Tpye
                                    <div class="input-group">
                                            <select class="form-control" name="available" id="available_<?php echo $houses["house_id"];?>">
                                            <?php if ($houses['buy'] == 'sold') { ?>
                                            <option value="sold" selected>sold</option>
                                            <option value="sale">sale</option>
                                            <?php }else { ?>
                                            <option value="sale">sale</option>
                                            <?php } ?>
                                            </select>
                                        <div class="input-group-append">
                                            <span class="input-group-text" style="padding: 0px 10px;" aria-label="Username" aria-describedby="basic-addon1" >Type</span>
                                        </div>
                                    </div> <!-- input-group -->
                                </label>
                            </div>
                            <div class="col-12 mb-2">
                                <label for="authors">code</label>
                                <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon2"><i class="fas fa-chair mr-1" aria-hidden="true"></i></span>
                                </div>
                                     <input type="text" name="" class="form-control" value="<?php echo $houses["code"];?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 mb-2">
                                discount price
                                <div class="input-group">
                                    <input  type="number" class="form-control form-control-sm" name="discount_price" id="discount_price_<?php echo $houses["house_id"];?>" value="<?php echo $houses["price_discount"];?>">
                                    <div class="input-group-append">
                                        <span class="input-group-text" style="padding: 0px 10px;" aria-label="Username" aria-describedby="basic-addon1">Frw</span>
                                    </div>
                                </div> <!-- input-group -->
                            </div>
                            <div class="col-12 mb-2">
                                    Price
                                <div class="input-group">
                                    <input  type="number" class="form-control form-control-sm" name="price" id="price_<?php echo $houses["house_id"];?>" value="<?php echo $houses["price"];?>">
                                    <div class="input-group-append">
                                        <span class="input-group-text" style="padding: 0px 10px;"
                                            aria-label="Username" aria-describedby="basic-addon1" >Frw</span>
                                    </div>
                                </div> <!-- input-group -->
                            </div>
                        </div>
                        <div class="form-group mt-2">
                            <textarea class="form-control" name="additioninformation" id="text_<?php echo $houses["house_id"];?>" value="<?php echo $houses["price"];?>" placeholder="tell us your property" rows="3"><?php echo $houses["text"];?></textarea>
                        </div>
                    </div><!-- card-body -->
                    <div class="card-footer text-center">
                        <div id="responseSubmithouse"></div>
                        <button type="button" class="btn btn-primary update-houseAdmin-btn btn-lg btn-block" data-house="<?php echo $houses["house_id"];?>" data-user="<?php echo $houses["user_id3"];?>"> Submit</button>
                    </div><!-- card-footer -->

                </div><!-- card -->
            </div> <!-- img-popup-wrap -->
        </div> <!-- wrap6" -->
        
</div> <!-- house-popup" -->

<?php }

if (isset($_POST['showpopupdelete']) && !empty($_POST['showpopupdelete'])) {
    $user_id= $_SESSION['key'];
	$house_id= $_POST['showpopupdelete'];
	$house_user_id= $_POST['deleteEvents'];
    $houses= $house->house_getPopupTweet($user_id,$house_id,$house_user_id);
    ?>
     <div class="house-popup">
        
        <div class="wrap6" id="disabler">
            <div class="wrap6Pophide" onclick="togglePopup ( )" ></div>
            <span class="col-12 col-md-3  colose">
                <button class="close-imagePopup"><i class="fa fa-times" aria-hidden="true"></i></button>
            </span>
            <div class="img-popup-wrap" id="popupEnd">
            <div class="img-popup-body">

            <div class="card">
            <span id='responseDeletePost<?php echo $houses['house_id']; ?>'></span>
                <div class="card-header">
                    <h5 class="text-center text-muted">Are you sure you want to delete This Posts?</h5>
                <div class="user-block">
                    <div class="user-blockImgBorder">
                        <div class="user-blockImg">
                                    <?php if (!empty($houses['profile_img'])) {?>
                                    <img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $houses['profile_img'] ;?>" alt="User Image">
                                    <?php  }else{ ?>
                                    <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="User Image" >
                                    <?php } ?>
                            </div>
                        </div>
                    <span class="username">
                        <a style="padding-right:3px;" href="<?php echo PROFILE ;?>"><?php echo $houses['firstname']." ".$houses['lastname'] ;?></a>
                        <!-- //Jonathan Burke Jr. -->
                        <!-- <span class="description">Shared publicly - < ?php echo $users->timeAgo($houses['created_on3']); ?></span> -->
                    </span>
                    <div class="description">Shared publicly - <?php echo $users->timeAgo($houses['created_on3']); ?></div>
                </div> <!-- user-block -->
                </div>
                <div class="card-body">

                <!-- <div class="shadow-lg"> -->
                    <div class="property-list" id="property-list">
                    <div class="timeline">
                    <div class="single-property-item ">
                    <!-- < ?php echo $house->buychangesColor($houses['buy']); ?> -->
                    <!-- <i class="bg-success text-light require" >Sale </i> -->
                    <!-- <i class="fa fa-user"></i> -->

                    <!-- < ?php if($houses['discount'] != 0){ ?>
                    < ?php echo $house->PercentageDiscount($houses['discount']); ?>
                    < ?php }else { echo ''; ?> -->
                        <!-- <span class="bg-info text-light" > 0% </span>  -->
                    <!-- < ?php } ?> -->

                    <div class="row timeline-item">

                        <div class="col-md-4 px-0">
                            <div class="property-pic">
                                <?php 
                                // echo $house->banner($houses['banner']) ;
                                        $file = $houses['photo']."=".$houses['other_photo'];
                                        $expode = explode("=",$file);  ?>
                                <img class="propertyPicture" src="<?php echo BASE_URL.'uploads/house/'.$expode[0]; ?>" >
                            </div>
                        </div>
                        <div class="col-md-8">
                            <?php if ($houses['buy'] == 'sold') { ?>
                                <div class="property-text"
                                    style="background: url('<?php echo BASE_URL.'assets/image/background_image/sold.png'; ?>')no-repeat center center;
                                        background-size:cover;height:100%;width:100%">
                            <?php }else {
                                # code...
                                echo ' 
                                <div class="property-text" >
                                ';
                            } ?>
                                <!-- <div class="s-text">For Sale</div> -->
                                
                                <h5 class="r-title" style="display: inline-block;">
                                <i class="fa fa-home" aria-hidden="true"></i>
                                    <?php 
                                    $subect = $houses['categories_house'];
                                    $replace = " ";
                                    $searching = "_";
                                    echo str_replace($searching,$replace, $subect);
                                    ?>
                                </h5> |
                                
                                <span class="h6 text-success text-uppercase ml-2"><?php echo $houses['equipment']; ?></span>
                                
                                <div> From:<span class="room-price price-change"> <?php echo $house->nice_number(number_format($houses['price'])); ?> Frw
                                    <?php  echo (substr($houses['categories_house'],-4) == 'sale')? '':'/month';?>
                                    </span>
                                    <?php if($houses['price_discount'] != 0){ ?>
                                        
                                    <span class="text-danger price-change" style="text-decoration: line-through;">
                                    <?php echo number_format($houses['price_discount']); ?> Frw </span> <?php } ?>
                                </div>
                                
                                <h5 class="r-title pt-3"><a href="javascript:void(0)" id="house-readmore" data-house="<?php echo $houses['house_id']; ?>" >
                                    <?php $titlex= $houses['name_of_house'];
                                    if (strlen($titlex) > 25) {
                                    echo $titlex = substr($titlex,0,25).'..';
                                    }else{ 
                                    echo $titlex;
                                    } ?>
                                </a>
                                </h5>

                                <a class="properties-location"  href="javascript:void(0)" id="house-readmore" data-house="<?php echo $houses['house_id']; ?>" ><i class="icon_pin"></i>
                                <!-- < ?php echo $houses['provincename']; ?> /  -->
                                <?php echo $houses['namedistrict']; ?> District/ 
                                <?php echo $houses['namesector']; ?> Sector
                                <!-- < ?php echo $houses['nameCell']; ?> Cell  -->
                                </a>

                                <div style="margin-bottom:18px;font-size: 11px;">
                                    <i class="fa fa-clock-o" style="color: #2cbdb8;margin-right: 4px;" aria-hidden="true"></i> Created on <?php echo $house->timeAgo($houses['created_on3'])." By ".$houses['authors']; ?>
                                </div>

                                <!-- <p>
                                < ?php 
                                    $titlex= $houses['text'];
                                    if (strlen($titlex) > 20) {
                                    echo $titlex = substr($titlex,0,87).'..
                                    <a class="properties-location"  href="javascript:void(0)" id="house-readmore" data-house="'.$houses['house_id'].'" >Read more</a>
                                    ';
                                    }else{ 
                                    echo $titlex;
                                    } ?>

                                    </p> -->
                                <ul class="room-features">
                                    <li>
                                        <i class="fa fa-bed"></i>
                                        <p><?php echo $houses['bedroom']; ?>  Bed Room</p>
                                    </li>
                                    <li>
                                        <i class="fa fa-bath"></i>
                                        <p><?php echo $houses['bathroom']; ?> Baths Room</p>
                                    </li>
                                    <li>
                                        <i class="fa fa-car"></i>
                                        <p><?php echo $houses['car_in_garage']; ?> Garage</p>
                                    </li>
                                </ul>
                            </div><!-- col -->
                        </div><!-- row timeline-item-->
                    </div><!-- single -->
                    </div><!-- END TIMELINE -->
                    <!-- <div class="single-property-item ">
                        <i class="fa fa-clock-o bg-info text-light"></i>
                    </div> -->
                    </div>
                    <!-- property-list -->
                      
                <!-- </div>shadow -->

                </div><!-- card-body -->
                </div><!-- card-body -->
                <div class="card-footer"><!-- card-footer -->
                <button class="delete-it-house  btn btn-primary btn-md float-right ml-3" type="submit">Delete</button>
                <button class="cancel-it btn btn-info btn-md  float-right">Cancel</button>
                </div><!-- card-footer -->
            </div><!-- card end -->
    
            </div><!-- img-popup-body -->
        </div><!-- user-show-popup-box -->
    </div> <!-- Wrp4 -->
</div> <!-- apply-popup" -->


<?php
}
?>