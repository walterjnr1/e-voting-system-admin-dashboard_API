<?php
include('../inc/controller.php');

//$searchQuery=$_REQUEST['search']['value'];

  //$searchQuery = '';
  if (!empty($_REQUEST['search']['value'])) {
      $searchQuery = "WHERE (fullname LIKE '%" . $_REQUEST['search']['value'] . "%' 
                     OR index_no LIKE '%" . $_REQUEST['search']['value'] . "%' 
                     OR house LIKE '%" . $_REQUEST['search']['value'] . "%')";
  }
    $filename = "students_data_".date('Y-m-d').".xls"; // Define the name of the export file
    header('Content-Type: application/vnd.ms-excel'); // Define the content type for the export file
    header('Content-Disposition: attachment; filename="'.$filename.'"'); // Define the filename for the export file
    header('Cache-Control: max-age=0'); // Avoid any cache issues
    $f = fopen('php://output', 'w'); // Create a new output stream

     // Output the datatable headers
     $fields = array('Index No','fullname','sex','Programme','class','Boarding Status','Aggregate','Raw Score','Enrollment Code','JHS Attended','JHS Type','Phone','Email','Father\'s Name','Father\'s Occupation','Mother\'s Name','Mother\'s Occupation','Guardian','Residential Telephone','Admission Status','Session','House')
     fputcsv($f, $fields, ',', '"'); // Output the headers using the CSV format

  // Output the datatable rows
  //$conn = mysqli_connect("localhost", "username", "password", "database_name"); // Connect to the database
  $query = "SELECT * FROM tblstudents {$searchQuery} order by ID desc"; // Define the SQL query to fetch the data from the database
  $result = mysqli_query($conn, $query); // Execute the query
  while($row = mysqli_fetch_assoc($result))
  {
      $lineData = array($row['index_no'],$row['fullname'],$row['sex'],$row['programme'],$row['class'],$row['boarding_status'],$row['aggregate'],$row['raw_score'],$row['enrollment_code'],$row['jhs_attended'],$row['jhs_type'],$row['phone'],$row['email'],$row['father_name'],$row['father_occupation'],$row['mother_name'],$row['mother_occupation'],$row['guardian'],$row['residential_telephone'],$row['status'],$row['session'],$row['house']);
      fputcsv($f, $lineData, ',', '"'); // Output the data using the CSV format
  }
  fclose($f); // Close the output stream
  exit;


?>