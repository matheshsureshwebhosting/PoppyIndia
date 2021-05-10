<?php include("lib/common.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

<title>Order Tracking : Buy Mattress Online - India&#039;s Best Mattress Brand</title>

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
    <section class="checkout-section" >
        <div class="container">
            <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12 table-column">


                
            <?php 

            $order=$objMain->getRow("select * from orders where id='".$id."'"); 
if(!empty($order)){ 
            ?>
                    <div class="row" style="margin-top: 50px;">
                <div class="col-lg-6 col-md-12 col-sm-12 right-column">
                    <div class="inner-box">
                         <div class="order-info">
                            <h4 class="sub-title" style="border: none;background: #f1efef;">Order Status
                                <span class="status-<?php echo $order['status']; ?>"><?php echo strtoupper($order['status']); ?></span>
                            </h4>
                        </div>

                        <div class="order-info">
                            <h4 class="sub-title">Cancel Order</h4>
                            <div class="order-product">
                                <div class="amount-box">
                                    <form method="post" action="init.php?module=user&action=cancel_order&do=cancel&id=<?php echo $id; ?>">
                                    <div class="text clearfix">
                                        <h4 style="font-weight: normal; padding-left: 0"> Reason for Cancel </h4>
                                        <textarea class="form-control" id="cancel_reason" name="cancel_reason" required="" rows="4"></textarea>
                                    </div>

                                    <div class="text clearfix">
                                        <input type="submit" name="submit" id="submit" value="Submit" class="pull-right theme-btn">
                                    </div>    
                                    </form>                                
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


                    </div>

                <?php }  ?>
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