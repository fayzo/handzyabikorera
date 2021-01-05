<?php 
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));


if (isset($_POST['craft_id']) && !empty($_POST['craft_id'])) {
    if (isset($_SESSION['key_craft'])) {
        # code...
        $user_id= $_SESSION['key_craft'];
    }
    
    $craft_id = $_POST['craft_id'];
    // $user= $house->houseReadmore($craft_id);
    $mysqli= $db;
    $query= $mysqli->query("SELECT * FROM craft H
        Left JOIN provinces P ON H. province = P. provincecode
        Left JOIN districts M ON H. districts = M. districtcode
        Left JOIN sectors T ON H. sector = T. sectorcode
        Left JOIN cells C ON H. cell = C. codecell
        Left JOIN vilages V ON H. village = V. CodeVillage 
        Left JOIN users U ON H. user_id3 = U. user_id 
    WHERE H. craft_id = $craft_id ");
    $row = $query->fetch_array();
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
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <div class="img_box" >
                                        <?php 
                                            $file = $row['photo']."=".$row['other_photo'];
                                            $expode = explode("=",$file); ?>
                                            <figure><img class="product-big-img" src="<?php echo BASE_URL.'uploads/craft/'.$expode[0]; ?>" alt=""></figure>
                                        </div>
                                        <div class="product-thumbs">
                                            <div class="product-thumbs-track ps-slider owl-carousel">

                                                    <div class="pt active" data-imgbigurl="<?php echo BASE_URL.'uploads/craft/'.$expode[0]; ?>" >
                                                        <img src="<?php echo BASE_URL.'uploads/craft/'.$expode[0]; ?>"  alt="">
                                                    </div>

                                                    <?php  for ($i=1; $i < count($expode); ++$i) { 
                                                            ?>
                                                            <div class="pt" data-imgbigurl="<?php echo BASE_URL.'uploads/craft/'.$expode[$i]; ?>">
                                                                <img src="<?php echo BASE_URL.'uploads/craft/'.$expode[$i]; ?>" alt="">
                                                            </div>
                                                    <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 product_detail_side">
                                        <div class="abotext_box">
                                            <div class="product-heading">
                                                <h2>Jane Lauren Design Chair</h2>
                                            </div>
                                            <div class="product-detail-side">
                                                <span><del>$679.89</del></span><span class="new-price">$547.60</span>
                                                <br><span class="rating">
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                </span>
                                                <span class="review">(5 customer review)</span>
                                            </div>
                                            <div class="detail-contant">
                                                <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.
                                                    <br><span class="stock">2 in stock</span>
                                                </p>

                                                 <?php if(isset($_SESSION['key_craft'])){ if($craft['user_id3_list'] != $user_id && $craft['craft_id_list'] != $craft['craft_id']  ){ ;?>
                                                    <form method="post" class="cart" id="form-craft-cartitem<?php echo $craft['code']; ?>add">
                                                        <div style="display:inline-flex;" >
                                                            <input type="hidden" style="width:30px;" name="user_id" value="<?php echo $user_id; ?>" />
                                                            <input type="hidden" style="width:30px;" name="actions" value="add" />
                                                            <input type="hidden" style="width:30px;" name="code" value="<?php echo $craft['code']; ?>" />
                                                            <input type="hidden" class="form-control form-control-sm text-center mr-2" style="width:30px;" name="quantitys" value="1" size="2" readonly/>
                                                            <div class="quantity">
                                                                <input step="1" min="1" max="5" name="quantity" value="1" title="Qty" class="input-text qty text" size="4" type="number">
                                                            </div>
                                                            <a class="bt_main" href="#" onclick="xxda('add','<?php echo 'form-craft-cartitem'.$craft['code'].'add'; ?>','<?php echo $craft['code']; ?>');" >+ Add to cart</a>
                                                        </div>
                                                    </form>
                                                <?php  } }else{ ?>
                                                    <form class="cart" method="post" action="#">
                                                        <div class="quantity">
                                                            <input step="1" min="1" max="5" name="quantity" value="1" title="Qty" class="input-text qty text" size="4" type="number">
                                                        </div>
                                                        <button type="button" id="login-please" data-login="1" class="bt_main">Add to cart</button>
                                                    </form>
                                                <?php } ;?>
                                            

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="full">
                                            <div class="tab_bar_section">
                                                <ul class="nav nav-tabs" role="tablist">
                                                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#description">Description</a> </li>
                                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#reviews">Reviews (2)</a> </li>
                                                </ul>
                                                <!-- Tab panes -->
                                                <div class="tab-content">
                                                    <div id="description" class="tab-pane active">
                                                        <div class="product_desc">
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ac elementum elit. Morbi eu arcu ipsum. Aliquam lobortis accumsan quam ac convallis. Fusce elit mauris, aliquet at odio vel, convallis vehicula nisi. Morbi vitae porttitor dolor. Integer eget metus sem. Nam venenatis mauris vel leo pulvinar, id rutrum dui varius. Nunc ac varius quam, non convallis magna. Donec suscipit commodo dapibus.
                                                                <br>
                                                                <br>Vestibulum et ullamcorper ligula. Morbi bibendum tempor rutrum. Pelle tesque auctor purus id molestie ornare.Donec eu lobortis risus. Pellentesque sed aliquam lorem. Praesent pulvinar lorem vel mauris ultrices posuere. Phasellus elit ex, gravida a semper ut, venenatis vitae diam. Nullam eget leo massa. Aenean eu consequat arcu, vitae scelerisque quam. Suspendisse risus turpis, pharetra a finibus vitae, lobortis et mi.</p>
                                                        </div>
                                                    </div>
                                                    <div id="reviews" class="tab-pane fade">
                                                        <div class="product_review">
                                                            <h3>Reviews (2)</h3>
                                                            <div class="commant-text row">
                                                                <div class="col-lg-2 col-md-2 col-sm-4">
                                                                    <div class="profile">
                                                                        <img class="img-responsive" src="<?php echo BASE_URL_LINK ;?>images/lllll.png" alt="#">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-10 col-md-10 col-sm-8">
                                                                    <h5>Ravi</h5>
                                                                    <p><span class="c_date">July 23, 2019</span> | <span><a rel="nofollow" class="comment-reply-link" href="#">Reply</a></span></p>
                                                                    <span class="rating">
                                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                    </span>
                                                                    <p class="msg">ThisThis book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, “Lorem ipsum dolor sit amet..
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="commant-text row">
                                                                <div class="col-lg-2 col-md-2 col-sm-4">
                                                                    <div class="profile">
                                                                        <img class="img-responsive" src="<?php echo BASE_URL_LINK ;?>images/lllll.png" alt="#">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-10 col-md-10 col-sm-8">
                                                                    <h5>Ravi</h5>
                                                                    <p><span class="c_date">July 23, 2019</span> | <span><a rel="nofollow" class="comment-reply-link" href="#">Reply</a></span></p>
                                                                    <span class="rating">
                                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                    </span>
                                                                    <p class="msg">Nunc augue purus, posuere in accumsan sodales ac, euismod at est. Nunc faccumsan ermentum consectetur metus placerat mattis. Praesent mollis justo felis, accumsan faucibus mi maximus et. Nam hendrerit mauris id scelerisque placerat. Nam vitae imperdiet turpis</p>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <div class="full review_bt_section">
                                                                        <div class="float-right">

                                                                            <a class="bt_main" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Leave a Review</a>

                                                                        </div>
                                                                    </div>

                                                                    <div class="full">

                                                                        <div id="collapseExample" class="full collapse commant_box">
                                                                            <form accept-charset="UTF-8" action="index.html" method="post">
                                                                                <input id="ratings-hidden" name="rating" type="hidden">
                                                                                <textarea class="shadow-form-control form-control animated" cols="50" id="new-review" name="comment" placeholder="Enter your review here..." required=""></textarea>
                                                                                <div class="full_bt center">
                                                                                    <button class="bt_main" type="submit">Save</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                    </div><!-- /.card-body -->
                <div class="card-footer text-muted">
                    Footer
                </div><!-- /.card-footer -->
                </div>

           </div><!-- img-popup-body -->
        </div><!-- user-show-popup-box -->
    </div> <!-- Wrp4 -->
</div> <!-- apply-popup" -->


    <script>
    	 $(document).ready(function() {
			// $("#content-slider").lightSlider({
            //     loop:true,
            //     keyPress:true
            // });
            // $('#image-gallery').lightSlider({
            //     gallery:true,
            //     item:1,
            //     thumbItem:9,
            //     slideMargin: 0,
            //     speed:1500,
            //     auto:true,
            //     loop:true,
            //     onSliderLoad: function() {
            //         $('#image-gallery').removeClass('cS-hidden');
            //     }  
            // });

            /*-------------------
                    Propery Short Slider
                --------------------- */
                $(".ps-slider").owlCarousel({
                items: 5,
                dots: false,
                autoplay: false,
                margin: 10,
                loop: true,
                smartSpeed: 1200
            });

                /*------------------
                    Single Product
                --------------------*/
            $('.product-thumbs-track .pt').on('click', function () {
                $('.product-thumbs-track .pt').removeClass('active');
                $(this).addClass('active');
                var imgurl = $(this).data('imgbigurl');
                var bigImg = $('.product-big-img').attr('src');
                if (imgurl != bigImg) {
                    $('.product-big-img').attr({
                        src: imgurl
                    });
                }
            });

		});
    </script>

<?php } 


if(isset($_POST['contacts_agent'])){ 
    
    # code...
    $businessDetails= $home->businessData('1');
    $user_id = $_POST['user_id_agent'];

    $mysqli= $db;
    $query= $mysqli->query("SELECT * FROM users WHERE user_id = $user_id ");
    $row = $query->fetch_array();
    ?>

    <div class="house-popup">
        
    <div class="wrap6" id="disabler">
        <div class="wrap6Pophide" onclick="togglePopup ( )" ></div>
        <span class="col-sm-12 col-md-3  colose">
            <button class="close-imagePopup"><i class="fa fa-times" aria-hidden="true"></i></button>
        </span>
        <div class="img-popup-wrap" id="popupEnd" style="max-width: 409px;">
            <div class="img-popup-body" >
    
            <div class="card">
                <div class="card-header">
                        <button class="btn btn-success btn-sm  float-right d-md-block d-lg-none" onclick="togglePopup( )">close</button>
                        <div class="property-contactus">
                            <div class="agent-desc">
                            <div class="user-block">
                                <div class="user-blockImgBorder">
                                    <div class="user-blockImg">
                                        <?php if (!empty($row['profile_img'])) { ?>
                                            <img src="<?php echo BASE_URL_LINK."image/users_profile_cover/".$row['profile_img']; ?>" alt="User Image">
                                        <?php  }else{ ?>
                                            <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE;?>" alt="User Image">
                                        <?php } ?>
                                    </div>
                                </div>
                                <!-- <span class="username tooltips">
                                    <a href="http://localhost:80/Blog_nyarwanda_CMS/fayzo">faysal shema</a>
                                </span>
                                <span class="description">Publish <i class="fa fa-clock-o" style="color: #2cbdb8;margin-right: 4px;" aria-hidden="true"></i>- Sep 17, 2019</span> -->
                            </div>
                                <div class="agent-title">
                                    <h5><a href="<?php echo BASE_URL.$row['username']; ?>"> Contact <?php echo $row['lastname']; ?></a></h5>
                                    <!-- <span>Saler Marketing </span> -->
                                    <span class="mr-2"> Agent </span>
                                    <span class="agent-social">
                                        <!-- <a href="< ?php echo $businessDetails['facebook_business']; ?>"><i class="fa fa-facebook"></i></a>
                                        <a href="< ?php echo $businessDetails['twitter_business']; ?>"><i class="fa fa-twitter"></i></a>
                                        <a href="< ?php echo $businessDetails['google_plus_business']; ?>"><i class="fa fa-google-plus"></i></a>
                                        <a href="< ?php echo $businessDetails['instagram_business']; ?>"><i class="fa fa-instagram"></i></a>
                                        <a href="< ?php echo $businessDetails['email_business']; ?>>"><i class="fa fa-envelope"></i></a> -->
                                        <?php  if(!empty($row['facebook'])){ ?>
                                        <a target="_blank" href="<?php echo $row['facebook']; ?>"><i class="fa fa-facebook"></i></a>
                                        <?php }else { ?>
                                            <a target="_blank" href="<?php echo $businessDetails['facebook_business']; ?>"><i class="fa fa-facebook"></i></a>
                                        <?php } ?>
                                        <?php  if(!empty($row['twitter'])){ ?>
                                            <a href="<?php echo $row['twitter']; ?>"><i class="fa fa-twitter"></i></a>
                                        <?php }else { ?>
                                            <a target="_blank" href="<?php echo $businessDetails['twitter_business']; ?>"><i class="fa fa-twitter"></i></a>
                                        <?php } ?>
                                        <?php  if(!empty($row['instagram'])){ ?>
                                            <a target="_blank" href="<?php echo $row['instagram']; ?>"><i class="fa fa-instagram"></i></a>
                                        <?php }else { ?>
                                            <a target="_blank" href="<?php echo $businessDetails['instagram_business']; ?>"><i class="fa fa-instagram"></i></a>
                                        <?php } ?>
                                        <?php  if(!empty($row['email'])){ ?>
                                            <a target="_blank" href="<?php echo $row['email']; ?>"><i class="fa fa-envelope"></i></a>
                                        <?php }else { ?>
                                            <a target="_blank" href="<?php echo $businessDetails['email_business']; ?>>"><i class="fa fa-envelope"></i></a>
                                        <?php } ?>
                                    </span>
                                </div>

                            </div>
                        </div>
                </div>
                <form action="#" method="post" id="form_agentMessage" class="agent-contact-form">
                <div class="card-body">
                    <div id="responses"></div> 
                    <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                    <input type="hidden" name="craft_id" value="0">
                            <div class="form-row">
                                <div class="col-12">
                                <label for="lastname">Name :</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon2"><i class="fa fa-user"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="name_clientToAgent" id="name_clientToAgent"
                                        aria-describedby="helpId" placeholder="name">
                                        <span id="response"></span>
                                </div>
                                </div>
                                <div class="col-12">
                                <label for="specialize">email :</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon2"><i class="fa fa-envelope"></i>
                                        </span>
                                    </div> 
                                    <input type="email" class="form-control" name="email_clientToAgent" id="email_clientToAgent"
                                        aria-describedby="helpId" placeholder="@email">
                                        <span id="response"></span>
                                </div>
                                </div>
                                <div class="col-12">
                                <label for="specialize">Telephone :</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon2"><i class="fa fa-phone"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="phone_clientToAgent" id="phone_clientToAgent" 
                                        aria-describedby="helpId" placeholder="Telephone">
                                        <span id="response"></span>
                                </div>
                                </div>
                            </div>
                               
                            <textarea class="form-control mt-2" id="message_clientToAgent"  name="message_clientToAgent"  placeholder="Messages"></textarea>
                                <div id="responseAgentMessage"></div>
                        </div>  <!-- card-body -->
                        <div class="card-footer">
                            <button id="submit_clientToAgent"  class="btn btn-block btn-primary m-2"  type="button" >Send Message</button>
                        </div>
                         <!-- card-footer -->
                        </form>
                      </div>
                           <!-- card -->
    
            </div><!-- img-popup-body -->
            </div><!-- tweet-show-popup-box -->
        </div> <!-- Wrp4 -->
    </div> <!-- apply-popup" -->
    
    <?php } 

if (isset($_POST['name_clientToAgent']) && !empty($_POST['name_clientToAgent'])) {
    $user_id= $_POST['user_id'];
    $craft_id= $_POST['craft_id'];
    $datetime= date('Y-m-d H-i-s');

    $name = $users->test_input($_POST['name_clientToAgent']);
    $email = $users->test_input($_POST['email_clientToAgent']);
    $phone = $users->test_input($_POST['phone_clientToAgent']);
    $message = $users->test_input($_POST['message_clientToAgent']);
    // echo var_dump($_POST);

	$users->Postsjobscreates('agent_message',array( 
	'name_client'=> $name,
	'email_client'=> $email, 
	'phone_client'=> $phone, 
	'message_client'=> $message, 
    'user_id3'=> $user_id,
    'house_id_msg'=> $craft_id,
    'datetime'=> $datetime 
        ));
} 


if (isset($_POST['newslatter_email_client']) && !empty($_POST['newslatter_email_client'])) {
    $email = $users->test_input($_POST['newslatter_email_client']);

    require '../../newsletters_thank_.php';
    $datetime= date('Y-m-d H-i-s');

	$users->Postsjobscreates('client_subscribe_email',array( 
	'email_subscribe'=> $email, 
    'datetime'=> $datetime 
        ));
} ?>

