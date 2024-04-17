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

$fullname = $_POST['txtfullname'] ?? 'Nonso Willims';
$sex = $_POST['cmdsex']?? 'Male';
$dob = $_POST['txtdob']?? '9/09/1990';
$maritalstatus = $_POST['cmdstatus']?? 'Single';
$phone = $_POST['txtphone']?? '08067361023';
$email = $_POST['txtemail']?? 'a';
$address = $_POST['txtaddress']?? 'as';
$lga = $_POST['txtlga']?? 'as';
$state = $_POST['cmdstate']?? 'as';
$occupation =$_POST['txtoccupation']?? 'as';
$qualification = $_POST['cmdqualification']?? 'as';
$status = 1;


date_default_timezone_set('Africa/Lagos');
$current_date = date('Y-m-d');

$sql = "SELECT * FROM tblvoter where email='$email'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
echo json_encode("Voter Already Exist");
}else{
    
     //get image name
     //$image = $_FILES['image']['name'] ?? 'wewewewewe'; 

     //make image path
    // $imagePath = 'uploadImage/Profile/'.$image; 
 
    // $tmp_name = $_FILES['image']['tmp_name']; 
 
     //move image to images folder
    // move_uploaded_file($tmp_name, $imagePath);
    // $image = "../uploadImage/Profile/" .$_FILES['image']['name'] ; 
    $image = "../uploadImage/Profile/" .$_FILES['image']['name'] ; 

//save Voter details
$query = "INSERT into `tblvoter` (voterID,fullname,maritalstatus,sex,DOB,phone,email,address,lga,state,occupation,status,educational_qualification,photo)
VALUES ('$voterID','$fullname','$maritalstatus','$sex','$dob','$phone','$email','$address','$lga','$state','$occupation','$status','$qualification','$image')";
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

  echo json_encode("Something Went Wrong");
  }
}

?>