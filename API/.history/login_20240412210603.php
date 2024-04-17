<?php 
include('../database/connect.php'); 
include('../database/connect2.php');

$voterid = $_POST['txtvoterid'];
$password = $_POST['txtpassword'];

$sql = "SELECT * FROM tblvoter WHERE voterID='" .$voterid. "' and password = '".$password."' and status = '1'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
$row = mysqli_fetch_assoc($result);




echo json_encode("Success");
}else { 
echo json_encode("Wrong email and Password");
}

?>



