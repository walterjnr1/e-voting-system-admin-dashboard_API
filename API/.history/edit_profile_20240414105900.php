<?php 
include('../database/connect.php'); 
include('../database/connect2.php');

$voterid = $_POST['txtvoterid'];



//Get voter details
$sql_get_status = "select * from tblvoter where voterID='$livestock_no'"; 
$result_get_status = $conn->query($sql_get_status);
$row_get_status = mysqli_fetch_array($result_get_status);
$status_current=$row_get_status['status'];

if ($status_current=="Sick"){
$status_update="Healthy";
}else if ($status_current=="Healthy"){
$status_update="Sick";
}

$stmt = $dbh->prepare("UPDATE livestock SET status = ? WHERE livestock_no = ?");
$result =  $stmt->execute([$status_update,$livestock_no]);

echo json_encode(['livestock_no' => $livestock_no,'success' => $result]);

?>
