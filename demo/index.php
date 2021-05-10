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

<!-- New THeme -- >
<!-- Owl Stylesheets -->
<link rel="stylesheet" href="assets/style/owlcarousel/assets/owl.carousel.min.css" />
<link rel="stylesheet" href="assets/style/owlcarousel/assets/owl.theme.default.min.css" />
<link rel="stylesheet" href="assets/style/css/style.min.css" type="text/css" media="all" />
<link rel="stylesheet" href="assets/style/css/testimonials.css" type="text/css" media="all" />
<link rel='stylesheet' href='assets/plugins/js_composer/assets/css/js_composer.min.css' type='text/css' media='all' />


<link href="vendor/slider/theme.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="assets/plugins/revslider/public/assets/css/rs6.css" type="text/css" media="all" />

<script src="js/jquery.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script src="js/owl.js"></script>
<script src="js/wow.js"></script>
<script src="js/validation.js"></script>
<script src="js/jquery.fancybox.js"></script>
<script src="js/appear.js"></script>
<script src="js/parallax.min.js"></script>
<script src="js/isotope.js"></script>
<script src="js/jquery-ui.js"></script>  
<script src="js/jquery.bootstrap-touchspin.js"></script> 

<script type="text/javascript" src="assets/plugins/revslider/public/assets/js/rbtools.min.js"></script>
<script type="text/javascript" src="assets/plugins/revslider/public/assets/js/rs6.min.js"></script>
        
        <script>
            document.documentElement.className = document.documentElement.className.replace("no-js", "js");
        </script>
        <style>
           
            .vc_custom_1609515743268 {
                background-image: url('assets/images/testimonial1.png');
            }
            .no-js img.lazyload {
                display: none;
            }
            figure.wp-block-image img.lazyloading {
                min-width: 150px;
            }
            .lazyload,
            .lazyloading {
                opacity: 0;
            }
            .lazyloaded {
                opacity: 1;
                transition: opacity 400ms;
                transition-delay: 0ms;
            }
        </style>
        <script type="text/javascript">
            function setREVStartSize(e) {
                //window.requestAnimationFrame(function() {
                window.RSIW = window.RSIW === undefined ? window.innerWidth : window.RSIW;
                window.RSIH = window.RSIH === undefined ? window.innerHeight : window.RSIH;
                try {
                    var pw = document.getElementById(e.c).parentNode.offsetWidth,
                        newh;
                    pw = pw === 0 || isNaN(pw) ? window.RSIW : pw;
                    e.tabw = e.tabw === undefined ? 0 : parseInt(e.tabw);
                    e.thumbw = e.thumbw === undefined ? 0 : parseInt(e.thumbw);
                    e.tabh = e.tabh === undefined ? 0 : parseInt(e.tabh);
                    e.thumbh = e.thumbh === undefined ? 0 : parseInt(e.thumbh);
                    e.tabhide = e.tabhide === undefined ? 0 : parseInt(e.tabhide);
                    e.thumbhide = e.thumbhide === undefined ? 0 : parseInt(e.thumbhide);
                    e.mh = e.mh === undefined || e.mh == "" || e.mh === "auto" ? 0 : parseInt(e.mh, 0);
                    if (e.layout === "fullscreen" || e.l === "fullscreen") newh = Math.max(e.mh, window.RSIH);
                    else {
                        e.gw = Array.isArray(e.gw) ? e.gw : [e.gw];
                        for (var i in e.rl) if (e.gw[i] === undefined || e.gw[i] === 0) e.gw[i] = e.gw[i - 1];
                        e.gh = e.el === undefined || e.el === "" || (Array.isArray(e.el) && e.el.length == 0) ? e.gh : e.el;
                        e.gh = Array.isArray(e.gh) ? e.gh : [e.gh];
                        for (var i in e.rl) if (e.gh[i] === undefined || e.gh[i] === 0) e.gh[i] = e.gh[i - 1];
                        var nl = new Array(e.rl.length),
                            ix = 0,
                            sl;
                        e.tabw = e.tabhide >= pw ? 0 : e.tabw;
                        e.thumbw = e.thumbhide >= pw ? 0 : e.thumbw;
                        e.tabh = e.tabhide >= pw ? 0 : e.tabh;
                        e.thumbh = e.thumbhide >= pw ? 0 : e.thumbh;
                        for (var i in e.rl) nl[i] = e.rl[i] < window.RSIW ? 0 : e.rl[i];
                        sl = nl[0];
                        for (var i in nl)
                            if (sl > nl[i] && nl[i] > 0) {
                                sl = nl[i];
                                ix = i;
                            }
                        var m = pw > e.gw[ix] + e.tabw + e.thumbw ? 1 : (pw - (e.tabw + e.thumbw)) / e.gw[ix];
                        newh = e.gh[ix] * m + (e.tabh + e.thumbh);
                    }
                    if (window.rs_init_css === undefined) window.rs_init_css = document.head.appendChild(document.createElement("style"));
                    document.getElementById(e.c).height = newh + "px";
                    window.rs_init_css.innerHTML += "#" + e.c + "_wrapper { height: " + newh + "px }";
                } catch (e) {
                    console.log("Failure at Presize of Slider:" + e);
                }
                //});
            }
        </script>

        <link href="assets/style/styles.css" rel="stylesheet" />
        <link href="assets/style/responsive.css" rel="stylesheet" />
        <link href="assets/style/css/all.css" rel="stylesheet" />

