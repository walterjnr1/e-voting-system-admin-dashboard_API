<?php
include('../inc/controller.php');

$value = $_POST['class'];

$sql = "SELECT tblsubject.name as subject FROM tblsubjectcombination INNER JOIN tblclass ON tblsubjectcombination.class = tblclass.ID INNER JOIN tblsubject ON tblsubjectcombination.subject = tblsubject.ID where tblsubjectcombination.class =? order by tblsubjectcombination.class asc";

$stmt = $dbh->prepare($sql);
$stmt->execute([$value]);
$data = array();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
$data[] = $row; // Add each row of data to the array

}
header('Content-Type: application/json');
echo json_encode($data);
?>
 