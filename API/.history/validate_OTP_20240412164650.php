<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require_once 'vendor/autoload.php';
include('../database/connect.php'); 
include('../database/connect2.php');

$otp = $_POST['txtotp']??'1234';
$email = $_POST['txtemail'];

$sql = "SELECT * FROM otpverifications WHERE email='" .$email. "' and otp = '".$otp."'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
// output data of each row
$row = mysqli_fetch_assoc($result);
echo json_encode("Success");
}else { 
echo json_encode("Wrong email and Password");
}

?>



