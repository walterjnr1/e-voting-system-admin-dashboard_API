<?php
include('../inc/controller.php');
if(empty($_SESSION['login_username']))
    {   
      header("Location: login.php"); 
    }
$username = $_SESSION["login_username"];

 
if(isset($_POST["btnsave"]))
{

 $prospectusType = strtoupper(mysqli_real_escape_string($conn,$_POST['cmdprospectusType']));

//check if prospectus already exist
$sql = "SELECT * FROM `tblprospectus` WHERE `prospectus_type`=? ";
      $query = $dbh->prepare($sql);
      $query->execute(array($prospectusType));
      $row = $query->rowCount();
      if($row > 0) {
      $_SESSION['error'] ="Prospectus for {$prospectusType} Already exist. Delete old Prospectus before uploading New one";
      }else {

  $file = addslashes(file_get_contents($_FILES['prospectus']['tmp_name']));
  $file_name= addslashes($_FILES['prospectus']['name']);
  $file_size= getimagesize($_FILES['prospectus']['tmp_name']);
  move_uploaded_file($_FILES["prospectus"]["tmp_name"],"../Downloads/Prospectus/" . $_FILES["prospectus"]["name"]);			

//save prospectus details
$query = "INSERT into `tblprospectus` (prospectus_type,filename)
VALUES ('$prospectusType','$file_name')";

    $result = mysqli_query($conn,$query);
      if($result){

header( "refresh:2;url= add_prospectus.php" );
//header("Location: add_prospectus.php"); 
$_SESSION['success'] ='Prospectus uploaded Successfully';

  //save activity log details
  $task= $username.' '.'uploaded New prospectus'.' '. 'On' . ' '.$current_date;
  $sql = 'INSERT INTO activity_log(task) VALUES(:task)';
  $statement = $dbh->prepare($sql);
  $statement->execute([
  ':task' => $task
  ]);

}else{
$_SESSION['error'] ='Problem Uploading prospectus';


}
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Upload Prospectus|Admin Dashboard</title>
  <link rel="icon" type="image/png" sizes="16x16" href="../<?php echo $logo; ?>">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
 
  <script type="text/javascript">
		function deldata(){
if(confirm("ARE YOU SURE YOU WISH TO DELETE THIS PROSPECTUS ?" ))
{
return  true;
}
else {return false;
}
	 
}

</script>
</head>
<body class="hold-transition sidebar-mini">
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
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Prospectus</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-4">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Prospectus</h3>
              </div>
              <!-- /.card-header -->
              Always use this prospectus filename for Day student = "https___cssps.gov_day.pdf " 

Always use this prospectus filename for Boarders = "https___cssps.gov_boarder.pdf"
              <!-- form start -->
              <form  action="" method="POST" enctype="multipart/form-data">
                <div class="card-body">
               
                <div class="form-group">
                    <label for="exampleInputEmail1">Propestus Type </label>
                    <select class="form-control" id="cmdprospectusType" name="cmdprospectusType">
    <option>Select Propestus Type</option> 
    <option>Day Student</option> 
    <option>Boarder</option> 
</select>                
  </div>
      <div class="form-group">
                    <label for="exampleInputPassword1">File</label>
                    <p class="text-center">
                        <input type="file" name="prospectus" id="prospectus" required class="form-control form-control-sm rounded-0">
                       </p>
							
              </div>
		   </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="btnsave" class="btn btn-primary">Upload</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

           
          </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-8">
            <!-- general form elements disabled -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Propestus Record(s)</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <table width="106%" align="center" class="table table-bordered table-striped" id="example1">
                    <thead>
                    <tr> <th width="3%"><div align="center">#</div></th>

                    <th width="13%"><div align="center">Propestus Type</div></th>
                    <th width="13%"><div align="center">Filename</div></th>
							         <th width="6%"><div align="center">Action</div></th>

                        </tr>
                    </thead>
                      <div align="center"></div>
                    
                    <tbody>
                                         <?php 
                                          $sql = "SELECT * FROM tblprospectus order by ID desc";
                                           $result = $conn->query($sql); 
										$cnt=1;
                                           while($row = $result->fetch_assoc()) { ?>
                      <tr class="gradeX">
					  <td height="47"><div align="center"><?php echo $cnt; ?></div></td>

            <td><div align="center"><?php echo $row['prospectus_type']; ?></div></td>
            <td><div align="center"><?php echo $row['filename']; ?></div></td>


                     <td>     <div class="btn-group" >
                    <button type="button" class="btn btn-danger btn-flat">Action</button>
                    <button type="button" class="btn btn-danger btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown">
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" role="menu">
							     
                      <a class="dropdown-item" href="delete_prospectus.php?file_id=<?php echo $row['filename'];?>&id=<?php echo $row['ID'];?>" onClick="return deldata();">Delete</a>

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
                    <td width="386"></td>
                  </tr>
                </table>
                <p>&nbsp;</p>
              </td>
            </tr>
			
          </table>
          <p>
            <!-- /.card -->
                     <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      
    </div>
    <strong><?php include '../inc/footer2.php' ?>
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
<!-- bs-custom-file-input -->
<script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>

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

<script>
    function display_img(input) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#logo-img').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
   
</script>
</body>
</html>
