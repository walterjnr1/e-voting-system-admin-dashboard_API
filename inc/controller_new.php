<?php 
session_start();
error_reporting(1);
include('database/connect.php'); 
include('database/connect2.php'); 

//set time
date_default_timezone_set('Africa/Accra');
$current_date = date('Y-m-d H:i:s');


//website data
$stmt = $dbh->query("SELECT * FROM website_settings");
$row_website = $stmt->fetch();
$schoolname=$row_website['schoolname'];  
$address=$row_website['address'];
$state=$row_website['state'];
$email_website=$row_website['email'];
$phone=$row_website['phone'];
$url=$row_website['url'];
$email_server=$row_website['email_server'];
$email_username=$row_website['email_username'];
$app_password=$row_website['app_password'];
$port=$row_website['email_port'];
$logo=$row_website['logo'];
$publickey=$row_website['publickey'];
$secretkey=$row_website['secretkey'];
$_SESSION['admission_fee']=$row_website['admission_fee'];

$sql = "select * from school_session order by ID desc limit 1"; 
$result = $conn->query($sql);
$row_session = mysqli_fetch_array($result);
$current_session=$row_session['current_session'];

$query = "SELECT * FROM tblschools"; 
$result = mysqli_query($conn, $query); 

if ($result) 
{ 
 $count_schools = mysqli_num_rows($result); 
   
} 
?>