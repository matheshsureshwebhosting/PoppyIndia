<?php include("lib/common.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

<title>Register : Buy Mattress Online - India&#039;s Best Mattress Brand</title>

<!-- Stylesheets -->
<link href="css/style.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">
    <link rel="icon" href="images/favicon.png">
<link rel="stylesheet" type="text/css" href="vendor/slick/slick.css"/>
<style type="text/css">
    .main-header .logo-box .logo:before { background: none !important; }
</style>
<link rel="stylesheet" href="vendor/bootstrap-select/css/bootstrap-select.css">
<style type="text/css">

</style>
<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '662327334354562');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=662327334354562&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->
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
                            <h4 class="sub-title">Signup</h4>
                            <form action="init.php?module=user&action=register" method="post" id="register_frm" class="billing-form" autocomplete="off">
                                <div class="row" id="signup_det">
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <label>Name*</label>
                                        <div class="field-input">
                                            <input type="text" name="name" id="name" required="">
                                            <label class="error hide" id="name_error">* Please enter you name</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <label>Phone Number</label>
                                        <div class="field-input">
                                            <input type="text" name="mobileno" id="mobileno" class="mobile" style="letter-spacing: 1px;"  autocomplete="false">
                                            <label class="error" id="mobileno_error">* Please enter 10 Digit Mobile No</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <label>Email ID</label>
                                        <div class="field-input">
                                            <input type="text" name="emailid" id="emailid">
                                            <label class="error" id="email_error">* Please enter valid email ID</label>
                                        </div>
                                    </div>
                                    <label class="col-lg-12 error" id="user_error">* Please enter Email ID or Mobile No</label>
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group" style="margin-bottom: 0;">
                                        <label>Password *</label>
                                        <div class="field-input">
                                            <input type="text" name="userpassword" id="userpassword" required="" minlength="5">
                                            <label class="error hide" id="password_error">* Password should be Minimum 4 Letters</label>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    
                                        <div class="subscriptionbox">
     <input type="checkbox" id="checkbox" name="" value="yes" checked="">
     <label for="checkbox"><span>I agree to subscribe to get latest offers</span></label>
  </div>

                                    </div>
                                    
                                </div>
                                <div class="row" style="display: none;" id="otp_det">
                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <label>OTP</label>
                                        <div class="field-input">
                                            <input type="text" name="otp" id="otp" class="year" style="letter-spacing: 1px;"  autocomplete="false">
                                            <label class="error" id="otp_error">* OTP Invalid</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="order-btn pull-right" id="register" style="margin-top: 20px; margin-bottom: 20px;"><button type="button" onclick="validate();" class="theme-btn">Submit</button></div>
                                <div class="" id="validate_otp" style="float: left; width: 100%; display: none;">
                                    <label onclick="resendotp();" style="margin-top: 20px;color: #84226d;">Not received OTP? ReSend OTP</label>
                                <div class="order-btn" id="validate_otp" style="margin-top: 20px; margin-bottom: 20px; float: right;"><button type="button" onclick="validate_otp();" class="theme-btn">Validate</button></div>
</div>
                                    <label class="col-lg-12 error" id="register_error" style="display: none;"></label>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 customer-column">
                    <div class="customer">Existing Customer? <a href="login.php">Click here to Login</a></div>
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
    $("#otp_error").hide();
    $("#password_error").hide();

     function validate(){ 
    var name=$("#name").val();
    var mobileno=$("#mobileno").val(); 
    var emailid=$("#emailid").val();     
    var userpassword=$("#userpassword").val();   
    var subscription='no';  
    mobileno=mobileno.replace("_", "");

     $("#name_error").hide();
    $("#mobileno_error").hide();
    $("#email_error").hide();
    $("#user_error").hide();
    $("#otp_error").hide();
    $("#password_error").hide();

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
    if(name=='' || userpassword.length<4){ error=1;
        $("#password_error").show();
    } 

    if(user==0) { error=1; $("#user_error").show(); }

     if (($('#checkbox').is(':checked')))  {
        subscription='yes';
     }

    if(error==0) 
       $.ajax({
        url: 'lib/ajax.php',
        type: 'post',
        data: {'type' : 'register', 'name': name, emailid: emailid, mobileno:mobileno, 'userpassword':userpassword, 'subscription' : subscription },
        success: function(obj) { 
            data = jQuery.parseJSON(obj);
            $("#register_error").html(data['message']);
            $("#register_error").show();
                
            if(data['error']==0){
                $("#signup_det").hide();
                $("#otp_det").show();
                $("#register").hide();
                $("#validate_otp").show();
            }
        }
        });
    }

    function validate_otp(){
        var error=0;
    var otp=$("#otp").val();       
    otp=otp.replace("_", "");
    $("#otp_error").hide();
    $("#register_error").hide();
    if(otp.length>0 && otp.length!=4) { error=1; 
        $("#otp_error").show();
    }

        if(error==0) 
       $.ajax({
        url: 'lib/ajax.php',
        type: 'post',
        data: {'type' : 'otp_validate', 'otp': otp },
        success: function(obj) { 
            data = jQuery.parseJSON(obj);
            if(data['status']=='success') window.location.href = data['return_url'];
            else { $("#register_error").html('Invalid OTP'); $("#register_error").show(); }
        }
        });
    }

    function resendotp(){
        $.ajax({
        url: 'lib/ajax.php',
        type: 'post',
        data: {'type' : 'otp_resend' },
        success: function(data) { 
            $("#register_error").html('* OTP has been sent successfully');
        }
        });        
    }
</script>
</body><!-- End of .page_wrapper -->

</html>