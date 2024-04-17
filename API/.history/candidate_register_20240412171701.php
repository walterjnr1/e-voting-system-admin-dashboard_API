<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require_once 'vendor/autoload.php';
include('../database/connect.php'); 
include('../database/connect2.php'); 

//voter id code
$digits = 5;
$candidateID = "C".rand(pow(10, $digits-1), pow(10, $digits)-1);

$voteid = $_POST['txtvoteid'] ?? '1234';
$office = $_POST['cmdoffice']?? 'xxx';
$party = $_POST['cmdparty']?? '';
$status = 1;

date_default_timezone_set('Africa/Lagos');
$current_date = date('Y-m-d');

$sql = "SELECT * FROM tblcandidate where email='$email'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
echo json_encode("Candidate Already Exist");
}else{
    
     //get image name
     $image = $_FILES['image']['name'] ?? ''; 

     //make image path
    $imagePath = 'uploadImage/Profile/'.$image; 
 
     $tmp_name = $_FILES['image']['tmp_name']; 
 
     //move image to images folder
     move_uploaded_file($tmp_name, $imagePath);
     $image = "../uploadImage/Profile/" .$_FILES['image']['name'] ; 

//save Voter details
$query = "INSERT into `tblcandidate` (voterID,candidateID,count,office,party,status)
VALUES ('$voterid','$candidateID','0','$office','$party','1')";
$result = mysqli_query($conn,$query);

if($result){

//Get voter details
$sql_voterid = "select * from tblvoter where email='$email'"; 
$result_voterid = $conn->query($sql_voterid);
$row_voterid = mysqli_fetch_array($result_voterid);
$fullname=$row_voterid['fullname'];


//SEnd registration Via SMS
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
<title>Candidate Registration |$appname </title>
</head>
<body>
<p>Hello $fullname ,</p>
       
<p>  Your registration with our E-voting App is complete</p>
<p>  Your voter ID is :$voterid  .</p>
<p>  Always keep your Voter ID safe. Thanks</p>


<p>Regards</p>        
<p>$appname</p>        
</body>
</html>
";

//Content
$mail->isHTML(true);                                  //Set email format to HTML
$mail->Subject = 'Candidate Registration | '.$appname.'';
$mail->Body    = $message;
$mail->send();

//save otp
$query_otp = "INSERT into `otpverifications` (code,email)
VALUES ('$code','$email')";
$result_otp = mysqli_query($conn,$query_otp);

echo json_encode("success");
} else {
echo json_encode("Something Went Wrong");
}
}

?>