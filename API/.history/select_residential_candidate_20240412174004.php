<?php 
include('../database/connect.php'); 
include('../database/connect2.php'); 

$stmt = $dbh->prepare("SELECT * FROM tblcandiate where username='$username'");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($result);


?>