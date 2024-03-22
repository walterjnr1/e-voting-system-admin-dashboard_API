<?php 
include('../inc/controller.php'); 
if(empty($_SESSION['login_index_no']))
    {   
      header("Location: ../login.php"); 
    }

//fetch student data
$index_no = $_SESSION["login_index_no"];
$sql="SELECT tblstudents.raw_score as raw_score ,tblstudents.enrollment_code as enrollment_code,tblstudents.jhs_attended as jhs_attended,tblstudents.jhs_type as jhs_type,tblstudents.phone as phone,tblstudents.email as email,tblstudents.father_name as father_name,tblstudents.father_occupation as father_occupation,tblstudents.mother_name as mother_name,tblstudents.mother_occupation as mother_occupation,tblstudents.guardian_name as guardian_name, tblstudents.residential_telephone as residential_telephone,
tblclass.name as class_name, tblhouse.name as house_name FROM tblstudents INNER JOIN tblclass ON tblstudents.class = tblclass.ID INNER JOIN tblhouse ON tblstudents.house = tblhouse.ID where tblstudents.index_no='$index_no'";
$row_student= $stmt->fetch();



if(isset($_POST["btnedit"]))
{
$rawscore = strtoupper(mysqli_real_escape_string($conn,$_POST['txtrawsore']));
$enrolment_code = strtoupper(mysqli_real_escape_string($conn,$_POST['txtenrolmentcode']));
$jhsattended = strtoupper(mysqli_real_escape_string($conn,$_POST['txtjhsattended']));
$jhstype = strtoupper(mysqli_real_escape_string($conn,$_POST['txtjhstype']));
$phone = strtoupper(mysqli_real_escape_string($conn,$_POST['txtphone']));
$email = strtoupper(mysqli_real_escape_string($conn,$_POST['txtemail']));
$father_name = strtoupper(mysqli_real_escape_string($conn,$_POST['txtfather_name']));
$father_occupation = strtoupper(mysqli_real_escape_string($conn,$_POST['txtfather_occupation']));
$mother_name = strtoupper(mysqli_real_escape_string($conn,$_POST['txtmother_name']));
$mother_occupation = strtoupper(mysqli_real_escape_string($conn,$_POST['txtmother_occupation']));
$guardian = strtoupper(mysqli_real_escape_string($conn,$_POST['txtguardian']));
$telephone = strtoupper(mysqli_real_escape_string($conn,$_POST['txttelephone']));
$class = strtoupper(mysqli_real_escape_string($conn,$_POST['cmdclass']));
$house = strtoupper(mysqli_real_escape_string($conn,$_POST['cmdhouse']));

//get class limit
$stmt = $dbh->query("SELECT * FROM tblclass where ID='$class'");
$row_class= $stmt->fetch();
$c_limit = $row_class['class_limit'];  

//get house limit
$stmt = $dbh->query("SELECT * FROM tblhouse where ID='$house'");
$row_class= $stmt->fetch();
$h_limit = $row_class['house_limit'];

//count class in tblstudents
$stmt = $dbh->prepare("SELECT COUNT(class) FROM tblstudents WHERE class = :class");
$stmt->bindParam(':class', $class);
$stmt->execute();
// Get the number of students in the specified class
$numStudents = $stmt->fetchColumn();

//count house in tblstudents
$stmt = $dbh->prepare("SELECT COUNT(house) FROM tblstudents WHERE house = :house");
$stmt->bindParam(':house', $house);
$stmt->execute();

// Get the number house 
$numHouse = $stmt->fetchColumn();

if ($numStudents >= $c_limit){
$_SESSION['error'] = "  Class Limit for this class has been exceeded.Please select another Class.";

}else{
	if ($numHouse >= $h_limit){
$_SESSION['error'] = "  House Limit for this class has been exceeded.Please select another House.";
		

//upload enrolment form 
	$file_type = $_FILES['enrolmentForm']['type']; //returns the mimetype
  $allowed = array("image/jpg", "image/jpeg");
  if(!in_array($file_type, $allowed)) {
	$_SESSION['error'] = 'Only jpg and jpeg formats are allowed.';
  }
  $file_size = $_FILES['enrolmentForm']['size']; // returns the file size in bytes
	$allowed_size = 2 * 1024 * 1024; // 2MB in bytes

	if ($file_size > $allowed_size) {
    $_SESSION['error'] = 'The image file size is too large. Please upload a file that is 2MB or smaller.';
	} else { 
  $image= addslashes(file_get_contents($_FILES['enrolmentForm']['tmp_name']));
  $image_name= addslashes($_FILES['enrolmentForm']['name']);
  $image_size= getimagesize($_FILES['enrolmentForm']['tmp_name']);
  
   // Define the destination path
   $destination_path = "../uploadImage/enrolmentForm/" . $image_name;
 // Check if the file already exists at the destination path
 if (file_exists($destination_path)) {
    // Delete the existing file
    unlink($destination_path);
  }

  move_uploaded_file($_FILES["enrolmentForm"]["tmp_name"],"../uploadImage/enrolmentForm/" . $_FILES["enrolmentForm"]["name"]);		
 
	
//save changes
$sql = " update tblstudents set raw_score='$rawscore',enrollment_code='$enrolment_code',
jhs_attended='$jhsattended',jhs_type='$jhstype',phone='$phone',email='$email',
father_name='$father_name',father_occupation='$father_occupation',mother_name='$mother_name',
mother_occupation='$mother_occupation',guardian_name='$guardian',residential_telephone='$telephone',
class='$class',house='$house' where index_no='$index_no'";


if (mysqli_query($conn, $sql)) {
	//save activity log details


	  //save activity log details
	  $task= $fullname_student.' '.'Edited his personal data'.' '. 'On' . ' '.$current_date;
	  $sql = 'INSERT INTO activity_log(task) VALUES(:task)';
	  $statement = $dbh->prepare($sql);
	  $statement->execute([
	  ':task' => $task
	  ]);

header( "refresh:3;url= personalRecordForm.php" );
//header("Location: personalRecordForm.php");
$_SESSION['success']="Personal Record Changed Successfully";

}else{
$_SESSION['error']='Editing Was Not Successful';

}
}
}
}
}
?>
	
