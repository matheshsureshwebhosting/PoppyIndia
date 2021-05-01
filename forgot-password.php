<?php include("lib/common.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

<?php $page=$objMain->getRow("select * from pages where id=7");
echo $page['html_code']; ?>

<?php include("inc/header_scripts.php"); ?>
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
    <section class="checkout-section">
        <div class="container">
            
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 left-column">
                    <?php
    if(isset($msg) && $msg=='wrong') { $atype="danger";
    $msg='<i class="icon fa fa-ban"></i> Mobile No / Email id not exist'; }

  ?>
    <?php if(isset($msg)) { ?>
      <div class="alert alert-<?php echo $atype; ?> alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <p style="color: #FFF"><?php echo $msg; ?></p>
      </div>
          <?php } ?>
                    <div class="inner-box">
                        <div class="billing-info">
                            <h4 class="sub-title">Forgot Password</h4>
                            <form action="init.php?module=user&action=forgot" method="post" class="billing-form">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <label>Mobile No / Email ID</label>
                                        <div class="field-input">
                                            <input type="text" name="username" id="username">
                                        </div>
                                    </div>

                                        
                                    <div class="col-lg-12 form-group pull-right">
                                        <button type="submit" class="theme-btn pull-right">Submit</button></div>
                                    </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
     
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