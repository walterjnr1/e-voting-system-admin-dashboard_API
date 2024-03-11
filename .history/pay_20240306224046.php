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
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fee Payment</title>
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
                            <a href="index.php" style="z-index: 3;" class="btn p-2 btn-outline-primary mr-auto d-inline-flex align-items-center"><i class="fas fa-home fa-2x" title="home"></i></a>
                            <h2 class="mr-auto">   Payment Details</h2>
                            <div class="ml-auto"></div>
                            <p><h6 class="mr-auto">   You will be Charged GHS <?php echo number_format((float) $_SESSION['admission_fee'] ,2); ?> from Paystack</h6></p>
                            
                        </div>
                        <div class="card-body">
                    

                        <form action="" method="POST" form id="paymentForm">
                            <div class="row">
                            <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="telephone" name="txtphone" class="form-control name" id="txtphone" value="" placeholder="SMS Phone" data-val="true" data-val-required="The Phone No field is required." required/>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <input type="email" class="form-control" name="txtemail" id="txtemail" value="" placeholder="Email Address" data-val="true" data-val-required="The Email field is required." required/>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" name="txtindexno" class="form-control name" id="txtindexno" value="<?php echo $_SESSION['index_no']  ?>" placeholder="BECE Index #" data-val="true" readonly/>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="row">
                              <div class="offset-md-4 col-md-4">
                                    <div class="form-group">
                                        <button type="submit" name="btnpay" class="btn btn-success" onClick="payPageWithPaystack()">Pay Now</button>
                     
                                    </div>
								  <img src="image/paystack-logo.svg" alt="paystack-logo" width="153" height="89">                                </div>
                            </div>
                    </form>
                    <p>     <input type="hidden" id="hidden_publickey" name="hidden_publickey" value="<?php echo $publickey; ?>"> </p>

                    <script src="https://js.paystack.co/v1/inline.js"></script>
				  <script>
const paymentForm = document.getElementById('paymentForm');
paymentForm.addEventListener("submit", payWithPaystack, false);

function payWithPaystack(e) {
  e.preventDefault();

  let handler = PaystackPop.setup({
    key: document.getElementById("hidden_publickey").value, // Replace with your public key
    email: document.getElementById("txtemail").value,
    amount: document.getElementById("hidden_amt").value * 100,
    currency: 'NGN', // Use GHS for Ghana Cedis or USD for US Dollars

    ref: 'shs'+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
    // label: "Optional string that replaces customer email"
    onClose: function(){
        window.location="http://localhost/mansen_school/pay.php?transaction=Cancelled";
      alert('Transaction Cancelled.');
    },
       callback: function(response){
      let message = 'Payment complete! Reference: ' + response.reference + ' . Kindly save the reference ID for future use.';
      alert(message);
window.location="http://localhost/mansen_school/verify_pay.php?amt="+encodeURIComponent(document.getElementById("hidden_amt").value)+"&email=" +encodeURIComponent(document.getElementById("txtemail").value)+"&indexno=" +encodeURIComponent(document.getElementById("txtindexno").value)+"&phone=" +encodeURIComponent(document.getElementById("txtphone").value)+"&reference=" + response.reference    }
  });

  handler.openIframe();
}
    </script> 
							 <p>     <input type="hidden" id="hidden_amt" name="hidden_amt" value="<?php echo $_SESSION['admission_fee']; ?>"> </p>

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