<?php include("lib/common.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

<title>Cart : Buy Mattress Online - India&#039;s Best Mattress Brand</title>

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
    <section class="checkout-section cart-page">
        <div class="container">
            <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12 table-column order-info " style="padding: 0;">
                     <?php $order_total=0;
if(isset($_SESSION['items']) && count($_SESSION['items'])>0){ ?>
                    <div class="order-product" style="padding: 0;">

                        <div class="row col-lg-12 cart-header hideonmobile">
                            <div class="col-lg-7">
                                Products
                            </div>
                            <div class="col-lg-1">
                                Price
                            </div>
                            <div class="col-lg-1">
                                Qty
                            </div>
                            <div class="col-lg-2">
                                Total
                            </div>

                        </div>
 
                                <?php
                                foreach($_SESSION['items'] as $key=>$item){   

                                $product=$objMain->getRow("select * from product where id=".$item['productid']);
            $category=$objMain->getRow("select * from category where id=".$product['category']);
            if($category['parent_id']!=0){
                $parent=$objMain->getRow("select * from category where id=".$category['parent_id']);
                $category_name=$parent['category_name']." / ".$category['category_name'];
            } else $category_name=$category['category_name'];

if($item['product_type']=='normal'){            
            $product_size=$objMain->getRow("select * from product_price where id=".$item['product_size']);
            $prod_size=$product_size['size_name']." - ".$product_size['size_inch_w']." x ".$product_size['size_inch_b']." in | ".$product_size['size_mm_w']." x ".$product_size['size_mm_b']." mm  X ".$item['dimension'];
        } else if($item['product_type']=='custom'){
            $prod_size="Custom Size : ".$item['custom_length']." in X ".$item['custom_width']." in";
        }
            $order_total+=$item['qty']*$item['price'];
             ?>



             <div class="row col-lg-12 singleproduct" id="product_<?php echo $key; ?>">
                            <div class="col-lg-7 prod-column">
                                        <div class="single-item">
                                    <figure class="image-box"><a href="#"><img src="images/products/<?php echo $product['cover_image']; ?>" alt=""></a></figure>
                                    <div class="text clearfix">
                                        <h4>
                                                <?php echo $product['product_name']." ".$item['dimension']."\""; ?><br>
                                            <label style="font-size: 14px; color:#979191;"><?php echo $category_name; ?></label><br>
                                                <label style="font-size: 14px;"><?php echo $prod_size; ?></label>
                                        </h4>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1 col-xs-4 price">
                                ₹ <?php echo $objMain->INR($item['price']); ?>
                            </div>
                            <div class="col-lg-1 col-xs-2 qty">
                                <input type="number" placeholder="Qty" value="<?php echo $item['qty']; ?>" min="1" onchange="updatecart(<?php echo $item['productid']; ?>,<?php echo $key; ?>,this.value);">
                                <input type="hidden" name="product_price_<?php echo $key; ?>" id="product_price_<?php echo $key; ?>" value="<?php echo $product['product_price']; ?>">
                            </div>
                            <div class="col-lg-2 col-xs-4 sub-total" id="product_total_<?php echo $key; ?>">
                               <span>₹ <?php echo $objMain->INR($item['qty']*$item['price']); ?></span>
                            </div>
                            <div class="col-lg-1 col-xs-2">
                                <div class="remove">
                                            <span onclick="removecart(<?php echo $key; ?>);"><i class="flaticon-cancel"></i></span>
                                        </div>
                            </div>

                        </div>

                        <?php $freebis=$objMain->getResults("select * from product_free where parent_id=".$product['id']);
                                if(!empty($freebis)){ $free_id=0;
                                    foreach($freebis as $free){ $free_id++;

                                        if($item['product_type']=='normal'){            
                $prod_size=$objMain->getRow("select * from product_price where id=".$item['product_size']);
                $free_size=$prod_size['size_inch_b'];
            } else {
                $free_size=$item['custom_width'];
            }

            $prod1=$objMain->getRow("select * from product_free_cost where product_id=".$free['free_product_id']." and size_from<=".$free_size." and size_to>=".$free_size);


                                        $prod=$objMain->getRow("select * from product where id=".$free['free_product_id']);
                                        ?>

                                        <div class="row col-lg-12 singleproduct product_<?php echo $key; ?>">
                            <div class="col-lg-7 prod-column">
                                        <div class="single-item">
                                    <figure class="image-box"><a href="#"><img src="images/products/<?php echo $prod['cover_image']; ?>" alt=""></a></figure>
                                    <div class="text clearfix">
                                        <h4>
                                                <?php echo $prod['product_name']." ".$item['dimension']."\""; ?><br>
                                            <span style="width: 100%;float: left;font-size: 14px;"><b style="color: #84226D;">FREE</b> for <?php echo $product['product_name']." ".$item['dimension']."\""; ?></span>
                                        </h4>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1 col-xs-4 price">
                                ₹ <?php echo $objMain->INR($prod1['cost']); ?>
                            </div>
                            <div class="col-lg-1 col-xs-2 qty">
                                <input type="text" placeholder="Qty" value="<?php echo $free['qty']*$item['qty']; ?>" min="1" id="free_<?php echo $free_id; ?>_<?php echo $key; ?>">
                                        <input type="hidden" value="<?php echo $prod1['cost']; ?>">
                            </div>
                            <div class="col-lg-2 col-xs-4 sub-total">
                               <span>&nbsp;</span>
                            </div>
                            <div class="col-lg-1 col-xs-2">
                                
                            </div>

                        </div>

                    <?php }} ?>


           <?php }  ?>

           <div class="row col-lg-12 singleproduct <?php if(!isset($_SESSION['discount_coupon'])) echo ''; else echo "last" ?>">
                            <div class="col-lg-7 prod-column hidemobile">
                                 &nbsp;
                            </div>
                            <div class="col-lg-2 col-xs-6 qty" style="color: #2b3c6b; font-weight: bold; text-align: right;">
                                Order Total :
                            </div>
                            <div class="col-lg-2 col-xs-6 sub-total"id="sub_total" style=" text-align: right;">₹ <?php echo $objMain->INR($order_total); ?>
                            </div>
            </div>

            <div class="row col-lg-12 singleproduct last" id="coupon_det" style="<?php if(!isset($_SESSION['discount_coupon'])) echo 'display: none;'; ?>">
                            <div class="col-lg-7 prod-column hidemobile">
                                 &nbsp;
                            </div>
                            <div class="col-lg-2 col-xs-6 qty" style="color: #2b3c6b; font-weight: bold; text-align: right;">
                                Coupon (<span id="coupon_code"><?php if(isset($_SESSION['discount_coupon'])) echo $_SESSION['discount_coupon']; ?></span>) :
                            </div>
                            <div class="col-lg-2 col-xs-6 sub-total"id="sub_total" style=" text-align: right;">
                                ₹ <span id="discount_value"><?php if(isset($_SESSION['discount_coupon'])) echo $objMain->INR($_SESSION['discount_value']); ?></span>
                            </div>
            </div>

            <div class="row col-lg-12 singleproduct" id="net_det" style="<?php if(!isset($_SESSION['discount_coupon'])) echo 'display: none;'; ?>">
                            <div class="col-lg-7 prod-column hidemobile">
                                 &nbsp;
                            </div>
                            <div class="col-lg-2 col-xs-6 qty" style="color: #2b3c6b; font-weight: bold; text-align: right;">
                                Net Amount :
                            </div>
                            <div class="col-lg-2 col-xs-6 sub-total"id="sub_total" style=" text-align: right;">
                                ₹ <span id="net_amount"><?php if(isset($_SESSION['discount_coupon'])) echo $objMain->INR($_SESSION['net_amount']); ?></span>
                            </div>
            </div>
                                
                                

                        <div class="othre-content">
                            <div class="text coupon-error" id="coupon_error" style="display:none;">* Invalid Coupon Code</div>
                            <div class="coupon-box clearfix">
                                <input type="text" name="coupon" id="coupon" placeholder="Apply Coupon Code">
                                <button class="theme-btn" type="button" onclick="couponvalidate();">Apply Now</button>
                                <a href="checkout.php" class="update-btn proceedcheckout" type="submit">Proceed to Checkout</a>
                                <a href="index.php" style="margin-right: 20px;background: #434242;" class="update-btn proceedcheckout">Continue to Shopping</a>
                            </div>
                        </div>

                    </div>
                    <?php  } else echo "<h2>&nbsp;No Items in your Cart <a href='index.php' class='theme-btn pull-right'>Continue Shopping</a></h2>"; ?>
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