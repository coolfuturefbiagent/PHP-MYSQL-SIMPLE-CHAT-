<?php
session_start();
date_default_timezone_set('Asia/Colombo');
error_reporting(E_ALL ^ E_DEPRECATED);
require_once("includes/mysqli.php");

define("MYSQL_HOST","localhost");
define("MYSQL_USER","root");
define("MYSQL_PASSWORD","");
define("DATABASE_NAME","messages_application");
define("DEBUG",true);
define("DEFAULT_TIMEZONE","gmt");
define("NOTFOUNDPAGE","404.php");

$mysqli = new mysqli (MYSQL_HOST,MYSQL_USER, MYSQL_PASSWORD, DATABASE_NAME);
$db = new MysqliDb ($mysqli);

$folder_name="chat_project";
$website_url="http://".$_SERVER['HTTP_HOST']."/".$folder_name."/";
$no_user_img=$website_url."media/none.120x120.png";

define("NO_USER_IMG",$no_user_img);
$profile_pictures_url=$website_url."profilepictures/";

define("FLAGS_FOLDER_NAME","flags");
define("MEDIA_FOLDER_NAME","media");
define("WEBSITE_URL",$website_url);
define("NUMBER_OF_DAYS_TO_DISPLAY_AS_NEW",5);
define("NUMBER_OF_HITS_TO_DISPLAY_AS_POPULAR",10);


$email="greendiary@gmail.com";

?>