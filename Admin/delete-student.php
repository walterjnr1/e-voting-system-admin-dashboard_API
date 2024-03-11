<?php
include('../inc/controller.php');
if(empty($_SESSION['login_username']))
{   
header("Location: login.php"); 
}  
$username = $_SESSION["login_username"];

$id= $_GET['id'];        
$sql = "DELETE FROM tblstudents WHERE ID=?";
$stmt= $dbh->prepare($sql);
$stmt->execute([$id]);

header("Location: student_record.php"); 
 //save activity log details
 $task= $username.' '.'deleted student'.' '. 'On' . ' '.$current_date;
 $sql = 'INSERT INTO activity_log(task) VALUES(:task)';
 $statement = $dbh->prepare($sql);
 $statement->execute([
 ':task' => $task
 ]);
 ?>