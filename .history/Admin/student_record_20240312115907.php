<?php
include('../inc/controller.php');
if(empty($_SESSION['login_username']))
{   
header("Location: login.php"); 
}  
$username = $_SESSION["login_username"];
		
if(isset($_POST['btnexport']))
{
    $filename = "students_data_".date('Y-m-d').".xls"; // Define the name of the export file
    header('Content-Type: application/vnd.ms-excel'); // Define the content type for the export file
    header('Content-Disposition: attachment; filename="'.$filename.'"'); // Define the filename for the export file
    header('Cache-Control: max-age=0'); // Avoid any cache issues
    $f = fopen('php://output', 'w'); // Create a new output stream

    // Output the datatable headers
    $fields = array('SN','Photo','Index No','fullname','sex','Programme','class','Boarding Status','Aggregate','Raw Score','Enrollment Code','JHS Attended','JHS Type','Phone','Email','Father\'s Name','Father\'s Occupation','Mother\'s Name','Mother\'s Occupation','Guardian','Residential Telephone','Admission Status','Session','House');
    fputcsv($f, $fields, ',', '"'); // Output the headers using the CSV format

    // Output the datatable rows
    $conn = mysqli_connect("localhost", "username", "password", "database_name"); // Connect to the database
    $query = "SELECT * FROM tblstudents order by ID desc"; // Define the SQL query to fetch the data from the database
    $result = mysqli_query($conn, $query); // Execute the query
    while($row = mysqli_fetch_assoc($result))
    {
        $lineData = array($row['SN'],$row['Photo'],$row['Index_No'],$row['fullname'],$row['sex'],$row['Programme'],$row['class'],$row['Boarding_Status'],$row['Aggregate'],$row['Raw_Score'],$row['Enrollment_Code'],$row['JHS_Attended'],$row['JHS_Type'],$row['Phone'],$row['Email'],$row['Father_Name'],$row['Father_Occupation'],$row['Mother_Name'],$row['Mother_Occupation'],$row['Guardian'],$row['Residential_Telephone'],$row['Admission_Status'],$row['Session'],$row['House'],$row['Action']);
        fputcsv($f, $lineData, ',', '"'); // Output the data using the CSV format
    }
    fclose($f); // Close the output stream
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Student Record|Dashboard</title>
  <link rel="icon" type="image/png" sizes="16x16" href="../<?php echo $logo; ?>">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  
  <script type="text/javascript">
		function Activate(fullname){
if(confirm("ARE YOU SURE YOU WISH TO ACTIVATE " + " " + fullname+ "FROM THE SYSTEM ?" ))
{
return  true;
}
else {return false;
}
	 
}

</script>

<script type="text/javascript">
		function Deactivate(fullname){
if(confirm("ARE YOU SURE YOU WISH TO DEACTIVATE " + " " + fullname+ "FROM THE SYSTEM  ?" ))
{
return  true;
}
else {return false;
}
	 
}

</script>
<script type="text/javascript">
		function deldata(fullname){
if(confirm("ARE YOU SURE YOU WISH TO DELETE " + " " + fullname+ "FROM THE DATABASE ?" ))
{
return  true;
}
else {return false;
}
	 
}

</script>
  <style type="text/css">
<!--
.style7 {vertical-align:middle; cursor:pointer; -webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none; border:1px solid transparent; padding:.375rem .75rem; line-height:1.5; border-radius:.25rem;transition:color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out; display: inline-block; color: #212529; text-align: center;}
-->
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Home</a>      </li>
      
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
 
      
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
    <img src="../<?php echo $logo ;?>" alt=" Logo"  width="200" height="111" class="" style="opacity: .8">
	        <span class="brand-text font-weight-light">  </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../<?php echo $photo_admin; ?>" alt="User Image" width="220" height="192" class="img-circle elevation-2">        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $fullname_admin;  ?></a>
        </div>
      </div>


      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         
		 <?php
			   include('sidebar.php');
			   
			   ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">&nbsp;</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Student Record</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <p>&nbsp;</p>
          <table width="1204" height="227" border="0" align="center">
            <tr>
              <td width="1090" height="184"><div class="card">
                <div class="card-header">
                <a href="export.php"><button type="submit" name="btnexport" class="btn btn-primary">Export</button></a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table width="85%" align="center" class="table table-bordered table-striped" id="example1">
                    <thead>
                    <th width="10%"><div align="center">SN</div></th>
							          <th width="7%"><div align="center">Photo</div></th>
                        <th width="5%"><div align="center">Index No</div></th>
                        <th width="5%"><div align="center">fullname</div></th>
                        <th width="5%"><div align="center">sex</div></th>
                        <th width="5%"><div align="center">Programme</div></th>
                        <th width="5%"><div align="center">class</div></th>
                        <th width="5%"><div align="center">Boarding Status</div></th>
                        <th width="5%"><div align="center">Aggregate</div></th>
                        <th width="5%"><div align="center">Raw Score</div></th>
                        <th width="5%"><div align="center">Enrollment Code</div></th>
                        <th width="5%"><div align="center">JHS Attended </div></th>
                        <th width="5%"><div align="center">JHS Type</div></th>
                        <th width="5%"><div align="center">Phone</div></th>
                        <th width="5%"><div align="center">Email</div></th>
                        <th width="5%"><div align="center">Father's Name</div></th>
                        <th width="5%"><div align="center">Father's Occupation</div></th>
                        <th width="5%"><div align="center">Mother's Name</div></th>
                        <th width="5%"><div align="center">Mother's Occupation</div></th>
                        <th width="5%"><div align="center">Guardian</div></th>
                        <th width="5%"><div align="center">Residential Telephone</div></th>
                        <th width="5%"><div align="center">Admission Status</div></th>
                        <th width="5%"><div align="center">Session</div></th>
                        <th width="5%"><div align="center">House</div></th>
                        <th width="5%"><div align="center">Action</div></th>

				     						    </tr>
                    </thead>
                      <div align="center"></div>
                    
                    <tbody>
                                      <?php 
                                          $sql = "SELECT * FROM tblstudents order by ID desc";
                                           $result = $conn->query($sql);
                                           $cnt=1;

                                          while($row = $result->fetch_assoc()) { ?>
                      <tr class="gradeX">
                      <td height="50"><div align="center"><?php echo $cnt; ?> </div></td>

					 <td><div align="center"><span class="controls"><img src="../<?php echo $row['photo'];?>"  width="91" height="73" border="2"/></span></div></td>
           <td height="50"><div align="center"><?php echo $row['index_no']; ?> </div></td>

           <td><div align="center"><?php echo $row['fullname']; ?></div></td>
                        <td><div align="center"><?php echo $row['sex']; ?></div></td>
                        <td><div align="center"><?php echo $row['programme']; ?></div></td>
                        <td><div align="center"><?php echo $row['class']; ?></div></td>
                        <td><div align="center"><?php echo $row['boarding_status']; ?></div></td>
                        <td><div align="center"><?php echo $row['aggregate']; ?></div></td>
                        <td><div align="center"><?php echo $row['raw_score']; ?></div></td>
                        <td><div align="center"><?php echo $row['enrollment_code']; ?></div></td>
                        <td><div align="center"><?php echo $row['jhs_attended']; ?></div></td>
                        <td><div align="center"><?php echo $row['jhs_type']; ?></div></td>
                        <td><div align="center"><?php echo $row['phone']; ?></div></td>
                        <td><div align="center"><?php echo $row['email']; ?></div></td>
                        <td><div align="center"><?php echo $row['father_name']; ?></div></td>
                        <td><div align="center"><?php echo $row['father_occupation']; ?></div></td>
                        <td><div align="center"><?php echo $row['mother_name']; ?></div></td>
                        <td><div align="center"><?php echo $row['mother_occupation']; ?></div></td>
                        <td><div align="center"><?php echo $row['guardian_name']; ?></div></td>
                        <td><div align="center"><?php echo $row['residential_telephone']; ?></div></td>
                        <td><div align="center">
                          
                        <?php if (($row['status'])==(('1')))  { ?>
                          <span class="badge badge-success">Admitted</span>			 
   <?php } else if (($row['status'])==(('2'))){?>
    <span class="badge badge-danger">Rejected</span> 
    <?php } else {?>
    <span class="badge badge-warning">Pending</span> 
    
    <?php } ?>
                   
                      </div>
                    </td>

                    <td><div align="center"><?php echo $row['school_session']; ?></div></td>
                        <td><div align="center"><?php echo $row['house']; ?></div></td>
                            
                        <td>  <div class="btn-group">
                    <button type="button" class="btn btn-danger btn-flat">Action</button>
                    <button type="button" class="btn btn-danger btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown">
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" role="menu">
                      <a class="dropdown-item" href="delete-student.php?id=<?php echo $row['ID'];?>" onClick="return deldata('<?php echo $row['fullname']; ?> ');">Delete</a>
                      <?php if (($row['status'])==(('1')))  { ?>
                      <a class="dropdown-item" href="admit_reject_student.php?id=<?php echo $row['ID'];?>" onClick="return Deactivate('<?php echo $row['fullname']; ?> ');">Reject</a>
					  <?php } else {?>
					  <a class="dropdown-item" href="admit_reject_student.php?uid=<?php echo $row['ID'];?>" onClick="return Activate('<?php echo $row['fullname']; ?> ');">Admit</a>
					  <?php } ?>
            <a class="dropdown-item" href="assign_class_house.php?Asid=<?php echo $row['ID'];?>">Assign Class/House</a>

                    </div>
                  </div>
                </td>
                    </tr>
                    <?php $cnt=$cnt+1;} ?>
                    </tbody>
                    <tfoot>
                    </tfoot>
                  </table>
				  
                </div>
                <!-- /.card-body -->
              </div>
                <table width="392" border="0" align="right">
                  <tr>
                    <td width="386"><div class="card-footer">
                </div>
                </td>
                  </tr>
                </table>
                <p>&nbsp;</p>
                
              </td>
            </tr>
			
          </table>
          <p>
            <!-- /.card -->
          </p>
        </div>
          <!-- /.col -->
    </div>
        <!-- /.row -->
  </div>
      <!-- /.container-fluid --><!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      
    </div>
 <?php  include('../inc/footer2.php');   ?>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
