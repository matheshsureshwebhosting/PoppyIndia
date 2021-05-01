<?php include("lib/common.php"); $menu='master'; ?><!DOCTYPE html> <?php $ptype="Change Password";

 ?>
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
                <h4 class="mb-0"><?php echo $ptype; ?>
                </h4>
                <ol class="breadcrumb mb-0 pl-0 pt-1 pb-0">
                    <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                    <li class="breadcrumb-item active"><?php echo $ptype; ?></li>
                </ol>
            </div>
            <!--page title end-->


            <div class="container-fluid">

                <!-- state start-->
                <div class="row">
                    
                    <div class=" col-md-6">
                         <?php
    if(isset($msg) && $msg=='suc') { $atype="success";
    $msg="Password Updated successfully"; }
     if(isset($msg) && $msg=='err') { $atype="danger";
    $msg="Old Password Wrong! Try Again"; }

  ?>
    <?php if(isset($msg)) { ?>
      <div class="alert alert-<?php echo $atype; ?> alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <p><i class="icon fa fa-ban"></i> <?php echo $msg; ?></p>
      </div>
          <?php } ?>
                        <div class="card card-shadow mb-4">
                            <div class="card-header">

                            </div>
                            <div class="card-body">
                                <form method="post" action="init.php?module=dealer&action=accountsettings&do=update">
                                   
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Old Password</label>
                                        <input type="password" name="old_pass" id="old_pass" required="" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">New Password</label>
                                        <input type="password" name="user_pass" id="user_pass" required="" class="form-control">
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
