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

//otp 
$digits_otp = 4;
$otp = rand(pow(10, $digits_otp-1), pow(10, $digits_otp)-1);

$fullname = $_POST['txtfullname'] ?? 'idong ebong';
$sex = $_POST['cmdsex']?? 'Male';
$dob = $_POST['txtdob']?? '';
$maritalstatus = $_POST['cmdstatus']?? '';
$phone = $_POST['txtphone']?? '09055453423';
$email = $_POST['txtemail']?? 'emma@gmail.com';
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

echo json_encode("success");
} else {
echo json_encode("Something Went Wrong");
}
}

?>