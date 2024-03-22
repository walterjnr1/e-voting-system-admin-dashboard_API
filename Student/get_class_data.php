<?php
include('../inc/controller.php');

//$value = $_POST['class'];
$value = $_REQUEST['selectSubject'];
$query = "SELECT * FROM tblstudents where class = '$value' and school_session='$current_session' "; 
$result = mysqli_query($conn, $query); 

if ($result) 
{ 
 $data = mysqli_num_rows($result); 
}                  
//header('Content-Type: application/json');
//echo json_encode($data);


// Store it in a array
$count = array("$data");
// Send in JSON encoded form
$myJSON = json_encode($count);
echo $myJSON;
?>

 