<?php include("lib/common.php");
$res=$objMain->getRow("select * from customers where id=".$_SESSION['userid']);
 ?>
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
                    <div class="col-lg-9 col-md-12 col-sm-12">
                    <?php
    if(isset($msg) && $msg=='success') { $atype="success";
    $msg='<i class="icon fa fa-thumbs-up"></i> Profile Updated Successfully'; }

  ?>
    <?php if(isset($msg)) { ?>
      <div class="alert alert-<?php echo $atype; ?> alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <p style="color: #FFF"><?php echo $msg; ?></p>
      </div>
          <?php } ?>
                    <div class="inner-box">
                            
                                <h3 class="sidebar-title" style=" padding-bottom: 10px;">My Profile</h3>
                            <form action="init.php?module=user&action=myprofile" method="post" class="general-form">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                                        <label>Name</label>
                                        <div class="field-input">
                                            <input type="text" name="customer_name" id="customer_name" required="" value="<?php echo $res['customer_name']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                                        <label>Mobile No</label>
                                        <div class="field-input">
                                            <input type="text" name="mobileno" id="mobileno" <?php if($res['mobileno']!='') echo 'disabled'; ?> value="<?php echo $res['mobileno']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                                        <label>Email ID</label>
                                        <div class="field-input">
                                            <input type="email" name="emailid" id="emailid" <?php if($res['emailid']!='') echo 'disabled'; ?> value="<?php echo $res['emailid']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <label>Address</label>
                                        <div class="field-input">
                                            <input type="text" name="address" id="address" value="<?php echo $res['address']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-12 form-group">
                                        <label>City</label>
                                        <div class="field-input">
                                            <input type="text" name="city" id="city" value="<?php echo $res['city']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 form-group">
                                        <label>State</label>
                                        <div class="field-input">
                                            <div class="select-column select-box">
                                            <select class="selectmenu" id="ui-id-2" style="display: none;" id="state" name="state">
                                                <?php $locations=$objMain->getResults("select * from location where parent_id=0 order by sort_order, location_name"); 
                                                if(!empty($locations)){
                                                    foreach($locations as $location){ ?>
                                                        <option <?php if($location['location_name']==$res['state']) echo "selected"; ?>><?php echo $location['location_name']; ?></option>
                                                 <?php   }
                                                } ?>
                                            </select>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 form-group">
                                        <label>Pincode</label>
                                        <div class="field-input">
                                            <input type="text" name="pincode" id="pincode" maxlength="6" value="<?php echo $res['pincode']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">

                                        <div class="subscriptionbox">
     <input type="checkbox" id="checkbox" name="checkbox" value="yes" <?php if($res['subscription']=='yes') echo 'checked=""'; ?>>
     <label for="checkbox"><span>I agree to subscribe to get latest offers</span></label>
  </div>

                                    </div>

                                    <div class="col-lg-6 form-group pull-right">
                                        <button type="submit" class="theme-btn pull-right">Submit</button></div>
                                    </div>
                                </div>
                            </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- shop-details end -->
<?php include("inc/footer.php"); ?>

<?php include("inc/footer_scripts.php"); ?>

</body><!-- End of .page_wrapper -->

</html>