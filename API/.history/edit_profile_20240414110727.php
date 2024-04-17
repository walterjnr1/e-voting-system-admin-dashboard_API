<?php 
include('../database/connect.php'); 
include('../database/connect2.php');

$voterid = $_POST['txtvoterid'];
$fullname = $_POST['txtfullname'];
$maritalstatus = $_POST['txtmaritalstatus'];
$sex = $_POST['cmdsex'];
$phone = $_POST['txtphone'];
$address = $_POST['txtaddress'];
$lga = $_POST['txtlga'];
$state = $_POST['cmdstate'];
$occupation = $_POST['txtoccupation'];
$qualification = $_POST['cmdqualification'];

$stmt = $dbh->prepare("UPDATE tblvoter SET status = ?,status = ? WHERE livestock_no = ?");
$result =  $stmt->execute([$status_update,$livestock_no]);

echo json_encode("success");
?>
