<?php include("lib/common.php"); $menu='slider'; ?><!DOCTYPE html> <?php $ptype="Miscellaneous";
$res=$objMain->getRow("select * from miscellaneous where id=".$id);

 ?>
<html lang="en">
<head>
    <?php include("inc/header_scripts.php"); ?>
    <title>Update <?php echo $ptype; ?></title>
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
                <h4 class="mb-0">Update <?php echo $ptype; ?>
                </h4>
                <ol class="breadcrumb mb-0 pl-0 pt-1 pb-0">
                    <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                    <li class="breadcrumb-item active">Update <?php echo $ptype; ?></li>
                </ol>
            </div>
            <!--page title end-->


            <div class="container-fluid">

                <!-- state start-->
                <div class="row">
                    
                    <div class=" col-md-6">
                        <div class="card card-shadow mb-4">
                            <div class="card-header">

                            </div>
                            <div class="card-body">
                                <form method="post" action="init.php?module=admin&action=miscellaneous&do=update&id=<?php echo $id; ?>" enctype="multipart/form-data" >
                                   

                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Place</label>
                                        <input type="text" name="type_name" id="type_name" required="" class="form-control" value="<?php echo $res['type_name']; ?>" style="text-transform: uppercase;" required="" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Place</label>
                                        <input type="text" name="coupon_code" id="coupon_code" required="" class="form-control" value="<?php echo $res['coupon_code']; ?>" style="text-transform: uppercase;" required="">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Value</label>
                                        <textarea name="type_value" id="type_value" rows="4" class="form-control" ><?php echo $res['type_value']; ?></textarea>
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
