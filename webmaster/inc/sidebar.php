<?php 
$mnu_master='';
$mnu_profile='';
$mnu_lead='';
$mnu_user='';
$mnu_payment="";
$mnu_ewallet='';
$mnu_epin="";
if($menu=='master') $mnu_master='active';
if($menu=='profile') $mnu_profile='active';
if($menu=='lead') $mnu_lead='active';
if($menu=='users') $mnu_user='active'; 
if($menu=='report') $mnu_report='active';
if($menu=='ewallet') $mnu_ewallet='active';
if($menu=='epin') $mnu_epin='active';  ?>
<div class="left-sidebar">
  
            <nav class="sidebar-menu">
                <ul id="nav-accordion">

                    <li class="sub-menu">
                        <a href="dashboard.php">
                            <i class="ti-home"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="sub-menu">
                        <a href="orders.php">
                            <i class="ti-printer"></i>
                            <span>Orders</span>
                        </a>
                    </li>

                    <li class="sub-menu">
                        <a href="orders.php?category=cancel-request">
                            <i class="ti-na"></i>
                            <span>Cancel Request</span>
                        </a>
                    </li>

                    <li class="sub-menu">
                        <a href="customers.php">
                            <i class="ti-user"></i>
                            <span>Customers</span>
                        </a>
                    </li>

                    <li class="sub-menu">
                        <a href="subscriptions.php">
                            <i class="ti-pencil-alt"></i>
                            <span>Subscribers</span>
                        </a>
                    </li>
                    
                    
                    <li class="sub-menu">
                        <a href="change_password.php">
                            <i class=" ti-lock"></i>
                            <span>Change Password</span>
                        </a>
                    </li>

                    <li class="nav-title">
                        <h5 class="text-uppercase">Promotion</h5>
                    </li>


                    <li class="sub-menu">
                        <a href="slider.php">
                            <i class="ti-image"></i>
                            <span>Slider</span>
                        </a>
                    </li>
                    
                    
                    <li class="sub-menu">
                        <a href="pages.php">
                            <i class=" ti-notepad"></i>
                            <span>Pages</span>
                        </a>
                    </li>
                    
                    <li class="sub-menu">
                        <a href="products.php">
                            <i class="ti-envelope"></i>
                            <span>Products</span>
                        </a>
                    </li>

                    <li class="sub-menu">
                        <a href="coupons.php">
                            <i class="ti-gift"></i>
                            <span>Coupons</span>
                        </a>
                    </li>

                    <li class="sub-menu">
                        <a href="miscellaneous.php">
                            <i class="ti-wallet"></i>
                            <span>Top News</span>
                        </a>
                    </li>

                    <li class="nav-title">
                        <h5 class="text-uppercase">Reports</h5>
                    </li>
                   

                    <li class="sub-menu">
                        <a href="report_orders.php">
                            <i class="ti-agenda"></i>
                            <span>Orders</span>
                        </a>
                    </li>


                    <li class="sub-menu">
                        <a href="report_customers.php">
                            <i class=" ti-agenda"></i>
                            <span>Customers</span>
                        </a>
                    </li>


                    <li class="sub-menu">
                        <a href="report_subscribers.php">
                            <i class=" ti-agenda"></i>
                            <span>Subscribers</span>
                        </a>
                    </li>

                    <li class="sub-menu">
                        <a href="init.php?module=login&action=logout">
                            <i class=" ti-shift-left-alt"></i>
                            <span>Logout</span>
                        </a>
                    </li>
                    
                </ul>
            </nav>
            
        </div>
        