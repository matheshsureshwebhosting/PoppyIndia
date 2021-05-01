<?php extract($_REQUEST); require_once 'connection.php'; require_once 'functions.php'; require_once 'admin.php';
require_once 'PHPMailer/class.phpmailer.php';

if($type=='order_update'){
	$objMain->Query("update orders set status='".$status."' where id=".$id);
	$order=$objMain->getRow("select * from orders where id=".$id);
if($order['userid']!=0) {
	$user=$objMain->getRow("select * from customers where id=".$order['userid']);
if($user['emailid']!='' || $order['emailid']!=''){

	if($order['emailid']!='') $emailid=$order['emailid'];
	else if($user['emailid']!='') $emailid=$user['emailid'];
	if($status=='out-for-delivery')	{ 
	    $objAdmin->DeliveryOutEmail($emailid);
	} else if($status=='delivered'){
	    $objAdmin->DeliveredEmail($emailid);
	} else if($status=='cancelled'){
		$objAdmin->CancelOrderMail($id,$emailid);
	}
} }
if($order['mobileno']!=''){
    if($status=='out-for-delivery')	{ 
        $message='Your purchase for '.$order['tracking_id'].' Mattress has been shipped and out for delivery. Use the tracking link to see how many sleeps you are away from Poppy';
	    $objAdmin->sendsms($order['mobileno'],$message);
	} else if($status=='delivered'){
        $message='Thank you for your purchase at Poppy Mattress. You order on '.$order['tracking_id'].' mattress has been delivered to the address. We would love to know your feedback soon';
	    $objAdmin->sendsms($order['mobileno'],$message);
	} else if($status=='cancelled'){
        $message='Hi '.$order['name'].'! Your cancellation is processed for the order number '.$order['tracking_id'].'. It may take up to 5 working days for the refund amount to be reflected on your bank account. See the mail for more';
	    $objAdmin->sendsms($order['mobileno'],$message);
	}
}
} else if($type=='upload_images'){
	$destinationpath=DIR_PRODUCT;
	$last=$objMain->getRow("select sort_order from product_images where parent_id=".$id." order by sort_order desc");
	$exceed=0;
	$count=0;
	$images="";
				$alert="";
$sort_order=$last['sort_order'];
	foreach ($_FILES['file']['name'] as $filename) 
            {
			 if($filename!="") 
			 {
			 	$sort_order++;
				$rnd=rand(999,10000);
				$ext = pathinfo(basename($_FILES['file']['name'][$count]), PATHINFO_EXTENSION);
				$image_path =$rnd."_".$objMain->url_slug_name(basename($_FILES['file']['name'][$count])).".".$ext;
				$tmp=$_FILES['file']['tmp_name'][$count];
				$targetpath=$destinationpath.$image_path;
				move_uploaded_file($tmp,$targetpath);
				$objMain->Query("insert into product_images set parent_id=".$id.",image_path='".$image_path."', sort_order=".$sort_order);
				$rid=$objMain->insertID();
				$count++;
			 }
            }
       

 $gallery=$objMain->getResults("select * from product_images where parent_id=".$id); $cnt=0;
              if(!empty($gallery)) { foreach($gallery as $gimgs) {  $cnt++;

              $images.='<li id="image_li_'.$gimgs['id'].'" class="mr-2 mt-2 ui-sortable-handle">
              <div class="form-group" style="float: left; position: relative; margin:20px;" id="img_'.$gimgs['id'].'">
              <img src="'.HTTP_PRODUCT.$gimgs['image_path'].'" style="width: 100px;"  />';
              if($cnt>1)
              $images.='<span style="position: absolute;right: 0;top: 0;z-index: 99999999;cursor: pointer;font-size: 19px;background: #FFF;padding: 6px;line-height: 10px;" onclick="deletePhoto('.$gimgs['id'].');"><i class="fa fa-close"></i></span>';
              $images.='</div></li>';
              
              } } 
$data = array("images" => $images, 'alert' => $alert);
$json = json_encode($data);
echo $json;
} else if($type=='delete_image'){
	$res=$objMain->getRow("select * from product_images where id=".$id);
	unlink(DIR_PRODUCT.$res['image_path']);
	$objMain->Query("delete from product_images where id=".$id);
}  else if($type=='image_sortorder'){
	$ids=explode(",",$ids); $sort=0;
	foreach($ids as $imgid){ $sort++;
		if($sort==1) {
			$img=$objMain->getRow("select * from product_images where id=".$imgid);
			$objMain->Query("update product set cover_image='".$img['image_path']."' where id=".$id);
		}
		$objMain->Query("update product_images set sort_order=".$sort." where id=".$imgid);
	}
}
?>