<?php 
include('../database/connect.php'); 
include('../database/connect2.php'); 



$username=$_GET['username'];
$stmt = $dbh->prepare("SELECT * FROM livestock where username='$username'");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($result);


?>