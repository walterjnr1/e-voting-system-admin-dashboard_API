<?php 
include('../inc/controller.php'); 
if(empty($_SESSION['login_index_no']))
    {   
      header("Location: ../login.php"); 
    }
?>
<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>Student Dashboard| <?php echo $schoolname;  ?></title>
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
.style4 {font-size: smaller; font-weight: bold; color: #FF0000; }
.style5 {font-size: smaller}
.style6 {
	font-size: 20px;
	color: #000000;
}
.style10 {color: #FF0000}
.style11 {
	color: #009966;
	font-size: 14;
}
.style12 {
	font-size: 16px;
	font-weight: bold;
}
.style14 {font-size: 14px; font-weight: bold; }
.style15 {font-size: 14px; }
-->
    </style>
</head>
<body>
	
<?php include('header.php'); ?>

<?php include('sidebar.php'); ?>
	<div class="mobile-menu-overlay"></div>

	<div class="main-container">


<div class="footer-wrap pd-20 mb-20 card-box">	  
  <p class="style6 style12"><span class="pd-20"><?php echo $fullname_student;?>,</span>CONGRATULATION ON YOUR ADMISSION TO <?php echo $schoolname ; ?>,<?php echo $programme ; ?> PROGRAMME.</p>
  <p>YOUR PLACEMENT DETAIL (<?php echo $current_session ; ?>) </p>
  <p>START YOUR ADMISSION (Click on the button below)</p>
  <p><span class="style4">Please note that you are required to download the following:</span></p>
  <p class="style5">1. A picture of your enrollment form from cssps</p>
  
      <button type="submit" name="btnpay" class="btn btn-success" ><i class="fa fa-edit"></i> Complete Personal Record Form        </button>
      <p>&nbsp;</p>
      <p><img src="../<?php echo $photo ; ?>" alt="student image" width="118" height="104"></p>
      <p>&nbsp;</p>
      <table width="897" align="center" cellspacing="15">
        <tr>
          <td width="410"><div align="left" class="style14">FULLNAME</div></td>
          <td width="451"><div align="left" class="style15"><?php echo $fullname_student ; ?></div></td>
        </tr>
        <tr>
          <td><div align="left" class="style15"><strong>INDEX NO</strong></div></td>
          <td><div align="left" class="style15"><?php echo $index_no ; ?></div></td>
        </tr>
        <tr>
          <td><div align="left" class="style15"><strong>GENDER</strong></div></td>
          <td><div align="left" class="style15"><?php echo $sex ; ?></div></td>
        </tr>
        <tr>
          <td height="29"><div align="left" class="style15"><strong>PROGRAMME</strong></div></td>
          <td><div align="left" class="style15"><?php echo $programme ; ?></div></td>
        </tr>
        <tr>
          <td><div align="left" class="style15"><strong>CLASS</strong></div></td>
          <td><div align="left" class="style15"><?php echo $class ; ?></div></td>
        </tr>
        <tr>
          <td><div align="left" class="style15"><strong>BOARDING STATUS</strong> </div></td>
          <td><div align="left" class="style15"><?php echo $state ; ?></div></td>
        </tr>
        <tr>
          <td><div align="left" class="style15"><strong>HOUSE</strong></div></td>
          <td><div align="left" class="style15"><?php echo $boarding_status ; ?></div></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <form method="post" id="dataform" action="personalRecordForm.php">

          <td><button type="submit" name="btnpay" class="btn btn-success" ><i class="fa fa-edit"></i> Edit Personal Record </button></td>
                </tr>
        </form>
      </table>
      <p>&nbsp;</p>
      <p>Documents for Download (Please DOWNLOAD and print all documents) </p>
      <p align="left"><td><a href="download_prospectus.php"><button type="submit" name="btndownload_prospectus" class="btn btn-primary" ><i class="fa fa-download"></i> Prospectus </button> </a></td></p>
      <p align="left"><td><a href="../Downloads/admissionletter.php" target="_blank"><button type="submit" name="btndownload_admissionLetter" class="btn btn-primary" ><i class="fa fa-download"></i> Admission Letter </button> </a></td></p>
      <p align="left"><td><a href="download_personalrecordform.php"><button type="submit" name="btndownload_personalrecordform" class="btn btn-primary" ><i class="fa fa-download"></i> Personal Record Form</button></a></td> </p>
      <p align="left" class="style10">You are expected to come along with on the reporting date:</p>
      <p align="left" class="style11">1. PRINTED COPY OF THE PERSONAL RECORD AND DECLARATION FORM</p>
      <p align="left" class="style11">2. FULLY FILED PLACEMENT FORMS</p>
      <p align="left" class="style11">3. A COPY OF YOUR BECE RESULT SLIP</p>
      <p align="left" class="style11">4. BIRTH CERTIFICATE (PHOTOCOPY)</p>
      <p align="left" class="style10">Your admission is NOT complete without the following </p>
      <p>&nbsp;</p>
      </div>
  <p class="style5">&nbsp;</p>
  <p class="style5"></p><?php include('../inc/footer2.php');   ?> </p>
  <p>&nbsp;</p>
			  <p>&nbsp;</p>
</div>
	  </div>
	</div>
	<!-- js -->
	<script src="vendors/scripts/core.js"></script>
	<script src="vendors/scripts/script.min.js"></script>
	<script src="vendors/scripts/process.js"></script>
	<script src="vendors/scripts/layout-settings.js"></script>
	<script src="src/plugins/apexcharts/apexcharts.min.js"></script>
	<script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
	<script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
	<script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
	<script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
	<script src="vendors/scripts/dashboard.js"></script>




	
</body>
</html>