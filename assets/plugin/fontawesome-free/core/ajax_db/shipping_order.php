<?php 
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));


if (isset($_POST['order']) && !empty($_POST['order'])) {
    $user_id = $_POST['user'];
    $item_purchased = $_POST['order'];
    $datetime = $_POST['datetime'];
    // $user= $house->houseReadmore($craft_id);
    ?>

    <div class="craft-popup">
        
        <div class="wrap6" id="disabler">
            <div class="wrap6Pophide" onclick="togglePopup ( )" ></div>
            <span class="col-12 col-md-3  colose">
                <button class="close-imagePopup"><i class="fa fa-times" aria-hidden="true"></i></button>
            </span>
            <div class="img-popup-wrap" id="popupEnd">
                <div class="img-popup-body">

                <div class="card">
                    <span id="responseSubmithouse"></span>
                    <div class="card-header">
                        <button class="btn btn-success btn-sm  float-right d-md-block d-lg-none"  onclick="togglePopup ( )">close</button>
                        <div class="header-nav">
                            <div class="row">
                                <div class="col-lg-3 logo_section">
                                    <div class="full">
                                        <div class="center-desk">
                                            <div class="logo">
                                                <a href="index.php"><img src="<?php echo BASE_URL_LINK ;?>images/logo.jpg" alt="#"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <div class="right_header_info">
                                        <ul class="users_pro">
                                            <li>
                                                <img style="width:25px;" src="<?php echo BASE_URL_LINK ;?>image/img/rw-flag.jpg">
                                                <span style="color:#2b2828">Rwanda</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                         </div>
                    </div>
                    <div class="card-body" style="background: #e0dedc;">

                            <div class="container">

                <?php 

                // $result = $users->runQuery("SELECT * FROM craft_watchlist WHERE user_id3_list= $user_id and item_purchased_on = 'on' and item_purchased_list = '$item_purchased'
                $result = $users->runQuery("SELECT * FROM craft_watchlist W LEFT JOIN checkout_payment C on C. item_purchased = W. item_purchased_list WHERE W. user_id3_list= $user_id and W. item_purchased_on = 'on' and W. modified <= '$datetime'
                GROUP BY W. item_purchased_list HAVING COUNT(DISTINCT W. item_purchased_list)= 1 ORDER BY W. modified Desc");
                foreach ($result as $items ) {
                    $total_quantitys = 0;
                    $total_price = 0;
                    # code...
                ?>

                <h3> Date purchased on <?php echo $users->timeAgo($items['modified']); ?></h3>

                <table class="tbl-cart table table-responsive-sm table-hover table-bordered bg-light"  cellpadding="10" cellspacing="1">
                <thead class="main-active">
                <tr>
                <th style="text-align:left;" width="2%">No</th>
                <th style="text-align:left;">Name</th>
                <th style="text-align:left;">Code</th>
                <th style="text-align:right;" width="5%">quantitys</th>
                <th style="text-align:right;" width="12%">Unit Price</th>
                <th style="text-align:right;" width="13%">Price</th>
                <!-- <th style="text-align:center;" width="5%">Remove</th> -->
                </tr>	
                </thead>
                <tbody>
                <?php	

                    // $db =$users->database;
                    // $result = $users->runQuery("SELECT * FROM craft_watchlist WHERE user_id3_list= $user_id and item_purchased_on = 'on' and item_purchased_list = '$item[item_purchased_list]' ORDER BY modified Desc ");
                    $results = $users->runQuery("SELECT * FROM craft_watchlist WHERE user_id3_list= $user_id and item_purchased_on = 'on' and item_purchased_list = '$items[item_purchased_list]' ORDER BY modified Desc ");
                    // GROUP BY item_purchased_list HAVING COUNT(DISTINCT item_purchased_list) > 10 
                    $i= 1;
                    foreach ($results as $item){
                        $item_price = $item["quantitys"]*$item["unit_price"];
                        ?>
                                <tr>
                                <td>
                                      <?php echo $i++; ?>
                                </td>
                                <td><img src="<?php echo BASE_URL ;?>uploads/craft/<?php echo $item["photo_list"]; ?>" height='80px' width='80px' class="cart-item-image" /> <span class="ml-3"><?php echo $item["code_watchlist"]; ?></span></td>
                                <td><?php echo $item["code_watchlist"]; ?></td>
                                <td style="text-align:right;"><?php echo $item["quantitys"]; ?></td>
                                <td  style="text-align:right;"><?php echo "$ ".number_format($item["unit_price"]); ?></td>
                                <td  style="text-align:right;"><?php echo "$ ". number_format($item_price); ?></td>
                                </tr>
                                <?php
                                $total_quantitys += $item["quantitys"];
                                $total_price += ($item["unit_price"]*$item["quantitys"]);
                        }
                        ?>
                
                <tr>
                <td colspan="2" align="left" style="font-size:15px;font-weight:600">Total:</td>
                <td align="right" colspan="2"><?php echo $total_quantitys; ?></td>
                <td align="right" colspan="3"><strong><?php echo "$ ".number_format($total_price); ?></strong></td>
                <!-- <td></td> -->
                </tr>
                <tr>
                    <td colspan="2" align="left">
                        <div>
                        <span style="font-size:15px;font-weight:600">Shipping Address</span> : 
                    
                            <br><span >Name</span>: <?php echo $items["lastname"]; ?> 
                            <span >email</span>: <?php echo $items["email"]; ?> 
                            <span >phone</span>: <?php echo $items["phone"]; ?> 
                            <br><span >address</span> : <?php echo $items["address"].' ,'.$items["address2"]; ?> 
                            <span >Country</span> : <?php echo $items["country"]; ?>
                        </div>
                    </td>
                    <td colspan="5" align="left">
                    
                        <div style="position: relative;height: 40px;">
                            <div class="progress progress-xs mb-2">
                                <?php echo $handmade->Users_usage_shipping($items["shipping_percentage"]) ;?>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="left">Remove this invoice:</td>
                    <td colspan="5" align="center">
                        <form method="post" id="form-craft-cartitem<?php echo $items['code_watchlist']; ?>remove" >
                            <input type="hidden" style="width:30px;" name="user_id" value="<?php echo $items['user_id3_list']; ?>" />
                            <input type="hidden" style="width:30px;" name="actions" value="remove" />
                            <input type="hidden" style="width:30px;" name="code" value="<?php echo $items['code_watchlist']; ?>" />
                            <a href="javascript:void(0);" onclick="xxda('remove','<?php echo 'form-craft-cartitem'.$items['code_watchlist'].'remove'; ?>','<?php echo $items['code_watchlist']; ?>');"><img src="<?php echo BASE_URL_LINK ;?>image/product-images/icon-delete.png" alt="Remove Item" /></a> 
                        </form>
                    </td>
                </tr>
                </tbody>
                </table>		
            <?php } ?>


                                </div><!-- /.card-body -->
                    </div><!-- /.card-body -->
                <div class="card-footer text-muted">
                    Footer
                </div><!-- /.card-footer -->
                </div>

           </div><!-- img-popup-body -->
        </div><!-- user-show-popup-box -->
    </div> <!-- Wrp4 -->
</div> <!-- apply-popup" -->



<?php } ?>
