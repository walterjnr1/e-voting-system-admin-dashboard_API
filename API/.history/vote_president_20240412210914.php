<?php 
include('../database/connect.php'); 
include('../database/connect2.php'); 

$voterid = $_POST['txtvoterid'];

$stmt = $dbh->prepare("UPDATE livestock SET status = ? WHERE livestock_no = ?");
$result =  $stmt->execute([$status_update,$livestock_no]);

echo json_encode(['livestock_no' => $livestock_no,'success' => $result]);

?>
