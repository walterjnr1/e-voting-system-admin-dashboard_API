<?php 
require_once('db.php');
error_reporting(0);
 
date_default_timezone_set('Africa/Lagos');
$current_date = date('Y-m-d');

//$email = 'newleastpaysolution@gmail.com';
$email = $_POST['txtemail'];

  //get image name
    $image = $_FILES['image']['name'] ?? ''; 

    //create date now
    $date = date('Y-m-d');

    //make image path
    $imagePath = 'uploads/photo/'.$image; 

    $tmp_name = $_FILES['image']['tmp_name']; 

    //move image to images folder
    move_uploaded_file($tmp_name, $imagePath);
    $image = "uploads/photo/" .$_FILES['image']['name'] ; 
//update user photo

$stmt = $dbh->prepare("UPDATE users SET photo = ? WHERE email = ?");
$result =  $stmt->execute([$image,$email]);
if ($result){
echo json_encode("success");
}else{
echo json_encode("Problem");
}
?>
