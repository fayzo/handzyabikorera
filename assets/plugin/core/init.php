<?php 
session_start();

include('database/db.php');
include('class/Users.php');
include('class/Home.php');
include('class/Handmade.php');
include('class/Profile_craft_agent.php');

// define('BASE_URL','https://iragiro.com/');
define('BASE_URL','http://localhost/handmade_craft/');


define('HOME', BASE_URL);
define('BASE_URL_LINK', BASE_URL.'assets/');
define('LOGIN', BASE_URL.'includes/login');
define('LOGOUT', BASE_URL.'includes/logout');
define('ADMIN', BASE_URL.'admin');

// UPLOAD PHOTO
define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT'].'/handmade_craft');
// UPLOAD PHOTO
// (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off')? 'https' : 'http';
// echo  $_SERVER['SERVER_NAME'];
// echo  $_SERVER['REQUEST_URI'];

// THIS IS HOUSE LINK
// define('PROFILE', BASE_URL.'profile');
define('LIKE_HAND_MADE', BASE_URL.'likes');
define('SHOWCART', BASE_URL.'showcart.php');
define('CHECKOUT', BASE_URL.'checkout.php');
define('SETTING', BASE_URL.'settings.php');
define('PROFILE_EDIT', BASE_URL.'profile_edit.php');
define('VIEW_MESSAGE', BASE_URL.'message.php');
define('WATCH_LIST', BASE_URL.'watchlist.php');
define('PROPERTY_REQUEST', BASE_URL.'property_request.php');
define('VIEW_ALL_PROPERTY', BASE_URL.'view_all_property.php');
// END HOUSE LINK

// TWITTER SOCIAL MEDIA 
define('TWITTER', 'https://twitter.com/');
define('INSTAGRAM', 'https://www.instagram.com/');
define('FACEBOOK', 'https://www.facebook.com/');
define('GOOGLE_PLUS', 'https://www.google.com/');
define('MAIL', 'https://www.mail.com/');

// TWITTER SOCIAL MEDIA 

// DEFAULT IMAGE USERS 
define( 'NO_PROFILE_IMAGE', 'image/users_profile_cover/empty-profile.png');
define( 'NO_PROFILE_IMAGE_URL', 'assets/image/user_default_image/defaultprofileimage.png');
define( 'NO_COVER_IMAGE_URL', 'assets/image/user_default_image/defaultCoverImage.png');
define( 'COVER_IMAGE_URL', 'image/img/vision-city-rwanda.jpg');



?>