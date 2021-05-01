<?php include("lib/common.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

<title>Order Tracking : Buy Mattress Online - India&#039;s Best Mattress Brand</title>

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
    <section class="checkout-section" >
        <div class="container">
            <div class="row">
               
                <div class="col-lg-12 col-md-12 col-sm-12 table-column" style="min-height: 200px;">
                <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                    <div class="row">
                        <div class="col-lg-2" style="text-align: right;padding: 10px;font-size: 17px;color: #84226D;">
                            <label>Tracking No : </label>
                        </div>

                        <div class="col-lg-3">
                            <input type="text" name="trackingno" id="trackingno" required="" class="trackingcode">
                        </div>

                        <div class="col-lg-3">
                            <button type="submit" class="theme-btn">Track</button>
                        </div>
                    </div>
                </form>
            <?php 
if(isset($_REQUEST['trackingno']) && $_REQUEST['trackingno']!="") { 

            $order=$objMain->getRow("select * from orders where tracking_id='".$_REQUEST['trackingno']."'"); 
if(!empty($order)){  
            ?>
                    <div class="row" style="margin-top: 50px;">
                <div class="col-lg-6 col-md-12 col-sm-12 right-column">
                    <div class="inner-box">
                         <div class="order-info">
                            <h4 class="sub-title" style="border: none;background: #f1efef;">Shipping Status 
                                <span class="status-<?php echo $order['status']; ?>"><?php 
                                if($order['status']=='pending') echo "Pending";
                                else if($order['status']=='pending') echo "Pending";
                                else if($order['status']=='verification-process') echo "Verification Process";
                                else if($order['status']=='process') echo "Processing";
                                else if($order['status']=='dispatch') echo "Dispatch from Factory";
                                else if($order['status']=='out-for-delivery') echo "Out for Delivery";
                                else if($order['status']=='delivered') echo "Delivered";
                                 ?></span>
                            </h4>
                        </div>

                        <div class="order-info">
                            <h4 class="sub-title">Order Details</h4>
                            <div class="order-product">
                                <div class="amount-box">
                                    <div class="text clearfix">
                                        <h4 class="col-lg-4" style="font-weight: normal; padding-left: 0"> Order Date </h4>
                                        <span class="col-lg-8 order-parice">: <?php echo date("d-m-Y h:i A",strtotime($order['order_date'])); ?></span>
                                    </div>
                                    <div class="text clearfix">
                                        <h4 class="col-lg-4" style="font-weight: normal; padding-left: 0"> Tracking No </h4>
                                        <span class="col-lg-8 order-parice">: <?php echo $order['tracking_id']; ?></span>
                                    </div>
                                    <div class="text clearfix">
                                        <h4 class="col-lg-4" style="font-weight: normal; padding-left: 0"> Name </h4>
                                        <span class="col-lg-8 order-parice">: <?php echo $order['name']; ?></span>
                                    </div>
                                    <div class="text clearfix">
                                        <h4 class="col-lg-4" style="font-weight: normal; padding-left: 0"> Mobile No </h4>
                                        <span class="col-lg-8 order-parice">: <?php echo $order['mobileno']; if($order['mobileno_alt']) echo " / ".$order['mobileno_alt'];  ?></span>
                                    </div>
                                    <div class="text clearfix">
                                        <h4 class="col-lg-4" style="font-weight: normal; padding-left: 0"> Address </h4>
                                        <span class="col-lg-8 order-parice">: <?php echo $order['address']; ?></span>
                                    </div>
                                    <div class="text clearfix">
                                        <h4 class="col-lg-4" style="font-weight: normal; padding-left: 0"> City </h4>
                                        <span class="col-lg-8 order-parice">: <?php echo $order['city']; ?></span>
                                    </div>
                                    <div class="text clearfix">
                                        <h4 class="col-lg-4" style="font-weight: normal; padding-left: 0"> State </h4>
                                        <span class="col-lg-8 order-parice">: <?php echo $order['state']; ?></span>
                                    </div>
                                    <div class="text clearfix">
                                        <h4 class="col-lg-4" style="font-weight: normal; padding-left: 0"> Pincode </h4>
                                        <span class="col-lg-8 order-parice">: <?php echo $order['pincode']; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                       

                        <div class="additional-info">
                            <h4 class="sub-title">Order Notes</h4>
                            <div class="note-book">
                                <?php echo $order['order_notes']; ?>    
                            </div>
                        </div>
                    </div>
                </div>

                        <div class="col-lg-6 col-md-12 col-sm-12 right-column">
                    <div class="inner-box">
                        <div class="order-info">
                            <h4 class="sub-title">Your Items</h4>
                            <div class="order-product">
                                <?php 
                                $order_items=$objMain->getResults("select * from orders_items where order_id='".$order['id']."'");
if(!empty($order_items)){ $i=0;
    foreach($order_items as $item) { $i++; ?>
                                <div class="single-item">
                                    <figure class="image-box"><a href="#"><img src="images/products/<?php echo $item['cover_image']; ?>" alt=""></a></figure>
                                    <div class="text clearfix">
                                        <h4><?php echo $item['product_name']." ".$item['product_height']."\""; ?><br>
                                            <?php if($item['product_type']=='free') echo "<label><b style='color:#84226D'>FREE</b></label>"; ?>
                                            <label style="font-size: 14px; color:#979191;"><?php echo $item['category']; ?></label><br>
                                                <label style="font-size: 14px;"><?php echo $item['product_size']; ?></label>
                                        </h4>
                                        <span><?php if($item['product_type']!='free') echo "₹ ".$objMain->INR($item['amount']); ?></span>
                                    </div>
                                </div>
                            <?php } } ?>
                                <div class="amount-box">
                                    <div class="text clearfix">
                                        <h4 style="width: 100%; <?php if(isset($order['coupon_value'])) echo 'font-weight: normal; '; ?>">Order Total 
                                        <span class="order-parice pull-right">₹ <?php echo $objMain->INR($order['net_amount']); ?></span></h4>
                                    </div>
                                    <?php if(isset($order['coupon_value'])) { ?>
                                    <div class="text clearfix">
                                        <h4 style="width: 100%; font-weight: normal;">Coupon Discount
                                        <span class="order-parice pull-right">₹ <?php echo $objMain->INR($order['coupon_value']); ?></span></h4>
                                    </div>
                                    <div class="text clearfix">
                                        <h4 style="width: 100%;">Net Amount
                                        <span class="order-parice pull-right">₹ <?php echo $objMain->INR($order['net_amount']); ?></span></h4>
                                    </div>
                                <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                    </div>

                <?php } else { echo "<h3 style='margin-top: 50px;text-align: center;background: #84226d;color: #FFF;padding: 20px;'>Invalid Tracking Code</h3>"; } } ?>
                </div>
            </div>
        </div>
    </section>
    <!-- shop-details end -->
<?php include("inc/footer.php"); ?>

<?php include("inc/footer_scripts.php"); ?>

<script type="text/javascript">



</script>

</body><!-- End of .page_wrapper -->

</html>