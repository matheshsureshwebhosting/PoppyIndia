<?php include("lib/common.php");
include("inc/facebook_script.php");
$objMain->Query("update orders set status='failure' where id=".$_SESSION['order_id']);

header("location:cart.php?msg=failed");

?>