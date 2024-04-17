<?php 
include('../database/connect.php'); 
include('../database/connect2.php'); 

$voterid = $_POST['txtvoterid'] ??'V22222';
$stmt = $dbh->prepare("DELETE FROM tblvoter WHERE voterID = ?");
$result = $stmt->execute([$voterid]);

if ($result) {
    echo json_encode("success");
} else {
    echo json_encode("Something Went Wrong");
}
?>