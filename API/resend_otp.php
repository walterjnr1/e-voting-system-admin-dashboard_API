<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require_once 'vendor/autoload.php'; 
include('../database/connect.php'); 
include('../database/connect2.php');

$voterid = $_POST['txtvoterid']??'';

//phone and email
$sql_voterid = "select * from tblvoter where voterID='$voterid' and status='1'"; 
$result_voterid = $conn->query($sql_voterid);
$row_voterid = mysqli_fetch_array($result_voterid);
$fullname=$row_voterid['fullname'];
$phone=$row_voterid['phone'];
$email=$row_voterid['email'];

//Generate randomOTP
function randomOTP() {
    $alphabet = "0123456789";
    $refID = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 5; $i++) {
        $n = rand(0, $alphaLength);
       $refID[] = $alphabet[$n];
    }
    return implode($refID); //turn the array into a string
}
$otp = randomOTP();

//SEnd OTP Via SMS
$sender="E-voting";
$sms_username='info.autosyst@gmail.com';//Note: urlencodemust be added forusernameand 
$sms_password='Integax.sms@2022';// password as encryption code for security purpose.

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


//send otp email
$appname="Secured Mobile-based E-voting System using 2FA security";  
$email_server="SMTP.GMAIL.COM";
$email_username="ADMISSION.MANSENSHS@GMAIL.COM";
$app_password="XMVLDREPYHGKJFKF";
$port=465;
$email_website = "ADMISSION.MANSENSHS@GMAIL.COM";

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
<p>Hello $fullname ,</p>
       
<p>  Your OTP code is :$otp  .</p>

<p>$appname</p>        
</body>
</html>
";

//Content
$mail->isHTML(true);                                  //Set email format to HTML
$mail->Subject = 'OTP | '.$appname.'';
$mail->Body    = $message;
$mail->send();

//save otp
$query_otp = "INSERT into `otpverifications` (code,email)
VALUES ('$code','$email')";
$result_otp = mysqli_query($conn,$query_otp);

if ($result_otp){
echo json_encode("Success");
}else { 
echo json_encode("Problem");
}

?>



