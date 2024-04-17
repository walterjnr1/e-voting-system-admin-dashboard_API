<?php 
session_start();
error_reporting(1);
include('database/connect.php'); 
include('database/connect2.php'); 

//set time
date_default_timezone_set('Africa/Lagos');
$current_date = date('Y-m-d H:i:s');

//website data
$stmt = $dbh->query("SELECT * FROM website_settings");
$row_website = $stmt->fetch();
$schoolname=$row_website['schoolname'];  
$address=$row_website['address'];
$state=$row_website['state'];
$email_website=$row_website['email'];
$phone_website=$row_website['phone'];
$url=$row_website['url'];
$email_server=$row_website['email_server'];
$email_username=$row_website['email_username'];
$app_password="$row_website['app_password']";
$port=465;
$logo="uploadImage/logo/logo.png";


//fetch admin data
$username = $_SESSION["login_username"];

$stmt = $dbh->query("SELECT * FROM users where username='$username'");
$row_user= $stmt->fetch();
$fullname_admin=$row_user['fullname'];  
$photo_admin =$row_user['photo'];
$email_admin=$row_user['email'];
$password_admin=$row_user['password'];
$lastaccess=$row_user['lastaccess'];


?>