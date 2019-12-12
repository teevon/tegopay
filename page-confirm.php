<?php
include "paystacks/connect.php";

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = test_input($_POST['name']);
  $email = test_input($_POST['email']);
  $phone = test_input($_POST['tel']);
  $amount = test_input($_POST['amount']);
  $amount = intval($amount);
  $amount = $amount * 100;
  $payment_ref = test_input($_POST['payment_ref']);
  $query = "INSERT INTO online_donations (donor_name, donor_id, transaction_ref, transaction_amount) VALUES ('$name','$email','$payment_ref',$amount)";
  $query_result = mysqli_connect($dbConn, $query);

if (!$query_result)
{
  header("Location: pay_error.php?msg='Database currently unavailable. Please try again later '&payment_ref=" . urlencode($payment_ref));
  } else {
    echo $name . "<br>";
    echo $email . "<br>";
    echo $phone . "<br>";
    echo $amount . "<br>";
  }

}
$url_pay_err = 'pay_error.php?msg=window-closed&payment_ref='. urlencode($payment_ref);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="">

    <title>Voice of Freedom Donations Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
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
      <!-- <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
            <li role="presentation" class="active"><a href="#">Home</a></li>
            <li role="presentation"><a href="#">About</a></li>
            <li role="presentation"><a href="#">Contact</a></li>
          </ul>
        </nav>
        <h3 class="text-muted"></h3>
      </div> -->

      <div class="jumbotron">
        <div class="row">
          <div class="col-md-4">
        <img border="0" src="images/tegopay.png" width="73" height="73"></div>
        <div class="col-md-8 ref"><p class="head"><font color="#333333"><b>Payment Ref: <?php echo $payment_ref; ?></b></font></p><br><b>Payment Date:</b> <?php echo date("D, F j, Y, g:i a"); ?></div>
      </div><hr>
        <!-- <h2>Online Payments</h1> -->
        <p class="small">Please verify that the transaction details are correct</p>
        <br>
        <form method="POST" action="https://api.paystack.co/transaction/initialize" role="form">
                <div class="form-group">
                  <label for="name1"><span class="required">*</span> Name</label>
                  <input type="text" name="name" class="form-control" id="name1" value="<?php echo $name; ?>"
                  readonly>
                </div>
                <div class="form-group">
                  <label for="email1"><span class="required">*</span> Email</label>
                  <input type="text" name="email" class="form-control" id="email1" value="<?php echo $email; ?>"
                  readonly/>
                </div>
                <div class="form-group">
                  <label for="tel1"><span class="required">*</span> Phone</label>
                  <input type="text" name="tel" class="form-control" id="tel1" value="<?php echo $phone; ?>"
                  readonly>
                </div>
                <div class="form-group">
                  <label for="payref1"> Payment Ref.</label>
                  <input type="text" name="payment_ref" class="form-control" id="payref1" value="<?php echo $payment_ref; ?>" readonly>
                </div>
                <div class="form-group">
                  <label for="amt1"> Amount</label>
                  <div class="input-group">
                  <span class="input-group-addon">₦</span>
                  <input type="text" name="amount" class="form-control" id="amt1" type="number" value="<?php echo $amount * 0.01 ; ?>" readonly/>
                </div>
              </div><br>
                <script src="https://js.paystack.co/v1/inline.js"></script>
                <div class="form-group center-block">
                <button type="button" onclick="payWithPaystack()" class="btn btn-success" name="B1">Pay &raquo;</button> <button type="button" class="btn btn-danger pull-right">&laquo; Go Back</button>
                </div>
              </form>
        <!-- <p><a class="btn btn-lg btn-success" href="#" role="button">Sign up today</a></p> -->
      </div>


      <footer class="footer">
        <p>tegopay</p>
      </footer>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script>
	function payWithPaystack(){
		var handler = PaystackPop.setup({
			key: 'pk_live_ee75abf1aa1441aad270734e10dc0cf428c0fb9',
			email: '<?php echo $email; ?>',
			amount: ' <?php echo $amount; ?>',
			ref: '<?php echo $payment_ref; ?>',
			metadata: {
				custom_fields: [
				   {
				   	 display_name: "Mobile Number",
				   	 variable_name: "mobile_number",
				   	 value: <?php echo $phone; ?>
				   }
				]
			},
			callback: function(response) {
				self.location="verify.php?payment_ref=<?php echo $payment_ref ;?>";
			},
			onClose: function(){
				//alert('window closed');
                                self.location="verify.php?payment_ref=<?php echo $payment_ref ;?>";
			}
		});
		handler.openIframe();
	}
</script>
  </body>
</html>
