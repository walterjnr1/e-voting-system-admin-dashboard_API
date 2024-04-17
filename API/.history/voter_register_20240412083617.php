<?php 
require_once('../database/connect.php'); 

$digits = 5;
$voterid = rand(pow(10, $digits-1), pow(10, $digits)-1);

$fullname = mysqli_real_escape_string($conn,$_POST['cmdname']);
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

$sql = "SELECT * FROM livestock where livestock_no='$livestock_no'";
$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {
echo json_encode("livestock No Already Exist");
}else{
    
//save livestock details
$query = "INSERT into `livestock` (username,name,sex,livestock_no,weight,status,date_register)
VALUES ('$username','$name','$sex','$livestock_no','$weight','$status','$current_date')";
$result = mysqli_query($conn,$query);

if($result){

//Get phone Number
$sql_get = "select * from users where username='$username'"; 
$result_get = $conn->query($sql_get);
$row_get = mysqli_fetch_array($result_get);
$phone=$row_get['phone'];

//SEnd livestock code Via SMS
$username='rexrolex0@gmail.com';//Note: urlencodemust be added forusernameand 
$password='admin123';// passwordas encryption code for security purpose.

$sender='E-VOTING';
$message  = 'Your livestock Code for New '.$name.'  is :'.$livestock_no.'';
$api_url  = 'https://portal.nigeriabulksms.com/api/';

//Create the message data
$data = array('username'=>$username, 'password'=>$password, 'sender'=>$sender, 'message'=>$message, 'mobiles'=>$phone);
//URL encode the message data
$data = http_build_query($data);
//Send the message
$request = $api_url.'?'.$data;
$result  = file_get_contents($request);
$result  = json_decode($result);


  echo json_encode("success");
  } else {
  echo json_encode("Something Went Wrong");
  }
}













$username = $_POST['txtusername'] ?? '';
$fullname = $_POST['txtfullname'] ?? '';
$password = $_POST['txtpassword'] ?? '';
$restaurant = $_POST['txtrestaurant'] ?? '';
$phone = $_POST['txtphone']?? '';
$address = $_POST['txtaddress']?? '';
//$photo = $_POST['photo']?? '';

date_default_timezone_set('Africa/Lagos');
$current_date = date('Y-m-d');

//check if username already exist
$stmt = $dbh->prepare("SELECT * FROM users WHERE username=?");
$stmt->execute([$username]); 
$user = $stmt->fetch();
if ($user) {
echo json_encode("User Already Exist");
}else{

    //get image name
    $image = $_FILES['image']['name'] ?? ''; 

    //create date now
    $date = date('Y-m-d');

    //make image path
    $imagePath = 'uploads/'.$image; 

    $tmp_name = $_FILES['image']['tmp_name']; 

    //move image to images folder
    move_uploaded_file($tmp_name, $imagePath);
    $image = "uploads/" .$_FILES['image']['name'] ; 

    
//save user details
$query = "
INSERT INTO users (company_name, username,password, fullname,phone, address,photo) VALUES (:restaurant, :username, :password,:fullname, :phone,:address,:photo)";

$user_data = array(
 ':restaurant'  => $restaurant,
 ':username'   => $username,
  ':password'   => $password,
  ':fullname'   => $fullname,
 ':phone'   => $phone,
  ':address'  => $address,
  ':photo'  => $image
 );
 
$statement = $dbh->prepare($query);
if($statement->execute($user_data)) {

echo json_encode("success");
} else {
echo json_encode("Something Went Wrong");
}
}
?>