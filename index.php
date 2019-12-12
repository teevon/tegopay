<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Tegogo Payment Page</title>
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
        <div class="col-md-8 ref"><p class="head"><font color="#333333"><b>Payment Ref: <?php $trans_code = rand().rand(); echo $trans_code; ?></b></font></p><br><b>Payment Date:</b> <?php echo date("D, F j, Y, g:i a"); ?></div>
      </div><hr>
        <!-- <h2>Online Payments</h1> -->
        <p class="small">Make your payments to Tegogo using this payment portal. Please make a note of your payment reference for this transaction.</p>
        <br>
        <form method="POST" action="create_pay.php" role="form">
                <div class="form-group">
                  <label for="name1"><span class="required">*</span> Name</label>
                  <input type="text" name="name" class="form-control" id="name1" placeholder="Enter your name">
                </div>
                <div class="form-group">
                  <label for="email1"><span class="required">*</span> Email</label>
                  <input type="text" name="email" class="form-control" id="email1" placeholder="Enter your email address" type="email" required/>
                </div>
                <div class="form-group">
                  <label for="tel1"><span class="required">*</span> Phone</label>
                  <input type="text" name="tel" class="form-control" id="tel1" placeholder="Enter your phone number">
                </div>
                <div class="form-group">
                  <label for="payref1"> Payment Ref.</label>
                  <input type="text" name="payment_ref" class="form-control" id="payref1" value="<?php echo $trans_code; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="inputEmail3">Select Service For which you are making payment </label>
                      <select name="service" class="form-control" required>
                      <option value="">Select ... </option>
                        <option value="web-design" >Web App Development</option>
                        <option value="web-hosting" >Mobile App Development</option>
                        <option value="Email" >Desktop App Development</option>
                        <option value="travelnow" >Multi Platform App Development</option>
                          </select>
                  </div>
                <div class="form-group">
                  <label for="amt1"> Amount</label>
                  <div class="input-group">
                  <span class="input-group-addon">₦</span>
                  <input type="text" name="amount" class="form-control" id="amt1" type="number" placeholder="Enter numbers only e.g. 5000" required/>
                </div>
              </div><br>
                <div class="form-group center-block">
                <button type="submit" class="btn btn-primary" name="B1">Continue &raquo;</button> <input type="reset" class="btn btn-danger">
                </div>
              </form>
        <!-- <p><a class="btn btn-lg btn-success" href="#" role="button">Sign up today</a></p> -->
      </div>


      <footer class="footer">
        <p>tegopay</p>
      </footer>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
