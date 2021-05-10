<?php include("lib/common.php"); // unset($_SESSION['items']); unset($_SESSION['total_qty']);
$product=$objMain->getRow("select * from product where id=34");
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

<title><?php echo $category_name." ".$product['product_name']; ?> : Buy Mattress Online - India&#039;s Best Mattress Brand</title>

<!-- Stylesheets -->
<link href="css/style.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">
    <link rel="icon" href="images/favicon.png">
<link rel="stylesheet" type="text/css" href="vendor/slick/slick.css"/>
<style type="text/css">
    .main-header .logo-box .logo:before { background: none !important; }
</style>
<link rel="stylesheet" href="vendor/bootstrap-select/css/bootstrap-select.css">
<!--toastr-->
    <link href="vendor/toastr-master/toastr.css" rel="stylesheet">
    <?php include("inc/header_scripts.php"); ?>
    <style type="text/css">
        #owl-demo .item{
  background: #FFF;
  padding: 30px 0px;
  margin: 10px;
  color: #FFF;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  text-align: center;
}
        .image-gallery {
  margin: 0 auto;
  display: table;
  width: 100%;
  float: left;
}

.primary,
.thumbnails {
  display: table-cell;
}

.thumbnails {
  width: 100%;
  float: left;
  display: block;

}

.primary {
  width: 100%;
  float: left;
  height: 400px;
  background-color: none;
  background-size: cover;
  background-position: center center;
  background-repeat: no-repeat;
  border-radius: 20px;
}

.thumbnail:hover .thumbnail-image, .selected .thumbnail-image {
  border: 4px solid #84226D;
  cursor: pointer;
}

.thumbnail {
    margin-right: 10px;
}

.thumbnail-image {
  width: 100px;
  height: 100px;
  margin: 20px auto;
  background-size: cover;
  background-position: center center;
  background-repeat: no-repeat;
  border: 4px solid transparent;
  display: table-cell;
}
.colors ul{list-style:none; padding:0; margin: 0;margin-top:10px; }

.colors li{display: inline;margin: 0 0 10px 0;}

.colors label{cursor: pointer;}

.colors input{display:none;}

.colors input[type="radio"]:checked + .swatch{box-shadow: inset 0 0 0 2px white;}

.swatch{
  display:inline-block;
  vertical-align: middle;
  height: 30px;
  width:30px;
  margin: 0 5px 0 0 ;
  border: 1px solid #d4d4d4;
}
    </style>
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
                        <div class="image-gallery">



  <main class="primary" style="background-image: url('images/products/<?php echo $product['cover_image']; ?>');"></main>
    <aside class="thumbnails">
        <?php $images=$objMain->getResults("select * from product_images where parent_id=".$product_id." order by sort_order");
if(!empty($images)){
    foreach($images as $image){ ?>
    <span class="thumbnail" data-big="images/products/<?php echo $image['image_path']; ?>">
      <div class="thumbnail-image" style="background-image: url(images/products/<?php echo $image['image_path']; ?>"></div>
    </span>
<?php } } ?>
  </aside>
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
      <p style="font-size: 15px; "><?php echo $psize['dimension']; ?>"</p>
              <i class="fa fa-check"></i>
    </label>
</div>
<?php } } ?>


                                        </div>
                                    </div>

<div id="normal_sizes">

      <button type="button" class="btn btn-light active" onclick="productfilter('Single','<?php echo $product_id; ?>');">Single</button>
  <button type="button" class="btn btn-light inactive" onclick="productfilter('Double','<?php echo $product_id; ?>');">Double</button>
  <button type="button" class="btn btn-light inactive" onclick="productfilter('Queen','<?php echo $product_id; ?>');">Queen</button>
  <button type="button" class="btn btn-light inactive" onclick="productfilter('King','<?php echo $product_id; ?>');">King</button>
<p style="font-family: 'Montserrat', sans-serif;margin-top: 20px;color: #a3a0a0;text-transform: uppercase;">Select Color</p>
  <div class="colors">
  <ul>
    <?php $colors=explode(",",$product['product_colors']); 

      foreach ($colors as $key => $color) {
    ?>
    <li>
      <label>
        <input type="radio" name="color" value="<?=$color?>" <?php if($key==0){ echo "checked"; } ?>>
        <span class="swatch" style="background-color:<?=$color?>"></span>
      </label>
    </li>
  <?php } ?>
   
  </ul> 
