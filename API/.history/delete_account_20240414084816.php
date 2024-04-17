<?php 
include('../database/connect.php'); 
include('../database/connect2.php'); 

$voterid = $_POST['txtvoterid'];
$stmt = $dbh->prepare("DELETE FROM livestock WHERE livestock_no = ?");
$result = $stmt->execute([$livestock_no]);

echo json_encode(['livestock_no' => $livestock_no,'success' => $result]);
?>