<?php
include('inc/controller_new.php'); 

if(empty($_SESSION['admission_fee']))
    {   
      header("Location: start_pay.php"); 
    }

    ?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from verify.waeconline.org.ng/BuyPIN by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 16 Nov 2023 15:20:28 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack --><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Fee Payment Successful</title>
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
                        <div class="card-header d-flex flex-wrap">
                 
                                                        <h6 class="mr-auto"><strong>  Your online admission processing fee Payment Was Successful</strong></h6>
                        </div>
                        <div class="card-body">
                    

                        <form action="login.php" method="POST">
                            
                          
                            
                            
                            <div class="row">
                              <div class="offset-md-4 col-md-4">
                                    <div class="form-group">
                                        <button type="submit" name="btncontinue" class="btn btn-success" >Continue</button>
                     
                                    </div>
							  </div>
                            </div>
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

<!-- Mirrored from verify.waeconline.org.ng/BuyPIN by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 16 Nov 2023 15:20:35 GMT -->
</html>