<?php 
include('../database/connect.php'); 
include('../database/connect2.php'); 

$voterid = $_POST['txtvoterid'];

$stmt = $dbh->prepare("UPDATE tblcandidate SET count = ? WHERE candidateID = ?");
$result =  $stmt->execute([$status_update,$livestock_no]);


$sql = " update tblcandidate set fullname='$fullname',email='$email' where ID='$id'";
if (mysqli_query($conn, $sql)) {


echo json_encode(['livestock_no' => $livestock_no,'success' => $result]);

?>
