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
<?php include("inc/facebook_script.php"); ?>
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
                    <div class="col-lg-9 col-md-12 col-sm-12 content-side myorders">
                        <div class="our-shop">
                            <div class="row">
                    <?php $orders=$objMain->getResults("select * from orders where status!='initiated' and userid=".$_SESSION['userid']);
                   // echo "select * from orders where status!='initiated' and userid=".$_SESSION['userid'];
                    if(!empty($orders)) { 
                        foreach($orders as $order){
                        ?>
                            <div class="class-details">
                                <div class="class-details-content">
                        <div class="inner-box">
                            <div class="upper-content">
                                <div class="info-box">
                                    <ul class="clearfix">
                                        <li>
                                            <h6>Order Placed</h6>
                                            <h5><?php echo date("d-m-Y",strtotime($order['order_date'])); ?></h5>
                                        </li>
                                        <li>
                                            <h6>Tracking No</h6>
                                            <h5><?php echo $order['tracking_id']; ?></h5>
                                        </li>
                                        <li>
                                            <h6>Net Amount</h6>
                                            <h5>₹ <?php echo $objMain->INR($order['net_amount']); ?></h5>
                                        </li>
                                        <li>
                                            <h6>Status</h6>
                                            <h5 style="font-size: 15px;"><?php echo strtoupper($order['status']); ?></h5>
                                        </li>
                                        <li>
                                            <a href="order-detail.php?id=<?php echo $order['id']; ?>" class="theme-btn">View Detail</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="lower-content">
<?php $order_items=$objMain->getResults("select * from orders_items where product_type!='free' and order_id=".$order['id']);
if(!empty($order_items)){ $i=0;
    foreach($order_items as $item) { $i++; ?>

                                <div class="row orderitem" style="margin-bottom: 20px;border-bottom: 1px solid #ede6e6;padding-bottom: 10px;">
                                    <div class="col-lg-2 prod-thumb">
                                        <img src="images/products/<?php echo $item['cover_image']; ?>" alt="">
                                    </div>
                                    <div class="col-lg-5" style="color: #84226d; font-size: 18px;">
                                        <?php echo $item['product_name']; ?>
                                                <span style="width: 100%;float: left;font-size: 14px; color: #454242;"><?php echo $item['category']; ?></span>
                                                <span style="width: 100%;float: left;font-size: 14px; margin-top: 10px; color:#454242;"><?php echo $item['product_size']; ?></span>
                                    </div>
                                    <div class="col-lg-1" style="text-align: center;">
                                        <label><?php if($i==1) echo "Qty"; else echo "&nbsp;"; ?></label>
                                        <span style="width: 100%;float: left;font-size: 23px;color: #84226d;"><?php echo $item['qty']; ?></span>
                                    </div>
                                    <div class="col-lg-2" style="text-align: center;">
                                        <label><?php if($i==1) echo "Rate"; else echo "&nbsp;"; ?></label>
                                        <span style="width: 100%;float: left;font-size: 23px;color: #84226d;">₹ <?php echo $objMain->INR($item['price']); ?></span>
                                    </div>
                                    <div class="col-lg-2" style="text-align: center;">
                                        <label><?php if($i==1) echo "Amount"; else echo "&nbsp;"; ?></label>
                                        <span style="width: 100%;float: left;font-size: 23px;color: #84226d;">₹ <?php echo $objMain->INR($item['amount']); ?></span>
                                    </div>

                                </div>
                            <?php } } ?>

                            </div>
                        </div>
                    </div></div>
                <?php } } ?>
                            </div>
                        </div>
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
       $.ajax({
        url: 'lib/ajax.php',
        type: 'post',
        data: {'type' : 'register', 'name': name, emailid: emailid, mobileno:mobileno },
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