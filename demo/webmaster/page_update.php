<?php include("lib/common.php"); $menu='slider'; ?><!DOCTYPE html> <?php $ptype="Page";
$res=$objMain->getRow("select * from pages where id=".$id);

 ?>
<html lang="en">
<head>
    <?php include("inc/header_scripts.php"); ?>
    <title>Update <?php echo $res['page_name']; ?></title>
    <!--summernote-->
    <link href="assets/vendor/summernote/summernote-bs4.css" rel="stylesheet">
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
                <h4 class="mb-0">Update <?php echo $res['page_name']; ?>
                <a href="pages.php" class="btn btn-danger btn-sm pull-right"><i class="fa fa-mail-reply"></i> Back</a>
                </h4>
            </div>
            <!--page title end-->


            <div class="container-fluid">
<?php
    if(isset($msg) && $msg=='suc') { $atype="success";
    $msg=$ptype." Added successfully"; }
     if(isset($msg) && $msg=='upd') { $atype="success";
    $msg=$ptype." HTML code Updated successfully"; }
     if(isset($msg) && $msg=='del') { $atype="danger";
    $msg=$ptype." Deleted successfully"; }
    if(isset($msg) && $msg=='exist') { $atype="danger";
    $msg=$ptype." Associated with cars. Could not delete the model"; }

  ?>
    <?php if(isset($msg)) { ?>
      <div class="alert alert-<?php echo $atype; ?> alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <p><i class="icon fa fa-thumbs-up"></i> <?php echo $msg; ?></p>
      </div>
          <?php } ?>
                <!-- state start-->
                <div class="row">
                    
                    <div class=" col-md-12">
                        <div class="card card-shadow mb-4">
                            <div class="card-header">

                            </div>
                            <div class="card-body">
                                <form method="post" action="init.php?module=admin&action=page&do=update&id=<?php echo $id; ?>" id="frm" enctype="multipart/form-data" >

                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">HTML Code</label>
                                        <textarea name="html_code" id="summernote" class="form-control"><?php echo $res['html_code']; ?></textarea>
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


    <!--summernote-->
    <script src="assets/vendor/summernote/summernote-bs4.min.js"></script>
    <script>
        $(document).ready(function() {
$('#summernote').on('summernote.init', function () {
      $('#summernote').summernote('codeview.activate');
    }).summernote({
      height: 300,
  toolbar: false,
      placeholder: 'Paste content here...'
    });
        });

        $( "#frm" ).submit(function( event ) {

      $('#summernote').summernote('codeview.deactivate');
});
    </script>

</body>
</html>
