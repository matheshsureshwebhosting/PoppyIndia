<?php include("lib/common.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

<?php $page=$objMain->getRow("select * from pages where id=8");
echo $page['html_code']; ?>

<!-- Stylesheets -->
<?php include("inc/header_scripts.php"); ?>
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
    if(isset($msg) && $msg=='fillinput') { $atype="danger";
    $msg='<i class="icon fa fa-ban"></i> Please Fill All Fields'; }
    if(isset($msg) && $msg=='failed') { $atype="danger";
    $msg='<i class="icon fa fa-ban"></i> Invaild Warranty'; }
    if(isset($msg) && $msg=='success') { $atype="success";
    $msg='<i class="icon fa fa-ban"></i> Successfully Warranty Register'; }
     if(isset($msg) && $msg=='notwrite') { $atype="danger";
    $msg='<i class="icon fa fa-ban"></i> There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.'; }
    if(isset($msg) && $msg=='exfile') { $atype="danger";
    $msg='<i class="icon fa fa-ban"></i> Upload failed. Allowed file types: jpg,pdf,doc'; }
    if(isset($msg) && $msg=='notup') { $atype="danger";
    $msg='<i class="icon fa fa-ban"></i> File Not Upload'; }

  ?>
    <?php if(isset($msg)) { ?>
      <div class="alert alert-<?php echo $atype; ?> alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <p style="color: #FFF"><?php echo $msg; ?></p>
      </div>
          <?php } ?>
                    <div class="inner-box">
                        <div class="billing-info">
                            <h4 class="sub-title">30 Days's Trial Register</h4>
                            <form action="init.php?module=user&action=trial" method="post" class="billing-form" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <label>Invoice No</label>
                                        <div class="field-input">
                                            <input type="text" class="form-control" name="invoice_no" id="invoice_no">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <label>Invoice</label>
                                        <div class="field-input">
                                            <input type="file" class="form-control" name="invoice" id="invoice"><small>jpg,pdf,doc</small>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-6 col-sm-12 form-group">
                                        <label>Date of Birth</label>
                                        <div class="field-input">
                                            <input type="date" name="customer_date_of_birth" id="customer_date_of_birth">
                                        </div>
                                    </div>
                                     <div class="col-lg-12 col-md-6 col-sm-12 form-group">
                                        <label>Mobile No.</label>
                                        <div class="field-input">
                                            <input type="text" name="mobileno" id="mobileno">
                                        </div>
                                    </div>

                                        
                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <button type="submit" class="theme-btn pull-right">Submit</button></div>
                                </div>
                            </form>
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