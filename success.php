<?php include("lib/common.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

<title>Order Success : Buy Mattress Online - India&#039;s Best Mattress Brand</title>

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
    <section class="cart-section cart-page" style="padding: 150px 0;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 table-column">
                    <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <p style="color: #FFF"><i class="fa fa-thumbs-up"></i> Order Placed Successfully</p>
      </div>

                     <h2 style="font-size: 25px;color: #84226d;">Your Tracking ID : <span><?php echo $tracking_id; ?></a></h2>
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