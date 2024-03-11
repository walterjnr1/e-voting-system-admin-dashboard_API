<?php
//session_start();
include('../inc/controller.php');

if(empty($_SESSION['login_index_no'])) {
  header("Location: ../login.php");
}

$filename_boarder = "../Downloads/Prospectus/https___cssps.gov_boarder.pdf"; 
$filename_day = "../Downloads/Prospectus/https___cssps.gov_day.pdf"; 


if($boarding_status=='BOARDING')
{
    
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($filename_boarder).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filename_boarder));
    readfile($filename_boarder);
    exit;
//}
}else{
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($filename_day).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filename_day));
    readfile($filename_day);
    exit;
}
