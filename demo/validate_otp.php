<?php include("lib/common.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

<title>Login : Buy Mattress Online - India&#039;s Best Mattress Brand</title>

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
                    <div class="inner-box">
                        <div class="billing-info">
                            <h4 class="sub-title">Validate</h4>
                            <form action="init.php?module=user&action=otp" method="post" id="register_frm" class="billing-form" autocomplete="off">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <label>OTP*</label>
                                        <div class="field-input">
                                            <input type="text" name="name" id="name" required="" class="year">
                                            <label class="error hide" id="name_error">* Invalid OTP</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="order-btn pull-right" style="margin-top: 20px; margin-bottom: 20px;"><button type="button" onclick="validate();" class="theme-btn">Continue to Login</button></div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 customer-column">
                    <div class="customer">Existing Customer? <a href="register">Click here to Login</a></div>
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

<!--input mask-->
    <script src="vendor/input-mask/jquery.inputmask.bundle.js"></script>
    <script src="vendor/input-mask-init.js"></script>


<script type="text/javascript">
    $("#name_error").hide();
    $("#mobileno_error").hide();
    $("#email_error").hide();
    $("#user_error").hide();

     function validate(){ 
    var name=$("#name").val();
    var mobileno=$("#mobileno").val(); 
    var emailid=$("#emailid").val();       
    mobileno=mobileno.replace("_", "");

    $("#name_error").hide();
    $("#mobileno_error").hide();
    $("#email_error").hide();
    $("#user_error").hide();

    var re = /\S+@\S+\.\S+/;
    var user=0;
    var error=0;
    if(name==''){ error=1;
        $("#name_error").show();
    } 
    if(mobileno.length>0 && mobileno.length!=10) { error=1; user=1; console.log("Mobile");
        $("#mobileno_error").show();
    }
    
    if(mobileno.length==10 || (emailid!="" && re.test(emailid))) user=1; 

    if(emailid!="" && !re.test(emailid)){  user=1; error=1; console.log("Email");
        $("#email_error").show();
    }

    if(user==0) { error=1; $("#user_error").show(); }

    if(error==0) 
        document.getElementById("register_frm").submit();

    }
</script>
</body><!-- End of .page_wrapper -->

</html>