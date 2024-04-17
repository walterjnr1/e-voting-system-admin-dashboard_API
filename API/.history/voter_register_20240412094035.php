<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require_once 'vendor/autoload.php';
include('../database/connect.php'); 
include('../database/connect2.php'); 


header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
//voter id code
$digits = 5;
$voterID = rand(pow(10, $digits-1), pow(10, $digits)-1);

//otp 
$digits_otp = 4;
$otp = rand(pow(10, $digits_otp-1), pow(10, $digits_otp)-1);

$fullname = mysqli_real_escape_string($conn,$_POST['txtfullname']);
$sex = mysqli_real_escape_string($conn,$_POST['cmdsex']);
$dob = mysqli_real_escape_string($conn,$_POST['txtdob']);
$maritalstatus = mysqli_real_escape_string($conn,$_POST['cmdstatus']);
$phone = mysqli_real_escape_string($conn,$_POST['txtphone']);
$email = mysqli_real_escape_string($conn,$_POST['txtemail']);
$address = mysqli_real_escape_string($conn,$_POST['txtaddress']);
$lga = mysqli_real_escape_string($conn,$_POST['txtlga']);
$state = mysqli_real_escape_string($conn,$_POST['cmdstate']);
$occupation = mysqli_real_escape_string($conn,$_POST['txtoccupation']);
$qualification = mysqli_real_escape_string($conn,$_POST['cmdqualification']);


date_default_timezone_set('Africa/Lagos');
$current_date = date('Y-m-d');

$sql = "SELECT * FROM tblvoter where email='$email'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
echo json_encode("Voter Already Exist");
}else{
    
     //get image name
     $image = $_FILES['image']['name'] ?? ''; 

     //make image path
     $imagePath = 'uploadImage/Profile/'.$image; 
 
     $tmp_name = $_FILES['image']['tmp_name']; 
 
     //move image to images folder
     move_uploaded_file($tmp_name, $imagePath);
     $photo = "../uploadImage/Profile/" .$_FILES['image']['name'] ; 

//save Voter details
$query = "INSERT into `tblvoter` (voterID,fullname,maritalstatus,sex,DOB,phone,email,address,lga,state,occupation,status,educational_qualification,photo)
VALUES ('$voterID','$fullname','$maritalstatus','$sex','$dob','$phone','$email','$address','$lga','$state','$occupation','$status','$qualification','$photo')";
$result = mysqli_query($conn,$query);

if($result){

//SEnd OTP Via SMS

$sender="e-voting";
$sms_username='rexrolex0@gmail.com';//Note: urlencodemust be added forusernameand 
$sms_password='admin123';// password as encryption code for security purpose.


$message  = 'Your OTP Code for Login is '.$otp.' ';
$api_url  = 'https://portal.nigeriabulksms.com/api/';

//Create the message data
$data = array('username'=>$sms_username, 'password'=>$sms_password, 'sender'=>$sender, 'message'=>$message, 'mobiles'=>$phone);
//URL encode the message data
$data = http_build_query($data);
//Send the message
$request = $api_url.'?'.$data;
$result  = file_get_contents($request);
$result  = json_decode($result);


 echo json_encode("success");
  } else {
  echo json_encode("Something Went Wrong");
  }
}

?>