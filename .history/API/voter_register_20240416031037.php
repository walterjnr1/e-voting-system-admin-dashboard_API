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
$voterID = "V".rand(pow(10, $digits-1), pow(10, $digits)-1);

$fullname = $_POST['txtfullname'] ?? 'idong ebong';
$sex = $_POT['cmdsex']?? 'Male';
$dob = $_POST['txtdob']?? '';
$maritalstatus = $_POST['cmdmaritalstatus']?? '';
$phone = $_POST['txtphone']?? '080673623';
$email = $_POST['txtemail']?? 'newleastpaysolution@gmail.com';
$address = $_POST['txtaddress']?? '';
$lga = $_POST['txtlga']?? '';
$state = $_POST['cmdstate']?? '';
$occupation =$_POST['txtoccupation']?? '';
$qualification = $_POST['cmdqualification']?? '';
$status = 1;

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
     $image = "../uploadImage/Profile/" .$_FILES['image']['name'] ; 

//save Voter details
$query = "INSERT into `tblvoter` (voterID,fullname,maritalstatus,sex,DOB,phone,email,address,lga,state,occupation,status,educational_qualification,photo)
VALUES ('$voterID','$fullname','$maritalstatus','$sex','$dob','$phone','$email','$address','$lga','$state','$occupation','$status','$qualification','$image')";
$result = mysqli_query($conn,$query);

if($result){

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
 $query_otp = "INSERT into `otpverifications` (code,voterID,created_at,updated_at)
 VALUES ('$code','$voterID')";
 $result_otp = mysqli_query($conn,$query_otp);
 

echo json_encode("success");
} else {
echo json_encode("Something Went Wrong");
}
}
?>