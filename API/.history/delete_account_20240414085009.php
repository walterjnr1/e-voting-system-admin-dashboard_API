<?php 
include('../database/connect.php'); 
include('../database/connect2.php'); 

$voterid = $_POST['txtvoterid'];
$stmt = $dbh->prepare("DELETE FROM tblvoter WHERE voterid = ?");
$result = $stmt->execute([$voterid]);


if $result(){
echo json_encode("success");
} else {
echo json_encode("Something Went Wrong");
}

?>