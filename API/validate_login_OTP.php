<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require_once 'vendor/autoload.php';
include('../database/connect.php'); 
include('../database/connect2.php');

$otp = $_POST['txtotp']??'';
$voterid = $_POST['txtvoterid']??'';

$sql = "SELECT * FROM otpverifications WHERE voterID='" .$voterid. "' and code = '".$otp."'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
$row = mysqli_fetch_assoc($result);

//delete otp
$stmt = $dbh->prepare("DELETE FROM otpverifications WHERE code = ?");
$result = $stmt->execute([$otp]);

echo json_encode("success");
}else { 
echo json_encode("Wrong email and Password");
}

?>



