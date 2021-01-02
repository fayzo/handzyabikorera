<?php
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

if (isset($_REQUEST['sectorcode']) && !empty($_REQUEST['sectorcode'])) {

	$get_cell = mysqli_query($db,"SELECT * FROM  cells WHERE sectorcode ='".$_REQUEST['sectorcode']."'");

	echo "<select name=\"codecell\" id=\"codecell\" class=\"form-control\">" ;
	if(mysqli_fetch_array($get_cell)==0){
		echo "<option value=\"No Cell Available\">No Cell Available</option>";
	}else{
	
	    echo "<option value=\"\">------Select cell------</option>";
		while($row=mysqli_fetch_array($get_cell)){
			echo "<option value=\"".$row['codecell']."\">".$row['nameCell']."</option>";
		}
	}
	echo "</select><br>";

}

if (isset($_POST['sector']) && !empty($_POST['sector'])) {
	$categories = $_POST['categories'];
	$province= $_POST['province'];
	$district = $_POST['district'];
	$sector = $_POST['sector'];
	$pages = $_POST['pages'];
	$user_id = $_POST['user_id'];

	$mysqli= $db;
	$query= $mysqli->query("SELECT * FROM house H,provinces P,districts M ,sectors T 
	WHERE  P. provincecode = '{$province}' and
	M. districtcode= '{$district}'and T. sectorcode = '{$sector}' ");
	$houses = $query->fetch_array();
	
	echo $house->propertyView_SeachSectorNavbar($categories,$province,$district,$sector,$pages,$user_id);
	echo "<div class='text-center h3 text-success'>$houses[provincename] / $houses[namedistrict] district / $houses[namesector] sector </div>";
	echo $house->propertyView_SeachSectorList($categories,$province,$district,$sector,$pages,$user_id);
} 

if (isset($_POST['sector_list']) && !empty($_POST['sector_list'])) {

	$categories = $_POST['categories'];
	$province= $_POST['province'];
	$district = $_POST['district'];
	$sector = $_POST['sector_list'];
	$pages = $_POST['pages'];
	$user_id = $_POST['user_id'];

	echo $house->propertyView_SeachSectorList($categories,$province,$district,$sector,$pages,$user_id);
} 
// echo var_dump($_POST);
?>

	