</div> 
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
    <p id="length_error" style="display: none;">Length customization is allowed between 68 - 78 inch</p>
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
                  <span class="mrpprice" data-product-price="" style=" font-family: 'Montserrat', sans-serif; color: #84226D; width: 100%; float: left; ">MRP ₹. <span id="mrp_price" style="text-decoration: line-through;">
                     <?php $dis_val=$product['product_price']*(10/100); ?>
                    <?php echo $objMain->INR($product['product_price']+$dis_val); ?></span></span>

                    <span class="mrpprice" data-product-price="" style=" font-family: 'Montserrat', sans-serif;  color: #84226D; ">PRICE ₹. <span id="product_price"><?php echo $objMain->INR($product['product_price']); ?></span></span><br>
                    <?php 
                     $act_price=$product['product_price'];
                    if(isset($_SESSION['dic_coupon_code']) && !empty($_SESSION['dic_coupon_code']) && ($product_id==29 || $product_id==30 || $product_id==31)){
                           
                           $p_detail=$objMain->getRow("select * from coupon where coupon_code='".$_SESSION['dic_coupon_code']."'");
                         if(!empty($p_detail)){
                          if($p_detail['discount_type']=='percentage'){
                            $dis=$act_price*($p_detail['discount_value']/100);
                            $act_price=$act_price-$dis;

                          }else{
                            $act_price=$act_price-$p_detail['discount_value'];
                          }

                         }
                       }
                     ?>

                    <span class="mrpprice" data-product-price="" style=" font-family: 'Montserrat', sans-serif;font-size: 29px;  color: #84226D; "> ₹. <span id="discount_price"><?php echo $objMain->INR($act_price); ?></span></span>
                    <br>
                    <p style="font-size: 12px;">(Inclusive of shipping and taxes)</p>
                    
                </div>
                <div class="col-lg-2 col-xs-12 qty">
                    <input type="number" id="qty" name="qty" placeholder="Qty" value="1" min="1" style="padding: 5px 10px;border: 1px solid #84226d;width: 80px;color: #84226d;font-size: 23px;">
                </div>
                <div class="col-md-4 col-xs-12">
                    <div class="add_to_cart">
                        <button class="theme-btn" onclick="addtocart(<?php echo $product_id; ?>);"> Add to Cart</button>
                    </div>
                </div>
            </div>

           




            <input type="hidden" name="product_amount" id="product_amount" value="<?php echo $objMain->INR($product['product_price']); ?>">
            <input type="hidden" name="product_size_type" id="product_size_type" value="normal">
<div class="sharethis-inline-share-buttons" style="margin-top:34px"></div>

                        </div>
                    </div>
                </div>
                </div>
            </div>
            <br>
            <div class="col-lg-12" style="margin-top: 50px; background: #FFF; padding-top: 50px; padding-bottom: 50px;">
            <div class="container-md ta-center">
        <h2 class="m-b-5" style="text-align: center;">Why Choose the Cuddle Buddy?</h2>
        <p class="m-b-2" style="text-align: center;">India 1<sup>st</sup> complete natural hybrid mattress</p>
        <div class="image-container m-b-2" style="margin: 50px 0; ">
            <div id="videoBox" class="box">
    <video width="1024" id="myvideo" muted class="hideonmobile">
      <source src="assets/videos/hybrid.mp4" type="video/mp4">
      Your browser does not support HTML5 video. </video>
    <video width="315" id="myvideo1" muted class="hidedesktop">
      <source src="assets/videos/hybrid.mp4" type="video/mp4">
      Your browser does not support HTML5 video. </video>
  </div>

  
        </div>
    </div>
    <div class="container-lg ta-center">
        <div class="row cols-m-t-1">
            <div class="column col-md-4 fs-body-1">
                <div class="p-x-content text-center">
                    <h3 class="m-b-6">Airflow Technology</h3>
                    <p>A mattress protector is all you need to enhance the life of your mattress and keep them safeguard from the attack of mites and dust particles. We at poppy Mattress offer you the premium quality mattress protector to wrap your mattresses for complete protection.</p>

<p>The mattress protector is made with premium cotton fabric which enhances sleeping comfort. Moreover, these mattress protectors are 100% waterproof, which keeps your mattress protected from spilling liquid damages. We are here with our complete range of mattress protectors for all sizes.</p>
                </div>
            </div>
            <div class="column col-md-4 fs-body-1">
                <div class="p-x-content text-center">
                    <h3 class="m-b-6">Wrapped pocketed springs</h3>
                    <p>So, you can choose according to your need. Also, the edges of the mattress protector are made with cotton lycra elastic so that you can easily pull and tuck the protector over your mattress with the least effort. The soft cotton layer over the mattress protector further increases the breathability of the mattress and keeps you cool while sleeping over it. </p>

