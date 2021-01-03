<!-- -- < ?php include "header_if_login.php"?> --> 
<?php include "Get_usernameProfile.php"?>
<?php include "header.php"?>
<!-- <body class="chair"> -->
<?php include "navbar.php" ?>
    
<div class="container py-3">
    <h2>Shopping Cart</h2>
    <div class="row">
        <div class="col-md-12">

            <?php echo $handmade->Craft_showCart_item(); ?>
            <a href="<?php echo CHECKOUT ;?>" class="btn btn-primary float-right">Check out</a>
        </div>
    </div>
</div>

<?php include "footer.php"?>
