<?php
include('../inc/controller.php');
if(empty($_SESSION['login_username']))
    {   
      header("Location: login.php"); 
    }
    
$username = $_SESSION["login_username"];

$sql = "select * from website_settings"; 
$result = $conn->query($sql);
$row_db= mysqli_fetch_array($result);


if(isset($_POST["btnedit"]))
{

$name = strtoupper(mysqli_real_escape_string($conn,$_POST['txtname']));
$address = strtoupper(mysqli_real_escape_string($conn,$_POST['txtaddress']));
$state = strtoupper(mysqli_real_escape_string($conn,$_POST['txtstate']));
$email = (mysqli_real_escape_string($conn,$_POST['txtemail']));
$phone = strtoupper(mysqli_real_escape_string($conn,$_POST['txtphone']));
$url = (mysqli_real_escape_string($conn,$_POST['txturl']));
$email_server = (mysqli_real_escape_string($conn,$_POST['txtemail_server']));
$email_username = (mysqli_real_escape_string($conn,$_POST['txtemail_username']));
$app_password = (mysqli_real_escape_string($conn,$_POST['txtapp_password']));
$port = strtoupper(mysqli_real_escape_string($conn,$_POST['txtport']));
$admission_fee = strtoupper(mysqli_real_escape_string($conn,$_POST['txtadmission_fee']));
$secretkey = (mysqli_real_escape_string($conn,$_POST['txtsecretkey']));
$publickey = (mysqli_real_escape_string($conn,$_POST['txtpublickey']));
$box = strtoupper(mysqli_real_escape_string($conn,$_POST['txtbox']));
$reportdate = strtoupper(mysqli_real_escape_string($conn,$_POST['txtreportdate']));
$headmaster = strtoupper(mysqli_real_escape_string($conn,$_POST['txtheadmaster']));

//save website details
$sql = " update website_settings set schoolname='$name',address='$address',state='$state',email='$email',phone='$phone',url='$url',email_server='$email_server',
email_username='$email_username',app_password='$app_password',email_port='$port',admission_fee='$admission_fee',
publickey='$publickey',secretkey='$secretkey',box='$box',reportdate='$reportdate',headmaster='$headmaster'";

if (mysqli_query($conn, $sql)) {
        
  header( "refresh:3;url= website_settings.php" );
$_SESSION['success'] ='Website details Added Successfully';

  //save activity log details
  $task= $username.' '.'Added website details'.' '. 'On' . ' '.$current_date;
  $sql = 'INSERT INTO activity_log(task) VALUES(:task)';
  $statement = $dbh->prepare($sql);
  $statement->execute([
  ':task' => $task
  ]);

}else{
$_SESSION['error'] ='Problem adding Website Details';
}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Website Setting|Admin Dashboard</title>
  <link rel="icon" type="image/png" sizes="16x16" href="../<?php echo $logo; ?>">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
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
    <a href="index.php" class="brand-link">
    <img src="../<?php echo $logo ;?>" alt=" Logo"  width="200" height="111" class="" style="opacity: .8">
	  <span class="brand-text font-weight-light"></span>
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
              <li class="breadcrumb-item active">Website Settings </li>
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
        
		 <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Website Settings </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
             <form  action="" method="POST" >
                <div class="card-body">
                 
				   <div class="form-group">
                    <label for="exampleInputEmail1">School Name </label>
                    <input type="text" class="form-control" name="txtname" id="exampleInputEmail1" size="77" value="<?php echo $row_db['schoolname'];   ?>" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">HeadMaster</label>
                    <input type="text" class="form-control" name="txtheadmaster" id="exampleInputPassword1" size="77" value="<?php echo $row_db['headmaster'];   ?>" >
                  </div>
				  <div class="form-group">
                    <label for="exampleInputPassword1">Address</label>
                    <input type="text" class="form-control" name="txtaddress" id="exampleInputPassword1" size="77" value="<?php echo $row_db['address'];   ?>" >
                  </div>
				
                  <div class="form-group">
                    <label for="exampleInputPassword1">State</label>
                    <input type="text" class="form-control" name="txtstate" id="exampleInputPassword1" size="77" value="<?php echo $row_db['state'];   ?>" >
                  </div>    
                  
                  <div class="form-group">
                    <label for="exampleInputPassword1">School Email</label>
                    <input type="text" class="form-control" name="txtemail" id="exampleInputPassword1" size="77" value="<?php echo $row_db['email'];   ?>" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Phone</label>
                    <input type="text" class="form-control" name="txtphone" id="exampleInputPassword1" size="77" value="<?php echo $row_db['phone'];   ?>" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">URL</label>
                    <input type="text" class="form-control" name="txturl" id="exampleInputPassword1" size="77" value="<?php echo $row_db['url'];   ?>" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Email Host/Server</label>
                    <input type="text" class="form-control" name="txtemail_server" id="exampleInputPassword1" size="77" value="<?php echo $row_db['email_server'];   ?>" >
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Email Username </label>
                    <input type="text" class="form-control" name="txtemail_username" id="exampleInputPassword1" size="77" value="<?php echo $row_db['email_username'];   ?>" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">App Password</label>
                    <input type="text" class="form-control" name="txtapp_password" id="exampleInputPassword1" size="77" value="<?php echo $row_db['app_password'];   ?>" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Email Port</label>
                    <input type="number" class="form-control" name="txtport" id="exampleInputPassword1" size="77" value="<?php echo $row_db['email_port'];   ?>" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Admission Fee</label>
                    <input type="text" class="form-control" name="txtadmission_fee" id="exampleInputPassword1" size="77" value="<?php echo $row_db['admission_fee'];   ?>" >
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Paystack Public Key</label>
                    <input type="text" class="form-control" name="txtpublickey" id="exampleInputPassword1" size="77" value="<?php echo $row_db['publickey'];   ?>" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Paystack Secret Key</label>
                    <input type="text" class="form-control" name="txtsecretkey" id="exampleInputPassword1" size="77" value="<?php echo $row_db['secretkey'];   ?>" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">P.O.Box</label>
                    <input type="text" class="form-control" name="txtbox" id="exampleInputPassword1" size="77" value="<?php echo $row_db['box'];   ?>" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Report Back Date</label>
                    <input type="date" class="form-control" name="txtreportdate" id="exampleInputPassword1" size="77" value="<?php echo $row_db['reportdate'];   ?>" >
                  </div>
                  
              </div>
                <!-- /.card-body -->
 
                <div class="card-footer">
                  <button type="submit" name="btnedit" class="btn btn-primary">Save Changes</button>
                </div>
              </form>
            </div>
		
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col --><!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)--><!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <?php include('../inc/footer2.php');  ?>
    <div class="float-right d-none d-sm-inline-block">
      
    </div>
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
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
	
<link rel="stylesheet" href="popup_style.css">
<?php if(!empty($_SESSION['success'])) {  ?>
<div class="popup popup--icon -success js_success-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      <strong>Success</strong> 
    </h1>
    <p><?php echo $_SESSION['success']; ?></p>
    <p>
      <button class="button button--success" data-for="js_success-popup">Close</button>
    </p>
  </div>
</div>
<?php unset($_SESSION["success"]);  
} ?>
<?php if(!empty($_SESSION['error'])) {  ?>
<div class="popup popup--icon -error js_error-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      <strong>Error</strong> 
    </h1>
    <p><?php echo $_SESSION['error']; ?></p>
    <p>
      <button class="button button--error" data-for="js_error-popup">Close</button>
    </p>
  </div>
</div>
<?php unset($_SESSION["error"]);  } ?>
    <script>
      var addButtonTrigger = function addButtonTrigger(el) {
  el.addEventListener('click', function () {
    var popupEl = document.querySelector('.' + el.dataset.for);
    popupEl.classList.toggle('popup--visible');
  });
};

Array.from(document.querySelectorAll('button[data-for]')).
forEach(addButtonTrigger);
    </script>

    
</body>
</html>
