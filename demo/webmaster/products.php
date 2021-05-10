<?php include("lib/common.php"); include("lib/session_check.php"); $menu='master';
 ?>
<!DOCTYPE html> <?php $ptype='Products'; ?>
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
                    <div class="col-lg-12 top_search">
<form method="get" action="products.php" id="search_form">
<div class="col-lg-1 pull-right">
    <button type="submit" class="btn btn-danger">SEARCH</button>
</div>
<div class="col-lg-3 pull-right">

                    <select class="form-control select2" id="category" name="category">
                        <option value="0">--Select Category--</option>
                                            <?php $results=$objMain->getResults("select * from category where parent_id=0");
                                            if(!empty($results)){ foreach($results as $result) { 
                                                $subcategory=$objMain->getResults("select * from category where parent_id=".$result['id']);
                                                if(!empty($subcategory)){ ?>
                                                    <optgroup label="<?php echo $result['category_name']; ?>"> <?php
                                                    foreach($subcategory as $subcate){ ?>
<option value="<?php echo $subcate['id']; ?>" <?php if(isset($category) && $category==$subcate['id']) echo "selected"; ?> ><?php echo $subcate['category_name']; ?></option>
<?php                                                    } ?>

                                                </optgroup> <?php
                                                } else { ?>
<option value="<?php echo $result['id']; ?>" <?php if(isset($category) && $category==$result['id']) echo "selected"; ?>><?php echo $result['category_name']; ?></option>
                                                <?php } ?>
                                                ?>
                                            <?php } } ?>
                                        </select>
</div>
         </form>

                </div>

                    <div class=" col-sm-12">
                        <?php
    if(isset($msg) && $msg=='suc') { $atype="success";
    $msg=$ptype." Added successfully"; }
     if(isset($msg) && $msg=='upd') { $atype="success";
    $msg=$ptype." Meta Updated successfully"; }
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
                        <div class="card card-shadow mb-4">
                            
                            <div class="card-body">
                                <table id="bs4-table" class="table table-bordered table-striped" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Image</th>
                                        <th>Product Name</th>
                                        <th>Images</th>
                                    </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <?php 
$qry=""; 

if(isset($category) && $category!=0)  $qry.=" and category=".$category;



if($qry=="") $qry=" and 1=2";
    $results=$objMain->getResults("select * from product where 1=1 ".$qry." order by sort_order");

                                        if(!empty($results)) { $i=0; foreach($results as $result) { $i++;
                                         ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><img src="<?php echo HTTP_PRODUCT.$result['cover_image']; ?>" style="width: 100px;"></td>
                                        <td><?php echo $result['product_name']; ?></td>
                                        <td> 
                                            <a href="products_images.php?id=<?php echo $result['id']; ?>" class="btn btn-success btn-sm">Images</a>
                                            <a href="products_meta.php?id=<?php echo $result['id']; ?>" class="btn btn-success btn-sm">Meta Update</a>
                                        </td>
                                    </tr>
                                    <?php } } ?>
                                   
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
