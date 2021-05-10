<?php include("lib/common.php"); if(!isset($_SESSION['id'])) header("location:forgot-password.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

<title>Reset Password : Buy Mattress Online - India&#039;s Best Mattress Brand</title>

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
    if(isset($msg) && $msg=='sent') { $atype="danger";
    $msg='<i class="icon fa fa-thumbs-up"></i> OTP has been set to your Mobile No / Email id'; }

  ?>
    <?php if(isset($msg)) { ?>
      <div class="alert alert-<?php echo $atype; ?> alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <p style="color: #FFF"><?php echo $msg; ?></p>
      </div>
          <?php } ?>
                    <div class="inner-box">
                        <div class="billing-info">
                            <h4 class="sub-title">Reset Password</h4>
                            <form action="init.php?module=user&action=resetpassword" method="post" class="billing-form">
                                <div class="row"  id="validate_btn">
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <label>OTP</label>
                                        <div class="field-input">
                                            <input type="text" name="otp" id="otp" class="year">
                                        </div>
                                        <label class="col-lg-12 error" id="otp_error" style="display: none;">* Invalid OTP</label>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <label onclick="resendotp();" style="margin-top: 10px;color: #84226d;">Not received OTP? ReSend OTP</label>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <button type="button" class="theme-btn pull-right" onclick="validateotp();">Submit</button>
                                    </div>
                                </div>

                                <div class="row" id="submit_btn" style="display: none;">
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <label>New Password</label>
                                        <div class="field-input">
                                            <input type="password" name="userpassword" id="userpassword" placeholder="Enter your new password" minlength="4" required="">
                                        </div>
                                    </div>

                                    <div class="col-lg-12 form-group pull-right">
                                        <button type="submit" class="theme-btn pull-right">Submit</button>
                                    </div>
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
<!--input mask-->
    <script src="vendor/input-mask/jquery.inputmask.bundle.js"></script>
    <script src="vendor/input-mask-init.js"></script>

<script type="text/javascript">
    function validateotp(){
    var otp=$("#otp").val();     
    otp=otp.replace("_", "");

    $("#otp_error").hide();

    var error=0;

    if(otp=='' || otp.length!=4) { error=1; 
        $("#otp_error").show();
    }
    
    if(error==0) 
       $.ajax({
        url: 'lib/ajax.php',
        type: 'post',
        data: {'type' : 'reset_otpvalidate', 'otp': otp },
        success: function(data) { 
            if(data=='success'){
                $("#otp_error").hide();
                $("#validate_btn").hide();
                $("#submit_btn").show();
            } else {
                $("#otp_error").show();
            }
        }
        });
    }

    function resendotp(){
        $.ajax({
        url: 'lib/ajax.php',
        type: 'post',
        data: {'type' : 'forget_otp_resend' },
        success: function(data) { 
            $("#otp_error").html('* OTP has been sent successfully');
            $("#otp_error").show();
        }
        });        
    }
</script>
</body><!-- End of .page_wrapper -->

</html>