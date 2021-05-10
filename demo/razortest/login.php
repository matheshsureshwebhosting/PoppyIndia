<?php include("lib/common.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

<title>Login : Buy Mattress Online - India&#039;s Best Mattress Brand</title>

<!-- Stylesheets -->
<link href="css/style.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">
    <link rel="icon" href="images/favicon.png">
<link rel="stylesheet" type="text/css" href="vendor/slick/slick.css"/>
<style type="text/css">
    .main-header .logo-box .logo:before { background: none !important; }
</style>
<link rel="stylesheet" href="vendor/bootstrap-select/css/bootstrap-select.css">
<?php include("inc/facebook_script.php"); ?>
</head>

<!-- page wrapper -->
<body class="boxed_wrapper">


    <div class="preloader"></div>

   <?php include("inc/header_inner.php"); ?>

    <!-- shop-details -->
    <section class="checkout-section">
        <div class="container">
            
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 left-column">
                    <?php
    if(isset($msg) && $msg=='failed') { $atype="danger";
    $msg='<i class="icon fa fa-ban"></i> User name / Password Wrong'; }
     if(isset($msg) && $msg=='logout') { $atype="danger";
    $msg='<i class="icon fa fa-thumbs-up"></i> Logout successfully'; }
    if(isset($msg) && $msg=='session') { $atype="danger";
    $msg='<i class="icon fa fa-ban"></i> Session Expired! Login Again'; }

  ?>
    <?php if(isset($msg)) { ?>
      <div class="alert alert-<?php echo $atype; ?> alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <p style="color: #FFF"><?php echo $msg; ?></p>
      </div>
          <?php } ?>
                    <div class="inner-box">
                        <div class="billing-info">
                            <h4 class="sub-title">Login</h4>
                            <form action="init.php?module=user&action=validate" method="post" class="billing-form">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <label>Mobile No / Email ID</label>
                                        <div class="field-input">
                                            <input type="text" name="username" id="username">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-6 col-sm-12 form-group">
                                        <label>Password</label>
                                        <div class="field-input">
                                            <input type="password" name="userpassword" id="userpassword">
                                        </div>
                                    </div>

                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                    <a href="forgot-password.php" style="color: #84226D; font-weight: bold; padding-top: 10px; float: left; ">Forgot Password? </a>
                </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <button type="submit" class="theme-btn pull-right">Submit</button></div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 customer-column">
                    <div class="customer">New Customer? <a href="register.php">Click here to Register</a></div>
                </div>
            </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 right-column">
                    <div class="inner-box">

                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- shop-details end -->
<?php include("inc/footer.php"); ?>

<?php include("inc/footer_scripts.php"); ?>


</body><!-- End of .page_wrapper -->

</html>