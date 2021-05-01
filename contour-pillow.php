<?php include("lib/common.php"); // unset($_SESSION['items']); unset($_SESSION['total_qty']);
$product=$objMain->getRow("select * from product where id=32");
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


<div class="row" style="margin-top: 50px;">
                <div class="col-md-6 col-xs-12">
                    <span class="mrpprice" data-product-price="" style=" font-family: 'Montserrat', sans-serif; color: #84226D; width: 100%; float: left; ">MRP ₹. <span id="product_price" style="text-decoration: line-through;"><?php echo $objMain->INR($product['mrp_price']); ?></span></span>
                    <span class="actualprice" data-product-price="" style=" font-family: 'Montserrat', sans-serif; font-size: 29px; color: #84226D; float: left; width: 100%; margin-top: 20px; ">₹. <span id="product_price"><?php echo $objMain->INR($product['product_price']); ?></span></span>
                    <br>
                    <p style="font-size: 12px;">(Inclusive of shipping and taxes)</p>
                    
                </div>
               <!-- 
                <div class="col-lg-2 col-xs-12 qty">
                    <input type="number" id="qty" name="qty" placeholder="Qty" value="1" min="1" style="padding: 5px 10px;border: 1px solid #84226d;width: 80px;color: #84226d;font-size: 23px;">
                </div>
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
            <br>
            <div class="product-info-tabs">
                <div class="product-tab tabs-box">
                    <ul class="tab-btns tab-buttons clearfix">
                        <li class="tab-btn active-btn" data-tab="#tab-1">Product Description</li>
                    </ul>
                    <div class="tabs-content">
                        <div class="tab active-tab clearfix" id="tab-1">
                            <div class="text">
                                
                               <p>Poppy Mattress offers our whole new range of pillows made with Oeko Tex ,Eco institute certified Natural latex. for your optimum neck support and superior comfort. Our Latex contour pillows are manufactured with premium quality latex that provides adequate support to your neck.</p>

<p>Our Contour Latex Pillow is designed in a special shape that helps in protecting the cervical spine. The bones are supported by muscles and tendons, which are highly sensitive—the cushioned spongy contour pillow from Poppy’s ease the regions under stress. With the experts on board, we have helped create these Contour shape that can bring the lost natural neck position. Many people have trouble sleeping due to stress in the neck area. Some people have pain throughout the day, as they have slept in an inappropriate position. Thus Contour Latex Pillow are the possible solution to reducing these morning neck pains and relieving the sore or stiff neck. </p>

<p>the pillow with original 100% natural latex, which is extremely breathable and hypo-allergic. Moreover, the cell structure of the latex soap pillow has a natural ventilation system and rich in anti-microbial properties. So, you can say the pillow is free from the attack of dust mites, mildew, and molds. Get this latex pillow from poppyindia.com for exceptional support to the neck and head. 
</p>

<p>Pillow Cover is Easily Removable and Washable, It Contains Inner Cotton Cover as well for better Breathability and comfort.</p>

                            </div>
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
                <h5>Prefered</h5>
                <h1>Related Products</h1>
            </div>



            <div class="row">
<?php 
if($category['parent_id']==0) 
$related=$objMain->getResults("select * from product where id=33 or id=34");
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

$(".image-checkbox").on("click", function (e) { 

  var $checkbox = $(this).find('input[type="radio"]');
  uncheckradio1(); 
  if ($(this).find('input[type="radio"]').is(':checked')) { 
    $(this).removeClass('image-checkbox-checked'); 
    $checkbox.prop("checked",false);
  } else { 
    $(this).addClass('image-checkbox-checked');    
    $checkbox.prop("checked",true);
  }
  calculate();
  e.preventDefault();
});

function uncheckradio1(){ 
    $('.image-checkbox').removeClass('image-checkbox-checked');
}

function calculate(){ console.log("welcome");
    var size=$('input[name=size]:checked').val();
    //var size_value=$("#product_size").val();    
var size_value = $("#product_size option:selected").attr('data-count');
console.log("--Size Value --"+size_value+"---Size--"+size);
    var price=[];
  <?php $product_size=$objMain->getResults("select * from product_price where product_id=".$product_id." group by dimension");
if(!empty($product_size)){ $i=0;
    foreach($product_size as $psize){ $product_price='price['.$psize['dimension'].']=[0'; 
        $prices=$objMain->getResults("select * from product_price where product_id=".$product_id." and dimension=".$psize['dimension']);
if(!empty($prices)){ $i=0;
    foreach($prices as $price){ $product_price=$product_price.',"'.$objMain->INR($price['product_price']).'"'; }
}
$product_price.='];'; 
echo $product_price;
}} 
    ?>  
    
    $("#product_price").html(price[size][size_value]);
    $("#product_amount").val(price[size][size_value])
}

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

</style>

</body><!-- End of .page_wrapper -->

</html>