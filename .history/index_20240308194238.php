<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
require 'inc/controller_new.php'; 

if(isset($_POST["btnproceed"]))
{
$_SESSION['school_id']= $_POST['cmdschool'];
header("Location: school_display.php"); 

}
if(isset($_POST["btnsend"]))
{

    $msg= $_POST['txtmessage'];
    $subject= $_POST['txtsubject'];
    $email= $_POST['txtemail'];

    
     //send compliant via email
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
        $mail->setFrom($email, 'Mansen New Student');
        $mail->addAddress($email_website,$schoolname);     //Add a recipient
     
         $message = "
         <html>
         <head>
         <title>Complaint |'.$subject.'</title>
         </head>
         <body>
    
         <p><h4>Title : </h4> ".$subject."</p>
                               
         <p><h4>Message : </h4> ".$msg."</p>  
               
         </body>
         </html>
         ";
     
         //Content
         $mail->isHTML(true);                                  //Set email format to HTML
         $mail->Subject = ''.$subject.'  |'.$schoolname.'';
         $mail->Body    = $message;
     
         $mail->send();
     if(!$mail) {   
        $_SESSION['error'] = "There Was problem Sending Message...";
    
    }else { 
        
        $_SESSION['success'] = "Your Message has been Recieved Successfully";
    }


}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> Home - Mansen Online Admission System</title>


    <meta charset="utf-8" />
    <title>Mansen Online Admission System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="P" />
    <meta name="keywords" content="" />
    <meta content="" name="author" />

    <!-- Pixeden Icon -->
    <link rel="stylesheet" type="text/css" href="css/pe-icon-7.css" />

    <!--Slider-->
    <link rel="stylesheet" href="css/owl.carousel.min.css" />
    <link rel="stylesheet" href="css/owl.theme.default.min.css" />

    <!-- css -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="css/materialdesignicons.min.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $logo; ?>">
        <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/toastr.css">

        <style type="text/css">
