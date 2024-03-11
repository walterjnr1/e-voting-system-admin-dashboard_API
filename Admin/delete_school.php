<?php
include('../inc/controller.php');
if(empty($_SESSION['login_username']))
{   
header("Location: login.php"); 
}  
$username = $_SESSION["login_username"];

$id= $_GET['id'];        
$sql = "DELETE FROM tblschools WHERE ID=?";
$stmt= $dbh->prepare($sql);
$stmt->execute([$id]);
header("Location: add_school.php"); 

 //save activity log details
 $task= $username.' '.'Deleted School'.' '. 'On' . ' '.$current_date;
 $sql = 'INSERT INTO activity_log(task) VALUES(:task)';
 $statement = $dbh->prepare($sql);
 $statement->execute([
 ':task' => $task
 ]);
?>