<!-- End Theme -->
</head>

<!-- page wrapper -->
<body class="home boxed_wrapper">


    <!-- .preloader -->
    <div class="preloader"></div>
    <!-- /.preloader -->

    <!-- Main Header -->
    <?php include("inc/header.php"); ?>
    <!-- End Main Header -->
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

<div class="c-m4 hidedesktop">
            <div class="c-m4__sticky">
                <div data-w-id="8f049488-7c81-fe74-00b8-eecc80ba379d" class="c-m4__sticky-wrap">
                    <div class="c-m4__container sticky">
                        <div class="c-m4__copy-wrap">
                            <div style="display: block;" class="c-m4__copy c-m4__copy-1">
                                <h1 class="c-m4__title">Cuddle Buddy <br>India 1<sup>st</sup> All-Natural Mattress Series </h1>
                                <div class="c-linebreak-red"></div>
                                <p class="c-m4__copy">Cuddle Buddy makes sure to deliver the best-customized mattresses with ECO Institut OEKO-TEK confidence in textiles standard 100 and Brit Qualis ISO certification that allow you to have a premium buoyant feel.</p>
                                <div class="c-m4__cta-wrap"><a href="cuddle-buddy.php" class="red-button sticky-mobile-glow w-button">View All Mattress</a></div>
                            </div>
                            <div style="display: none;" class="c-m4__copy c-m4__copy-2">
                               <h1 class="c-m4__title">Cuddle Buddy <br>India 1<sup>st</sup> All-Natural Mattress Series </h1>
                                <div class="c-linebreak-red"></div>
                                <p class="c-m4__copy">Cuddle Buddy makes sure to deliver the best-customized mattresses with ECO Institut OEKO-TEK confidence in textiles standard 100 and Brit Qualis ISO certification that allow you to have a premium buoyant feel.</p>
                                <div class="c-m4__cta-wrap"><a href="cuddle-buddy.php" class="red-button sticky-mobile-glow w-button">View All Mattress</a></div>
                            </div>
                            <div style="display: none;" class="c-m4__copy c-m4__copy-3">
                                <h1 class="c-m4__title">Cuddle Buddy <br>India 1<sup>st</sup> All-Natural Mattress Series </h1>
                                <div class="c-linebreak-red"></div>
                                <p class="c-m4__copy">Cuddle Buddy makes sure to deliver the best-customized mattresses with ECO Institut OEKO-TEK confidence in textiles standard 100 and Brit Qualis ISO certification that allow you to have a premium buoyant feel./p>
                                <div class="c-m4__cta-wrap"><a href="cuddle-buddy.php" class="red-button sticky-mobile-glow w-button">View All Mattress</a></div>
                            </div>
                        </div>
                        <div class="c-m4__incidental"><img src="https://assets.website-files.com/5faabe4b6f6b4331a5f27952/5fb6ff852bc2fefd79f861b4_m4-tomato.png" loading="lazy" alt="" /></div>
                        <div class="c-m4__page-dots">
                            <div style="background-color: rgb(251, 173, 24);" class="c-m4__dot c-m4__dot-1"></div>
                            <div style="background-color: #84226d;" class="c-m4__dot c-m4__dot-2"></div>
                            <div style="background-color: #84226d;" class="c-m4__dot c-m4__dot-3"></div>
                            <div style="background-color: #84226d;" class="c-m4__dot c-m4__dot-3"></div>
                        </div>
                    </div>
                    <div class="c-m4__triggers">
                        <div data-w-id="01a2472f-4989-7db5-e9ec-9c30a75d5f87" class="c-m4__trigger c-m4__trigger-1"></div>
                        <div data-w-id="2778f472-9eee-a946-2b42-aa6a30bdcc51" class="c-m4__trigger c-m4__trigger-2"></div>
                        <div data-w-id="74d775d8-c252-a564-04cf-377ff9dca0ee" class="c-m4__trigger c-m4__trigger-3"></div>
                        <div data-w-id="74d775d8-c252-a564-04cf-377ff9dca0ee" class="c-m4__trigger c-m4__trigger-3"></div>
                    </div>
                    <div class="c-m4__products-wrap">
                        <div class="c-m4__product-wrapper">
                            <div class="c-m4__product-shot">
                                <img
                                    src="assets/images/mobile/1.png"
                                    loading="lazy"
                                    sizes="(max-width: 479px) 100vw, (max-width: 991px) 70vw, 740px"
                                    srcset="
                                        assets/images/mobile/1.png  500w,
                                        assets/images/mobile/1.png  1442w
                                    "
                                    alt=""
                                    class="c-m4__image"
                                />
                            </div>
                        </div>
                        <div class="c-m4__product-wrapper">
                            <div class="c-m4__product-shot">
                                <img
                                    src="assets/images/mobile/2.png"
                                    loading="lazy"
                                    sizes="(max-width: 479px) 100vw, (max-width: 991px) 70vw, 740px"
                                    srcset="
                                        assets/images/mobile/2.png  500w,
                                        assets/images/mobile/2.png  1442w
                                    "
                                    alt=""
                                    class="c-m4__image"
                                />
                            </div>
                        </div>
                        <div class="c-m4__product-wrapper">
                            <div class="c-m4__product-shot">
                                <a href="cuddle-buddy-latex-hrfoam.php">
                                <img
                                    src="assets/images/mobile/3.png"
                                    loading="lazy"
                                    sizes="(max-width: 479px) 100vw, (max-width: 991px) 70vw, 740px"
                                    srcset="
                                        assets/images/mobile/3.png  500w,
                                        assets/images/mobile/3.png  1442w
                                    "
                                    alt=""
                                    class="c-m4__image"
                                />
                            </a>
                        </div>
                    </div>
                        <div class="c-m4__product-wrapper">
                            <div class="c-m4__product-shot">
                                <img
                                    src="assets/images/mobile/4.png"
                                    loading="lazy"
                                    sizes="(max-width: 479px) 100vw, (max-width: 991px) 70vw, 740px"
                                    srcset="
                                        assets/images/mobile/4.png  500w,
                                        assets/images/mobile/4.png  1442w
                                    "
                                    alt=""
                                    class="c-m4__image"
                                />
                        </div>
                    </div>
                    <div class="w-embed"></div>
                </div>
            </div>
        </div> 
