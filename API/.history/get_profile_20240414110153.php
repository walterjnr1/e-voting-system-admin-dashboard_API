<?php 
include('../database/connect.php'); 
include('../database/connect2.php');

$voterid = $_POST['txtvoterid'];

//Get voter details
$sql = "select * from tblvoter where voterID='$voterid'"; 
$result = $conn->query($sql);
$row = mysqli_fetch_array($result);
$status_current=$row['status'];
$status_current=$row['status'];
$status_current=$row['status'];
$status_current=$row['status'];
$status_current=$row['status'];
$status_current=$row['status'];

if ($status_current=="Sick"){
$status_update="Healthy";
}else if ($status_current=="Healthy"){
$status_update="Sick";
}

$stmt = $dbh->prepare("UPDATE livestock SET status = ? WHERE livestock_no = ?");
$result =  $stmt->execute([$status_update,$livestock_no]);

echo json_encode(['livestock_no' => $livestock_no,'success' => $result]);

?>
