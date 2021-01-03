
<!-- < ?php include "header_if_login.php"?> -->
<?php include "Get_usernameProfile.php"?>
<?php include "header.php"?>
<!-- <body class="chair"> -->
<?php include "navbar.php" ?>


    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="text-center">
                    <h1>Handmade by Artist in Rwanda</h1>
                    <p>Your Favorite liking items </p>
                </div>
                <?php echo $handmade->handmade_like_list('1',$user_id); ?>
            </div>
            <div class="col-md-3 py-4">
                <span id="responseSubmitfooditerm"> </span>
                <div id="responseSubmitfooditermview">
                    <?php echo $handmade->Craft_showCart_itemSale(); ?>
                </div>
            </div>
        </div>
    </div>



<?php include "footer.php" ?>
