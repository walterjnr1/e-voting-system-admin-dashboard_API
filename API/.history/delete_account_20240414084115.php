<?php 
include('../database/connect.php'); 
include('../database/connect2.php'); 

date_default_timezone_set('Africa/Lagos');
$current_date = date('Y-m-d');

$livestock_no = $_POST['txtlivestock_no'];
$stmt = $dbh->prepare("DELETE FROM livestock WHERE livestock_no = ?");
$result = $stmt->execute([$livestock_no]);

echo json_encode(['livestock_no' => $livestock_no,'success' => $result]);
?>