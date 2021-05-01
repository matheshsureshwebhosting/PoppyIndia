<?php include("lib/common.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

<title>My Account : Buy Mattress Online - India&#039;s Best Mattress Brand</title>

<!-- Stylesheets -->
<link href="css/style.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">
    <link rel="icon" href="images/favicon.png">
<link rel="stylesheet" type="text/css" href="vendor/slick/slick.css"/>
<style type="text/css">
    .main-header .logo-box .logo:before { background: none !important; }
</style>
<link rel="stylesheet" href="vendor/bootstrap-select/css/bootstrap-select.css">
</head>

<!-- page wrapper -->
<body class="boxed_wrapper">


    <div class="preloader"></div>

   <?php include("inc/header_inner.php"); ?>

    <!-- shop-details -->
    <section class="shop-section">
        <div class="container">
            <div class="product-block-area">
                <div class="row">
                    <div class="col-lg-3 col-md-12 col-sm-12 sidebar-side">
                        <div class="shop-sidebar sidebar">
                            <div class="sidebar-categories sidebar-widget">
                                <h3 class="sidebar-title" style="border-bottom: 1px solid #6e7586; padding-bottom: 10px;">My Account</h3>
                                <ul class="categories-list">
                                    <li><a href="dashboard.php"><i class="fa fa-shopping-bag"></i> My Orders</a></li>
                                    <li><a href="myprofile.php"><i class="fa fa-user"></i> My Profile</a></li>
                                    <li><a href="change-password.php"><i class="fa fa-lock"></i> Change Password</a></li>
                                    <li><a href="init.php?module=user&action=logout"><i class="fa fa-arrow-circle-left"></i> Logout</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-12 col-sm-12">
                    <?php
    if(isset($msg) && $msg=='success') { $atype="success";
    $msg='<i class="icon fa fa-thumbs-up"></i> Password Changed Successfully'; }

    if(isset($msg) && $msg=='failed') { $atype="danger";
    $msg='<i class="icon fa fa-ban"></i> OLD Password Wrong.'; }

  ?>
    <?php if(isset($msg)) { ?>
      <div class="alert alert-<?php echo $atype; ?> alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <p style="color: #FFF"><?php echo $msg; ?></p>
      </div>
          <?php } ?>
                    <div class="inner-box">
                            
                                <h3 class="sidebar-title" style=" padding-bottom: 10px;">Change Password</h3>
                            <form action="init.php?module=user&action=changepassword" method="post" class="general-form">
                                <div class="row">
                                    <div class="col-lg-6 col-md-4 col-sm-12 form-group">
                                        <label>Old Password</label>
                                        <div class="field-input">
                                            <input type="password" name="oldpassword" id="oldpassword" minlength="4">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-4 col-sm-12 form-group">
                                        <label>New Password</label>
                                        <div class="field-input">
                                            <input type="password" name="newpassword" id="newpassword" minlength="4">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 form-group pull-right">
                                        <button type="submit" class="theme-btn pull-right">Submit</button></div>
                                    </div>
                                </div>
                            </form>
                    </div>
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