<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require_once 'vendor/autoload.php';
include('../database/connect.php'); 
include('../database/connect2.php');

$otp = $_POST['txtotp']??'';
$email = $_POST['txtemail']??'';

$sql = "SELECT * FROM otpverifications WHERE email='" .$email. "' and code = '".$otp."'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
$row = mysqli_fetch_assoc($result);




echo json_encode("success");
}else { 
echo json_encode("Wrong email and Password");
}

?>



