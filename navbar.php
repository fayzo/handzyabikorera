
<body class="hold-transition main-layout sidebar-collapse">

<!-- loader  -->
<div class="loader_bg">
    <div class="loader"><img src="<?php echo BASE_URL_LINK ;?>images/loading.gif" alt="#" /></div>
</div>
 <!-- end loader -->

<div class="wrapper">
   
    <div class="sidebar main-sidebar">
        <!-- Sidebar  -->
        <nav id="sidebar">

            <div id="dismiss" data-widget="pushmenu">
                <i class="fa fa-arrow-left"></i>
            </div>

            <ul class="list-unstyled components">
                <li class="active"> <a href="<?php echo BASE_URL;?>">Home</a></li>
                <li> <a href="<?php echo BASE_URL;?>about.php">About</a></li>
                <li> <a href="<?php echo BASE_URL;?>product.php">Product</a></li>
                <li> <a href="<?php echo BASE_URL;?>blog.php">Blog</a></li>
                <li> <a href="<?php echo BASE_URL;?>contact.php">Contact us</a></li>
            </ul>

        </nav>
    </div>

    <div id="content">
        <!-- header -->
        <header>

            <div class="container-fluid">
                <div class="row">

                    <div class="col-12 py-2 d-md-block d-none" style="background-color: #f3f3f3 ;">
                        <div class="row">
                            <div class="col-auto mr-auto">
                                <ul class="top-nav">
                                    <li>
                                        <a href="tel:+123-456-7890"><i class="fa fa-phone-square mr-2"></i>+(250)-787-384312</a>
                                    </li>
                                    <li>
                                        <a href="mailto:mail@ecom.com"><i class="fa fa-envelope mr-2"></i>irangiro@ubukorikori.com</a>
                                    </li>
                                    <li>
                                    <a href="javascript:void(0)" class="btn btn-sm btn-outline-success text-dark mr-2 border-0" id="contacts_business" data-contacts="contacts_business">
                                    @ CONTACT US</a>
                                        <!-- <a href="mailto:mail@ecom.com"><i class="fa fa-envelope mr-2"></i>irangiro@ubukorikori.com</a> -->
                                    </li>
                                </ul>
                            </div>
                            <div class="col-auto">
                                <ul class="top-nav">
                                    <li>
                                        <a href="register.html"><i class="fas fa-map-marker-alt mr-2"></i>Kigali-Rwanda</a>
                                        <!-- <a href="register.html"><i class="fas fa-user-edit mr-2"></i>Register</a> -->
                                    </li>
                                    <li>
                                        <a href="login.html"><i class="fas fa-map mr-2"></i>Address:KG 534 St, RW</a>
                                        <!-- <a href="login.html"><i class="fas fa-sign-in-alt mr-2"></i>Login</a> -->
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div><!-- col -->
                </div><!-- row -->
            </div><!-- container -->

            <!-- header inner -->
            <div class="header">

                <div class="container-fluid">

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
                                    <li>
                                        <a style="border: none;" href="javascript:void(0)" class="btn btn-sm btn-outline-primary" id="add_craft" data-craft="<?php echo $user_id; ?>" ><i class="fa fa-edit"></i> + Add Craft </a>
                                    </li>
                                    <li class="users_pro_li">
                                        <!-- <a href="#"><img style="margin-right: 15px;" src="< ?php echo BASE_URL_LINK ;?>icon/1.png" alt="#" /></a> -->
                                        <?php if (isset($_SESSION['key_craft'])) { ?>
                                        <div class="dropdown user-menu show">
                                            <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <?php if (!empty($user['profile_img'])) { ?>
                                                    <img style="margin-right: 15px;" src="<?php echo BASE_URL_LINK."image/users_profile_cover/".$user['profile_img'] ;?>" width="25px" height="25px" class="user-image rounded-circle"  alt="User Image" >
                                                <?php  }else{ ?>
                                                    <img style="margin-right: 15px;" src="<?php echo BASE_URL_LINK ;?>icon/1.png" alt="User Image" class="user-image" >
                                                <?php } ?>
                                                <span class="hidden-xs"><span id="welcome-json">welcome </span><?php echo $user['username']; ?></span>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <!-- User image -->
                                                <li class="user-header" style="background: url('<?php echo BASE_URL_LINK.COVER_IMAGE_URL;?>') center center;background-size: cover; overflow: hidden; width: 100%;">
                                                    <?php if (!empty($user['profile_img'])) { ?>
                                                        <img src="<?php echo BASE_URL_LINK."image/users_profile_cover/".$user['profile_img'] ;?>" alt="" class="rounded-circle" alt="User Image" >
                                                    <?php  }else{ ?>
                                                        <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE;?>" alt="User Image" class="rounded-circle">
                                                    <?php } ?>
                                                <p>
                                                <?php echo $user['username']." -".$user['register_as']; ?> 
                                                <!-- - Agent -->
                                            <small>Member since  <?php echo $users->timeAgo($user['date_registry']); ?> </small>
                                            </p>
                                        </li>
                                        <!-- Menu Body -->
                                        <li class="user-body">
                                            <div class="row">
                                            <div class="col-4 text-center">
                                                <a href="<?php echo SETTING; ?>">Settings</a>
                                            </div>
                                        <?php  if ($_SESSION['register_as'] != 'buyer') { ?>
                                                <div class="col-4 text-center">
                                                    <a href="<?php echo BASE_URL.$user['username'] ;?>" >Profile</a>
                                                </div>
                                                <div class="col-4 text-center">
                                                    <a href="<?php echo PROFILE_EDIT; ?>">Profile Edit</a>
                                                </div>
                                            <?php } ?>
                                                </div>

                                            <!-- /.row -->
                                        </li>
                                        <!-- Menu Footer-->
                                        <li class="user-footer main-active">
                                        <?php  if ($_SESSION['admin'] == 'admin') { ?>
                                            <div class="pull-left">
                                            <a href="<?php echo ADMIN; ?>" class="btn btn-info btn-sm">Admin</a>
                                            </div>
                                            <?php } ?>
                                            <div class="pull-right">
                                            <!-- <a href="< ?php echo LOGOUT;?>" class="btn btn-danger btn-sm ">Sign out</a> -->
                                            <a href="javascript:void(0)" id="logout-please" class="btn btn-danger btn-sm ">Sign out</a>
                                            <!-- <a href="< ?php echo LOGOUT; ?>" class="btn btn-danger btn-sm ">Sign out</a> -->
                                            </div>
                                        </li>
                                        </ul>
                                        </div>
                                        <?php }else{ ?>
                                            <!-- <a style="color:white;border: none;" class="btn btn-sm btn-outline-success" href="< ?php echo LOGIN; ?>">login</a> -->
                                            <a id="login-please" data-login="1" href="javascript:void(0)" ><img src="<?php echo BASE_URL_LINK ;?>icon/1.png" alt="#" /> Register | Sign in</a>
                                            <!-- <a style="color:white;border: none;" class="btn btn-sm btn-outline-success" id="login-please" data-login="1" href="javascript:void(0)"><i class="fa fa-user" aria-hidden="true"></i> login</a> -->
                                        <?php } ?>
                                    </li>
                                    <li class="tytyu" style="position: relative;display: inline-block;">
                                        <?php if ($user['likes_counts'] > 0){ echo '<span class="likescounter badge badge-danger navbar-badge">'.$user["likes_counts"].'</span>' ;} ?>
                                        <a href="<?php echo LIKE_HAND_MADE ;?>"> <img style="margin-right: 15px;" src="<?php echo BASE_URL_LINK ;?>icon/2.png" alt="#" /></a>
                                    </li>
                                    <li>
                                        <?php if(isset($_SESSION["like_cart_item"])){ ?>

                                            <div class="dropdown foodcarts user-menu show">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="messages-dropdown-menu">
                                                <img style="margin-right: 15px;" src="<?php echo BASE_URL_LINK ;?>icon/3.png" alt="#" />
                                                <!-- <i style="font-size: 20px;" class="fa fa-shopping-cart"></i> -->
                                                <span id="messages1"><?php if(count($_SESSION["like_cart_item"]) > 0){echo '<span  class="badge badge-danger navbar-badge">'.count($_SESSION["like_cart_item"]).'</span>'; } ?></span>
                                                </a>
                                                <ul class="dropdown-menu" >
                                                    <li class="header main-active">You have <span><?php if(count($_SESSION["like_cart_item"]) > 0){echo '<span>'.count($_SESSION["like_cart_item"]).'</span>'; }else{ echo 'no' ;} ?></span> Cart</li>
                                                    <li>
                                                        <!-- inner menu: contains the actual data -->
                                                        <ul class="menu bg-light" id="messages-menu-view" >
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>

                                        <?php  }else{ ?>
                                                <a href="#"><img style="margin-right: 15px;" src="<?php echo BASE_URL_LINK ;?>icon/3.png" alt="#" /></a>
                                        <?php } ?>

                                    </li>

                                    <li>
                                        <button type="button" id="sidebarCollapse" data-widget="pushmenu">
                                            <img src="<?php echo BASE_URL_LINK ;?>images/menu_icon.png" alt="#" width="40px" />
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- end header inner -->
        </header>
        <!-- end header -->