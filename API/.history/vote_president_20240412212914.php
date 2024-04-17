<?php 
include('../database/connect.php'); 
include('../database/connect2.php'); 

$voterid = $_POST['txtvoterid'];
$candidateid = $_POST['txtcandidateid'];

$stmt = $dbh->prepare("UPDATE tblcandidate SET count = ? WHERE candidateID = ?");
$result =  $stmt->execute([$status_update,$livestock_no]);


$sql = " update tblcandidate set count='$fullname' where candidateID='$candidateid'";
if (mysqli_query($conn, $sql)) {


echo json_encode(['livestock_no' => $livestock_no,'success' => $result]);
echo json_encode("success");
} else {
echo json_encode("Something Went Wrong");
}
?>
