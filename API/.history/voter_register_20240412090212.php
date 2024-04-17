<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require_once 'vendor/autoload.php';
include('../inc/controller.php');

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
VALUES ('$voterID','$fullname','$maritalstatus','$sex','$dob','$phone','$email','$address','$lga','$state','$occupation','$status','$educational_qualification','$photo')";
$result = mysqli_query($conn,$query);

if($result){

//SEnd OTP Via SMS

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


//send confirmation email
$mail = new PHPMailer(true);
     
//Server settings
$mail->isSMTP();                                            //Send using SMTP
$mail->Host       = $email_server;                     //Set the SMTP server to send through
$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
$mail->Username   = $email_username;                     //SMTP username
$mail->Password   = $app_password;                               //SMTP password
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
 $mail->Port       = $port;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

//Recipients
$mail->setFrom($email_website, $appname);
$mail->addAddress($email,$fullname);     //Add a recipient

$message = "
<html>
<head>
<title>OTP |$appname </title>
</head>
<body>
<p>Hello <strong>$fu ,</strong></p>
       
<p> Your Admission Application into College of Health, Jigawa was received successfully. Admission Committe will get back to you as sson as possible. </p>
<p>  Enrollment code is :$admissionno  .</p>
<p>  password is :$password  .</p>

<p>N/B: you will use the enrollment code as Admission Number when you are offer an admission.</p>

<p> Regards.</p>
<p>College of Health,  Hadejia</p>        
</body>
</html>
";

//Content
$mail->isHTML(true);                                  //Set email format to HTML
$mail->Subject = 'Admission Application |College of Health,  Hadejia';
$mail->Body    = $message;

$mail->send();



  echo json_encode("success");
  } else {
  echo json_encode("Something Went Wrong");
  }
}


?>