</div>

<div class="vc_row wpb_row vc_row-fluid top-slider vc_row-o-full-height vc_row-o-columns-middle vc_row-o-equal-height vc_row-flex hideonmobile" style="margin-bottom: 0;">
    <div class="wpb_column vc_column_container vc_col-sm-12">
        <div class="secslider vc_column-inner">
            <div class="wpb_wrapper">
                <script type="text/javascript" src="assets/plugins/revslider/public/assets/js/rbtools.min.js"></script>
                <script type="text/javascript" src="assets/plugins/revslider/public/assets/js/rs6.min.js"></script>
                <!-- START Slider 1 REVOLUTION SLIDER 6.4.6 -->
                <p class="rs-p-wp-fix"></p>
                <rs-module-wrap id="rev_slider_1_1_wrapper" data-source="gallery" style="background: transparent; padding: 0;">
    <rs-module id="rev_slider_1_1" style="" data-version="6.4.6">
        <rs-slides>
            <rs-slide data-key="rs-2" data-title="Slide" data-in="o:0;" data-out="a:false;" data-sloop="s:0;e:16000;">
                <img src="assets/plugins/revslider/public/assets/assets/transparent.png" alt="Slide" title="Home" data-parallax="off" data-no-retina class="rev-slidebg tp-rs-img no-lazyload" />
                <img src="assets/plugins/revslider/public/assets/assets/transparent.png" alt="Slide" title="Home" data-parallax="off" data-no-retina class="rev-slidebg tp-rs-img no-lazyload" />
                <!--
                            -->
                <rs-layer
                    id="slider-1-slide-2-layer-0"
                    data-type="image"
                    data-rsp_ch="on"
                    data-xy="x:r;xo:-150px,-150px,-425px,-262px;y:m;yo:0,0,84px,51px;"
                    data-text="w:normal;s:20,20,11,6;l:0,0,14,8;"
                    data-dim="w:943px,943px,555px,342px;h:648px,648px,381px,235px;"
                    data-frame_0="x:-50,-50,-28,-17;"
                    data-frame_1="st:1000;sp:1000;"
                    data-frame_999="x:-50,-50,-28,-17;o:0;st:6500;sp:1000;"
                    style="z-index: 10;"
                >
                    <a href="cuddle-buddy-hybrid.php"><img src="assets/images/01/hybrid.png" width="943" height="648" data-no-retina class="tp-rs-img no-lazyload" /></a>
                </rs-layer>

                <rs-layer
                    id="slider-1-slide-2-layer-5"
                    data-type="text"
                    data-color="#fff"
                    data-xy="yo:250px;"
                    data-text="w:normal;s:16,16,6,4;l:24,24,9,6;ls:2,2,0,0;"
                    data-dim="w:604.969px,604.969px,604px,604px;minh:0px,0px,none,none;"
                    data-rsp_o="off"
                    data-rsp_bd="off"
                    data-frame_0="x:-50;"
                    data-frame_1="st:500;sp:1000;"
                    data-frame_999="x:50;o:0;st:5000;sp:1000;"
                    style="z-index: 15; font-family: Poppins;"
                >
                    <div class="slider-caption">
                        <h1 style="font-weight: bold;">
                            Your Hybrid mattress buddy
                        </h1>
                        <p>
                            Cuddle Buddy here has a hybrid mattress range made with premium quality 100% pure cotton as top layer and Natural latex, which is two inches thick and has bottom layer pocketed springs. Its individually wrapped
                            pocketed springs provide better support to the back and have cottony latex foam so that you get supreme comfort
                        </p>
                        <p>The hybrid mattress has beautifully blended the latex and pocketed springs to control your motion during sleeping.</p>
                    </div>
                </rs-layer>
                <!--
                            -->
                <rs-layer
                    id="slider-1-slide-2-layer-6"
                    data-type="image"
                    data-rsp_ch="on"
                    data-xy="x:r;xo:-250px,-250px,-419px,-258px;y:m;yo:0,0,248px,153px;"
                    data-text="w:normal;s:20,20,11,6;l:0,0,14,8;"
                    data-dim="w:997px,997px,587px,362px;h:825px,825px,486px,299px;"
                    data-frame_0="x:-50,-50,-28,-17;"
                    data-frame_1="st:7500;sp:1000;"
                    data-frame_999="x:-50,-50,-28,-17;o:0;st:10000;sp:1000;"
                    style="z-index: 14;"
                >
                    <a href="cuddle-buddy-latex.php"><img src="assets/images/01/latex.png" width="707" height="585" data-no-retina class="tp-rs-img no-lazyload" /></a>
                </rs-layer>

                <!--
                            -->
                <rs-layer
                    id="slider-1-slide-2-layer-7"
                    data-type="text"
                    data-color="#fff"
                    data-xy="yo:200px;"
                    data-text="w:normal;s:16,16,6,4;l:24,24,9,6;ls:2,2,0,0;"
                    data-dim="w:609.094px,609.094px,609px,609px;minh:0px,0px,none,none;"
                    data-rsp_o="off"
                    data-rsp_bd="off"
                    data-frame_0="x:-50;"
                    data-frame_1="st:6000;sp:1000;"
                    data-frame_999="x:50;o:0;st:10000;sp:1000;"
                    style="z-index: 14; font-family: Poppins;"
                >
                    <div class="slider-caption">
                        <h2>
                            Your Eco mattress buddy
                        </h2>
                        <p>
                            For a peaceful sleep, an airy mattress is all you need. So, here Cuddle Buddy brings another exclusive range of 100 % pure Natural latex mattresses that make your sleep more relaxing and cozy. Pure natural Latex
                            mattress constructed with six inches of latex promises to improve your sleep and make it more comfortable.
                        </p>
                    </div>
                </rs-layer>
                <!--
                            -->
                <rs-layer
                    id="slider-1-slide-2-layer-8"
                    data-type="image"
                    data-rsp_ch="on"
                    data-xy="x:r;xo:-250px,-250px,-419px,-258px;y:m;yo:0,0,248px,153px;"
                    data-text="w:normal;s:20,20,11,6;l:0,0,14,8;"
                    data-dim="w:997px,997px,587px,362px;h:825px,825px,486px,299px;"
                    data-frame_0="x:-50,-50,-28,-17;"
                    data-frame_1="st:11000;sp:1000;"
                    data-frame_999="x:-50,-50,-28,-17;o:0;st:15000;sp:1000;"
                    style="z-index: 16;"
                >
                    <a href="cuddle-buddy-latex-hrfoam.php"><img src="assets/images/01/latexwithhr.png" width="707" height="585" data-no-retina class="tp-rs-img no-lazyload" /></a>
                </rs-layer>

                <rs-layer
                    id="slider-1-slide-2-layer-9"
                    data-type="text"
                    data-color="#fff"
                    data-xy="yo:270px;"
                    data-text="w:normal;s:16,16,6,4;l:24,24,9,6;ls:2,2,0,0;"
                    data-dim="w:628.703px,628.703px,628px,628px;minh:0px,0px,none,none;"
                    data-rsp_o="off"
                    data-rsp_bd="off"
                    data-frame_0="x:-50;"
                    data-frame_1="st:11000;sp:1000;"
                    data-frame_999="x:50;o:0;st:15000;sp:1000;"
                    style="z-index: 13; font-family: Poppins;"
                >
                    <div class="slider-caption">
                        <h2>
                            Your Natural Budget Friendly mattress buddy
                        </h2>
                        <p>
                            Natural Latex with HR foam mattress is not just great for sleep but also excellent to support your back. That's why Cuddle Buddy comes with a whole new range of India 1st complete natural mattress latex with PU
                            HR foam mattresses made with 100% pure natural latex and premium quality organic cotton fabric
                        </p>
                    </div>
                </rs-layer>
                <!--
