<?php include("lib/common.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="MHS">

    <!--favicon icon-->
    <link rel="icon" type="image/png" href="assets/img/favicon.png">

    <title>Login | <?php echo COMPANY_NAME; ?></title>

    <!--google font-->
    <link href="//fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">


    <!--common style-->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">
    <link href="assets/vendor/themify-icons/css/themify-icons.css" rel="stylesheet">
    <link href="assets/vendor/weather-icons/css/weather-icons.min.css" rel="stylesheet">

    <!--custom css-->
    <link href="assets/css/main.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="assets/vendor/html5shiv.js"></script>
    <script src="assets/vendor/respond.min.js"></script>
    <![endif]-->

</head>
<body class="">

    <!--===========login start===========-->

    <div class="container">


        <form class="form-signin" action="init.php?module=user&action=password_forgot" method="post">

         <?php
    if(isset($msg) && $msg=='suc') { $atype="success";
    $msg="Password Reset SMS sent successfully"; }
     if(isset($msg) && $msg=='failed') { $atype="danger";
    $msg="Invalid ID. Check your member ID"; }

  ?>
    <?php if(isset($msg)) { ?>
      <div class="alert alert-<?php echo $atype; ?> alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <p style="font-size: 16px;"><i class="icon fa fa-ban"></i> <?php echo $msg; ?></p>
      </div>
          <?php } ?>
          
            <a href="index.php" class="brand text-center">
                <img src="assets/img/logo-home.png" class="img-responsive" style="max-width: 100%; padding: 20px;">
            </a>
            <h2 class="form-signin-heading">Recover Password</h2>
            <div class="form-group">
                <label for="inputEmail" class="sr-only">Member ID</label>
                <input type="text" id="userid" name="userid" class="form-control" placeholder="Member ID" required maxlength="10">
            </div>

            <div class="checkbox mb-4 mt-4" style="margin-bottom:  10px;">
                 <label class="custom-control custom-checkbox">
                    
                </label>

                <a href="index.php"  class="float-right text-muted">Back to Login ?</a>
            </div>
           <button type="submit" class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>

        </form>

    </div>
    <!--===========login end===========-->


    <!-- Placed js at the end of the page so the pages load faster -->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/jquery-ui-1.12.1/jquery-ui.min.js"></script>
    <script src="assets/vendor/popper.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/vendor/jquery-ui-touch/jquery.ui.touch-punch-improved.js"></script>
    <script class="include" type="text/javascript" src="assets/vendor/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/vendor/jquery.scrollTo.min.js"></script>

    <!--[if lt IE 9]>
    <script src="assets/vendor/modernizr.js"></script>
    <![endif]-->


</body>
</html>


