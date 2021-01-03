<!-- -- < ?php include "header_if_login.php"?> --> 
<?php include "Get_usernameProfile.php"?>
<?php include "header.php"?>
<!-- <body class="chair"> -->
<?php include "navbar.php" ?>
    
    <!-- Property Section Begin -->
    <section class="property-section spad">

        <div class="container">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Profile</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="<?php echo (isset($_SESSION['key_craft']))? HOME:F_INDEX ; ?>">Home</a></li>
                  <?php if(isset($_SESSION['key_craft'])){ ?> 
                  <li class="breadcrumb-item active"><a href="<?php echo PROFILE_EDIT; ?>">Profile Edit</a></li>
                  <?php } ?>
                </ol>
            </div>
        </div>
        </div><!-- /.container-fluid -->

        <div class="container">
        <div class="row">
          <div class="col-md-3 mb-3">

            <!-- Profile Image -->
            <div class="card bg-light">
                <div class="card-header text-muted border-bottom-0">
                  Real Estate Agent
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b><?php echo $profileData['firstname']." ".$profileData['lastname']; ?></b></h2>
                      <!-- <p class="text-muted text-sm"><b>About: </b> Web Designer / UX / Graphic Artist / Coffee Lover </p> -->
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fa fa-lg fa-building"></i></span> Address: <?php echo $profileData['location']; ?></li>
                        <li class="small"><span class="fa-li"><i class="fa fa-lg fa-phone"></i></span> Phone : (+250) <br><?php echo substr($profileData['telephone'],1); ?></li>
                      </ul>
                    </div>
                    <div class="col-5 text-center single-agent-profile">
                        <div class="sa-pic">
                              <?php if (!empty($profileData['profile_img'])) { ?>
                                  <img src="<?php echo BASE_URL_LINK."image/users_profile_cover/".$profileData['profile_img'] ;?>" alt="" class="img-circle img-fluid" alt="User Image" >
                              <?php  }else{ ?>
                                  <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE;?>" alt="User Image" class="img-circle img-fluid">
                              <?php } ?>
                            <!-- <img src="< ?php echo BASE_URL;?>assets/image/img/agent/agent-1.jpg" alt="" class="img-circle img-fluid"> -->
                            <div class="hover-social">
                                <a target="_blank" href="<?php echo TWITTER.$profileData['twitter']; ?>" class="twitter"><i class="fa fa-twitter"></i></a>
                                <a target="_blank" href="<?php echo FACEBOOK.$profileData['facebook']; ?>" class="instagram"><i class="fa fa-instagram"></i></a>
                                <a target="_blank" href="<?php echo INSTAGRAM.$profileData['instagram']; ?>" class="facebook"><i class="fa fa-facebook"></i></a>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <?php if ($profileData['user_id'] != isset($_SESSION['key_craft'])) { ?>
                      <a href="javascript:void(0)" id="contacts_agent" data-user="<?php echo $profileData['user_id'];?>"  class="btn btn-sm bg-teal">
                        <i class="fas fa-comments"></i> Message
                      </a>
                    <?php }else { ?>
                      <a href="<?php echo VIEW_MESSAGE; ?>" class="btn btn-sm bg-teal">
                         <i class="fas fa-eye"></i> Message
                      </a>
                    <?php } ?>
                    <!-- <a href="#" class="btn btn-sm btn-primary">
                      <i class="fas fa-user"></i> View Profile
                    </a> -->
                  </div>
                </div>
              </div>

              <div class="card bg-light mt-3">
              <div class="card-header text-muted border-bottom-0">
                About Me
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                <p class="text-muted"><?php echo $profileData['location']; ?></p>

                <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                <p class="text-muted">
                <?php echo $profileData['skills']; ?>

                </p>

                <hr>

                <strong><i class="far fa-file-alt mr-1"></i>Professional</strong>

                <p class="text-muted">

                <?php echo $profileData['notes']; ?>
                </p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col -->
          <div class="col-md-9">
                  <?php echo $profile_craft_agent->craftList_agentNavbar('Featured',1,$profileData['user_id']); ?>
                  <?php echo $profile_craft_agent->craftList_agentHome('Featured',1,$profileData['user_id']); ?>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      
    </section>
    <!-- Property Section End -->

    
    <?php include "footer.php"?>