-->
            </rs-slide>
        </rs-slides>
    </rs-module>
</rs-module-wrap>

                    <script type="text/javascript">
                        setREVStartSize({
                            c: "rev_slider_1_1",
                            rl: [1240, 1240, 778, 480],
                            el: [900, 900, 960, 720],
                            gw: [1320, 1320, 778, 480],
                            gh: [900, 900, 960, 720],
                            type: "standard",
                            justify: "",
                            layout: "fullscreen",
                            offsetContainer: "",
                            offset: "",
                            mh: "0",
                        });
                        var revapi1, tpj;
                        function revinit_revslider11() {
                            jQuery(function () {
                                tpj = jQuery;
                                revapi1 = tpj("#rev_slider_1_1");
                                tpj.noConflict();
                                if (revapi1 == undefined || revapi1.revolution == undefined) {
                                    revslider_showDoubleJqueryError("rev_slider_1_1");
                                } else {
                                    revapi1.revolution({
                                        DPR: "dpr",
                                        sliderLayout: "fullscreen",
                                        duration: "16000ms",
                                        visibilityLevels: "1240,1240,778,480",
                                        gridwidth: "1320,1320,778,480",
                                        gridheight: "900,900,960,720",
                                        perspective: 600,
                                        perspectiveType: "global",
                                        editorheight: "900,768,960,720",
                                        responsiveLevels: "1240,1240,778,480",
                                        progressBar: { disableProgressBar: true },
                                        navigation: {
                                            onHoverStop: false,
                                        },
                                        parallax: {
                                            levels: [5, 10, 15, 20, 25, 30, 35, 40, 45, 46, 47, 48, 49, 50, 51, 30],
                                            type: "mouse",
                                            origo: "slidercenter",
                                            speed: 0,
                                        },
                                        fallbacks: {
                                            allowHTML5AutoPlayOnAndroid: true,
                                        },
                                    });
                                }
                            });
                        } // End of RevInitScript
                        var once_revslider11 = false;
                        if (document.readyState === "loading") {
                            document.addEventListener("readystatechange", function () {
                                if ((document.readyState === "interactive" || document.readyState === "complete") && !once_revslider11) {
                                    once_revslider11 = true;
                                    revinit_revslider11();
                                }
                            });
                        } else {
                            once_revslider11 = true;
                            revinit_revslider11();
                        }
                    </script>
                </rs-module-wrap>
                <!-- END REVOLUTION SLIDER -->
            </div>
        </div>
    </div>
