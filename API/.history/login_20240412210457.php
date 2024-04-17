<?php 
include('../database/connect.php'); 
include('../database/connect2.php');

$voterid = $_POST['txtvoterid'];
$password = $_POST['txtpassword'];

$sql = "SELECT * FROM tblvoter WHERE v='" .$username. "' and password = '".$password."'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
// output data of each row
$row = mysqli_fetch_assoc($result);
echo json_encode("Success");
}else { 
echo json_encode("Wrong email and Password");
}

?>



