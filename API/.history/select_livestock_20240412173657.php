<?php 




$username=$_GET['username'];
$stmt = $dbh->prepare("SELECT * FROM livestock where username='$username'");
//$stmt = $dbh->prepare("SELECT * FROM livestock");

$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($result);


?>