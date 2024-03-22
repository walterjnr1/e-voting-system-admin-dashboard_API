<?php
include('../inc/controller.php');
if(empty($_SESSION['login_username']))
{   
header("Location: login.php"); 
}  
$username = $_SESSION["login_username"];

$file_id= $_GET['file_id'];   
$id= $_GET['id'];        

//delete from table
$sql = "DELETE FROM tblpersonaldataform WHERE ID=? and filename=?";
$stmt= $dbh->prepare($sql);
$stmt->execute([$id,$file_id]);

// Define the destination path
$destination_path = "../uploadImage/personaldataform/" . $file_id;
// Check if the file already exists at the destination path
if (file_exists($destination_path)) {
   // Delete the existing file
   unlink($destination_path);
 }


header("Location: add_personaldataform.php"); 
 //save activity log details
 $task= $username.' '.'deleted personal data form'.' '. 'On' . ' '.$current_date;
 $sql = 'INSERT INTO activity_log(task) VALUES(:task)';
 $statement = $dbh->prepare($sql);
 $statement->execute([
 ':task' => $task
 ]);
 ?>