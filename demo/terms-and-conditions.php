<?php include("lib/common.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

<?php $page=$objMain->getRow("select * from pages where id=11");
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
    <section class="about-section style-two" style="padding-top: 0px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 content-column">
                    <div class="content-box">
                        <div class="sec-title style-two">
                            <h1>Poppy MATTRESS - Terms & Conditions</h1>
                        </div>
                        <div class="text">
                            
<ul>
<li>1. Warranty will be only applicable on a manufacturing defect and if a defect occurs from Mishandling from the customer side POPPY is not responsible.</li>

<li>2. Only Original purchaser can avail warranty</li>

<li>3. The Poppy mattress should have been necessarily bought from the POPPY website or authorized websites of POPPY or from Authorized dealers</li>

<li>4. Please keep the copy of Invoice which will be considered as proof of purchase. You should submit Invoice copy to claim warranty.</li>

<li>5. If invoice copy is not submitted, POPPY has rights to decline your claim of warranty</li>

<li>6. Proper photographs of damaged mattress should be submitted; If not so the claim will be rejected by the POPPY.</li>

<li>7. All the warranty claim will be inspected and processed in 14 days.</li>

<li>8. If Your claim is verified, POPPY will either repair or replace ,In case both is not possible a settlement will be made in form of pro-rated credit settlements.</li>

<li>9. The final decision will be reserved with POPPY mattress</li>

<li>10. Disputes, If any, will be subject to Karur jurisdiction only.</li>
</ul>


                        </div>
                    </div>
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