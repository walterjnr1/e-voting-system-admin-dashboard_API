<?php 
include('../database/connect.php'); 
include('../database/connect2.php'); 

date_default_timezone_set('Africa/Lagos');
$current_date = date('Y-m-d');

$voterid = $_POST['txtvoterid']??'V12343';
$candidateid = $_POST['txtcandidateid']??'C57726';
$electiontype = $_POST['txtelectiontype']??'President';


//check if voter already voted
$sql = "SELECT * FROM votes where voterID ='$voterid' and election_type ='President'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
echo json_encode("Voter Already voted");
}else{


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
}
?>
