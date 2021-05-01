<?php include("lib/common.php");  
$product=$objMain->getRow("select * from product where id=15");
$product_id=$product['id'];
$parent_cat=$product['category'];
$category=$objMain->getRow("select * from category where id=".$product['category']);
            if($category['parent_id']!=0){
                $parent=$objMain->getRow("select * from category where id=".$category['parent_id']);
                $category_name=$parent['category_name']." ".$category['category_name'];
                $breadcrumb=$parent['category_name']." / ".$category['category_name']; $parent_cat=$parent['id'];
            } else { $category_name=$category['category_name']; $breadcrumb=$category['category_name']; }
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

<?php echo $product['html_code']; ?>

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
    <section class="shop-details">
        <div class="container">
            <div class="product-details-content">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                        <div class="image-box">
                            <figure class="image"><img src="images/products/<?php echo $product['cover_image']; ?>" alt=""></figure>
                        </div>

                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                        <div class="content-box">
                            <h2><?php echo $product['product_name']; ?></h2>
                            <span><?php echo $breadcrumb; ?></span>
                            <div class="text">

                                <div class="info-box" style="margin-top: 20px;">

                                        <p style="font-family: 'Montserrat', sans-serif;margin-bottom:10px; margin-top: 20px;color: #a3a0a0;text-transform: uppercase;">HEIGHT</p>
                                        <div class="row col-sm-12" style="padding-left: 8px;">
<?php $product_size=$objMain->getResults("select * from product_price where product_id=".$product_id." group by dimension");
if(!empty($product_size)){ $i=0;
    foreach($product_size as $psize){ $i++; if($i==1) { $first_size=$psize['dimension']; $checked='image-checkbox-checked'; } else $checked=''; ?>
<div style="float: left; position: relative;  margin:5px; text-align: center;" >
    <label class="image-checkbox <?php echo $checked; ?>" style="padding: 10px 30px 0px 30px; margin-top: -10px;">
      <input type="radio" name="size" <?php if($i==1) echo 'checked="true"'; ?> id="size_<?php echo $psize['dimension']; ?>" value="<?php echo $psize['dimension']; ?>"  />
      <p style="font-size: 15px; ">E.T <?php echo $psize['dimension']; ?>"</p>
              <i class="fa fa-check"></i>
    </label>
</div>
<?php } } ?>


                                        </div>
                                    </div>

<div id="normal_sizes">
<p style="font-family: 'Montserrat', sans-serif;margin-top: 20px;color: #a3a0a0;text-transform: uppercase;">Select Size</p>

<select class="selectpicker" id="product_size" style="width: 100%;" onchange="calculate()">

<?php $prices=$objMain->getResults("select * from product_price where product_id=".$product_id." and dimension=".$first_size);
if(!empty($prices))
{ $i=0;
    foreach($prices as $price){ $i++; ?>
        <option value="<?php echo $price['id']; ?>" data-count="<?php echo $i; ?>" data-content="<?php echo $price['size_name']; ?> <span class='size-text'><?php echo $price['size_inch_w']; ?> x <?php echo $price['size_inch_b']; ?> in | <?php echo $price['size_mm_w']; ?> x <?php echo $price['size_mm_b']; ?> mm</span>"><?php echo $price['size_name']; ?></option>
 <?php
    }
    } ?>
</select>
   



<div class="custom_order">
            <p>Can’t find your mattress size? <span class="form_pop" style="font-weight: 400;" onclick="showcustomsize();">Get Custom Size</span></p>
</div>
</div>
<div class="custom_sizes" style="margin-top: 20px; display: none;" id="custom_sizes">
    <p style="font-family: 'Montserrat', sans-serif;margin-bottom:10px; margin-top: 20px;color: #a3a0a0;text-transform: uppercase;">DIMENSION</p>
    <div class="row col-lg-12" style="margin-bottom: 15px;">
        <div class="col-lg-3 " style="text-align: center;">
            <label>Length (in)</label>
            <input type="text" name="length" id="length" class="sizes" onkeyup="customprice();">
        </div>
        <div class="col-lg-1 xmark">
            X
        </div>
        <div class="col-lg-3" style="text-align: center;">
            <label>Width (in)</label>
            <input type="text" name="width" id="width" class="sizes" onkeyup="customprice();">
        </div>
    </div>
    <p id="length_error" style="display: none;">Length customization is allowed between 68 - 84 inch</p>
    <p id="width_error" style="display: none;">Width customization is allowed between 30 - 72 inch</p>
    <ul class="list">
        <li>Please round down the size (For eg. if the size that you need is 74.6 please make it 74).</li>
    </ul>


<div class="custom_order">
            <p>Do you want mattress normal size? <span class="form_pop" style="font-weight: 400;" onclick="shownormalsize();">Click Here</span></p>
</div>
</div>

<div class="row" style="margin-top: 50px;">
                <div class="col-md-6 col-xs-12">
                    <span class="actualprice" data-product-price="" style=" font-family: 'Montserrat', sans-serif; font-size: 29px; color: #84226D; ">₹. <span id="product_price"><?php echo $objMain->INR($product['product_price']); ?></span></span>
                    <br>
                    <p style="font-size: 12px;">(Inclusive of shipping and taxes)</p>
                    
                </div>
                <!--
                <div class="col-lg-2 col-xs-12 qty">
                    <input type="number" id="qty" name="qty" placeholder="Qty" value="1" min="1" style="padding: 5px 10px;border: 1px solid #84226d;width: 80px;color: #84226d;font-size: 23px;">
                </div>
                <!--
                <div class="col-md-4 col-xs-12">
                    <div class="add_to_cart">
                        <button class="theme-btn" onclick="addtocart(<?php echo $product_id; ?>);"> Add to Cart</button>
                    </div>
                </div>
                -->
            </div>

            <input type="hidden" name="product_amount" id="product_amount" value="<?php echo $objMain->INR($product['product_price']); ?>">
            <input type="hidden" name="product_size_type" id="product_size_type" value="normal">
