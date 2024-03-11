<?php
include('inc/controller_new.php'); 
if(empty($_SESSION['index_no']))
    {   
      header("Location: index.php"); 
    }
    
$index_no = $_SESSION["index_no"];

//fetch student details
$stmt = $dbh->query("SELECT * FROM tblstudents where index_no='$index_no'");
$row_school = $stmt->fetch();
$fullname=$row_school['fullname'];

$admission_fee=$_SESSION['admission_fee'];

if(isset($_POST['btnpay']))
{
    header("Location: pay.php"); 

}

?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from verify.waeconline.org.ng/BuyPIN by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 16 Nov 2023 15:20:28 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<style type="text/css">
<!--
.style1 {color: #000000}
-->
</style>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Admisssion Proceesing Payment</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="css/iofrm-style.css">
    <link rel="stylesheet" type="text/css" href="css/iofrm-theme13.css">
    <link href="plugin/TelPlugin/build/css/intlTelInput.css" rel="stylesheet" />
    <link href="app-assets/vendors/css/switchery.min.css" rel="stylesheet" />
    <link href="css/auth.css" rel="stylesheet" />
    <link href="css/singlesided.css" rel="stylesheet" />
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $logo; ?>">
</head>
<body style="height:100vh;overflow-y:auto;" class="d-flex flex-column">
    <div class="form-body">
        <div class="row">
            <div class="form-holder">
                <div class="aa"></div>
                <div class="bb"></div>
              <div class="form-content">
                <div class="form-items card" style="z-index:100">
                  <div class="card-header d-flex flex-wrap"> <a href="index.php" style="z-index: 3;" class="btn p-2 btn-outline-primary mr-auto d-inline-flex align-items-center"><i class="fas fa-home fa-2x" title="home"></i></a>
                      <h3 class="mr-auto">Online Admission Processing Fee Payment</h3>
                    <div class="ml-auto"></div>
                  </div>
                  <div class="card-body">
                    <form method="post" id="BuyPIN" action="">
                      <div class="row">
                        <div class="col-lg-6 col-md-12">
                          <div class="form-group"></div>
                        </div>
                      </div>
                      <div class="row"></div>
                      <div class="row"></div>
                      <div class="row">
                        <div class="col-lg-12 col-md-12 form-group mb-2" style="color:#000000">
                          <p class="style3 style1"><strong>Hi <?php echo $fullname;  ?>,</strong></p>
                          <p class="style3">You have Placement in this school and your are required to pay processing fee for the use of this system before you proceed to the next stages. </p>
                        </div>
                      </div>
                      <div class="row" align="center">
                        <div class="offset-md-2 col-md-3" >
                          <div class="form-group" >
                            <button type="submit" name="btnpay" class="btn btn-success">
                            <div align="center">Start Payment  (GHS <?php echo number_format((float) $admission_fee ,2); ?>)</div>
                            </button>
                          </div>
                        </div>
                      </div>
                      <p class="style2">                
                      <a href="login.php"><h6 class="mr-auto">Click here if you have already pay and have your reference Code .(Check your Phone or Email Address for reference code) . </h6></a>
                      <p></p>
                    </form>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
     <!-- Footer Start -->
     <section class="footer pt-0 mt-auto bg-dark">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center footer-alt my-1">
                        <p class="f-15">
                        <?php include('inc/footer.php');?>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer End -->
    <!-- Modal -->
    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title mt-1" id="myModalLabel2">Terms and condition</h4>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <ul class="list-group">
                            <li class="list-group-item">Results are available from 1980 to date </li>
                            <li class="list-group-item">Passports are not available for results earlier than 1999 </li>
                            <li class="list-group-item">Some results may not have passport from 1999 to 2011 </li>
                            <li class="list-group-item">The fact that there are no passport for a result does not invalidate it </li>
                        </ul>
                    </div>
                </div>
                <div class="card-footer">
                    <form id="agreement_form">
                        <input style="visibility:hidden" type="checkbox" id="agreebox" name="agreebox" checked />
                        <button class="btn btn-success" type="submit">I agree</button>
                        <button class="btn btn-danger" type="button" data-dismiss="modal">I disagree</button>
                    </form>
                </div>
            </div><!-- modal-content -->

        </div><!-- modal-dialog -->
    </div>
    <!-- modal -->
    <script src="js/jquery.min.js" type="text/javascript"></script>
    <script src="js/popper.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <script src="lib/jquery-validation/dist/jquery.validate.js"></script>
    <script src="plugin/TelPlugin/build/js/intlTelInput.min.js"></script>
    <script src="plugin/TelPlugin/build/js/intlTelInput-jquery.min.js"></script>
    <script src="app-assets/vendors/js/switchery.min.js" type="text/javascript"></script>
    <script src="app-assets/js/switch.min.js" type="text/javascript"></script>
    <script src="js/buyPIN.js"></script>

</body>
</html>