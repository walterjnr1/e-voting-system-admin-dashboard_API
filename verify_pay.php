<?php
include('inc/controller_new.php'); 

if ($ref ="") {
header("Location:javascript://history.go(-1)");
}

  $curl = curl_init();
  
  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.paystack.co/transaction/verify/". rawurlencode($ref),
        CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
      "Authorization: Bearer {$secretkey}",
      "Cache-Control: no-cache",
    ),
  ));
  
  $response = curl_exec($curl);

  curl_close($curl);
  //echo $response;
      $json_output = json_decode($response, true);

   $email = $_GET['email'];
   $ref = $_GET['reference'];
   $amt = $_GET['amt'];
   $indexno = $_GET['indexno'];
   $phone = $_GET['phone'];





  //save payment details
    $sql = 'INSERT INTO tblpayment(referenceID,index_no,amount,phone,email,school,payment_date) VALUES(:referenceID,:index_no,:amount,:phone,:email,:school,:payment_date)';
    $statement = $dbh->prepare($sql);
    $statement->execute([
        ':referenceID'   => $ref,
        ':index_no'   => $indexno,
        ':amount'   => $amt,
        ':phone'   => $phone,
         ':email'   => $email,
         ':school'   => strtolower($schoolname),
         ':payment_date'   => $current_date

        ]);

//update student status
$sql_status = " update tblstudents set status='1' where index_no='$indexno'";
if (mysqli_query($conn, $sql_status)) {
 header("Location: pay_success.php");
}
?>