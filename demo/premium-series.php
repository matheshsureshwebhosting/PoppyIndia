<?php include("lib/common.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

<?php $page=$objMain->getRow("select * from pages where id=14");
echo $page['html_code']; ?>

<?php include("inc/header_scripts.php"); ?>
</head>

<!-- page wrapper -->
<body class="boxed_wrapper">


    <?php include("inc/header_inner.php"); ?>


    <!--Page Title-->
    <section class="page-title centred" style="">
        <div class="container">
            <div class="content-box">
                <h1>Premium Series</h1>
                <p style="color: #FFF;">A range of premium quality mattresses for every need</p>
                
            </div>
        </div>
    </section>
    <!--End Page Title-->


    <!-- classes-section -->
    <section class="classes-section classes-page-section sec-pad">
        <div class="container">
<?php $categories=$objMain->getResults("select * from category where parent_id=4");
if(!empty($categories)) { $i=0;
    foreach($categories as $category) { $i++; ?>

        <div class="sec-title centred" style="<?php if($i>1) echo 'margin-top: 100px;'; ?>">
                <h5><?php echo $category['short_desc']; ?></h5>
                <h1><?php echo $category['category_name']; ?></h1>
        </div>

        <?php $products=$objMain->getResults("select * from product where category=".$category['id']);
        if(!empty($products)){
            foreach($products as $product) { ?>

<div class="card" style="margin-bottom: 40px; box-shadow: 0 30px 50px rgba(229, 229, 229, 0.8); padding: 20px;">
            <div class="row">
                    <div class="col-lg-6">
                            <figure class="image-box"><a href="<?php echo $product['url_slug']; ?>"><img src="images/products/<?php echo $product['cover_image']; ?>" alt=""></a></figure>
                    </div>
                    <div class="col-lg-6">
                            <h3><a href="<?php echo $product['url_slug']; ?>"><?php echo $product['product_name']; ?></a></h3>

                            <div class="row">
                                                <div class="col-md-7 col-xs-12">
                                                    <p class="price thin-font">₹. <?php echo $objMain->INR($product['product_price']); ?> *</p>
                                                    <span class="price tax-text">(Inclusive of all taxes)</span>
                                                </div>
                                                <div class="col-md-5 col-xs-12">
                                                    <a href="<?php echo $product['url_slug']; ?>" class="theme-button-medium w-btn-nocase w-btn-dark-blue ml-0 mr-0" id="" style="float: right;">Shop Now</a>
                                                </div>
                                            </div>


                            <div class="product-extra-details mt-3em" style="margin-top: 3em">
                                                        <ul class="product_desc_list thin-font">
                                                            <?php $specs=$objMain->getResults("select * from product_specification where product_id=".$product['id']." order by sort_order ");
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

      <?php      }
        }


    }
} else { ?>
    <?php $products=$objMain->getResults("select * from product where category=4");
        if(!empty($products)){
            foreach($products as $product) { ?>

<div class="card" style="margin-bottom: 40px; box-shadow: 0 30px 50px rgba(229, 229, 229, 0.8); padding: 20px;">
            <div class="row">
                    <div class="col-lg-6">
                            <figure class="image-box"><a href="<?php echo $product['url_slug']; ?>"><img src="images/products/<?php echo $product['cover_image']; ?>" alt=""></a></figure>
                    </div>
                    <div class="col-lg-6">
                            <h3><a href="<?php echo $product['url_slug']; ?>"><?php echo $product['product_name']; ?></a></h3>

                            <div class="row">
                                                <div class="col-md-7 col-xs-12">
                                                    <p class="price thin-font">₹. <?php echo $objMain->INR($product['product_price']); ?> *</p>
                                                    <span class="price tax-text">(Inclusive of all taxes)</span>
                                                </div>
                                                <div class="col-md-5 col-xs-12">
                                                    <a href="<?php echo $product['url_slug']; ?>" class="theme-button-medium w-btn-nocase w-btn-dark-blue ml-0 mr-0" id="" style="float: right;">Shop Now</a>
                                                </div>
                                            </div>


                            <div class="product-extra-details mt-3em" style="margin-top: 3em">
                                                        <ul class="product_desc_list thin-font">
                                                            <?php $specs=$objMain->getResults("select * from product_specification where product_id=".$product['id']." order by sort_order ");
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

      <?php      }
        } } ?>

            






            
        </div>
    </section>
    <!-- classes-section end -->


    <!-- testimonial-style-two -->
    <!-- testimonial-style-two end -->


    <!-- main-footer -->
    <?php include("inc/footer.php"); ?>

<?php include("inc/footer_scripts.php"); ?>



</body><!-- End of .page_wrapper -->

</html>
