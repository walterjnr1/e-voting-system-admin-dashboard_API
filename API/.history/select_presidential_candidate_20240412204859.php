<?php 
include('../database/connect.php'); 
include('../database/connect2.php'); 

//SELECT * FROM table1, table2 WHERE table1.rollno = table2.rollno 
//AND table1.rollno = {$rollno};

$stmt = $dbh->prepare("SELECT * FROM tblvoter,tblcandidate where tblvoter.email = tblcandidate.email and tblcandidate.office = 'Governor' and tblcandidate.status='1'");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($result);

?>