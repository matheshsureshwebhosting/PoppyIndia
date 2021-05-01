<?php include("lib/common.php"); include("lib/session_check.php"); $menu='slider'; 
 ?>
                       <?php  $order=$objMain->getRow("select * from orders where id=".$id); ?>
<!DOCTYPE html> <?php $ptype='View order'; ?>
<html lang="en">
<head>
    <?php include("inc/header_scripts.php"); ?>
    <title><?php echo $ptype; ?></title>
</head>
<body class="app header-fixed left-sidebar-fixed right-sidebar-fixed right-sidebar-overlay right-sidebar-hidden">

    <!--===========header start===========-->
   <?php include("inc/header.php"); ?>
    <!--===========header end===========-->

    <!--===========app body start===========-->
    <div class="app-body">

        <!--left sidebar start-->
        <?php include("inc/sidebar.php"); ?>
        <!--left sidebar end-->

        <!--main contents start-->
        <main class="main-content">
            <!--page title start-->
            <div class="page-title">
                <h4 class="mb-0">  <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-mail-reply"></i> Back</a>
                <div class="col-lg-3 pull-right">
                <select class="form-control " style="font-size: 16px; " onchange="updateorder(this.value)">
                    <option value="verification-process" <?php if($order['status']=='verification-process') echo "selected"; ?>>Verification call under process</option>
                    <option value="process" <?php if($order['status']=='process') echo "selected"; ?>>Order Placed</option>
                    <option value="dispatch" <?php if($order['status']=='dispatch') echo "selected"; ?>>Dispatch from Factory</option>
                    <option value="out-for-delivery" <?php if($order['status']=='out-for-delivery') echo "selected"; ?>>Out for Delivery</option>
                    <option value="delivered" <?php if($order['status']=='delivered') echo "selected"; ?>>Delivered</option>   
                    <option value="cancel-request" <?php if($order['status']=='cancel-request') echo "selected"; ?>>Cancel Request</option>       
                    <option value="cancelled" <?php if($order['status']=='cancelled') echo "selected"; ?>>Cancelled</option>  
                </select>
            </div>
                </h4>
            </div>
            <!--page title end-->


            <div class="container-fluid">

                <!-- state start-->
                <div class="row">

                    <div class=" col-sm-12">
                       <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 right-column">
                    <div class="inner-box">
                         

                        <div class="card card-shadow mb-4">
                            <div class="card-header">
                                <div class="card-title">
                                    Order Details
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td>Order Date</td>
                                        <td>: <?php echo date("d-m-Y h:i A",strtotime($order['order_date'])); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tracking No</td>
                                        <td>: <?php echo $order['tracking_id']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Name</td>
                                        <td>: <?php echo $order['name']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Mobile No </td>
                                        <td>: <?php echo $order['mobileno']; if($order['mobileno_alt']) echo " / ".$order['mobileno_alt']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td>: <?php echo $order['address']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>City</td>
                                        <td>: <?php echo $order['city']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>State</td>
                                        <td>: <?php echo $order['state']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Pincode</td>
                                        <td>: <?php echo $order['pincode']; ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Notes</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="border-top: none;"><?php echo $order['order_notes']; ?> </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
<?php if($order['status']=='cancel-request' || $order['status']=='cancelled') { ?>
                        <div class="card card-shadow mb-4">
                            <div class="card-header">
                                <div class="card-title">
                                    Cancel Details
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td>Cancel Date</td>
                                        <td>: <?php echo date("d-m-Y h:i A",strtotime($order['cancel_date'])); ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Cancel Reason</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="border-top: none;"><?php echo $order['cancel_reason']; ?> </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php } ?>

                    </div>
                </div>

                        <div class="col-lg-6 col-md-12 col-sm-12 right-column">

                        <div class="card card-shadow mb-4">
                            <div class="card-header">
                                <div class="card-title">
                                    Order Items
                                </div>
                            </div>
                            <div class="card-body">
                                <?php 
                                $order_items=$objMain->getResults("select * from orders_items where order_id='".$order['id']."'");
if(!empty($order_items)){ $i=0;
    foreach($order_items as $item) { $i++; ?>
                                <div class="media mb-4">
                                    <img class="align-self-center mr-3 rounded-circle" src="<?php echo HTTP_PRODUCT.$item['cover_image']; ?>" alt=" " style="width: 80px; height: 80px;">
                                    <div class="media-body">
                                        <p class="mb-0"><strong class=""><?php echo $item['product_name']." ".$item['product_height']."\""; ?></strong>

                                        <span class="pull-right">₹ <?php echo $objMain->INR($item['amount']); ?></span>
                                        </p>
                                            <span style="font-size: 14px; color:#979191; float: left; width: 100%;"><?php echo $item['category']; ?></span>
                                                <span style="font-size: 14px;"><?php echo $item['product_size']; ?></span>
                                    </div>
                                </div>
                            <?php } } ?>

                            <div class="table-responsive">
                                <table class="table">

                                    <tbody>
                                    <tr>
                                        <td style="vertical-align: middle; font-size: 18px; <?php if(isset($order['coupon_value'])) echo 'font-weight: normal; '; ?>">Order Total </td>
                                        <td style="font-size: 18px; text-align: right;">₹ <?php echo $objMain->INR($order['net_amount']); ?></td>
                                    </tr>
                                    <?php if(isset($order['coupon_value'])) { ?>
                                    <tr>
                                        <td style="vertical-align: middle; font-size: 18px;">Coupon Discount (<?php echo $order['coupon_code']; ?>)</td>
                                        <td style="font-size: 18px; text-align: right;">₹ <?php echo $objMain->INR($order['coupon_value']); ?></td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: middle; font-size: 18px;">Net Amount</td>
                                        <td style="font-size: 18px; text-align: right;">₹ <?php echo $objMain->INR($order['net_amount']); ?></td>
                                    </tr>
                                <?php } ?>

                                    </tbody>
                                </table>
                            </div>

                            </div>
                        </div>

                </div>

                    </div>

                    </div>
                </div>


                <!-- state end-->

            </div>
        </main>
        <!--main contents end-->

        <!--right sidebar start-->
        <?php include("inc/rightsidebar.php"); ?>
        <!--right sidebar end-->

    </div>
    <!--===========app body end===========-->

    <!--===========footer start===========-->
    <?php include("inc/footer.php"); ?>
        <!--===========footer end===========-->


    <?php include("inc/footer_scripts.php"); ?>
<script type="text/javascript">
    function updateorder(status){
        $.ajax({
                url: 'lib/ajax.php',
                type: 'post',
                data: { 'type' : 'order_update', 'status' : status, 'id' : <?php echo $id; ?> },
                beforeSend: function(){
                    //$("#loadmore").val(0);
                },
                success: function(obj) { 
                     toastr.success("Order Status updated successfully","");
                   }
            });
    }

</script>
    

</body>
</html>
