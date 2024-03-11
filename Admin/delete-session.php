<?php
include('../inc/controller.php');
if(empty($_SESSION['login_username']))
    {   
      header("Location: add-session.php"); 
    }
      
$id= $_GET['id'];        
$sql = "DELETE FROM school_session WHERE ID=?";
$stmt= $dbh->prepare($sql);
$stmt->execute([$id]);

header("Location: add-session.php"); 

 //save activity log details
 $task= $username.' '.'deleted session'.' '. 'On' . ' '.$current_date;
 $sql = 'INSERT INTO activity_log(task) VALUES(:task)';
 $statement = $dbh->prepare($sql);
 $statement->execute([
 ':task' => $task
 ]);
 ?>