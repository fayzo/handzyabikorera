<?php 
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

if (isset($_POST['showMessage1']) && !empty($_POST['showMessage1'])) {
	?>
    <!-- start message -->
    <?php echo  $handmade->FoodshowCart_itemNavbar(); ?>
    <!-- end message -->
   					
<?php }

?>