<?php 
include('../database/connect.php'); 
include('../database/connect2.php');

$voterid = $_POST['txtvoterid'];
$fullname = $_POST['txtvoterid'];
$maritalstatus = $_POST['txtvoterid'];
$sex = $_POST['cmsexe'];
$phone = $_POST['txtphone'];
$address = $_POST['txtaddress'];
$lga = $_POST['txtlga'];
$state = $_POST['cmdstate'];
$occupation = $_POST['txtoccupation'];
$qualification = $_POST['cmdqualification'];


$stmt = $dbh->prepare("UPDATE livestock SET status = ? WHERE livestock_no = ?");
$result =  $stmt->execute([$status_update,$livestock_no]);

echo json_encode("success");

?>
