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
</head>

<!-- page wrapper -->
<body class="boxed_wrapper">


    <div class="preloader"></div>

   <?php include("inc/header_inner.php"); ?>

    <!-- shop-details -->
    <section class="cart-section cart-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 table-column">
                     <?php $order_total=0;
if(isset($_SESSION['items']) && count($_SESSION['items'])>0){ ?>
                    <div class="table-outer">
       
                        <table class="cart-table">
                            <thead class="cart-header">
                                <tr>
                                    <th class="prod-column">Products</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th class="price">Price</th>
                                    <th class="quantity">Quantity</th>
                                    <th>Total</th>
                                    <th>&nbsp;</th>
                                </tr>    
                            </thead>
                            <tbody>
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
                    <tr id="product_<?php echo $key; ?>">
                                    <td colspan="3" class="prod-column">
                                        <div class="column-box">
                                            <div class="prod-thumb">
                                                <a href="#"><img src="images/products/<?php echo $product['cover_image']; ?>" alt=""></a>
                                            </div>
                                            <div class="prod-title">
                                                <?php echo $product['product_name']." ".$item['dimension']."\""; ?>
                                                <span style="width: 100%;float: left;font-size: 14px; color:#979191;"><?php echo $category_name; ?></span>
                                                <span style="width: 100%;float: left;font-size: 14px;"><?php echo $prod_size ; ?></span>
                                            </div>    
                                        </div>
                                    </td>
                                    <td class="price">₹ <?php echo $objMain->INR($item['price']); ?></td>
                                    <td class="qty">
                                        <input type="number" placeholder="Qty" value="<?php echo $item['qty']; ?>" min="1" onchange="updatecart(<?php echo $item['productid']; ?>,<?php echo $key; ?>,this.value);">
                                        <input type="hidden" name="product_price_<?php echo $key; ?>" id="product_price_<?php echo $key; ?>" value="<?php echo $product['product_price']; ?>">
                                    </td>
                                    <td class="sub-total" id="product_total_<?php echo $key; ?>">₹ <?php echo $objMain->INR($item['qty']*$item['price']); ?></td>
                                    <td>
                                        <div class="remove">
                                            <span onclick="removecart(<?php echo $key; ?>);"><i class="flaticon-cancel"></i></span>
                                        </div>
                                    </td>
                                </tr>

                                <?php $freebis=$objMain->getResults("select * from product_free where parent_id=".$product['id']);
                                if(!empty($freebis)){
                                    foreach($freebis as $free){ 
                                        $prod=$objMain->getRow("select * from product where id=".$free['free_product_id']);
                                        ?>

                                        <tr class="product_<?php echo $key; ?>">
                                    <td colspan="3" class="prod-column">
                                        <div class="column-box">
                                            <div class="prod-thumb">
                                                <a href="#"><img src="images/products/<?php echo $prod['cover_image']; ?>" alt=""></a>
                                            </div>
                                            <div class="prod-title">
                                                <?php echo $prod['product_name']; ?>
                                                <span style="width: 100%;float: left;font-size: 14px;"><b style="color: #84226D;">FREE</b> for <?php echo $product['product_name']." ".$item['dimension']."\""; ?></span>
                                            </div>    
                                        </div>
                                    </td>
                                    <td class="price">₹ <?php echo $objMain->INR($prod['product_price']); ?></td>
                                    <td class="qty">
                                        <input type="text" placeholder="Qty" value="<?php echo $free['qty']*$item['qty']; ?>" min="1">
                                        <input type="hidden" value="<?php echo $prod['product_price']; ?>">
                                    </td>
                                    <td class="sub-total">&nbsp;</td>
                                    <td>&nbsp;
                                    </td>
                                </tr>

                                <?php } }?>    

           <?php }  ?>
                                
                                
                                <tr>
                                    <td colspan="3" class="prod-column">&nbsp;</td>
                                    <td class="qty" colspan="2" style="color: #2b3c6b; font-weight: bold; text-align: right;">Order Total :</td>
                                    <td class="sub-total" id="sub_total" style=" text-align: right;">₹ <?php echo $objMain->INR($_SESSION['sub_total']); ?></td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr id="coupon_det" style="<?php if(!isset($_SESSION['discount_coupon'])) echo 'display: none;'; ?>">
                                    <td colspan="3" class="prod-column">&nbsp;</td>
                                    <td class="qty" colspan="2" style="color: #2b3c6b; font-weight: bold; text-align: right;">Coupon (<span id="coupon_code"><?php if(isset($_SESSION['discount_coupon'])) echo $_SESSION['discount_coupon']; ?></span>) :</td>
                                    <td class="sub-total" style=" text-align: right;">₹ <span id="discount_value"><?php if(isset($_SESSION['discount_coupon'])) echo $objMain->INR($_SESSION['discount_value']); ?></span></td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr id="net_det" style="<?php if(!isset($_SESSION['discount_coupon'])) echo 'display: none;'; ?>">
                                    <td colspan="3" class="prod-column">&nbsp;</td>
                                    <td class="qty" colspan="2" style="color: #2b3c6b; font-weight: bold; text-align: right;">Net Amount :</td>
                                    <td class="sub-total" style=" text-align: right;">₹ <span id="net_amount"><?php if(isset($_SESSION['discount_coupon'])) echo $objMain->INR($_SESSION['net_amount']); ?></span></td>
                                    <td>&nbsp;</td>
                                </tr>
      
                            </tbody>    
                        </table>
                        <div class="othre-content">
                            <div class="text coupon-error" id="coupon_error" style="display:none;">* Invalid Coupon Code</div>
                            <div class="coupon-box clearfix">
                                <input type="text" name="coupon" id="coupon" placeholder="Apply Coupon Code">
                                <button class="theme-btn" type="button" onclick="couponvalidate();">Apply Now</button>
                                <a href="checkout.php" class="update-btn" type="submit">Proceed to Checkout</a>
                            </div>
                        </div>

                    </div>
                    <?php  } else echo "<h2>No Items in your Cart <a href='index.php' class='theme-btn pull-right'>Continue Shopping</a></h2>"; ?>
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