</div>

<section class="classes-section" style="padding: 80px 0; background: #84226D; ">
    <div class="container container-lg">
        <div class="row">
            <div class="box column col-md-9 col-6 text-left">
                <div class="inner-container" data-eco-ben-modal="">
                    <p style="color: #FFF; font-size: 48px;margin-bottom: 20px;/* color: #67de0d; */text-transform: uppercase;line-height: 65px; font-weight: bold;">Be One of our Lucky 500 Buddies, Save Upto 25%, Shop Now </p>
                    <h1 class="mobile-bottom60" style="color: #FFF; font-size:33px;">- INDIA's 1<sup>st</sup> All Natural Mattress</h1>

                </div>
            </div>
            <div class="box column col-md-3 col-6 text-center" style="align-self: center;">
                <div class="inner-container" data-eco-ben-modal="" style="font-size: 90px; color: #FFF; font-weight: bold; ">
                    499
                    <p style="font-size: 17px; margin-top: 39px; color: #FFF;">only available</p>
                </div>
            </div>
        </div>
    </div>
</section>

    <div class="vc_row wpb_row vc_row-fluid homework-div vc_custom_1609514869134 vc_row-has-fill">
                                        <div class="wpb_column vc_column_container vc_col-sm-12">
                                            <div class="vc_column-inner">
                                                <div class="wpb_wrapper">
                                                    <div class="vc_row wpb_row vc_inner vc_row-fluid containerfull vc-cont">
                                                        <div class="wpb_column vc_column_container vc_col-sm-12">
                                                            <div class="vc_column-inner">
                                                                <div class="wpb_wrapper">
                                                                    <div class="wpb_text_column wpb_content_element Works-text-top">
                                                                        <div class="wpb_wrapper">
                                                                            <div class="owl-carousel owl-theme dportfolio">
                                                                                <div class="item">
                                                                                    <a href="cuddle-buddy.php" rel="tag">
                                                                                    <div class="project-info">
                                                                                        <div class="img-thumbnail" style="background-image: url(assets/images/hybrid.png);"></div>
                                                                                        <div class="detaiimages">
                                                                                            <span>
                                                                                                <span class="portfolio-item">Cuddle Buddy</span>
                                                                                            </span>
                                                                                            <h2 class="entry-title" style="color: #000;">Organic Luxury Hybrid</h2>
                                                                                            <div class="detai"></div>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                                </div>
                                                                                <div class="item">
                                                                                    <a href="cuddle-buddy.php" rel="tag">
                                                                                    <div class="project-info">
                                                                                        <div class="img-thumbnail" style="background-image: url(assets/images/latex.png);"></div>
                                                                                        <div class="detaiimages">
                                                                                            <span>
                                                                                                <span class="portfolio-item">Cuddle Buddy</span>
                                                                                            </span>
                                                                                            <h2 class="entry-title" style="color: #000;">Organic Latex</h2>
                                                                                            <div class="detai"></div>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                                </div>
                                                                                <div class="item">
                                                                                    <a href="cuddle-buddy.php" rel="tag">
                                                                                    <div class="project-info">
                                                                                        <div class="img-thumbnail" style="background-image: url(assets/images/latexhr.png);"></div>
                                                                                        <div class="detaiimages">
                                                                                            <span>
                                                                                                <span class="portfolio-item">Cuddle Buddy</span>
                                                                                            </span>
                                                                                            <h2 class="entry-title" style="color: #000;">Eco Cloud</h2>
                                                                                            <div class="detai"></div>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                                </div>
                                                                                <div class="item">
                                                                                    <a href="contour-pillow.php" rel="tag">
                                                                                    <div class="project-info">
                                                                                        <div class="img-thumbnail" style="background-image: url(images/products/accessories/contour-pillow.png);"></div>
                                                                                        <div class="detaiimages">
                                                                                            <span>
                                                                                                <span class="portfolio-item">Accessories</span>
                                                                                            </span>
                                                                                            <h2 class="entry-title" style="color: #000;">Contour Pillow</h2>
                                                                                            <div class="detai"></div>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                                </div>
                                                                                <div class="item">
                                                                                    <a href="soap-pillow.php" rel="tag">
                                                                                    <div class="project-info">
                                                                                        <div class="img-thumbnail" style="background-image: url(images/products/accessories/soap-pillow.png);"></div>
                                                                                        <div class="detaiimages">
                                                                                            <span>
                                                                                                <span class="portfolio-item">Accessories</span>
                                                                                            </span>
                                                                                            <h2 class="entry-title" style="color: #000;">Soap Pillow</h2>
                                                                                            <div class="detai"></div>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
    <!-- main-slider -->


    <!-- main-slider end -->
