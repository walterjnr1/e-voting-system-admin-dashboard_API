<?php 
session_start();
error_reporting(1);
include('../database/connect.php'); 
include('../database/connect2.php'); 

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
$app_password=$row_website['app_password'];
$port=$row_website['email_port'];
$admission_fee=$row_website['admission_fee'];
$logo=$row_website['logo'];
$headmaster=$row_website['headmaster'];
$reportdate=$row_website['reportdate'];
$box=$row_website['box'];

//fetch admin data
$username = $_SESSION["login_username"];

$stmt = $dbh->query("SELECT * FROM users where username='$username'");
$row_user= $stmt->fetch();
$fullname_admin=$row_user['fullname'];  
$photo_admin =$row_user['photo'];
$email_admin=$row_user['email'];
$password_admin=$row_user['password'];
$lastaccess=$row_user['lastaccess'];

//fetch student data
$index_no = $_SESSION["login_index_no"];
$stmt = $dbh->query("SELECT * FROM tblstudents where index_no='$index_no'");
$row_student= $stmt->fetch();
$fullname_student=$row_student['fullname'];  
$photo=$row_student['photo'];
$email=$row_student['email'];
$sex=$row_student['sex'];
$phone=$row_student['phone'];
$boarding_status=$row_student['boarding_status'];
$class=$row_student['class'];
$programme=$row_student['programme'];
$aggregate=$row_student['aggregate'];
$raw_score=$row_student['raw_score'];
$enrollment_code=$row_student['enrollment_code'];
$jhs_attended=$row_student['jhs_attended'];
$jhs_type=$row_student['jhs_type'];
$house=$row_student['house'];


//fetch school data
$sql = "select * from school_session order by ID desc limit 1"; 
$result = $conn->query($sql);
$row_session = mysqli_fetch_array($result);
$current_session=$row_session['current_session'];


?>