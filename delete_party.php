<?php
include('inc/controller.php');
if(empty($_SESSION['login_username']))
{   
header("Location: login.php"); 
}  
$username = $_SESSION["login_username"];

$id= $_GET['id'];        
$sql = "DELETE FROM party WHERE ID=?";
$stmt= $dbh->prepare($sql);
$stmt->execute([$id]);

header("Location: add_party.php"); 
?>