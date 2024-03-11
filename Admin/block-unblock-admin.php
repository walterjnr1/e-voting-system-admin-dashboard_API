<?php
include('../inc/controller.php');
if(empty($_SESSION['login_username']))
    {   
      header("Location: login.php"); 
    }
    
$username = $_SESSION["login_username"];
 // for Block User   	
if(isset($_GET['id']))
{
$id=intval($_GET['id']);


mysqli_query($conn,"update users set status='0' where ID='$id'");
header("location: admin-record.php");
}

// for unBlock user
if(isset($_GET['uid']))
{
$uid=intval($_GET['uid']);

mysqli_query($conn,"update users set status='1' where ID='$uid'");
header("location: admin-record.php");



}

  //save activity log details
  $task= $username.' '.'block/unblock User'.' '. 'On' . ' '.$current_date;
  $sql = 'INSERT INTO activity_log(task) VALUES(:task)';
  $statement = $dbh->prepare($sql);
  $statement->execute([
  ':task' => $task
  ]);
?>