<?php 
include('../inc/controller.php'); 
if(empty($_SESSION['login_index_no']))
    {   
      header("Location: ../login.php"); 
    }

	$index_no = $_SESSION["login_index_no"];


if(isset($_POST["btnedit"]))
{


$image= addslashes(file_get_contents($_FILES['userImage']['tmp_name']));
$image_name= addslashes($_FILES['userImage']['name']);
$image_size= getimagesize($_FILES['userImage']['tmp_name']);
move_uploaded_file($_FILES["userImage"]["tmp_name"],"../uploadImage/Profile/" . $_FILES["userImage"]["name"]);			
$student_photo="uploadImage/Profile/" . $_FILES["userImage"]["name"];
			
$sql = " update tblstudents set photo='$student_photo' where index_no='$index_no'";
   
if (mysqli_query($conn, $sql)) {

	//save activity log details
	$task= $fullname_student.' '.'Edited his photo'.' '. 'On' . ' '.$current_date;
	$sql = 'INSERT INTO activity_log(task) VALUES(:task)';
	$statement = $dbh->prepare($sql);
	$statement->execute([
	':task' => $task
	]);
header( "refresh:2;url= photo.php" );
$_SESSION['success']='Photo changed successfully';

}else{
$_SESSION['error']='Editing Was Not Successful';
}
}
?> 
<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>Upload Photo| <?php echo $schoolname;  ?></title>
	<link rel="icon" type="image/png" sizes="16x16" href="../<?php echo $logo; ?>">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/style.css">

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
	</script>
	
<style type="text/css">
<!--
.style1 {color: #000000}
-->
</style></head>
<body>
	

<?php include('header.php'); ?>

<?php include('sidebar.php'); ?>
	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
		
				<div class="row">
				
					<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
						<div class="card-box height-100-p overflow-hidden">
							
											<div class="profile-setting">
											<form  action="" method="POST" enctype="multipart/form-data">
													<ul class="profile-edit-list row">
													
														<li class="weight-500 col-md-9">
															<h4 align="center" class="text-blue h5 mb-20">Edit Photo</h4>
															<div class="form-group">
																<div align="center"><img src="../<?php echo $photo; ?>" alt="" class="avatar-photo" height="33" width="111" id="logo-img">															      </div>
															</div>
															<div class="form-group">
																<input name="userImage" type="file" class="form-control-file form-control height-auto" accept="image/jpeg,image/jpg" onChange="display_img(this)" required/>
															</div>
															
                                                            <button type="submit" name="btnedit" class="btn btn-success"> Save Changes</button>
														</li>
													</ul>
											  </form>
											</div>
					  </div>
										<!-- Setting Tab End -->
				  </div>
		  </div>
	  </div>
</div>
					</div>
				</div>
			</div>
			
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			<div class="footer-wrap pd-20 mb-20 card-box">
            <?php include('../inc/footer2.php'); ?>
            </div>
		</div>
	</div>
	<!-- js -->
	<script src="vendors/scripts/core.js"></script>
	<script src="vendors/scripts/script.min.js"></script>
	<script src="vendors/scripts/process.js"></script>
	<script src="vendors/scripts/layout-settings.js"></script>
	<script src="src/plugins/cropperjs/dist/cropper.js"></script>
	<script>
		window.addEventListener('DOMContentLoaded', function () {
			var image = document.getElementById('image');
			var cropBoxData;
			var canvasData;
			var cropper;

			$('#modal').on('shown.bs.modal', function () {
				cropper = new Cropper(image, {
					autoCropArea: 0.5,
					dragMode: 'move',
					aspectRatio: 3 / 3,
					restore: false,
					guides: false,
					center: false,
					highlight: false,
					cropBoxMovable: false,
					cropBoxResizable: false,
					toggleDragModeOnDblclick: false,
					ready: function () {
						cropper.setCropBoxData(cropBoxData).setCanvasData(canvasData);
					}
				});
			}).on('hidden.bs.modal', function () {
				cropBoxData = cropper.getCropBoxData();
				canvasData = cropper.getCanvasData();
				cropper.destroy();
			});
		});
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
	<link rel="stylesheet" href="src/styles/popup_style.css">
<?php if (!empty($_SESSION['success'])) {  ?>
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
<?php if (!empty($_SESSION['error'])) {  ?>
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
<?php unset($_SESSION["error"]);
} ?>
<script>
  var addButtonTrigger = function addButtonTrigger(el) {
    el.addEventListener('click', function() {
      var popupEl = document.querySelector('.' + el.dataset.for);
      popupEl.classList.toggle('popup--visible');
    });
  };

  Array.from(document.querySelectorAll('button[data-for]')).
  forEach(addButtonTrigger);
</script>
</body>
</html>