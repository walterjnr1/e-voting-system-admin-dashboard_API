<?php 
include('../database/connect.php'); 
include('../database/connect2.php'); 

$voterid = $_POST['txtvoterid'];
$candidateid = $_POST['txtcandidateid'];

$stmt = $dbh->prepare("UPDATE tblcandidate SET count = ? WHERE candidateID = ?");
$result =  $stmt->execute([$status_update,$livestock_no]);


$sql = " update tblcandidate set count=(count) + 1 where candidateID='$candidateid'";
if (mysqli_query($conn, $sql)) {


    //save voting details
$query = "INSERT into `votes` (voterID,fullname,maritalstatus,sex,DOB,phone,email,address,lga,state,occupation,status,educational_qualification,photo)
VALUES ('$voterID','$fullname','$maritalstatus','$sex','$dob','$phone','$email','$address','$lga','$state','$occupation','$status','$qualification','$image')";
$result = mysqli_query($conn,$query);



echo json_encode("success");
} else {
echo json_encode("Something Went Wrong");
}
?>
