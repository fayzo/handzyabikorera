<?php
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

$users->forgotUsernameCountsTodelete('users',
array('forgotUsernameCounts' => 'forgotUsernameCounts +1', ),$_SESSION['keycreate']);
$db->query("UPDATE users SET chat = 'off' WHERE user_id= $_SESSION[key_food] ");

unset($_SESSION['key_food']);
unset($_SESSION['profile_img']);
unset($_SESSION['approval']);
unset($_SESSION['chat']);
unset($_SESSION['register_as']);
unset($_SESSION['admin']);
unset($_SESSION['foodcart_item']);

session_unset();
session_destroy();
// header ('location: '.LOGIN.'');


?>