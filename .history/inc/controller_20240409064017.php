<?php 
session_start();
error_reporting(0);
include('database/connect.php'); 
include('database/connect2.php'); 

//set time
date_default_timezone_set('Africa/Lagos');
$current_date = date('Y-m-d H:i:s');

//website data
$appname="Secured Mobile-based E-voting System using 2FA security";  
$email_server="SMTP.GMAIL.COM";
$email_username="ADMISSION.MANSENSHS@GMAIL.COM";
$app_password="XMVLDREPYHGKJFKF";
$port=465;
$logo="uploadImage/logo/logo.png";
$sender="e-voting";


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