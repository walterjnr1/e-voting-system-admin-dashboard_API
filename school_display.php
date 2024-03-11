<?php
include('inc/controller_new.php'); 

if(empty($_SESSION['school_id']))
    {   
      header("Location: index.php"); 
    }
    
$school_id = $_SESSION["school_id"];

//fetch selected school details
$stmt = $dbh->query("SELECT * FROM tblschools where ID='$school_id'");
$row_school = $stmt->fetch();

$selected_school_name=$row_school['name'];
$selected_school_logo=$row_school['logo'];
$_SESSION['selected_school_name'] =$row_school['name'];

$msg_error = "";

if(isset($_POST['btnlogin']))
{

$sql = "SELECT * FROM `tblstudents` WHERE `index_no`=?";
      $query = $dbh->prepare($sql);
      $query->execute(array($_POST['txtindexno']));
      $row = $query->rowCount();
      $fetch = $query->fetch();
      if($row > 0 && ($row_school['name'] == 'Mansen Senior High School' )) {
          $_SESSION['index_no'] = $fetch['index_no'];
    header("Location: start_pay.php"); 
          }else{ 
$msg_error=' Wrong Index Number or Wrong School Was selected';
}
}

?>


<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6 lt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7 lt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8 lt8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="UTF-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
        <title>Online Admission System</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Login and Registration Form with HTML5 and CSS3" />
        <meta name="keywords" content="html5, css3, form, switch, animation, :target, pseudo-class" />
        <meta name="author" content="Codrops" />
        <link rel="shortcut icon" href="image/logo.png"> 
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/style2.css" />
		<link rel="stylesheet" type="text/css" href="css/animate-custom.css" />
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $logo; ?>">
        <link rel="stylesheet" href="css/bootstrap.min.css">

        <style type="text/css">
<!--

.style1 {
	font-size: 36px;
	font-weight: bold;
}
.style2 {
	font-size: 24px;
	color: #FF0000;
}
.style4 {color: #000000}
.style9 {font-size: 18px}
#login {
  margin: 5em auto;
  width: 500px;
  height: 820px;
}
.style10 {
	color: #FF0000;
	font-weight: bold;
}
.style11 {color: #000000; font-weight: bold; }
-->
        </style>
</head>
    <body>
    <div class="container">
            <div align="center">
              <!-- Codrops top bar -->
            </div>
            <section>				
              <div id="container_demo" >
                  
                <p align="center"><a href="index.php" class="style11">Home</a> </p>
                <p align="center">
                  <?php if ($msg_error <> "") { ?>
         </p>
                <div class="alert alert-danger">
           <div align="center"><?php echo $msg_error ; ?>
           </div>
         </div>

         <div align="center">
  <?php } ?>
  </p>
         </div>
         <div id="wrapper">
             <div id="login" class="">
                 <form action="" method="post" autocomplete="on"> 
                     <h1 align="center"><img src="<?php echo $selected_school_logo; ?>" alt="logo" width="89" height="89"></h1>
                                <div align="center"><span class="style1"><?php echo $selected_school_name; ?>.                                </span> </div>
                     <p align="center" class="style2 style4">Online Admission </p>
                     <p align="center"><strong>Very Important Notice:</strong></p>
                     <p align="center"> 
                       Please ensure that you have printed your CSSPS PLACEMENT FORM. Your ENROLMENT CODE, which can be found on your Placement Form, would be REQUIRED by this system.
                     Your admission is NOT complete without your Enrolment Code.                                </p>
                     <p align="center"><strong>Admission instruction: </strong></p>
                     <p align="center"> Kindly Use your JHS Index number to log in to the system. </p>
                     <p align="center">Enter your B.E.C.E Index Number followed by the year. Eg (100000000024)</p>
                     <p align="center">
                       <input name="txtindexno" type="text" id="txtindexno" value="" placeholder="Enter JHS Index No Here" required/> 
                     </p>
                     <p align="center" class="login button"> 
                         <input type="submit" value="Login" name="btnlogin"/> 
				     </p>
                     <div>
                       <div>
                         
                         <p align="center" class="style4"><span class="button login style9"><strong>HELPLINE(S) : </strong></span></p>
                         <p align="center" class="style4">+233266059070</p>
                       </div>
                   </div>
                 </form>
           </div>
                </div>
                    <div align="center" class="style10">
                      <div align="center"><a href="index.php"></a></div>
                </div>
              </div>  
      </section>
    </div>

    
    </body>
</html>
