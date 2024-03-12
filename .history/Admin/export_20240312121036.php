<?php
include('../inc/controller.php');

$searchQuery=$_REQUEST['search']['value'];

  //$searchQuery = '';
  if (!empty($_REQUEST['search']['value'])) {
      $searchQuery = "WHERE (fullname LIKE '%" . $_REQUEST['search']['value'] . "%' 
                     OR Index_No LIKE '%" . $_REQUEST['search']['value'] . "%' 
                     OR Programme LIKE '%" . $_REQUEST['search']['value'] . "%' 
                     OR class LIKE '%" . $_REQUEST['search']['value'] . "%')";
  }
    $filename = "students_data_".date('Y-m-d').".xls"; // Define the name of the export file
    header('Content-Type: application/vnd.ms-excel'); // Define the content type for the export file
    header('Content-Disposition: attachment; filename="'.$filename.'"'); // Define the filename for the export file
    header('Cache-Control: max-age=0'); // Avoid any cache issues
    $f = fopen('php://output', 'w'); // Create a new output stream

  // Output the datatable rows
  $conn = mysqli_connect("localhost", "username", "password", "database_name"); // Connect to the database
  $query = "SELECT * FROM tblstudents {$searchQuery} order by ID desc"; // Define the SQL query to fetch the data from the database
  $result = mysqli_query($conn, $query); // Execute the query
  while($row = mysqli_fetch_assoc($result))
  {
      $lineData = array($row['SN'],$row['photo'],$row['index_no'],$row['fullname'],$row['sex'],$row['programme'],$row['class'],$row['boarding_status'],$row['aggregate'],$row['raw_score'],$row['enrollment_code'],$row['jhs_attended'],$row['JHS_Type'],$row['Phone'],$row['Email'],$row['Father_Name'],$row['Father_Occupation'],$row['Mother_Name'],$row['Mother_Occupation'],$row['Guardian'],$row['Residential_Telephone'],$row['Admission_Status'],$row['Session'],$row['House'],$row['Action']);
      fputcsv($f, $lineData, ',', '"'); // Output the data using the CSV format
  }
  fclose($f); // Close the output stream
  exit;


?>