<!--
.style9 {font-size: x-large}
.style11 {font-size: small; color: #FF0000; }
-->
        </style>
</head>
<body style="height:100vh;" class="d-flex flex-column">
    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="sk-chase">
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
            </div>
        </div>
    </div>

    <!--Navbar Start-->
    <nav class="navbar navbar-expand-lg fixed-top navbar-custom sticky sticky-dark nav-light">
        <div class="container">
            <!-- LOGO -->
            <a class="navbar-brand logo" href="index.html">
                <img src="image/logo.png" alt="" class="logo-dark" height="51">
                <img src="image/logo.png" alt="" class="logo-light" height="81">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <i class="mdi mdi-menu"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav ml-auto navbar-center" id="mySidenav">
                    <li class="nav-item active">
                        <a href="#home" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item active">
                        <a href="student_login.php" class="nav-link">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a href="#contact" class="nav-link">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://mansenshs.com/">Visit mansen shs</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->
    


<!-- Hero Start -->


<section class="hero-7-bg position-relative bg-gradient-primary" id="home">
    <div class="hero-7-bg-overlay"></div>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="hero-title">
                    <h1 class="hero-7-title">
                        <span class="text-wrapper">
                            <span class="text-light font-weight-normal style9">Welcome to SHS online admission system </span>                        </span>                    </h1>
                    <p class="text-light-70 mb-4 pb-2">
                        This is a SHS online admission system designed by Mansen IT Team. Use this portal to process your admission into your prefered senior High school. You can use this portal to check and submit your placement documents, print your admission letter, prospectus, and medical documents, 
                        among other things. ONLY REPORT TO SCHOOL WHEN SCHOOL REOPENS...<br />
                    </p>
                </div>
            </div>

            <div class="col-lg-5 offset-lg-1">
                <div class="hero-login-form mx-auto p-4 rounded mt-5 mt-lg-0 bg-white">
                    <div class="text-center">
                        <h3 class="form-title mb-4">SELECT YOUR SCHOOL</h3>
<h5 class="form-title mb-4">(Schools are alphabetically sorted)</h5>
</div>
                    <form class="registration-form" id="registration-form" action="" method="POST">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-4">
                                    <label for="referencePIN" class="f-15">Schools</label>
                                
                                    <?php
			      $sql = "select * from tblschools order by name desc";
             $school = $dbh->query($sql);                       
             $school->setFetchMode(PDO::FETCH_ASSOC);
             echo '<select name="cmdschool"  id="cmdschool" class="form-control" required>';
			  echo '<option value="">Select Your School</option>';
             while ( $row = $school->fetch() ) 
             {
                echo '<option value="'.$row['ID'].'">'.$row['name'].'</option>';
             }

             echo '</select>';
			     ?>                                 
                                
                                    </div>
                            </div>
                        </div>
 
                        <div class="d-flex flex-wrap">
        <button type="submit" name="btnproceed" class="btn btn-primary btn-sm">Proceed Now</button>
       
            </div>
            <div id='spacer' style="height: 50px;"></div>

        <h5 align="center" class="style11">If your school is not listed,please visit your school premises for the admission process
          or contact your school directly to inquire about their admission procedures.
          Thank you.</h5>
        <p align="center" class="text-black"><strong> No. of Schools: <?php echo $count_schools; ?> </strong></p>
                    
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="hero-bottom-img">

                <div class="container position-absolute" style="
    top: -80px;
    right: 0;
    left: 0;
">
                  
                </div>
                <img src="image/hero-7-shape-light.png" alt="" class="img-fluid shape-light mx-auto">
                <img src="image/hero-7-shape-dark.png" alt="" class="img-fluid shape-dark mx-auto">
            </div>
        </div>
    </div>
</section>
<!-- Hero End -->

<!-- contact Us Start -->
<section class="section" id="contact">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="text-center mb-5">
                    <h4 class="text-uppercase mb-0">CONTACT US</h4>
                    <div class="my-3">
                        <img src="image/title-border.png" alt="" class="img-fluid mx-auto d-block">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="contact-address">
                    <span class="text-black">CONTACT INFO                    </span>
                    <h4 class="title mb-0 text-black">Mansen IT team</h4>
                    <p class="text-muted mb-3 f-15 text-black">
                       xxxxxxxxx                    </p>
                    <p class="text-muted f-15 mb-3 text-black">
                        Tel: +233266059070                    </p>
                    <p class="text-muted f-15"><span class="text-black">
                      e-mail: codethriveiconsult@gmail.com<br />
                      infor@mansenshs.com</span><br />
                  </p>
              </div>
            </div>

            <div class="col-lg-5 offset-lg-1 card">
                <div class="card-body">
                    <div class="custom-form mt-4 mt-lg-0">
                        <div id="message"></div>
                        <form method="post" name="contactForm" id="contactForm" action="">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group app-label">
                                        <label for="email">Email address</label>
                                        <input name="txtemail" id="txtemail" type="email" class="form-control" placeholder="Enter your email.." value="" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group app-label">
                                        <label for="subject">Subject</label>
                                        <input type="text" name="txtsubject" class="form-control" id="txtsubject" placeholder="Enter Subject.." value="" required/>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group app-label">
                                        <label for="details">Message</label>
                                        <textarea name="txtmessage" id="txtsubject" rows="3" class="form-control" placeholder="Enter message.." required>
</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <button type="submit" id="submit" name="btnsend" class="btn btn-primary">Send Message <i class="mdi mdi-telegram ml-2"></i></button>
                                    <div id="simple-msg"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- contact Us End -->

    <!-- Footer Start -->
    <section class="footer pt-0 mt-auto">
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
    <!-- Footer End -->
    <!-- javascript -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.easing.min.js"></script>
    <!-- anime -->
    <script src="js/anime.min.js"></script>
    <!-- COUNTER -->
    <!-- carousel -->
    <script src="js/owl.carousel.min.js"></script>
    <!-- Main Js -->
    <script src="js/app.js"></script>
    
    <script src="js/site.js"></script>
    <script src="js/general.js"></script>
    <script src="app-assets/vendors/js/toastr.min.js" type="text/javascript"></script>
    <script src="lib/jquery-validation/dist/jquery.validate.js"></script>
    <script src="../www.google.com/recaptcha/api6979.js?render=6Lf3z9wUAAAAAPTC6tPRnbU73Vnq_OGvNHzEgFxi"></script>   
    
    
    
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
