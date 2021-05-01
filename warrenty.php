<?php include("lib/common.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

<?php $page=$objMain->getRow("select * from pages where id=3");
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
                            <h1>Poppy MATTRESS - Warranty</h1>
                        </div>
                        <div class="text">
                            <p>All our Mattresses are crafted with Quality Materials and Finest Workmanship. Every mattress manufactured are checked for quality before they are shipped. Although, all our mattresses are tagged with the warranty card that can be used for any sort of manufacturing defect. The warranty applies for a period of 5 to 10 years from the date of delivery. In case of any Manufacturing defect (Given below) within one year of purchase the Mattress will be repaired or replaced with an identical product. And any Manufacturing defect after the first year of purchase, repair or replacement will not be possible. But you will be given a pro-rated credit for purchasing.</p>
<p>P.S: Prorated Credit will be in Form of Credit vouchers will be applicable on Buying any POPPY products from our website. </p>

<h3>What is covered under warranty?</h3>
<ol>
<li>1. Any sort of defect in Workmanship (stitching)</li>
<li>2. Any damage to Fabric of Mattress and damage occurrence while removing the pvc cover</li>
<li>3. Reduction of thickness of Mattress greater than 1.5 inch will be considered as sagging and the Mattress is considered to be defected.</li>
<li>4. Any physical flaw in mattress causing inside foam material to crack or split upon arriving.</li>
<li>5. Any damage in inner springs of the Mattress.</li>
</ol>
<br>
<h3>What is not covered?</h3>
<ol>
<li>1. Improper use of Mattress: Our Mattress is designed to use in a firm surface therefore any problem which occurs due to the improper use of Mattress is not covered under warranty.</li>

<li>2. Rough handling: Use proper scissors to open the packaging do not use very sharp materials which may cause damage to fabrics. This will be not treated under warranty.</li>

<li>3. Damage on fabric: Any cause of damage to Fabric or handle of the Mattress while removing the package of the Mattress.<li>

<li>4. Sagging lesser than 1.5 inch will not be covered under warranty</li>

<li>5. Liquid spoilage in Fabric</li>

<li>6. Smell, Dirt resulting from poor mattress care</li>

<li>7. Exposure to prolonged hot / cold temperature that causes damage to mattress</li>

<li>8. Comfort preference will not be covered under warranty </li>

<li>9. Improper washing of the Cover.</li>

<li>10. Accessories given free for the mattress will not be covered under warranty </li>
</ol>


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