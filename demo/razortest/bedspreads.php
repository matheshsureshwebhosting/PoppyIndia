<?php include("lib/common.php"); // unset($_SESSION['items']); unset($_SESSION['total_qty']);
$product=$objMain->getRow("select * from product where id=22");
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
                                
                                <p>We are sure you would need a bedspread to keep your bedroom look cozy. Making a bed is an art, and we recommend you do it with Poppy???s bedspread. They solve more than one purpose and not just restricted to the interior of the room. A quality bedspread like ours will help prevent the mites and bacteria that normally settle in the dark conditions. It improves the breathability and protects you from all the respiratory issues.</p>

<p>Poppy???s bedspreads are manufactured in the best quality of all time. They are lightweight weight covers and comes in two different sizes. The basic quality of our bedspread also provides the warmth that you are looking for. The fabric chosen by us offers extra comfort, and you can have the best sleep. It is lightweight, and hence it is easy to maintain. You can put them cleaning routine, so there is no need to worry about the fading away of colors or diminished quality. Keep your bed warm, neat, and in style forever. </p>

<p>If you are wondering if there is any smart way to keep your cozy bed intact, then Poppy???s bedspreads are the best way to start. 
</p>

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