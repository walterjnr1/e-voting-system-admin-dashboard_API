<?php 
include('../database/connect.php'); 
include('../database/connect2.php'); 

$stmt = $dbh->prepare("SELECT * FROM tblvoter,tblcandidate where tblvoter.email = tblcandidate.email and tblcandidate.email = 'tblcandidate.email' and tblcandidate.status='1'");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($result);

?>