<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>Personal Record Form| <?php echo $schoolname;  ?></title>
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

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
.style2 {
	color: #FF0000;
	font-size: 12px;
}
.style3 {
	color: #993333;
	font-size: 12px;
}
.style4 {
	color: #000000;
	font-weight: bold;
}
-->
</style></head>
<body>
	

<?php include('header.php'); ?>

<?php include('sidebar.php'); ?>
	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
	    <div class="row">
				  <div class="col-xl-12 col-lg-8 col-md-8 col-sm-12 mb-30">
						<div class="card-box height-100-p overflow-hidden">
							
											<div class="profile-setting">
											<form action="" method="POST" enctype="multipart/form-data">
													<ul class="profile-edit-list row">
													
														<li class="weight-500 col-md-9">
															<h4 class="text-blue h5 mb-20"> Personal Record Form (<?php echo $current_session ; ?>)</h4>
															<h6 class="text-blue h5 mb-20 style2"> Note: the information you provide here must be the same with the one in your placement form. Any attempt to do otherwise may result in CANCELATION OF YOUR ADMISSION.Thank You </h6>

														    <strong>
														    <label>Enrolment Data Part 1. No action required.</label>
														    </strong>
<div class="form-group">
																<label>Index No:</label>
																<input class="form-control form-control-lg" type="text" name="txtfullname" value="<?php echo $index_no ; ?>" readonly>
														  </div>
															<div class="form-group">
																<label>Gender:</label>
																<input class="form-control form-control-lg" type="telephone" name="txtphone" value="<?php echo $sex ; ?>" readonly>
															</div>
															<div class="form-group">
																<label>Fullname:</label>
																<input class="form-control form-control-lg" type="text" name="txtfullname" value="<?php echo $fullname_student ; ?>" readonly>
															</div>
															<div class="form-group">
																<label>Programme:</label>
																<input class="form-control form-control-lg" type="telephone" name="txtphone" value="<?php echo $programme ; ?>" readonly>
															</div>
															<div class="form-group">
																<label>Boarding Status:</label>
																<input class="form-control form-control-lg" type="text" name="txtfullname" value="<?php echo $boarding_status ; ?>" readonly>
															</div>
															
															<div class="form-group">
																<label>Aggregate of Best Six:</label>
																<input class="form-control form-control-lg" type="text" name="txtfullname" value="<?php echo $aggregate ; ?>" readonly>
															</div>
														  <strong>
													      <label>Enrolment Data Part 2. <span class="style2">(Enter exactly what is in your enrolment form you printed from the CSSPS website)</span></label>
													      </strong>
															<div class="form-group">
																<label>Raw Score:</label>
																<input class="form-control form-control-lg" type="text" name="txtrawsore" value="<?php echo $row_student['raw_score'] ; ?>">
															</div>
															<div class="form-group">
																<label>Enrolment Code:(10 characters)</label>
																<input class="form-control form-control-lg" type="text" name="txtenrolmentcode"   maxlength   ="10"  value="<?php echo $row_student['enrollment_code'] ; ?>" >
																<label><span class="style3">Find the code on your ENROLMENT, your admission is invalid without correct enrolment code</span></label>
														  </div>
																<label>ENROLMENT FORM UPLOAD. <span class="style2">Please take a picture of your printed enrolment form and upload here (only jpg image - max 2mb)</span> </label>

														  <div class="form-group">
																<label>Enrolment form :</label>
						<input name="enrolmentForm" type="file" class="form-control-file form-control height-auto" accept="image/jpg,image/jpeg" required/>
						<label><span class="style2">Note: only Jpg and jpeg formats allowed - max file size is 2mb</span></label>
														  </div>
															<div class="form-group">
																<label>Name of JHS attended:</label>
																<input class="form-control form-control-lg" type="text" name="txtjhsattended" value="<?php echo $row_student['jhs_attended'] ; ?>" >
															</div>
															<div class="form-group">
																<label>JHS Type:</label>
																<input class="form-control form-control-lg" type="text" name="txtjhstype" value="<?php echo $row_student['jhs_type'] ; ?>">
															</div>
															<label>CLASS SELECTION (<?php echo $programme ; ?>) </label>
														<span class="text-blue h5 mb-20 style2"> Pls select a class below to see the elective subjects and select the right subject combination for your ward interest. </span>
														<div class="form-group">
																<label>Class:</label>
															
