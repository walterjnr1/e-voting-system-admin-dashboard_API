<?php
//session_start();
include('../inc/controller.php');
// Include the QR code library
include('../phpqrcode/qrlib.php');

if(empty($_SESSION['login_index_no'])) {
  header("Location: ../login.php");
}

//generate qr image
// Define the data to be encoded in the QR code
$qrdata = $headmaster . ' - ' . $schoolname. ' - ' .$index_no;
QRcode::png($qrdata, '../uploadImage/QrImage/'.$enrollment_code.'.png', QR_ECLEVEL_L, 4);
$file = '../uploadImage/QrImage/'.$enrollment_code.'.png';

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $fullname_student;  ?>| Admission Letter | <?php echo $schoolname;  ?></title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="16x16" href="../<?php echo $logo; ?>">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript">
        $("#btnPrint").live("click", function () {
            var divContents = $("#dvContainer").html();
            var printWindow = window.open('', '', 'height=400,width=800');
            printWindow.document.write('<html><head><title>DIV Contents</title>');
            printWindow.document.write('</head><body >');
            printWindow.document.write(document.body);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        });
    </script>
 
   
    <style>
        table {
            border-collapse: collapse;
        }

        .style3 {
            font-weight: bold;
            color: #000000;
            font-size: xx-large;
        }

        hr {
            display: block;
            height: 1px;
            border: 3;
            border-top: 1px solid #008000;
            margin: 1em 0;
            padding: 0;
        }

        .style7 {
            font-size: large;
            color: #000000;
        }

        .style11 {
            font-size: 18
        }

        .style12 {
            font-size: 16px;
            font-family: Geneva, Arial, Helvetica, sans-serif;
            color: #000000;
        }

        
    </style>
</head>

<body>
  
<p>&nbsp;</p>
<table width="600" height="500" align="center">
  <tr>
    <td width="570" height="500"><table width="931" height="1291">
      <tr>
        <td width="923" height="56"><p align="center" class="style3"><?php echo $schoolname;  ?></p>
          <p align="center" class="style3 style7">(GHANA EDUCATION SERVICE) </p>
          <table width="910" height="172" border="0" align="center">
            <tr>
              <td width="323" height="168">
            				<p style="margin : 0; padding-top:0;">HeadMaster</p>
<p style="margin : 0; padding-top:0;">Our Ref No. GED/MANSEN/<?php echo date("Y"); ?>/<?php echo rand(10, 99); ?></p>
<p style="margin : 0; padding-top:0;">Your Ref No. ..........................</p>
<p style="margin : 0; padding-top:0;">Phone <?php echo $phone;  ?></p>
<p style="margin : 0; padding-top:0;">Email: <?php echo strtolower($email);  ?></p>
	</td>
				
<td width="229"><div align="center"><img src="../<?php echo $logo;  ?>" alt="logo" width="115" height="114"></div></td>
<td width="304">
	<p style="margin : 0; padding-top:0;">Tel : <?php echo $phone_website;  ?></p>
<p style="margin : 0; padding-top:0;">P.O. Box : <?php echo $box;  ?>,<?php echo $state;  ?></p>
<p style="margin : 0; padding-top:0;"><?php echo $current_date;  ?> </p>
		
				</td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td height="74"><h5 align="left" class="style12">Dear Student,</h5>
          <h5 align="center" class="text-black" >OFFER OF  ADMISSION INTO <?php echo $schoolname;  ?> - <?php echo $current_session;  ?> ACADEMIC YEAR </h5></td>
      </tr>
      <tr>
        <td height="131"><table width="923" height="235" border="0">
          <tr>
            <td width="762" height="231"><p align="left" class="f-18">&nbsp;</p>
             
<p align="left" style="margin : 0; padding-top:0;"><span class="f-18"><span class="style11"><span class="text-black"><strong>ENROLLMENT CODE </strong>:<?php echo $enrollment_code;  ?> </span></span></span></p>
<p align="left" class="f-18 style11 text-black" style="margin : 0; padding-top:0;"><strong>NAME OF CANDIDATE :</strong> <?php echo $fullname_student;  ?></p>
<p align="left" class="f-18 style11 text-black" style="margin : 0; padding-top:0;"><strong>RESIDENCE STATUS :</strong> <?php echo $boarding_status;  ?></p>
<p align="left" class="f-18 style11 text-black" style="margin : 0; padding-top:0;"><strong>PROGRAMME STATUS :</strong> <?php echo $programme;  ?></p>
<p align="left" class="f-18 style11 text-black" style="margin : 0; padding-top:0;"><strong>HOUSE </strong>:     <?php echo $house;  ?></p>
            <td width="147"><img src="../<?php echo $photo;  ?>" alt="student picture" width="116" height="114" border="3"></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><p class="f-18 text-black f-18 f-18 text-black">I am pleased to inform you that you have been offered a place at <?php echo $schoolname;  ?> to pursue a 3 year pre-Tertiary programme leading to the West Africa Senior School certificate Examination.</p>
          <ol>
            <li class="f-18 f-18 f-18 f-18 f-18 text-black"> The reporting date for all first year student is on <strong><?php echo $reportdate;  ?></strong> at 09:00 Am .</li>
            <li class="f-18 f-18 f-18 f-18 f-18 text-black">you ward will be required to adhere religiously to all school rules and regulations as a students.</li>
            <li class="f-18 f-18 f-18 f-18 f-18 text-black">All students of the school are considered to be on probation through out their stay in the school and could be withdrawn/dismissed at anytime for gross misconduct or poor academic performance.</li>
            <li class="f-18 f-18 f-18 f-18 f-18 text-black">On the reporting day, you are to submit a printed copy of this admission letter to the senior house master/mistress for registration and other admission formalities.</li>
            <li class="f-18 f-18 f-18 f-18 f-18 text-black">All student are expected to deposit a photocopy of Health insurance card with the Senior Housemaster/HouseMistress.</li>
            <li class="f-18 f-18 f-18 f-18 f-18 text-black">All covid-19 protocols would be strictly adhered to.</li>
            <li class="f-18 f-18 f-18 text-black">Please accept our congratulations. </li>
          </ol></td>
      </tr>
      <tr>
        <td height="128"><table width="914" height="244" border="0">
          <tr>
            <td width="593" height="114"><p class="f-18">&nbsp;</p>
                <p class="f-14">&nbsp;</p></td>
            <td width="314"><img src="<?php echo $file; ?>" alt="student qrimage" width="115" height="101" border="3"></td>
          </tr>
          <tr>
            <td height="124"><p class="f-14"><a href="#" id="print-button" onClick="window.print();return false;">Print </a></p>
              </td>
            <td><p class="f-14"><span class="text-black"><strong>Yours Faithfully,</strong></span></p>
                <p class="f-14"><em>digitally signed and secured in Qr code </em></p>
              <p class="f-14 text-black"><strong><?php echo $headmaster;  ?>  (Headmater)</strong></p></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
