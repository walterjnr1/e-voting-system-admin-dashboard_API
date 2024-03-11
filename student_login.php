<?php
include('inc/controller_new.php'); 


$msg_error = "";
if(isset($_POST['btnlogin']))
{

    $sql = "SELECT * FROM `tblstudents` WHERE `index_no`=? and `status`=?";
    $query = $dbh->prepare($sql);
    $query->execute(array($_POST['txtindexno'],'1'));
    $row = $query->rowCount();
    $fetch = $query->fetch();
    if($row > 0) {
    $_SESSION['login_index_no'] = $fetch['index_no'];
   
   
    $task= $_SESSION['login_index_no'].' '.'logged in'.' '. 'On' . ' '.$current_date;
    $sql = 'INSERT INTO activity_log(task) VALUES(:task)';
    $statement = $dbh->prepare($sql);
    $statement->execute([
    ':task' => $task
    ]);
    header("Location: Student/index.php"); 
}else{ 
$_SESSION['error']=' Wrong Index Number or have not paid his Admission Fee';
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login System - Mansen Online Admission System</title>
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
                        <img class="logo-size card-img-top w-auto" src="../image/logo.png" height="100" alt="">
                        <div class="card-header d-flex flex-wrap">
                            <a href="index.php" style="z-index: 3;" class="btn p-2 btn-outline-primary mr-auto d-inline-flex align-items-center"><i class="fas fa-home fa-2x" title="home"></i></a><h4 class="mr-auto">LOGIN FORM</h4>
                            <div class="ml-auto"></div>
                        </div>
                        <div class="card-body">
                        <form method="post" id="BuyPIN" action="">
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <input type="text" name="txtindexno" class="form-control name" id="txtindexno" value="" placeholder="Enter Index No" data-val="true" data-val-required="The Surname field is required." />
                                    </div>
                                </div>
                                
                            </div>
                          
                            <div class="row">
                                <div class="offset-md-4 col-md-4">
                                    <div class="form-group">
                                        <button type="submit" name="btnlogin" class="btn btn-secondary">Login</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="footer pt-0 mt-auto bg-dark">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center footer-alt my-1">
                        <p class="f-15">
                        <?php include('inc/footer.php');?>

                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <script src="js/jquery.min.js" type="text/javascript"></script>
    <script src="js/popper.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <script src="lib/jquery-validation/dist/jquery.validate.js"></script>
    <script src="plugin/TelPlugin/build/js/intlTelInput.min.js"></script>
    <script src="plugin/TelPlugin/build/js/intlTelInput-jquery.min.js"></script>
    <script src="app-assets/vendors/js/switchery.min.js" type="text/javascript"></script>
    <script src="app-assets/js/switch.min.js" type="text/javascript"></script>
    <script src="js/buyPIN.js"></script>


    <link rel="stylesheet" href="Admin/popup_style.css">
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