<div class="sharethis-inline-share-buttons" style="margin-top:34px"></div>

                        </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="product-info-tabs">
                <div class="product-tab tabs-box">
                    <ul class="tab-btns tab-buttons clearfix">
                        <li class="tab-btn active-btn" data-tab="#tab-1">Product Description</li>
                        <li class="tab-btn" data-tab="#tab-2">Specification</li>
                    </ul>
                    <div class="tabs-content">
                        <div class="tab active-tab clearfix" id="tab-1">
                            <div class="text">
                                
                                <p>If you love sleeping and relax on your bed after a day of hard work, then the Luxe ET mattress is going to provide you with amazing comfort. A significant upgrade from the regular Luxe mattress, the Luxe ET better build quality, higher convenience, and drastic improvements over the materials used. It is truly a premium quality mattress that all of us need for resting our backs and sleep well. We have used a 10 mm Foam Layer to allow the mattress to support your back with the right softness. The foam helps to keep your body in the right posture and distributes it's weight uniformly.</p>

<p>The biggest highlight of the Luxe ET is the use of a 25 mm PU Super Soft Foam layer. Yes! We have come forward with the idea of providing comfort and luxurious support to our users. This layer of foam is responsible for the cushioning and bounce factor of the mattress. From the relaxation it provides, it is difficult not to fall in love with this premium mattress. The layer also adds to the durability of the mattress and helps it stay firm and robust, without hampering the comfort levels of it.</p>

<p>25 mm Bonded Foam is engineered to deliver consistent support to your back. It is designed to adjust according to your sleeping posture. That is why you are never going to experience any back pain or discomfort around the joints. The mattress adjusts to the position of your spine and prevents any pressure points to build up around the spinal cord section. This delivers a great level of comfort and coziness to you. Other than that, we also used Bonnell Springs to ensure our users get the right bounce that is perfect for all the pillow fights you have.</p>

<p>The Luxe ET is a one-of-a-kind mattress that is uniquely designed and engineered to deliver the highest level of comfort and relaxation to you. It is available in diverse size specifications and we can even offer you custom size dimensions.
</p>

                            </div>
                        </div>  
                        <div class="tab clearfix" id="tab-2">
                            <ul class="product_desc_list thin-font">
                                                            <?php $specs=$objMain->getResults("select * from product_specification where product_id=".$product_id." order by sort_order ");
                                                            if(!empty($specs)){
                                                                foreach($specs as $spec){ ?>
                                                            <li><span class="light-grey-text"><?php echo $spec['label_name']; ?>: </span><?php echo trim($spec['label_value']); ?></li>
<?php
                                                                }
                                                            } ?>
                                                        </ul>
                        </div>            
                    </div>
                </div>
            </div>
            
        </div>
    </section>
    <!-- shop-details end -->

<section class="classes-section classes-page-section sec-pad">
        <div class="container">


             <div class="sec-title style-two">
                <h5>Related</h5>
                <h1>Premium Series Products</h1>
            </div>



            <div class="row">
<?php 
if($category['parent_id']==0)
$related=$objMain->getResults("select * from product where category=".$category['id']."  and id!=".$product_id);
else 
$related=$objMain->getResults("select * from product where category in (select id from category where parent_id=".$parent_cat.") and id!=".$product_id);

if(!empty($related)){
    foreach($related as $rel) { ?>

                <div class="col-lg-4 col-md-6 col-sm-12 block-column relatedproducts">
                    <div class="inner-block wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <figure class="image-box"><a href="<?php echo $rel['url_slug']; ?>"><img src="images/products/<?php echo $rel['cover_image']; ?>" alt=""></a></figure>
                        <div class="lower-content">
                            <h3><a href="<?php echo $rel['url_slug']; ?>"><?php echo $rel['product_name']; ?></a></h3>
                            <div class="price">INR <?php echo $objMain->INR($rel['product_price']); ?></div>
                            <div class="product-extra-details mt-3em" style="margin-top: 2em">
                                                        <ul class="product_desc_list thin-font">
                                                            <li><span class="light-grey-text">Mattress Material: </span>Soft foam and High Resilience Foam</li>
                                                            <li><span class="light-grey-text">Mattress Usability: </span>Usable on both sides. </li>
                                                        </ul>
                                                    </div>
                            <ul class="info-box">
                                <a href="<?php echo $rel['url_slug']; ?>" style="color: #FFF;">SHOP NOW</a>
                            </ul>
                        </div>
                    </div>
                </div>
<?php } } ?>
                
            </div>
        </div>
    </section>

    <?php include("inc/footer.php"); ?>

<?php include("inc/footer_scripts.php"); ?>


<style type="text/css">
    /* Custom Checkbox */
.image-checkbox {
    cursor: pointer;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    border-bottom: 2px solid #4f4a4e;
    margin-bottom: 0;
    outline: 0;
}
.image-checkbox input[type="radio"] {
    display: none;
}

.image-checkbox-checked p { color: #84226D; }
.image-checkbox-checked {

    border-bottom: 2px solid #84226D !important;
}
.image-checkbox .fa {
  position: absolute;
  color: #84226D;
  padding: 3px;
  top: 0;
  right: 0;
  display: none;
  font-size: 10px;
}
.image-checkbox-checked .fa {
  display: block !important;
}
.relatedproducts ul.product_desc_list li {
        width: 100% !important;
    }

.size-text { float: right; }

</style>

</body><!-- End of .page_wrapper -->

</html>