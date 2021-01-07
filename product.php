
<?php include "Get_usernameProfile.php"?>
<?php include "header.php"?>
<!-- <body class="chair"> -->
<?php include "navbar.php" ?>

<div class="contactus">
      <div class="container-fluid">
          <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="title">
                  <h2>Our Product</h2>
                
                </div>
            </div>
          </div>
    </div>
</div>

  <section class="slider_section">

      <?php echo $handmade->craftList_homeNavbarblack('Featured',1,1); ?>

      <div class="container">
          <div class="row">
              <div class="col-md-9">
                  <div class="text-center">
                      <h1>Handmade by Artist in Rwanda</h1>
                      <p>Select Your Desire Arts</p>
                  </div>
                  <?php echo $handmade->handmade_list('Featured',1,$user_id); ?>
              </div>
              <div class="col-md-3">
                  <span id="responseSubmitfooditerm"> </span>
                  <div id="responseSubmitfooditermview">
                      <?php echo $handmade->Craft_showCart_itemSale(); ?>
                  </div>
              </div>
          </div>
      </div>
      
  </section>

  
<!--  footer --> 
<?php include "footer.php" ?>
<!--  footer --> 
   