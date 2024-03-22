<?php
include('../inc/controller.php');
if(empty($_SESSION['login_username']))
{   
header("Location: login.php"); 
}  
$username = $_SESSION["login_username"];
$query=$_POST['cmdsearch'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Student Report| <?php echo $schoolname ;?> </title>
  <link rel="icon" type="image/png" sizes="16x16" href="../<?php echo $logo;?>">
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
   <script type="text/javascript" src="http://jqueryjs.googlecode.com/files/jquery-1.3.1.min.js"> </script>
    <script type="text/javascript">
        function PrintElem(elem) {
            Popup($(elem).html());
        }

        function Popup(data) {
            var myWindow = window.open('', 'Student Report', 'height=400,width=1100');
            myWindow.document.write('<html><head><title>Student Report</title>');
            /*optional stylesheet*/ //myWindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
            myWindow.document.write('</head><body >');
            myWindow.document.write(data);
            myWindow.document.write('</body></html>');
            myWindow.document.close(); // necessary for IE >= 10

            myWindow.onload=function(){ // necessary if the div contain images

                myWindow.focus(); // necessary for IE >= 10
                myWindow.print();
                myWindow.close();
            };
        }
    </script>

  <style type="text/css">
<!--
.style8 {
	color: #0000FF;
	font-weight: bold;
}
.style11 {font-size: 14px}
.style12 {
	font-size: 14;
	color: #000000;
}
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
      <img src="../<?php echo $logo;   ?>" alt=" Logo"  width="200" height="111" class="" style="opacity: .8">
	        <span class="brand-text font-weight-light">  </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../<?php echo $photo_admin;  ?>" alt="User Image" width="220" height="192" class="img-circle elevation-2">        </div>
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
              <li class="breadcrumb-item active">Student Report</li>
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
        <div id="card">
          <p>&nbsp;</p>
          <table width="1049" border="0" align="center">
            <tr>
              <td width="1343" height="214"><div class="card">
                <div class="card-header">
                  <p align="center" class="style8">Student Report (<?php echo $current_session;  ?>) <a href="class_report.php"><span class="style12">&lt;&lt; Back</span> </a></p>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table width="97%" align="center" class="table" id="example1">
                    <thead>
                    <th width="4%"><span class="style11">photo</span></th>
						            <th width="5%"><span class="style11">Index No</span></th>
                        <th width="6%"><span class="style11">Fullname</span></th>
					             <th width="3%"><span class="style11">Sex</span></th>
                       <th width="8%"><span class="style11">Programme</span></th>
                       <th width="4%"><span class="style11">Class</span></th>
                       <th width="8%"><span class="style11">Boarding Status</span></th>
						            <th width="7%"><span class="style11">Aggregate</span></th>
                        <th width="5%"><span class="style11">Raw score</span></th>
                       <th width="8%"><span class="style11">Enrollment code</span></th>
					             <th width="7%"><span class="style11">JHS Attended</span></th>
                       <th width="4%"><span class="style11">Phone</span></th>
						            <th width="4%"><span class="style11">Email</span></th>
                        <th width="7%"><span class="style11">Father's Name</span></th>
                        <th width="8%"><span class="style11">Father's Occupation</span></th>
                        <th width="6%"><span class="style11">Guardian</span></th>
                       <th width="6%"><span class="style11">House</span></th>
				      </tr>
                    </thead>
                      <div align="center"></div>

                    <tbody>
                                         <?php
                        $ret=mysqli_query($conn,"SELECT tblstudents.index_no as index_no,tblstudents.photo as photo,tblstudents.fullname as fullname,tblstudents.sex as sex,tblstudents.programme as programme
                        ,tblstudents.boarding_status as boarding_status,tblstudents.aggregate as aggregate,tblstudents.raw_score as raw_score,tblclass.name as class,
                        tblhouse.name as house,tblstudents.enrollment_code as enrollment FROM tblstudents INNER JOIN tblclass ON tblstudents.class = tblclass.ID INNER JOIN tblhouse ON tblstudents.house = tblhouse.ID where tblstudents.phone LIKE '$query%' OR tblstudents.school_session LIKE '$query%' OR tblstudents.programme LIKE '$query%' OR tblstudents.index_no LIKE '$query%' OR tblstudents.sex LIKE '$query%' OR tblstudents.fullname LIKE '$query%' OR tblstudents.email LIKE '$query%' order by tblstudents.ID asc");
                        while ($row=mysqli_fetch_array($ret)) {
                            ?>
                         <tr class="gradeX">
                       <td height="35" class="center"><div align="center"><img src="../<?php echo $row['photo'];?>"  width="37" height="32" border="2"/></div></td>
                        <td><div align="center"><?php echo $row['index_no'];?> </div></td>
					            	<td><div align="center"><?php echo $row['fullname'];?> </div></td>
                        <td class="center"><div align="center"><?php echo $row['sex'];  ?></div></td>
                        <td class="center"><div align="center"><?php echo $row['programme'];?></div></td>
					               <td class="center"><div align="center"><?php echo $row['class'];?></div></td>
                        <td><div align="center"><?php echo $row['boarding_status'];?> </div></td>
						            <td><div align="center"><?php echo $row['aggregate'];?> </div></td>
                        <td class="center"><div align="center"><?php echo $row['raw_score'];  ?></div></td>
                        <td class="center"><div align="center"><?php echo $row['enrollment_code'];?></div></td>
						            <td class="center"><div align="center"><?php echo $row['jhs_attended'];?></div></td>
						           <td><div align="center"><?php echo $row['phone'];?> </div></td>
                        <td class="center"><div align="center"><?php echo $row['email'];  ?></div></td>
                        <td class="center"><div align="center"><?php echo $row['father_name'];?></div></td>
						           <td class="center"><div align="center"><?php echo $row['father_occupation'];?></div></td>
                         <td class="center"><div align="center"><?php echo $row['guardian_name'];  ?></div></td>
					            	<td><div align="center"><?php echo $row['house'];?> </div></td>
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
                    <td width="386"></td>
                  </tr>
                </table>
                <p align="left">&nbsp;       </p>
                <p align="left">
                  <input type="button" value="Print Report" onClick="PrintElem('#card')" />
                </p></td>
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
    <?php include('../inc/footer.php');  ?>

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
