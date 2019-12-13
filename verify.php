<?php
include 'connect.php';
$payment_ref = $_GET['payment_ref']; 
$result = array();
$url = 'https://api.paystack.co/transaction/verify/'.$payment_ref;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt(
  $ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer sk_test_c6fe0f879e3867b1d20a9357d87211007e2c4ea9']
);
$request = curl_exec($ch);
curl_close($ch);

if ($request) {
  $result = json_decode($request, true);
}

$result_message = $result[message];
$result_status = $result[status];
$result_data_amount = $result[data][amount];
$result_data_currency = $result[data][currency];
$result_data_transaction_date = $result[data][transaction_date];
$result_data_status = $result[data][status];
$result_data_reference = $result[data][reference];
$result_data_gateway_response = $result[data][gateway_response];

//echo $payment_ref;
//echo $result_message;


$sql_upd = "UPDATE online_payments SET trans_response = '$result_data_gateway_response' , 
trans_status = '$result_data_status',
ps_message = '$result_message', 
ps_status = '$result_status', 
ps_data_amount = '$result_data_amount', 
ps_data_currency = '$result_data_currency', 
ps_data_transaction_date = '$result_data_transaction_date', 
ps_data_status = '$result_data_status', 
ps_data_reference = '$result_data_reference', 
ps_data_gateway_response = '$result_data_gateway_response'
 WHERE trans_ref = '$payment_ref'";
 $update_txn_result = mysqli_query($dbConn, $sql_upd);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

	<title>Tegopay Verification Page</title>
	<link href="css/bootstrap.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Raleway" rel="stylesheet"> 
    <link href="css/narrow.css" rel="stylesheet">

<style>
body{font-family: 'Open Sans', sans-serif;}
.head{font-family: 'Raleway', sans-serif;
line-height: 26px;}
</style>
</head>


<body>

<div class="container">
	<div class="jumbotron">
		<div class="row">
          <div class="col-md-4">
        <img border="0" src="images/tegopay.png" width="73" height="73"></div>
        <div class="col-md-8 ref"><p class="head"><font color="#333333"><b>Payment Ref: <?php echo $payment_ref; ?></b></font></p></div>
      </div><hr>
      <div class="row">
        <div class="col-md-12">
          <p>VERIFICATION STATUS</p>
          
         <?php 

          $verify_msg = '';
            if ($result_data_status == "success") {
	     $verify_msg = "Payment with transaction reference ". $payment_ref . " was completed successfully";
             echo "<div class='alert alert-success' role='alert'> $verify_msg </div>";
          } else {
	     $verify_msg = "Payment with transaction reference " . $payment_ref . " failed";
             echo "<div class='alert alert-danger' role='alert'> $verify_msg </div>";
          }

          
          
          //if($sql_upd) {
          //   echo "<br> <span class='text-success'>Paystack records succesfully stored </span>";
          //} else {
          //   header('Location: pay_error.php?msg=Database unavailable. Please try again later');
          //}
          // ?>


<br>
<p style="font-size: 14px;">If your payment was successful, you will receive an email shortly containing the details of your payment. However, if your payment failed, or you want to make another payment, kindly click on the button below. </p><br><br>
<a href="index.php" class="btn btn-success">Make another payment or try again</a><br><br>
        </div>
      </div>
	</div>

	<footer class="footer">
        <p></p>
    </footer>
</div>

</body>
</html>