<p>Besides that, the mattress protector is machine wash safe for up to 30 cycles and even more. So, we assure you to use this mattress protector for the long term. As discussed above, the upper layer of the mattress protector is made from cotton fabric, which means it has an anti-allergen property, which further makes it safe for everyone. </p>
                </div>
            </div>
            <div class="column col-md-4 fs-body-1">
                <div class="p-x-content text-center">
                    <h3 class="m-b-6">We are certified by</h3>
                    <p>PoppyMattress provides India’s 1<sup>st</sup> exclusive range of mattress protectors in a myriad of color range for optimum protection of your mattress. So, come to us, select the type of mattress and get the best protector for your mattress. </p>
                </div>
            </div>
        </div>
    </div>
</div>         
           
            
        </div>
    </section>
     <section class="classes-section" style="padding: 80px 0; background: #84226D; ">
    <div class="container container-lg">
        <div class="row">
            <div class="box column col-md-3 col-6 text-center">
                <div class="inner-container" data-eco-ben-modal="">
                    <div class="center m-b-6">
                        <img src="images/icons/naturallatex.png" style="width: 65px;">
                    </div>
                    <p class="fs-label" style="font-weight: bold; color: #FFF; ">Natural Latex</p>
                </div>
            </div>
            <div class="box column col-md-3 col-6 text-center">
                <div class="inner-container" data-eco-ben-modal="">
                    <div class="center m-b-6">
                        <img src="images/icons/ecocertified.png" style="width: 65px;">
                    </div>
                    <p class="fs-label" style="font-weight: bold; color: #FFF; ">Eco Friendly</p>
                </div>
            </div>
            <div class="box column col-md-3 col-6 text-center">
                <div class="inner-container" data-eco-ben-modal="">
                    <div class="center m-b-6">
                        <img src="images/icons/indias1st.png" style="width: 65px;">
                    </div>
                    <p class="fs-label" style="font-weight: bold; color: #FFF; ">India's 1<sup>st</sup> Natural Hybrid Mattress</p>
                </div>
            </div>
            <div class="box column col-md-3 col-6 text-center">
                <div class="inner-container" data-eco-ben-modal="">
                    <div class="center m-b-6">
                        <img src="images/icons/30daystrial.png" style="width: 65px;">
                    </div>
                    <p class="fs-label" style="font-weight: bold; color: #FFF; ">30 Nights Trail</p>
                </div>
            </div>
        </div>
    </div>
</section>
    <!-- shop-details end -->
     <section class="classes-section sec-pad" style="padding-bottom: 0;">

    <div class="container">


   

<div class="container" style="margin: 0 auto; text-align: center;">
  
<div class="video-container">
<iframe src="https://www.youtube.com/embed/OrWygtSDCKA?rel=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
</div>

</div>


    <div class="sec-title centred" style="margin-top: 50px;">
                <h5>Trusted Clients</h5>
                <h1>Peoples who make us Proud</h1>
            </div>


    <div id="owl-demo" class="owl-carousel owl-theme">
          
  <div class="item">
    <h5>Dazzling Pavi</h5>
    <img src="images/icons/5star.png" style="width: 80px;">
    <p class="location" style="display: none;">Chennai</p>
    <p>The best service I had ever.I got my mattress in a very good condition after their service..thank you so much poppy..am really happy with your service</p>
  </div>
  
  <div class="item">
    <h5>Gunasekar</h5>
    <img src="images/icons/5star.png" style="width: 80px;">
    <p class="location" style="display: none;">Chennai</p>
    <p>Last sunday i bought poppy mattress. Premium series spring mattress.   Its amazing good quality and good discount price.  Poppy mattress head quarters MD desk people good response for my mails. Good customer service. I like this product.  My best wishes to poppy mattress company.</p>
  </div>

  <div class="item">
    <h5>Ostin Marshal</h5>
    <img src="images/icons/5star.png" style="width: 80px;">
    <p class="location" style="display: none;">Chennai</p>
    <p>Best of custom Service mattress one of the highest quality I’ve seen ever best discount 15% made by online and immediately 24hrs delivery</p>
  </div>

  <div class="item">
    <h5>Prince Ela</h5>
    <img src="images/icons/5star.png" style="width: 80px;">
    <p class="location" style="display: none;">Chennai</p>
    <p>I have been using poopy matters for couple of month it feel soft and very comfortable . Spring quality also good not so light also not hard.</p>
  </div>

  <div class="item">
    <h5>Renu Gopal  </h5>
    <img src="images/icons/4star.png" style="width: 80px;">
    <p class="location" style="display: none;">Chennai</p>
    <p>Excellent</p>
  </div>

  <div class="item">
    <h5>Mohammed Nadeem</h5>
    <img src="images/icons/5star.png" style="width: 80px;">
    <p class="location" style="display: none;">Chennai</p>
    <p>Superb quality, best price</p>
  </div>

  
 