<?php
			      $sql = "select * from tblclass order by name asc";
             $class = $dbh->query($sql);                       
             $class->setFetchMode(PDO::FETCH_ASSOC);
             echo '<select name="cmdclass"  id="selectSubject" class="form-control" >';
			  echo '<option value="'.$row_student['class_name'].'">'.$row_student['class_name'].'</option>';
             while ( $row = $class->fetch() ) 
             {
                echo '<option value="'.$row['ID'].'">'.$row['name'].'</option>';
             }
             echo '</select>';
			?>
			</div>
				 <p align="center" class="style4">Elective Subjects</p>
				 				 <p align="center" class="style4" id="classno"></p>

                 <div align="center">
                   
                   <table border="0" style= "background-color: #F9F6EE; color: #0000FF; margin: 0 auto;" >
                     <thead>
                       
                       </tr>
                       </thead>
                     <tbody>

					<tr> <td style='padding-left: 20px; padding-right: 20px;' id ="subjectlist"></td>
					</tr>
	              	</tbody>
                   </table>
                   </div>
													  </li>
													    <li class="weight-500 col-md-9" ><div id="classno">  </div></li>
												      <div id="classno"></div>
													    <li class="weight-500 col-md-9">
													      <div align="center">
													        <div align="left">
													          <script>
    		let option = document.getElementById("selectSubject");
    		let td = document.getElementsByTagName("td")[0];

    		option.addEventListener('change', function(){
       		 if(option != undefined && option.value != "Select"){
            let xhr = new XMLHttpRequest(); // Using XMLHttpRequest

            xhr.open("POST", "get_data.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            var valueToSend = option.value;
            xhr.send("class=" + encodeURIComponent(valueToSend));
            xhr.onreadystatechange = function() {
               
				if (xhr.readyState === 4 && xhr.status === 200) {
                    let response = JSON.parse(xhr.responseText);
                    td.innerHTML = "";

					response.forEach((data) => {
                        let tr = document.createElement('tr');
                        tr.textContent = data.subject;
                        td.appendChild(tr);
                    })

                } else if (xhr.readyState === 4 && xhr.status !== 200) {
                    console.error("AJAX error:", xhr.statusText);
                }
            };
           
            xhr.send();
        }
    })
                   </script>
				   <script>
       function classdetails(str) {
     
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function () {
          if (this.readyState == 4 && this.status == 200) {
          var myObj = JSON.parse(this.responseText);
             document.getElementById("classno").value = myObj[0];
            
            }};
          xmlhttp.open("GET", "get_class_data.php?selectSubject=" + str, true);
          xmlhttp.send();
      }
  
</script>

				
				
				   <span class="text-blue h5 mb-20 style2"> Change of class shall not be entertain in the school.</span> <span class="text-blue h5 mb-20 style2">Continue if there is no class for you to select, when you get to school, a class will be assigned to you.<br>
												              </span><br>
															  <label>HOUSE SELECTION </label>
														<div class="form-group">
																<label>House:</label>
															
<?php
			      $sql = "select * from tblhouse order by name asc";
             $house = $dbh->query($sql);                       
             $house->setFetchMode(PDO::FETCH_ASSOC);
             echo '<select name="cmdhouse"  id="cmdhouse" class="form-control" required>';
			  echo '<option value="'.$row_student['house_name'].'">'.$row_student['house_name'].'</option>';
             while ( $row = $house->fetch() ) 
             {
                echo '<option value="'.$row['ID'].'">'.$row['name'].'</option>';
             }
             echo '</select>';
			?>
			</div>
													          COMMUNICATION. <span class="style2">Please provide active phone number and email address (if any)</span> 
													          </label>
												            </div>
												          </div>
													      <div class="form-group">
													        <label>
													        <div align="center">Mobile phone:</div>
			            </label>
													        <div align="center">
													          <input class="form-control form-control-lg" type="telephone" name="txtphone" value="<?php echo $row_student['phone'] ; ?>" >
												            </div>
                       </div>
													      <div class="form-group">
													        <label>
													        <div align="center">Email Address:</div>
												            </label>
													        <div align="center">
													          <input class="form-control form-control-lg" type="email" name="txtemail" value="<?php echo $row_student['email'] ; ?>">
												            </div>
												          </div>
													      <label>
													      <div align="center">PARENTAL DATA. <span class="style2">All fields are mandatory</span> </div>
													      </label>
													      
													      <div class="form-group">
													        <label>
													        <div align="center">Father's Name:</div>
												            </label>
													        <div align="center">
													          <input class="form-control form-control-lg" type="text" name="txtfather_name" value="<?php echo $row_student['father_name'] ; ?>" >
												            </div>
												          </div>
													      <div class="form-group">
													        <label>
													        <div align="center">Father's Occupation:</div>
												            </label>
													        <div align="center">
													          <input class="form-control form-control-lg" type="text" name="txtfather_occupation" value="<?php echo $row_student['father_occupation'] ; ?>">
												            </div>
												          </div>
													      <div class="form-group">
													        <label>
													        <div align="center">Mother's Name:</div>
												            </label>
													        <div align="center">
													          <input class="form-control form-control-lg" type="text" name="txtmother_name" value="<?php echo $row_student['mother_name'] ; ?>" >
												            </div>
												          </div>
													      <div class="form-group">
													        <label>
													        <div align="center">Mother's Occupation:</div>
												            </label>
													        <div align="center">
													          <input class="form-control form-control-lg" type="text" name="txtmother_occupation" value="<?php echo $row_student['mother_occupation'] ; ?>">
												            </div>
												          </div>
													      <div class="form-group">
													        <label>
													        <div align="center">Name of Guardian:</div>
												            </label>
													        <div align="center">
													          <input class="form-control form-control-lg" type="text" name="txtguardian" value="<?php echo $row_student['guardian_name'] ; ?>" >
												            </div>
												          </div>
													      <div class="form-group">
													        <label>
													        <div align="center">Residential Telephone:</div>
												            </label>
													        <div align="center">
													          <input class="form-control form-control-lg" type="telephone" name="txttelephone" value="<?php echo $row_student['residential_telephone'] ; ?>">
												            </div>
												          </div>
													      <div align="center">
													        <button type="submit" name="btnedit" class="btn btn-success"> <i class="fa fa-edit"></i> Save Changes</button>
											              </div>
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
            <div class="footer-wrap pd-20 mb-20 card-box">
		

              <?php include('../inc/footer2.php');   ?> 
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

  <link rel="stylesheet" href="../Admin/popup_style.css">
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