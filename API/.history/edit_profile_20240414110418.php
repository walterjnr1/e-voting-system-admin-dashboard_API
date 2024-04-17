<?php 
include('../database/connect.php'); 
include('../database/connect2.php');

$voterid = $_POST['txtvoterid'];
$fullname = $_POST['txtvoterid'];
$maritalstatus = $_POST['txtvoterid'];
$sex = $_POST['txtvoterid'];
$DOB = $_POST['txtvoterid'];
$phone = $_POST['txtvoterid'];
$email = $_POST['txtvoterid'];
$address = $_POST['txtvoterid'];
$voterid = $_POST['txtvoterid'];
$voterid = $_POST['txtvoterid'];
$voterid = $_POST['txtvoterid'];
$voterid = $_POST['txtvoterid'];


$stmt = $dbh->prepare("UPDATE livestock SET status = ? WHERE livestock_no = ?");
$result =  $stmt->execute([$status_update,$livestock_no]);

echo json_encode("success");

?>