<div class="container">
<div class="video-container">
  <iframe src="https://www.youtube.com/embed/OrWygtSDCKA?rel=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
</div>
</div>




    <div class="vc_row wpb_row vc_row-fluid home-testimonials-div vc_custom_1609515743268 vc_row-has-fill">
    <div class="wpb_column vc_column_container vc_col-sm-12">
        <div class="vc_column-inner">
            <div class="wpb_wrapper">
                <div class="wpb_row vc_inner vc_row-fluid container vc-cont">
                    <div class="wpb_column vc_column_container col-sm-7">
                        <div class="vc_column-inner">
                            <div class="wpb_wrapper">
                                <div class="wpb_text_column wpb_content_element more-2000-clients-text home-testimonials-text">
                                    <div class="wpb_wrapper">
                                        <h3>Trusted Clients</h3>
                                        <h2>
                                            Peoples who<br />
                                            make us Proud.
                                        </h2>
                                    </div>
                                </div>

                                <div class="wpb_text_column wpb_content_element dsktestimonials2">
                                    <div class="wpb_wrapper">
                                        <div class="owl-carousel owl-theme dtestimonial">
                                            <div class="item">
                                                <div class="single-testimonials">
                                                    <div class="detai">
                                                        The best service I had ever.I got my mattress in a very good condition after their service..thank you so much poppy..am really happy with your service
                                                    </div>
                                                    <div class="baneinfo">
                                                        <h2>Dazzling Pavi</h2>
                                                        <span></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="single-testimonials">
                                                    <div class="detai">
                                                        Last sunday i bought poppy mattress. Premium series spring mattress.   Its amazing good quality and good discount price.  Poppy mattress head quarters MD desk people good response for my mails. Good customer service. I like this product.  My best wishes to poppy mattress company.
                                                    </div>
                                                    <div class="baneinfo">
                                                        <h2>Gunasekar</h2>
                                                        <span></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="single-testimonials">
                                                    <div class="detai">
                                                        Best of custom Service mattress one of the highest quality I’ve seen ever best discount 15% made by online and immediately 24hrs delivery
                                                    </div>
                                                    <div class="baneinfo">
                                                        <h2>Ostin Marshal</h2>
                                                        <span></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="single-testimonials">
                                                    <div class="detai">
                                                        I have been using poopy matters for couple of month it feel soft and very comfortable . Spring quality also good not so light also not hard.
                                                    </div>
                                                    <div class="baneinfo">
                                                        <h2>Prince Ela</h2>
                                                        <span></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="single-testimonials">
                                                    <div class="detai">
                                                        Excellent
                                                    </div>
                                                    <div class="baneinfo">
                                                        <h2>Renu Gopal</h2>
                                                        <span></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="single-testimonials">
                                                    <div class="detai">
                                                        Superb quality, best price
                                                    </div>
                                                    <div class="baneinfo">
                                                        <h2>Mohammed Nadeem</h2>
                                                        <span></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    <!-- main-footer -->
    <?php include("inc/footer.php"); ?>
    <!-- main-footer end -->


        <script src="assets/style/owlcarousel/owl.carousel.js"></script>
        <script src="assets/style/js/jquery-custom.js"></script>
        <script src="assets/style/gsap/minified/gsap.min.js"></script>
        <script src="assets/style/colorbox/jquery.colorbox.js"></script>
