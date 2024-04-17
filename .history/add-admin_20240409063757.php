<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

include('inc/controller.php');
if(empty($_SESSION['login_username']))
    {   
      header("Location: login.php"); 
    }
    
$username = $_SESSION["login_username"];

if(isset($_POST["btncreate"]))
{

$username = (mysqli_real_escape_string($conn,$_POST['txtusername']));
$fullname = strtoupper(mysqli_real_escape_string($conn,$_POST['txtfullname']));
$email = (mysqli_real_escape_string($conn,$_POST['txtemail']));
$group = (mysqli_real_escape_string($conn,$_POST['cmdgroup']));

//generate password
function generateRandomPassword($length = 8) {
  $password = '';
  $possibleCharacters = 'ABCDEFGHIJKLMNOPQRSTWXYZ0123456789';

  for ($i = 0; $i < $length; $i++) {
      $password .= $possibleCharacters[mt_rand(0, strlen($possibleCharacters) - 1)];
  }
return $password;
}
$password = generateRandomPassword(8);

$sql = "SELECT * FROM users where username='$username'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
$_SESSION['error'] =' Username Already Exist ';

//}elseif($password!=$password2){ 
//$_SESSION['error'] ='Both Passwords Do not match';

//}elseif(strlen($password) < 8){ 
//$_SESSION['error'] ='Password must be at least 8 characters';


}else{

//save users details
$query = "INSERT into `users` (username,password,fullname,email,lastaccess,status,photo,groupname)
VALUES ('$username','$password','$fullname','$email','Nill','1','uploadImage/Profile/default.png','$group')";
  $result = mysqli_query($conn,$query);

//send registration email
$mail = new PHPMailer(true);
     
//Server settings
$mail->isSMTP();                                            //Send using SMTP
$mail->Host       = $email_server;                     //Set the SMTP server to send through
$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
$mail->Username   = $email_username;                     //SMTP username
$mail->Password   = $app_password;                               //SMTP password
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
 $mail->Port       = $port;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

//Recipients
$mail->setFrom($email_website, $appname);
$mail->addAddress($email,$fullname);     //Add a recipient

$message = "
<html>
<head>
<title>User Account | $appname</title>
</head>
<body>
<p>Hello <strong>$fullname ,</strong></p>
       
<p> Your account as a $group with $appname has been successfully created.</p>
 
<p>  Username is :$username  .</p>
<p>  password is :$password  .</p>

<p>N/B: You Are advised to change password to something you can easily remember.</p>

<p> Regards.</p>
<p>$appname Team</p>        
</body>
</html>
";

//Content
$mail->isHTML(true);                                  //Set email format to HTML
$mail->Subject = "User Account  | $appname ";
$mail->Body    = $message;

$mail->send();

if($result){
$_SESSION['success'] ='User Account created Successfully and email sent to the user';

}else{
$_SESSION['error'] ='Problem Adding User';

}
}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Create User|Dashboard</title>
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $logo; ?>">
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
      <img src="<?php echo $logo ;?>" alt=" Logo"  width="200" height="111" class="" style="opacity: .8">
	  <span class="brand-text font-weight-light"></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo $photo_admin; ?>" alt="User Image" width="220" height="192" class="img-circle elevation-2">        </div>
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
              <li class="breadcrumb-item active">Create User </li>
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
                <h3 class="card-title">Create User </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
               <form id="form" action="" method="post" class="">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Username </label>
                    <input type="text" class="form-control" name="txtusername" id="exampleInputEmail1" size="77" value="<?php if (isset($_POST['txtusername']))?><?php echo $_POST['txtusername']; ?>" placeholder="Enter Username">
                  </div>
				   <div class="form-group">
                    <label for="exampleInputEmail1">Fullname </label>
                    <input type="text" class="form-control" name="txtfullname" id="exampleInputEmail1" size="77" value="<?php if (isset($_POST['txtfullname']))?><?php echo $_POST['txtfullname']; ?>" placeholder="Enter Fullname">
                  </div>
                 		
                  <div class="form-group">
                    <label for="exampleInputPassword1">Email</label>
                    <input type="email" class="form-control" name="txtemail" id="exampleInputPassword1" size="77" value="<?php if (isset($_POST['txtemail']))?><?php echo $_POST['txtemail']; ?>" placeholder="Enter Email">
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputPassword1">Group Name</label>
                    <select name="cmdgroup"  id="cmdgroup" class="form-control" required>';
             <option value="">Select User Group</option>
             <option value="Admission Committee">Admission Committee</option>
             <option value="Headmaster">Headmaster</option>
             <option value="Principal">Principal</option>

            </select>                     </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="btncreate" class="btn btn-primary">Create User</button>
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
    <?php include('..inc/footer2.php');  ?>
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