</div>


</div>

    </section>

<section class="classes-section classes-page-section sec-pad">
        <div class="container">


             <div class="sec-title style-two">
                <h5>Prefered</h5>
                <h1>Related Products</h1>
            </div>



            <div class="row">
<?php 
if($category['parent_id']==0) 
$related=$objMain->getResults("select * from product where id=32 or id=31 or id=29 or id=30 or id=31");
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
                        </div>
                    </div>
                </div>
<?php } } ?>
                
            </div>
        </div>
    </section>

    <?php include("inc/footer.php"); ?>

<?php include("inc/footer_scripts.php"); ?>

<script type="text/javascript">

$('.thumbnail').on('click', function() {
  var clicked = $(this);
  var newSelection = clicked.data('big');
  var $img = $('.primary').css("background-image","url(" + newSelection + ")");
  clicked.parent().find('.thumbnail').removeClass('selected');
  clicked.addClass('selected');
  $('.primary').empty().append($img.hide().fadeIn('slow'));
});




$('.my-select').selectpicker();

</script>

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

#owl-demo { margin-top: 50px; }

#owl-demo .item { padding: 20px 40px; text-align: center; color: #000; box-shadow: 4px 3px 8px 1px rgb(229 229 229 / 80%); }

#owl-demo .item .location { margin-bottom: 10px; color: #FFF; }

#owl-demo .item p { color: #000; }
#owl-demo .item img { width: 80px; margin: 0 auto; padding:10px 0 5px 0; }

.owl-controlls .owl-buttons div {
    color: #FFF;
    display: inline-block;
    margin: 5px;
    padding: 3px 10px;
    font-size: 12px;
    -webkit-border-radius: 30px;
    -moz-border-radius: 30px;
    border-radius: 30px;
    background: #869791;
    opacity: 0.5;
}

.owl-nav { display: none; }

#videoBox { text-align: center; }

*:focus {
    outline: none;
}

</style>
<script type="text/javascript" async src="js/v4.js"></script>

<script type="text/javascript">
   $(document).ready(function() {
  productfilter('Single','<?php echo $product_id; ?>');
 });

  $(document).ready(function(){
  $('.btn').click(function(){
    $('.btn').removeClass('active').addClass('inactive');
     $(this).removeClass('inactive').addClass('active');
    });
});
    $('.thumbnail').on('click', function() {
  var clicked = $(this);
  var newSelection = clicked.data('big');
  var $img = $('.primary').css("background-image","url(" + newSelection + ")");
  clicked.parent().find('.thumbnail').removeClass('selected');
  clicked.addClass('selected');
  $('.primary').empty().append($img.hide().fadeIn('slow'));
});
    $(document).ready(function() {
 
  $("#owl-demo").owlCarousel({
    loop: true,
    autoplaySpeed : 500,
    smartSpeed : 100,
    autoplay : true,
    dots: false,
    goToFirst : true,
                    nav: false,
                margin: 10,
                responsiveClass: true,
                responsive: {
                  0: {
                    items: 1,
                    nav: false
                  },
                  600: {
                    items: 2,
                    nav: false
                  },
                  1000: {
                    items: 3,
                    nav: false,
                    loop: true,
                    margin: 20
                  }
                }
  });
 
});

var ha = ( $('#videoBox').offset().top + $('#videoBox').height() );

$(window).scroll(function(){

  if ( $(window).scrollTop() > ha + 500 ) {
    $('#videoBox').css('bottom','0');
  } else if ( $(window).scrollTop() < ha + 200) {
    $('#videoBox').removeClass('out').addClass('in');
  } else {
    $('#videoBox').removeClass('in').addClass('out');
    $('#videoBox').css('bottom','-500px');
  };

});

$(window).bind('scroll', function() {
    if($(window).scrollTop() >= $('#videoBox').offset().top + $('#videoBox').outerHeight() - window.innerHeight) {
        $('#myvideo').trigger('play');
        $('#myvideo1').trigger('play');
    }

    if($(window).scrollTop() >= $('#videoBox1').offset().top + $('#videoBox1').outerHeight() - window.innerHeight) {
        $('#myvideo2').trigger('play');
        $('#myvideo3').trigger('play');
    }

});
</script>

</body><!-- End of .page_wrapper -->

</html>