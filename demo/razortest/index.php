<?php include("lib/common.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

<title>Poppy Mattress : Buy Mattress Online - India&#039;s Best Mattress Brand</title>

<!-- Stylesheets -->
<link href="css/style.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">
    <link rel="icon" href="images/favicon.png">
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
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-177884938-1">
</script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-177884938-1');
</script>
<!-- End Facebook Pixel Code -->
</head>

<!-- page wrapper -->
<body class="boxed_wrapper">


    <!-- .preloader -->
    <div class="preloader"></div>
    <!-- /.preloader -->

    <!-- Main Header -->
    <?php include("inc/header.php"); ?>
    <!-- End Main Header -->


    <!-- main-slider -->
    <section class="main-slider style-one">
        <div class="main-slider-carousel owl-carousel owl-theme nav-style-one">
            <?php $sliders=$objMain->getResults("select * from pu_slider order by sort_order");
            if(!empty($sliders)){
                foreach($sliders as $slider){ ?>
            
            <div class="slide">
                <img src="<?php echo HTTP_SLIDER.$slider['image_path']; ?>" style="width: 100%;">
            </div>
        <?php }  } ?>
        </div>
</section>

    <!-- main-slider end -->


    <!-- about-section -->
    <section class="about-section">
        <div class="container">
            <div class="sec-title centred">
                <h5>The right choice!</h5>
                <h1>From snuggle to Snore: We are the right choice </h1>
                <p class="snoozin_description">
                    Poppy is a sleep solutions brand bringing to you high quality, innovative sleep products at direct from factory prices! Your honest, luxurious and reliable sleep brand, making shopping for these products ridiculously fun and easy!
                </p>
            </div>

            <div class="row">
                <div class="row offers-banner d-flex">
                    <div class="col-sm-2">
                        <div class="offer-icon"><img src="images/icons/build-with-health.gif"></div>
                        <h6 class="">Hygiene and Health</h6>
                        <!-- <p>Direct from factory<br />to your doorstep</p> -->
                    </div>
                    <div class="col-sm-2">
                        <div class="offer-icon"><img src="images/icons/Waranty.gif"></div>
                        <h6 class="">Warranty</h6>
                        <!-- <p>100% refund,<br />no questions asked</p> -->
                    </div>
                    <div class="col-sm-2">
                        <div class="offer-icon"><img src="images/icons/Healthcare.gif"></div>
                        <h6 class="">Safe Sleep</h6>
                        <!-- <p>No sweat<br />unbeatable warranty</p> -->
                    </div>
                    <div class="col-sm-2">
                        <div class="offer-icon"><img src="images/icons/delivery.gif"></div>
                        <h6 class="">We are where you are</h6>
                        <!-- <p>Doorstep delivery<br />across India </p> -->
                    </div>
                    <div class="col-sm-2 giving-back-icon">
                        <div class="offer-icon"><img src="images/icons/good-sleep-every-night.gif"></div>
                        <h6 class="">Worth your sleep</h6>
                        <!-- <p>Together we give<br />back to society </p> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about-section end -->

<section class="classes-section sec-pad">
        <div class="container">
            <div class="sec-title centred">
                <h5>Meet</h5>
                <h1>Our Products</h1>
            </div>
            <div class="row">

                <div class="col-lg-4 col-md-6 col-sm-12 block-column" style="margin-bottom: 50px;">
                    <div class="inner-block wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <figure class="image-box"><a href="premium-series.php"><img src="images/products/premium-series/selene/pillow-top/1.png" alt=""></a></figure>
                        <div class="lower-content">
                            <h3><a href="premium-series.php">Premium Series</a></h3>
                            <div class="price">Starts from ₹ 7,185</div>
                            <div class="text">Where luxury is what is comfortable. Get your quality sleep right with premium</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 block-column" style="margin-bottom: 50px;">
                    <div class="inner-block wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <figure class="image-box"><a href="grand-series.php"><img src="images/products/grand-series/exuber/exuber/1.png" alt=""></a></figure>
                        <div class="lower-content">
                            <h3><a href="grand-series.php">Grand Series</a></h3>
                            <div class="price">Starts from ₹ 10,545</div>
                            <div class="text">Solid, Stable and Just more than enough to keep your sleep cycle tight</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 block-column" style="margin-bottom: 50px;">
                    <div class="inner-block wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <figure class="image-box"><a href="medico-series.php"><img src="images/products/medico-series/the-guardianz/1.png" alt=""></a></figure>
                        <div class="lower-content">
                            <h3><a href="medico-series.php">Medico Series</a></h3>
                            <div class="price">Starts from ₹ 15,735</div>
                            <div class="text">Say 'bye' to your zigzag spine. Make your alignment right with the Medico series</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 block-column">
                    <div class="inner-block wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <figure class="image-box"><a href="pu-foam-series.php"><img src="images/products/pu-foam-series/soffty-dlx/1.png" alt=""></a></figure>
                        <div class="lower-content">
                            <h3><a href="pu-foam-series.php">PU Foam Series</a></h3>
                            <div class="price">Starts from ₹ 4,425</div>
                            <div class="text">The pressure is not on you. It's on the mattress. Sleep well with our foam mattresses</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 block-column">
                    <div class="inner-block wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <figure class="image-box"><a href="rubberized-coir-series.php"><img src="images/products/rubberized-coir-series/saffron/1.png" alt=""></a></figure>
                        <div class="lower-content">
                            <h3><a href="rubberized-coir-series.php">Rubberized Coir Series</a></h3>
                            <div class="price">Starts from ₹ 4,184</div>
                            <div class="text">Sleep amid nature. An eco-friendly mattress series</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- service-section -->
    <section class="service-section sec-pad" style="background-image: url(images/background/bluebg.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-sm-12 inner-column">
                    <div class="inner-content">
                        <div class="sec-title style-two">
                            <h5 style="color: #FFF;">Customer Prefered</h5>
                            <h1>Best Selling Mattress</h1>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12 carousel-column">
                    <div class="carousel-content">
                        <div class="services-carousel owl-carousel owl-theme">
                        <?php $products=$objMain->getResults("select * from product where id in (15,2,3,6,10,13)");
                        if(!empty($products)) {
                            foreach($products as $product){  ?>
                            <div class="service-block-one">
                                <div class="inner-box">
                                    <a href="<?php echo $product['url_slug']; ?>"><img src="images/products/<?php echo $product['cover_image']; ?>" style="margin-bottom: 20px;"></a>
                                    <h3><a href="<?php echo $product['url_slug']; ?>" style="color: #84226d;"><?php echo $product['product_name']; ?> </a> <span class="pull-right" style="font-size: 13px; text-align: right;">from ₹ <?php echo $objMain->INR($product['product_price']); ?></span></h3>
                                    <div class="text"><?php echo $product['short_description']; ?></div>

                                </div>
                            </div>
                        <?php } } ?>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- service-section end -->


    <section class="about-section style-two">
        <div class="container">
<div class="title-box">
                            <div class="sec-title style-two">
                                <h5>Whatever is your Favorite Position, You have got our back!</h5>
                                <h1 style="font-size: 38px;">What is your favorite position in Sleeping?</h1>
                            </div>
                        </div>

                        <br><br>

            <div class="row">
                <div class="col-lg-6" style="min-height: 230px;">
                    <figure style="float: left; width: 15%;"><img src="images/icons/fetel.png" style="width: 70px;"></figure>
                    <div style="float: left; width: 75%; padding-left: 5%">
                        <h3>Fetal </h3>
                        <p>If you are sleeping on the side, with legs bent and curled towards their torsos. Now improve your position with PU Foam series</p>
                    </div>
                </div>
                <div class="col-lg-6" style="min-height: 230px;">
                    <figure style="float: left; width: 15%;"><img src="images/icons/solider.png" style="width: 70px;"></figure>
                    <div style="float: left; width: 75%; padding-left: 5%">
                        <h3>Soldier  </h3>
                        <p> You may lie on your back with arms down and close to the body. Euro Top model will help you have a peaceful night.</p>
                    </div>
                </div>
                <div class="col-lg-6" style="min-height: 230px;">
                    <figure style="float: left; width: 15%;"><img src="images/icons/freefall.png" style="width: 70px;"></figure>
                    <div style="float: left; width: 75%; padding-left: 5%">
                        <h3>Freefall  </h3>
                        <p>Usually, they sleep on their stomach while their head turned on one side. You love to keep the arms wrapped around the pillow or just tuck hands under it. Check all the pillow top models from us, and we are sure it is your destination</p>
                    </div>
                </div>
                <div class="col-lg-6" style="min-height: 230px;">
                    <figure style="float: left; width: 15%;"><img src="images/icons/yearner.png" style="width: 70px;"></figure>
                    <div style="float: left; width: 75%; padding-left: 5%">
                        <h3>Yearner  </h3>
                        <p>People who sleep in this position keep their arms stretched out of the body while sleeping sideways. Get the mediocre series from Poppys hat to help you sleep without any snooze</p>
                    </div>
                </div>
                <div class="col-lg-6" style="min-height: 230px;">
                    <figure style="float: left; width: 15%;"><img src="images/icons/starfish.png" style="width: 70px;"></figure>
                    <div style="float: left; width: 75%; padding-left: 5%">
                        <h3>Starfish  </h3>
                        <p> They sleep on their back with arms overhead. You must choose the Grand series to enjoy extreme comfort.</p>
                    </div>
                </div>
                <div class="col-lg-6" style="min-height: 230px;">
                    <figure style="float: left; width: 15%;"><img src="images/icons/log.png" style="width: 70px;"></figure>
                    <div style="float: left; width: 75%; padding-left: 5%">
                        <h3>Log </h3>
                        <p>If you keep your arms down just next to the body while you sleep on the side, then it is a log position. Try rubberized Coir and escape from the morning pain.</p>
                    </div>
                </div>


            </div>


        </div>
    </section>
    <!-- news-section end -->


    <!-- main-footer -->
    <?php include("inc/footer.php"); ?>
    <!-- main-footer end -->



<?php include("inc/footer_scripts.php"); ?>


<script type="text/javascript">
    $(document).ready(function() {
              $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                responsiveClass: true,
                responsive: {
                  0: {
                    items: 1,
                    nav: true
                  },
                  600: {
                    items: 1,
                    nav: false
                  },
                  1000: {
                    items: 1,
                    nav: true,
                    loop: false,
                    margin: 20
                  }
                }
              })
            })
</script>
</body><!-- End of .page_wrapper -->

</html>
