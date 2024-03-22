<?php
//session_start();
include('../inc/controller.php');

if(empty($_SESSION['login_index_no'])) {
  header("Location: ../login.php");
}

    $filename = "../Downloads/personaldataform/Personal_Records.pdf";  // your_file_name
if (file_exists($filename)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($filename).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filename));
    readfile($filename);
    exit;
}
