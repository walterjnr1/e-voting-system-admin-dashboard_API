<?php 
include('../database/connect.php'); 
include('../database/connect2.php'); 

date_default_timezone_set('Africa/Lagos');
$current_date = date('Y-m-d');

$voterid = $_POST['txtvoterid'];
$candidateid = $_POST['txtcandidateid'];
$electiontype = $_POST['txtelectiontype'];


//check if voter already voer



$stmt = $dbh->prepare("UPDATE tblcandidate SET count = ? WHERE candidateID = ?");
$result =  $stmt->execute([$status_update,$livestock_no]);


$sql = " update tblcandidate set count=(count) + 1 where candidateID='$candidateid'";
if (mysqli_query($conn, $sql)) {


//save voting details
$query = "INSERT into `votes` (voterID,candidateID,vote_date_time,election_type)
VALUES ('$voterid','$candidateid','$current_date','$electiontype')";
$result = mysqli_query($conn,$query);



echo json_encode("success");
} else {
echo json_encode("Something Went Wrong");
}
?>
