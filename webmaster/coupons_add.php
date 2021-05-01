<?php include("lib/common.php"); $menu='slider'; ?><!DOCTYPE html> <?php $ptype="Coupon";

 ?>
<html lang="en">
<head>
    <?php include("inc/header_scripts.php"); ?>
    <title>Add <?php echo $ptype; ?></title>
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
                <h4 class="mb-0">Add <?php echo $ptype; ?>
                </h4>
                <ol class="breadcrumb mb-0 pl-0 pt-1 pb-0">
                    <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                    <li class="breadcrumb-item active">Add <?php echo $ptype; ?></li>
                </ol>
            </div>
            <!--page title end-->


            <div class="container-fluid">

                <!-- state start-->
                <div class="row">
                    
                    <div class=" col-md-4">
                        <div class="card card-shadow mb-4">
                            <div class="card-header">

                            </div>
                            <div class="card-body">
                                <form method="post" action="init.php?module=admin&action=coupon&do=add" enctype="multipart/form-data" >
                                   

                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Coupon Code</label>
                                        <input type="text" name="coupon_code" id="coupon_code" required="" class="form-control" style="text-transform: uppercase;" required="">
                                    </div>

<div class="row">
                                    <div class="form-group col-lg-12">
                                        <label for="exampleFormControlTextarea1">Type</label>
                                        <div class="form-group">
                                            <label class="control control-solid control-solid-info  control--radio"> Flat 
                                        <input type="radio" name="discount_type" value="flat" checked="" />
                                        <div class="control__indicator"></div>
                                    </label>
                                    <label class="control control-solid control-solid-info control--radio"> Percentage
                                        <input type="radio" name="discount_type" value="percentage"  />
                                        <div class="control__indicator"></div>
                                    </label>
                                    
                                        </div>
                                    </div>
             </div>                      

                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Discount Value</label>
                                        <input type="text" name="discount_value" id="discount_value" required="" class="form-control inr" required="">
                                    </div> 

                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Start Date</label>
                                        <input type="text" name="start_date" id="start_date" required="" class="form-control  date-picker-input" required="">
                                    </div> 

                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Expire Date</label>
                                        <input type="text" name="expire_date" id="expire_date" required="" class="form-control date-picker-input" required="">
                                    </div> 
                                
                                    
                                    <button type="submit" class="btn btn-danger col-lg-4 pull-right">Submit</button>
                                </form>
                               
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
         function show_district(parent_id){
        
        $.ajax({
        url: 'lib/ajax.php',
        type: 'post',
        data: {'id':parent_id, type: 'district' },
        success: function(data) { 
           eval(data);
        }
    });
    }

    </script>

</body>
</html>
