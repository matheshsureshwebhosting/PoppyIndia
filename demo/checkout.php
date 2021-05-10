<?php include("lib/common.php");
if(isset($_SESSION['userid'])) { 
    $usr=$objMain->getRow("select * from customers where id=".$_SESSION['userid']);
    $name=$usr['customer_name'];
    $mobileno=$usr['mobileno'];
    $address=$usr['address'];
    $emailid=$usr['emailid'];
    $city=$usr['city'];
    $state=$usr['state'];
    $pincode=$usr['pincode'];
} else {
    $name='';
    $mobileno='';
    $emailid='';
    $address='';
    $city='';
    $state='';
    $pincode='';
}
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

<title>Checkout : Buy Mattress Online - India&#039;s Best Mattress Brand</title>

<!-- Stylesheets -->
<link href="css/style.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">
    <link rel="icon" href="images/favicon.png">
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
    <section class="checkout-section">
        <div class="container">
            <?php if(!isset($_SESSION['userid'])) { ?>
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 customer-column">
                    <div class="customer">Returning Customer? <a href="login.php">Click here to Login</a></div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 coupon-column">
                    
                </div>
            </div>
        <?php } ?>
        <form method="post" action="init.php?module=user&action=checkout" id="checkout_from">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-sm-12 left-column">
                    <div class="inner-box">
                        <div class="billing-info">
                            <h4 class="sub-title"><?php if(isset($_SESSION['userid'])) { echo "Shipping"; } else echo "Billing"; ?> Details</h4>
                            <div class="billing-form">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <label>Name*</label>
                                        <div class="field-input">
                                            <input type="text" name="username" id="username" value="<?php echo $name; ?>">
                                            <label class="error" id="name_error" style="display: none;">* Enter Name</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <label>Phone Number*</label>
                                        <div class="field-input">
                                            <input type="text" name="mobileno" id="mobileno" class="mobile" value="<?php echo $mobileno; ?>">
                                            <label class="error" id="mobileno_error" style="display: none;">* Enter 10 Digit Mobile No</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <label>Email ID</label>
                                        <div class="field-input">
                                            <input type="text" name="emailid" id="emailid"  value="<?php echo $emailid; ?>">
                                            <label class="error" id="email_error" style="display: none;">* Enter Valid Email ID</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <label>Alternative Phone Number</label>
                                        <div class="field-input">
                                            <input type="text" name="mobileno_alt" id="mobileno_alt" class="mobile">
                                            
                                            <label class="error" id="mobilenoalt_error" style="display: none;">* Enter 10 Digit Mobile No</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <label>Address*</label>
                                        <div class="field-input">
                                            <textarea name="address" id="address" class="address"><?php echo $address; ?></textarea>
                                            <label class="error" id="address_error" style="display: none;">* Enter Address</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <label>Town/City*</label>
                                        <div class="field-input">
                                            <input type="text" name="city" id="city" value="<?php echo $city; ?>">
                                            <label class="error" id="city_error" style="display: none;">* Enter City</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <label>State*</label>
                                        <div class="select-column select-box">
                                            <select class="selectmenu" id="ui-id-2" style="display: none;" id="state" name="state">
                                                <?php $locations=$objMain->getResults("select * from location where parent_id=0 order by sort_order, location_name"); 
                                                if(!empty($locations)){
                                                    foreach($locations as $location){ ?>
                                                        <option <?php if($location['location_name']==$state) echo "selected"; ?>><?php echo $location['location_name']; ?></option>
                                                 <?php   }
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <label>Zip Code*</label>
                                        <div class="field-input">
                                            <input type="text" name="pincode" id="pincode" class="pincode" value="<?php echo $pincode; ?>">
                                            <label class="error" id="pincode_error" style="display: none;">* Enter 6 Digit Pincode</label>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
                <div class="col-lg-8 col-md-12 col-sm-12 right-column">
                    <div class="inner-box">
                        <div class="order-info">
                            <h4 class="sub-title">Your Order</h4>
                            <div class="order-product">
                                <?php $order_total=0;
if(isset($_SESSION['items']) || count($_SESSION['items'])>0){ 
                                foreach($_SESSION['items'] as $key=>$item){       

           $product=$objMain->getRow("select * from product where id=".$item['productid']);
            $category=$objMain->getRow("select * from category where id=".$product['category']);
            if($category['parent_id']!=0){
                $parent=$objMain->getRow("select * from category where id=".$category['parent_id']);
                $category_name=$parent['category_name']." / ".$category['category_name'];
            } else $category_name=$category['category_name'];

if($product['category']!=15){
if($item['product_type']=='normal'){            
            $product_size=$objMain->getRow("select * from product_price where id=".$item['product_size']);
            $prod_size=$product_size['size_name']." - ".$product_size['size_inch_w']." x ".$product_size['size_inch_b']." in | ".$product_size['size_mm_w']." x ".$product_size['size_mm_b']." mm  X ".$item['dimension'];
        } else if($item['product_type']=='custom'){
            $prod_size="Custom Size : ".$item['custom_length']." in X ".$item['custom_width']." in";
        }
} else {
    $prod_size='';
}
            $order_total+=$item['qty']*$item['price'];

             ?>
                                <div class="row col-lg-12 singleproduct checkout" id="product_<?php echo $key; ?>" style="padding: 0;">
                            <div class="col-lg-7 prod-column">
                                        <div class="single-item">
                                    <figure class="image-box"><a href="#"><img src="images/products/<?php echo $product['cover_image']; ?>" alt=""></a></figure>
                                    <div class="text clearfix">
                                        <h4>
                                                <?php echo $product['product_name']." ".$item['dimension']."\""; ?><br>
                                            <label style="font-size: 14px; color:#979191;"><?php echo $category_name; ?></label><br>
                                                <label style="font-size: 14px;"><?php echo $prod_size; ?></label>
                                                 <ul>
                                                 <?php 
                                                   if(!empty($product['product_colors'])){
                                                    ?>
                                                    <li>
                                                      <label>
                                                        <span class="swatch" style="background-color:<?=$item['product_color']?>"></span>
                                                      </label>
                                                    </li>
                                                  <?php } ?>
                                              </ul>
                                        </h4>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-xs-4 price">
                                ₹ <?php echo $objMain->INR($item['price']); ?>
                            </div>
                            <div class="col-lg-1 col-xs-2 qty">
                               X <?php echo $item['qty']; ?>
                            </div>
                            <div class="col-lg-2 col-xs-4 sub-total" id="product_total_<?php echo $key; ?>">
                               <span>₹ <?php echo $objMain->INR($item['qty']*$item['price']); ?></span>
                            </div>

                        </div>


                                <?php $freebis=$objMain->getResults("select * from product_free where parent_id=".$product['id']);
                                if(!empty($freebis)){
                                    foreach($freebis as $free){ 
                                         if($item['product_type']=='normal'){            
                $prod_size=$objMain->getRow("select * from product_price where id=".$item['product_size']);
                $free_size=$prod_size['size_inch_b'];
            } else {
                $free_size=$item['custom_width'];
            }

 if($item['product_type']=='normal'){            
            $prod1=$objMain->getRow("select * from product_free_cost where product_id=".$free['free_product_id']." and size_from <=".$prod_size['size_inch_w']." and size_to >=".$free_size);
             } else {
            $prod1=$objMain->getRow("select * from product_free_cost where product_id=".$free['free_product_id']." and size_from >=".$item['custom_length']." and size_to >=".$item['custom_width']);
            }

                                        $prod=$objMain->getRow("select * from product where id=".$free['free_product_id']);
                                        ?>

                                        <div class="row col-lg-12 singleproduct checkout product_<?php echo $key; ?>">
                            <div class="col-lg-7 prod-column">
                                        <div class="single-item">
                                    <figure class="image-box"><a href="#"><img src="images/products/<?php echo $prod['cover_image']; ?>" alt=""></a></figure>
                                    <div class="text clearfix">
                                        <h4>
                                                <?php echo $prod['product_name']." ".$item['dimension']."\""; ?><br>
                                           <span style="width: 100%;float: left;font-size: 14px;"><b style="color: #84226D;">FREE</b> for <?php echo $product['product_name']." ".$item['dimension']."\""; ?></span>
                                            <div class="colors">
                                                  <ul>
                                                 <?php 
                                                   if(!empty($prod1['product_colors'])){
                                                
                                                    ?>
                                                    <li>
                                                      <label>
                                                        <span class="swatch" style="background-color:<?=$item['product_free_color']?>"></span>
                                                      </label>
                                                    </li>
                                                  <?php } ?>
                                              </ul>
                                          </div>
                                        </h4>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-xs-4 price">
                                ₹ <?php echo $objMain->INR($prod1['cost']); ?>
                            </div>
                            <div class="col-lg-1 col-xs-2 qty">
                                X <?php echo $free['qty']*$item['qty']; ?>
                            </div>
                            <div class="col-lg-2 col-xs-4 sub-total">
                               <span>&nbsp;</span>
                            </div>

                        </div>

                                <?php } }?>    

                            <?php } } ?>
                                <div class="amount-box">
                                    <div class="text clearfix">
                                        <h4 style="width: 100%; <?php if(isset($_SESSION['discount_coupon'])) echo 'font-weight: normal; '; ?>">Order Total 
                                        <span class="order-parice pull-right">₹ <?php echo $objMain->INR($order_total); ?></span></h4>
                                    </div>
                                    <?php if(isset($_SESSION['discount_coupon'])) { ?>
                                    <div class="text clearfix">
                                        <h4 style="width: 100%; font-weight: normal;">Coupon Discount
                                        <span class="order-parice pull-right">₹ <?php echo $objMain->INR($_SESSION['discount_value']); ?></span></h4>
                                    </div>
                                    <div class="text clearfix">
                                        <h4 style="width: 100%;">Net Amount
                                        <span class="order-parice pull-right">₹ <?php echo $objMain->INR($_SESSION['net_amount']); ?></span></h4>
                                    </div>
                                <?php } ?>
                                </div>
                            </div>
                        </div>

                        <div class="additional-info">
                            <h4 class="sub-title">Additional Information</h4>
                            <div class="note-book">
                                <label>Order Notes</label>
                                <textarea name="order_notes" placeholder="Notes about your order, e.g. special notes for your delivery"></textarea>
                            </div>
                        </div>
                        <div class="order-btn pull-right" style="margin-top: 20px;"><button type="button" class="theme-btn" onclick="checkout();">Place Order</button></div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </section>
    <!-- shop-details end -->
<?php include("inc/footer.php"); ?>

<?php include("inc/footer_scripts.php"); ?>
<!--input mask-->
    <script src="vendor/input-mask/jquery.inputmask.bundle.js"></script>
    <script src="vendor/input-mask-init.js"></script>
<script type="text/javascript">
    function checkout(){
        $("#name_error").hide();
    $("#mobileno_error").hide();
    $("#mobilenoalt_error").hide();
    $("#address_error").hide();
    $("#city_error").hide();
    $("#email_error").hide();
    $("#pincode_error").hide();

    var re = /\S+@\S+\.\S+/;

    var name=$("#name").val();
    var mobileno=$("#mobileno").val(); 
    var mobileno_alt=$("#mobileno_alt").val();   
    var address=$("#address").val(); 
    var city=$("#city").val(); 
    var pincode=$("#pincode").val();    
    var emailid=$("#emailid").val();      
    mobileno=mobileno.replace("_", "");      
    mobileno_alt=mobileno_alt.replace("_", "");
    pincode=pincode.replace("_", "");



    var error=0;
    if(name==''){ error=1;
        $("#name_error").show();
    } 
    if(mobileno.length!=10) { error=1; 
        $("#mobileno_error").show();
    }
    if(mobileno_alt.length>0 && mobileno_alt.length!=10) { error=1; 
        $("#mobilenoalt_error").show();
    }
    if(address==''){ error=1;
        $("#address_error").show();
    } 
    if(city==''){ error=1;
        $("#city_error").show();
    } 
    if(pincode==''){ error=1;
        $("#city_error").show();
    } 
    if(pincode.length!=6) { error=1; 
        $("#pincode_error").show();
    }

    if(emailid!="" && !re.test(emailid)){  error=1;
        $("#email_error").show();
    }

    if(error==0) document.getElementById("checkout_from").submit();

    }
</script>
</body><!-- End of .page_wrapper -->

</html>