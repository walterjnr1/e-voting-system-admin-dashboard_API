<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require_once 'vendor/autoload.php';
include('../database/connect.php'); 
include('../database/connect2.php');

$otp = $_POST['txtotp']??'45222';
$voterid = $_POST['txtvoterid']??'V93352';

$sql = "SELECT * FROM otpverifications WHERE voterID='" .$voterid. "' and code = '".$otp."'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
$row = mysqli_fetch_assoc($result);

//Get voter details
$sql_voterid = "select * from tblvoter where voterID='$voterid'"; 
$result_voterid = $conn->query($sql_voterid);
$row_voterid = mysqli_fetch_array($result_voterid);
$voterid=$row_voterid['voterID'];
$fullname=$row_voterid['fullname'];
$email=$row_voterid['email'];

//send success email
$appname="Secured Mobile-based E-voting System using 2FA security";  
$email_server="SMTP.GMAIL.COM";
$email_username="ADMISSION.MANSENSHS@GMAIL.COM";
$app_password="XMVLDREPYHGKJFKF";
$port = 465;
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
<title>Registration Complete |$appname </title>
</head>
<body>
<p>Hello $fullname ,</p>
       
<p>  Your your registration with our E-voting App is complete</p>
<p>  Your voter ID is :$voterid  .</p>
<p>  Always keep your Voter ID safe. Thanks</p>


<p>Regards</p>
<p>$appname</p>        
</body>
</html>
";

//Content
$mail->isHTML(true);                                  //Set email format to HTML
$mail->Subject = 'Registration Complete | '.$appname.'';
$mail->Body    = $message;
$mail->send();


//delete otp
$stmt = $dbh->prepare("DELETE FROM otpverifications WHERE code = ?");
$result = $stmt->execute([$otp]);

//update voter status
$stmt = $dbh->prepare("UPDATE tblvoter SET status = ? WHERE voterID = ?");
$result =  $stmt->execute([1,$voterid]);


echo json_encode("success");
}else { 
echo json_encode("Wrong email and Password");
}

?>



