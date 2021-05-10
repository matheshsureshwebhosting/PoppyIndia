<header class="main-header">

<?php $misc=$objMain->getRow("select * from miscellaneous where id=1 and type_value!=''");
                        if(!empty($misc)){ ?>
		<div class="header-top" style="background: #84226D; text-align: center;line-height: 18px;">
            <div class="container">
                <div class="inner-container clearfix">
                    <p style="color: #FFF; font-family: 'Montserrat', sans-serif;">
                        
                           <?php if($misc['type_value']!='') echo $misc['type_value']; ?> <br>
                           <span style="color:#FF9800; font-size:13px;">Delivery across South India.</span>
                    </p>
                </div>
            </div>
        </div>

    <?php } ?>

        <div class="header-top">
            <div class="container">
                <div class="inner-container clearfix">
                    <div class="social-links pull-left">
                        <ul class="social-list">
                           
                            <li> <a href="#"><i class="fas fa-phone"></i> +91 96429 11441</a> </li>
                        </ul>
                    </div>
                    <div class="header-info pull-right">
                        <ul class="info-list">
                            <li> <a href="tracking.php">Track Order</a> </li>
                            <li> <a href="faq.php">FAQs</a> </li>
                            <?php if(isset($_SESSION['userid']) && $_SESSION['userid']!="") {
$usr=$objMain->getRow("select * from customers where id=".$_SESSION['userid']);
                             ?>
                                <li style="background: #84226D; border-radius: 6px; padding-right: 10px; ">
                                    <i class="fas fa-user" style="color: #FFF;"></i> 
                                    <a href="dashboard.php" style="color: #FFF;"> Hi ! <?php echo $usr['customer_name']; ?></a>
                                </li>
                            <?php } else {  ?>
                                <li style="background: #84226D; border-radius: 6px; padding-right: 10px; ">
                                    <i class="fas fa-user" style="color: #FFF;"></i> 
                                    <a href="login.php" style="color: #FFF;">Sign in</a>
                                </li>
                                <li style="background: #84226D; border-radius: 6px; padding-right: 10px; ">
                                    <i class="fas fa-user-plus" style="color: #FFF;"></i> 
                                    <a href="register.php" style="color: #FFF;">Sign Up</a>
                                </li>
                            <?php } ?>

                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="header-bottom">
            <div class="container">
                <div class="clearfix">
                    <div class="logo-box pull-left">
                        <figure class="logo"><a href="index.php"><img src="images/logo.png" alt="" style="height: 64px;"></a></figure>
                    </div>
                    <div class="nav-outer pull-right clearfix">
                        <div class="menu-area">
                            <nav class="main-menu navbar-expand-lg">
                                <div class="navbar-header">
                                    <!-- Toggle Button -->      
                                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    </button>
                                </div>
                                <div class="navbar-collapse collapse clearfix">
                                    <ul class="navigation clearfix">
                                        <li class="dropdown children"><a href="#">Mattress</a>
                                            <ul>
                                                <li><a href="grand-series.php">Grand Series</a></li>
                                                <li><a href="premium-series.php">Premium Series</a></li>
                                                <li><a href="medico-series.php">Medico Series</a></li>
                                                <li><a href="pu-foam-series.php">PU Foam Series</a></li>
                                                <li><a href="rubberized-coir-series.php">Rubberized Coir Series</a></li>
                                            </li>
                                            </ul>
                                        </li>
                                        <li class="dropdown children"><a href="#">Pillow</a>
                                            <ul>
                                                <li><a href="neck-defender.php">Neck Defender</a></li>
                                                <li><a href="pu-foam-pillows.php">PU foam pillows</a></li>
                                                <li><a href="micro-fiber-pillow.php">Micro Fiber Pillow</a></li>
                                                <li><a href="polyester-fiber-pillow.php">Polyester Fiber Pillow</a></li>
                                            </ul>
                                        </li> 
                                        <li class="dropdown children"><a href="#">Accessories</a>
                                            <ul>
                                                <li><a href="comforter.php">Comforter</a></li>
                                                <li><a href="protector.php">Protector</a></li>
                                                <li><a href="bedspreads.php">Bedspreads</a></li>
                                            </ul>
                                        </li> 
                                        <li><a href="aboutus.php">Our Story</a></li>
                                        <li class="mobilemenu"><a href="tracking.php">Track Order</a></li>
                                        <li class="mobilemenu"><a href="faq.php">FAQ</a></li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                        <div class="outer-box">
                            <ul class="outer-content">
                                <li><a href="cart.php"><i class="fas fa-shopping-cart"></i>
                                    <span id="cart_top"><?php if(isset($_SESSION['total_qty']) && $_SESSION['total_qty']!=0) echo $_SESSION['total_qty']; ?></span></a></li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Sticky Header-->
        <div class="sticky-header">
        	<div class="header-top">
            <div class="container">
                <div class="inner-container clearfix">
                    <div class="social-links pull-left">
                        <ul class="social-list">
                           
                            <li> <a href="#"><i class="fas fa-phone"></i> +91 96429 11441</a> </li>
                        </ul>
                    </div>
                    <div class="header-info pull-right">
                        <ul class="info-list">
                            <li> <a href="tracking.php">Track Order</a> </li>
                            <li> <a href="faq.php">FAQs</a> </li>
                            <?php if(isset($_SESSION['userid']) && $_SESSION['userid']!="") {
$usr=$objMain->getRow("select * from customers where id=".$_SESSION['userid']);
                             ?>
                                <li style="background: #84226D; border-radius: 6px; padding-right: 10px; ">
                                    <i class="fas fa-user" style="color: #FFF;"></i> 
                                    <a href="dashboard.php" style="color: #FFF;"> Hi ! <?php echo $usr['customer_name']; ?></a>
                                </li>
                            <?php } else {  ?>
                                <li style="background: #84226D; border-radius: 6px; padding-right: 10px; ">
                                    <i class="fas fa-user" style="color: #FFF;"></i> 
                                    <a href="login.php" style="color: #FFF;">Sign in</a>
                                </li>
                                <li style="background: #84226D; border-radius: 6px; padding-right: 10px; ">
                                    <i class="fas fa-user-plus" style="color: #FFF;"></i> 
                                    <a href="register.php" style="color: #FFF;">Sign Up</a>
                                </li>
                            <?php } ?>
                            

                        </ul>
                    </div>
                </div>
            </div>
        </div>
            <div class="container clearfix">
                <figure class="logo-box"><a href="index.php"><img src="images/logo.png" alt="" style="height: 39px;"></a></figure>
                <div class="menu-area">
                    <nav class="main-menu navbar-expand-lg">
                        <div class="navbar-header">
                            <!-- Toggle Button -->      
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="navbar-collapse collapse clearfix">
                            <ul class="navigation clearfix">
                               <li class="dropdown children"><a href="#">Mattress</a>
                                            <ul>
                                                <li><a href="grand-series.php">Grand Series</a></li>
                                                <li><a href="premium-series.php">Premium Series</a></li>
                                                <li><a href="medico-series.php">Medico Series</a></li>
                                                <li><a href="pu-foam-series.php">PU Foam Series</a></li>
                                                <li><a href="rubberized-coir-series.php">Rubberized Coir Series</a></li>
                                            </li>
                                            </ul>
                                        </li>
                                        <li class="dropdown children"><a href="#">Pillow</a>
                                            <ul>
                                                <li><a href="neck-defender.php">Neck Defender</a></li>
                                                <li><a href="pu-foam-pillows.php">PU foam pillows</a></li>
                                                <li><a href="micro-fiber-pillow.php">Micro Fiber Pillow</a></li>
                                                <li><a href="polyester-fiber-pillow.php">Polyester Fiber Pillow</a></li>
                                            </ul>
                                        </li> 
                                        <li class="dropdown children"><a href="#">Accessories</a>
                                            <ul>
                                                <li><a href="comforter.php">Comforter</a></li>
                                                <li><a href="protector.php">Protector</a></li>
                                                <li><a href="bedspreads.php">Bedspreads</a></li>
                                            </ul>
                                        </li> 
                                        <li><a href="aboutus.php">Our Story</a></li>
                                        <li class="mobilemenu"><a href="tracking.php">Track Order</a></li>
                                        <li class="mobilemenu"><a href="faq.php">FAQ</a></li>
                                        <li><a href="cart.php"><i class="fas fa-shopping-cart"></i>
                                    <span id="cart_bottom"><?php if(isset($_SESSION['total_qty']) && $_SESSION['total_qty']!=0) echo $_SESSION['total_qty']; ?></span></a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div><!-- sticky-header end -->
    </header>
