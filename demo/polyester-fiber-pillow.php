<?php include("lib/common.php"); // unset($_SESSION['items']); unset($_SESSION['total_qty']);
$product=$objMain->getRow("select * from product where id=17");
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


<div class="row" style="margin-top: 50px;">
                <div class="col-md-6 col-xs-12">
                    <span class="actualprice" data-product-price="" style=" font-family: 'Montserrat', sans-serif; font-size: 29px; color: #84226D; ">???. <span id="product_price"><?php echo $objMain->INR($product['product_price']); ?></span></span>
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
                                
                                <p>A right pillow is an attribute for the excellent night???s sleep. Our polyester fiber pillow is the right choice for the head to be cradled in the perfect position. Despite you nod off in the night, you can stay comfortable throughout???neither neck cricks nor backaches. We assure you that our polyester pillows will become your personal preference for the ???Go-to??? sleep option. </p>
<p>Polyester at Poppy???s is engineered to mimic the natural cotton that offers softness, breathability, and coolness. We have consistency standards with excessive lumpiness and firmness. The polyester material we choose for the pillows comes with brilliant quality, and it is ideal for the right alignment. </p>

<p>Our Polyester Fiber Pillow is ???made for the right choice??? for the best price. The pillow features amazing small fiber balls that make them fluffy and breathable. In addition to the plushness, they possess supreme responsiveness and can retain the shape as it is. The fibers chosen at Poppy???s are antimicrobial and odorless. It can resist to the dust mites occurrence in the pillows usually. Also, our Polyester fiber pillows come in two different sizes. The medium support pillow will offer you plenty of support in the head region, and it???s quite lofty. The large-sized pillows cover most of your neck, and it is perfect for the back-sleepers who want to maintain their proper alignment during the sleep. </p>

<p>Are you excited about your perfect pillow companion? Want to experience the no-awkward sleep because of the pillows? Choose Polyester Fibre pillows from Poppy???s</p>

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