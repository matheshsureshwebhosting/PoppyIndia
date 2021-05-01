<?php include("lib/common.php"); include("lib/session_check.php"); $menu='slider'; 
$customer=$objMain->getRow("select * from customers where id=".$id);
 ?>
<!DOCTYPE html> <?php $ptype='Orders'; ?>
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
                <h4 class="mb-0"><?php  echo $customer['customer_name']." ".$ptype; ?> 
           
                </h4>
            </div>
            <!--page title end-->


            <div class="container-fluid">

                <!-- state start-->
                <div class="row">

                    <div class=" col-sm-12">
                        <?php
    if(isset($msg) && $msg=='suc') { $atype="success";
    $msg=$ptype." Added successfully"; }
    if(isset($msg) && $msg=='upd') { $atype="success";
    $msg=$ptype." Updated successfully"; }
    if(isset($msg) && $msg=='del') { $atype="success";
    $msg=$ptype." Deleted successfully"; }

  ?>
    <?php if(isset($msg)) { ?>
      <div class="alert alert-<?php echo $atype; ?> alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <p><i class="icon fa fa-thumbs-up"></i> <?php echo $msg; ?></p>
      </div>
          <?php } ?>
                        <div class="card card-shadow mb-4">
                            
                            <div class="card-body">
                                <table id="bs4-table" class="table table-bordered table-striped" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>                                        
                        <th>S.No</th>
                        <th>Order Date</th>
                        <th>Amount</th>
                        <th>Coupon</th>
                        <th>Net Amount</th>
                        <th>Status</th>
                        <th>Action</th>
                                    </thead>
                                   
                                    <tbody>
                                        <?php 

$results=$objMain->getResults("select * from orders where userid=".$id);
                    if(!empty($results)){ $i=0;
                        foreach($results as $result){ $i++; 

                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo date("d-m-Y",strtotime($result['order_date'])); ?></td>
                                <td><?php echo $objMain->INR($result['sub_total']); ?></td>
                                <td><?php echo $objMain->INR($result['coupon_value']); ?></td>
                                <td><?php echo $objMain->INR($result['net_amount']); ?></td>
                                <td><?php echo $result['status']; ?></td>
                                <td>
                                    <a href="orders_view.php?id=<?php echo $result['id']; ?>" class="btn btn-danger btn-sm">View</a>
                            </tr>

                   <?php     }
                    } ?>
                                   
                                    </tbody>
                                </table>
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

    

</body>
</html>