<!-- main-js -->
<script src="js/script.js"></script>

<script src="vendor/slider/webflow.7ca1ed32e.js" type="text/javascript"></script>

<script type="text/javascript" src="vendor/slick/slick.min.js"></script>
<script src="vendor/bootstrap-select/js/bootstrap-select.min.js"></script>

<script type="text/javascript">

function subscribe(){ 
    
    var subs_value=$("#subs_value").val();
    var mobileno='';
    var emailid='';
    var re = /\S+@\S+\.\S+/;
    var error=0;
    
    if(subs_value==''){ error=1;
        $("#subs_error").html('* Enter your details');
        $("#subs_error").show();
    } else {

        if(subs_value.match(/^\d+/)){
            if(subs_value.length>0 && subs_value.length!=10) { error=1; user=1; console.log("Mobile");
                $("#subs_error").html('* Enter valid 10 Digit Mobile No');
                $("#subs_error").show();
            } else {
                mobileno=subs_value;
                emailid='';
            }
        } else { 

            if(subs_value!="" && !re.test(subs_value)){  user=1; error=1; console.log("Email");
                $("#subs_error").html('* Enter Valid Email ID');
                $("#subs_error").show();
            } else {
                emailid=subs_value;
                mobileno='';
            }
        }
    }

 if(error==0){ 
        $.ajax({
            url: 'lib/ajax.php',
            type: 'post',
            data: { 'type' : 'subscription', 'mobileno' : mobileno, 'emailid' : emailid},
                beforeSend: function(){
                },
            success: function(obj) { 
                    data = jQuery.parseJSON(obj);
                    if(data['status']=='success'){
                        $("#subs_error").html('Subscribed Successfully!!!');
                        $("#subs_error").show(); 
                        $("#subs_value").val('');                       
                        toastr.success("Thanks for your subscription","");
                    } else {
                        $("#subs_error").html('You Already Subscribed with Us');
                        $("#subs_error").show();
                    }
                }
          });
    }

}
</script>


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
