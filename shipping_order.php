
<?php include "Get_usernameProfile.php"?>
<?php include "header.php" ?>
<!-- <body class="chair"> -->
<?php include "navbar.php" ?>

<div class="contactus">
      <div class="container-fluid">
          <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="title">
                  <h2>Shipping Order</h2>
                
                </div>
            </div>
          </div>
    </div>
</div>

  <section class="slider_section py-3">

      <div class="container">
          <div class="row">
              <div class="col-md-10 offset-1">
                  <div class="text-center">
                      <h1>Report of Shipping Order to clients</h1>
                  </div>
                  <?php echo $handmade->shipping_order(); ?>
              </div>
          </div>
      </div>
      
  </section>

  
<!--  footer --> 
<?php include "footer.php" ?>
<!--  footer --> 
   