<?php include("lib/common.php"); include("lib/session_check.php"); $menu='transaction';
$product=$objMain->getRow("select * from product where id=".$id);
$category=$objMain->getRow("select * from category where id=".$product['category']);
            if($category['parent_id']!=0){
                $parent=$objMain->getRow("select * from category where id=".$category['parent_id']);
                $category_name=$parent['category_name']." ".$category['category_name'];
                $breadcrumb=$parent['category_name']." / ".$category['category_name']; $parent_cat=$parent['id'];
            } else { $category_name=$category['category_name']; $breadcrumb=$category['category_name']; }
 ?>
<!DOCTYPE html> <?php $ptype="Images"; ?>
<html lang="en">
<head>
    <?php include("inc/header_scripts.php"); ?>
    <title>Product <?php echo $ptype; ?></title>
    <style type="text/css">
        #body ul li:first-child span{
            display: none;
        }
        #body ul li {
            background: #FFF;
        }
    </style>
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
                <h4 class="mb-0"> <?php echo $product['product_name']." - ".$ptype; ?>  <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="btn btn-danger btn-xs pull-right"><i class="fa fa-mail-reply"></i> Back to Products</a>
                </h4>

                <ol class="breadcrumb mb-0 pl-0 pt-1 pb-0">
                    <li class="breadcrumb-item active"><?php echo $category_name; ?></li>
                </ol>
                <div class="alert alert-success alert-dismissable" id="success_alert" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <p> File Uploaded Successfully</p>
                </div>
            </div>
            <!--page title end-->


            <div class="container-fluid">

                <div class=" col-md-12">
                        <div class="card card-shadow mb-4">
                            <div class="card-header">
                                <div class="card-title">
                                    Photos
                                </div>
                            </div>
                            <div class="card-body">
                                <form class="dropzone dropzone-info" id="ImagesUpload" action="init.php?module=admin&action=car&do=imageupdate&id=<?php echo $id; ?>" enctype="multipart/form-data" >
                                    <div class="dz-message needsclick">
                                        <h6>Drop files here or click to upload.</h6>
                                        <span class="note needsclick">( Only Upload  <strong> JPG, JPEG, PNG, GIF</strong> Files )</span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" id="reorder_status" value="0">

                    <div class="col-md-12" style="margin-bottom: 100px;">
                        <div class="row col-md-12">
                        <span class="btn pull-right btn-primary reorder" style="float: right; cursor: pointer;" onclick="reorderimages();">Save Reordering</span>
                         </div>
                    <div class="col-xs-12 showimg">
                        <div  class="alert alert-warning mt-3" style="margin-bottom: 45px;">
            <i class="fa fa-3x fa-exclamation-triangle float-right"></i> 1. Drag photos to reorder.<br>2. Click 'Save Reordering' when finished.<br>3. First Image is Cover Image
        </div>
<span class="col-xs-3 btn btn-outline-dark" style="position: absolute;background: #FFF;border-top: 1px solid;border-bottom: none;border-right: none;border-left: none;bottom: 103px;width: 140px;left: 0;">Cover Image</span>
              <!-- /.box -->
<?php
    if(isset($msg) && $msg=='del')
    $msg="Memes Removed Successfully.";
    ?>
    <?php if(isset($msg)) { ?>
      <div class="alert alert-danger alert-dismissable margin-top-20">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <p><i class="icon fa fa-ban"></i> <?php echo $msg; ?></p>
      </div>
          <?php } ?>
          <div class="row" id="body">
            <ul class="nav nav-pills ui-sortable" id="server_images">
              <?php $gallery=$objMain->getResults("select * from product_images where parent_id=".$id." order by sort_order"); 
              if(!empty($gallery)) { foreach($gallery as $gimgs) { ?>
<li id="image_li_<?php echo $gimgs['id']; ?>" class="mr-2 mt-2 ui-sortable-handle">
              <div class="form-group" style="float: left; position: relative; margin:20px;" id="img_<?php echo $gimgs['id']; ?>">
              <img src="<?php echo HTTP_PRODUCT.$gimgs['image_path']; ?>" style="width: 100px;"  />
                <span style="position: absolute;right: 0;top: 0;z-index: 99999999;cursor: pointer;font-size: 19px;background: #FFF;padding: 6px;line-height: 10px;" onclick="deletePhoto(<?php echo $gimgs['id']; ?>);"><i class="fa fa-close"></i></span>           
              </div>
              </li>
              <?php } } ?>
             </ul>
              <!-- /.box -->
            </div><!-- /.col -->

            <div class="row">                
                <div class="alert alert-danger alert-dismissable col-md-12" id="exceed_alert" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <p> Maximum 10 Images only allowed</p>
                </div>
            </div>
                </div>

                <!-- state end-->

            </div>

                <!-- state start-->
                

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
    <!--Dropzone-->
    

    <script type="text/javascript">

          
            $("ul.nav").sortable({ tolerance: 'pointer' });

        var serviceBlockUploadImage = $("#ImagesUpload").dropzone({
    url: "lib/ajax.php?type=upload_images&id=<?php echo $id; ?>",
    parallelUploads: 20,
    maxFiles: 50,
    maxFilesize: 8,
    addRemoveLinks: true,
    init: function() {
        this.on("success", function(file, response) {
            data = jQuery.parseJSON(response);
             $("#server_images").html(data['images']);
            if(data['alert']!=''){
                eval(data['alert']);
            } else {
            $('#exceed_alert').hide();
            toastr.success("Images Uploaded Successfully","");
        }
            $(".dz-remove").hide();
            $(".dz-filename").hide();
            $(".dz-message").show();
            $(".dz-message").html('<h6>Drop files here or click to upload.</h6> <span class="note needsclick">( Only Upload  <strong> JPG, JPEG, PNG, GIF, PDF</strong> Files )</span>');
            $("div.dz-preview").remove();

        });
    },
    uploadMultiple: true,
    acceptedFiles: '.jpg, .jpeg, .png, .pdf'
});

        function deletePhoto(id){
            $.ajax({
        url: 'lib/ajax.php',
        type: 'post',
        data: {'id': id, type: 'delete_image' },
        success: function(data) { 
           eval(data);
           $("#img_"+id).hide();
        }
    });
        }

        $(document).ready(function (e) {
    $('#images').on('submit',(function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type:'POST',
            url: $(this).attr('action'),
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
                console.log("success");
                eval(data);
                $('#images').trigger("reset");
            },
            error: function(data){
                console.log("error");
                console.log(data);
            }
        });
    }));

    

});

        function reorderimages(){
        var h = [];
                        $("#server_images li").each(function() { h.push($(this).prop('id').substr(9));  });
                         
                        $.ajax({
                            type: "POST",
                            url: "lib/ajax.php?type=image_sortorder&id=<?php echo $id; ?>",
                            data: {ids: " " + h + ""},
                            success: function(data){
                                toastr.success("Images Re Ordering Successfully","");
                            }
                        }); 
                        return false;
    }
    </script>
</body>
</html>
