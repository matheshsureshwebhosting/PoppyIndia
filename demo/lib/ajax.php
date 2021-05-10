<?php extract($_REQUEST); require_once 'connection.php'; require_once 'functions.php'; require_once 'admin.php'; require_once 'PHPMailer/class.phpmailer.php';

if($type=='addtocart') { $total_qty=0; $total_price=0; $ctqty=$qty;
			if(!isset($_SESSION['items']) || count($_SESSION['items'])==0){  //echo "--1--";
				$_SESSION['items'][0]['productid']=$productid;
				$_SESSION['items'][0]['dimension']=$dimension;
				$_SESSION['items'][0]['product_size']=$product_size;
				$_SESSION['items'][0]['qty']=$qty;
				$_SESSION['items'][0]['price']=$objMain->clean_amount('price');
				$_SESSION['items'][0]['custom_length']=$custom_length;
				$_SESSION['items'][0]['custom_width']=$custom_width;
				$_SESSION['items'][0]['product_type']=$product_type;
				$_SESSION['items'][0]['product_color']=$product_color;
				$_SESSION['total_qty']=$qty;
				$total_price=$qty*$_SESSION['items'][0]['price'];
			} else if(count($_SESSION['items'])>0){ //echo "---2---";

				$_SESSION['total_qty']=$_SESSION['total_qty']+$qty;
				$cnt=0;
				foreach($_SESSION['items'] as $key=>$item){
					//echo "<pre>";
					//print_r($_REQUEST);
					//echo "--------------";
					//print_r($item);
					if($item['productid']==$productid && $product_type=="normal" && $item['product_size']==$product_size && $item['dimension']==$dimension && $item['product_color']==$product_color ){ 
						$cnt=1; //echo "1";
						//echo $item['productid']."==".$productid." && ".$product_type."=="."normal"." && ".$item['product_size']."==".$product_size." && ".$item['dimension']."==".$dimension;
						$_SESSION['items'][$key]['qty']=$_SESSION['items'][$key]['qty']+$qty;
						$ctqty+=$_SESSION['items'][$key]['qty'];
					} else if($item['productid']==$productid && $product_type=="custom" && $item['custom_length']==$custom_length && $item['custom_width']==$custom_width && $item['dimension']==$dimension && $item['product_color']==$product_color){ $cnt=1; //echo "2";
					//echo $item['productid']."==".$productid." && ".$product_type."=="."custom"." && ".$item['custom_length']."==".$custom_length." && ".$item['custom_width']."==".$custom_width." && ".$item['dimension']."==".$dimension;
						$_SESSION['items'][$key]['qty']=$_SESSION['items'][$key]['qty']+$qty;
						$ctqty+=$_SESSION['items'][$key]['qty'];
					}

					$total_price=$total_price+($_SESSION['items'][$key]['price']*$_SESSION['items'][$key]['qty']);
				}

				if($cnt==0){
					$keys = array_keys($_SESSION['items']);
					$last = end($keys);
					$id=$last+1;
					$_SESSION['items'][$id]['productid']=$productid;
					$_SESSION['items'][$id]['dimension']=$dimension;
					$_SESSION['items'][$id]['product_size']=$product_size;
					$_SESSION['items'][$id]['qty']=$qty;
					$_SESSION['items'][$id]['price']=$objMain->clean_amount('price');
					$_SESSION['items'][$id]['custom_length']=$custom_length;
					$_SESSION['items'][$id]['custom_width']=$custom_width;
					$_SESSION['items'][$id]['product_type']=$product_type;
					$_SESSION['items'][$id]['product_color']=$product_color;
					$total_price=$total_price+($_SESSION['items'][$id]['price']*$_SESSION['items'][$id]['qty']);
				}

			}
	//print_r($_SESSION);
	//		echo $total_price;
	$_SESSION['sub_total']=$total_price;
	if(isset($_SESSION['discount_type']) && $_SESSION['discount_type']=='flat') {
			$_SESSION['net_amount']=$_SESSION['sub_total']-$_SESSION['discount_value'];
	} else if(isset($_SESSION['discount_type']) && $_SESSION['discount_type']=='percentage') {	
			$_SESSION['discount_value']=round($_SESSION['sub_total']*$_SESSION['discount_val']/100);
			$_SESSION['net_amount']=$_SESSION['sub_total']-$_SESSION['discount_value'];
	}

	$free_amount=0;

	$free=$objMain->getResults("select * from product_free where parent_id=".$productid);
	if(!empty($free)){
		foreach($free as $fr){

			if($product_type=='normal'){            
            	$prod_size=$objMain->getRow("select * from product_price where id=".$product_size);
            	$free_size=$prod_size['size_inch_b'];
        	} else {
        		$free_size=$custom_width;
        	}
             if($product_type=='normal'){    
             	// echo "select * from product_free_cost where product_id=".$fr['free_product_id']." and size_from<=".$prod_size['size_inch_w']." and size_to>=".$free_size;
             	// exit;
			$prod=$objMain->getRow("select * from product_free_cost where product_id=".$fr['free_product_id']." and size_from <=".$prod_size['size_inch_w']." and size_to >=".$free_size);
        	}else{
			$prod=$objMain->getRow("select * from product_free_cost where product_id=".$fr['free_product_id']." and size_from >=".$custom_length." and size_to >=".$custom_width);
        	}
        	if(!empty($prod['product_colors']))
        	{
        		$_SESSION['items'][(isset($id))? $id:0]['product_free_color']='#f7c3cf';
        	}

			$free_amount+=$prod['cost']*$fr['qty'];
		}
	}

	$free_amount=$free_amount*$ctqty;

	$alert='toastr.success("Item added in the Cart","");';
	$data = array("result" => 'success', 'alert' => $alert, 'total_qty' => $_SESSION['total_qty'], 'free_amount' => $free_amount);
	$json = json_encode($data);
	//print_r($_SESSION);
	echo $json;

} else if($type=='updatecart'){		// print_r($_SESSION);		// Update Cart
	$_SESSION['total_qty']=0;
	$qty=intval($qty);
	$cnt=0; $price=0; $total_price=0;
	foreach($_SESSION['items'] as $key=>$item){
		if($key==$prodkey){ $cnt=1;
			$_SESSION['items'][$key]['qty']=$qty;
			$_SESSION['items'][$key]['product_color']=$product_color;
			$price=$_SESSION['items'][$key]['price']*$qty;
			$productid=$_SESSION['items'][$key]['productid'];
		}
		$_SESSION['total_qty']=$_SESSION['total_qty']+$_SESSION['items'][$key]['qty'];
		$total_price=$total_price+($_SESSION['items'][$key]['price']*$_SESSION['items'][$key]['qty']);
	}
	$alert='toastr.success("Item Updated in the Cart","");';
	//echo "|".$_SESSION['discount_type']."|";
	$discount_amount=0;
	$net_amount=0;
	$_SESSION['sub_total']=$total_price;
	if(isset($_SESSION['discount_type']) && $_SESSION['discount_type']=='flat') {
			$_SESSION['net_amount']=$_SESSION['sub_total']-$_SESSION['discount_value'];
			$discount_amount=$_SESSION['discount_value'];
			$net_amount=$_SESSION['net_amount'];
	} else if(isset($_SESSION['discount_type']) && $_SESSION['discount_type']=='percentage') {	
			$_SESSION['discount_value']=round($_SESSION['sub_total']*$_SESSION['discount_val']/100);
			$_SESSION['net_amount']=$_SESSION['sub_total']-$_SESSION['discount_value'];
			$discount_amount=$_SESSION['discount_value'];
			$net_amount=$_SESSION['net_amount'];
	}

	$free_1=0; $free_2=0; $free_3=0;
	$free=$objMain->getResults("select * from product_free where parent_id=".$productid);
	if(!empty($free)){ $i=0;
		foreach($free as $fr){ $i++;
			if($i==1) $free_1=$fr['qty']*$qty;
			else if($i==2) $free_2=$fr['qty']*$qty;
			else if($i==3) $free_3=$fr['qty']*$qty;
		}
	}
	$data = array("result" => 'success', 'alert' => $alert, 'total_qty' => $_SESSION['total_qty'], 'discount_amount'=> $discount_amount, 'net_amount' => $net_amount, 'price' => $objMain->INR($price), 'total_price' => $objMain->INR($total_price), 'free_1' => $free_1, 'free_2' => $free_2, 'free_3' => $free_3 );
	$json = json_encode($data);
	echo $json;

} else if($type=='updatefreeproductcolor'){		// print_r($_SESSION);		// Update Cart
	$cnt=0; $price=0; $total_price=0;
	foreach($_SESSION['items'] as $key=>$item){
		if($key==$prodkey){ $cnt=1;
			$_SESSION['items'][$key]['product_free_color']=$product_color;
		
		}
	}
	$alert='toastr.success("Item Updated in the Cart","");';
	//echo "|".$_SESSION['discount_type']."|";

	$data = array('alert' => $alert );
	$json = json_encode($data);
	echo $json;

}  else if($type=='removecart'){			// Remove Cart Item
	$_SESSION['total_qty']=0; $total_price=0;
	// print_r($_SESSION['items']);
	// exit;
	foreach($_SESSION['items'] as $pkey=>$item){
		if($key==$pkey){ $cnt=1;
			unset($_SESSION['items'][$pkey]);
		} else {
			$_SESSION['total_qty']=$_SESSION['total_qty']+$_SESSION['items'][$pkey]['qty'];
			$total_price=$total_price+($_SESSION['items'][$pkey]['price']*$_SESSION['items'][$pkey]['qty']);
		}
	}
	$discount_amount=0;
	$net_amount=0;
	$_SESSION['sub_total']=$total_price;
	if(isset($_SESSION['discount_type']) && $_SESSION['discount_type']=='flat') {
			$_SESSION['net_amount']=$_SESSION['sub_total']-$_SESSION['discount_value'];
			$discount_amount=$_SESSION['discount_value'];
			$net_amount=$_SESSION['net_amount'];
	} else if(isset($_SESSION['discount_type']) && $_SESSION['discount_type']=='percentage') {	
			$_SESSION['discount_value']=round($_SESSION['sub_total']*$_SESSION['discount_val']/100);
			$_SESSION['net_amount']=$_SESSION['sub_total']-$_SESSION['discount_value'];
			$discount_amount=$_SESSION['discount_value'];
			$net_amount=$_SESSION['net_amount'];
	}
	$alert='toastr.success("Item removed in the Cart","");';
	$data = array("result" => 'success', 'alert' => $alert, 'total_qty' => $_SESSION['total_qty'], 'discount_amount'=> $discount_amount, 'net_amount' => $net_amount, 'total_price' => $objMain->INR($total_price));
	$json = json_encode($data);
	echo $json;

} else if($type=='register'){				// Registration Validation
	$qry=""; $error=0; $message=""; $mcount=0; $ecount=0;
	if($mobileno!="") { 
		$qry=" mobileno='".$mobileno."'";
		$mcount=$objMain->getResultsCount("select * from customers where ".$qry); 
		if($mcount>0) {
		$message="* Mobileno Already registered with us";
		$error=1;
		}
	}
	if($emailid!="") { $qry =" emailid='".$emailid."'";
		$ecount=$objMain->getResultsCount("select * from customers where ".$qry);
		if($ecount>0) {
		$message='* Email ID Already Registered with us';
		$error=1;
		}
	}

	if($mcount>0 && $ecount>0) { $error=1;
		$message='* Both Mobileno & Email ID Already registered with us';
	} 

	if($error==0){
		$_SESSION['otp']=rand(1000,9999);
		$_SESSION['name']=$name;
		$_SESSION['mobileno']=$mobileno;
		$_SESSION['emailid']=$emailid;
		$_SESSION['userpassword']=md5($userpassword);
		$_SESSION['subscription']=$subscription;
		$message='* OTP hasbeen sent to your Email / Mobile';
		
		if($_SESSION['emailid']!='')
		$objAdmin->OTPMail($_SESSION['emailid'],$_SESSION['otp']);
		
		$otpmsg='Hi! Welcome to Poppy Sleep World. Thank you for signing up with us. Your OTP is '.$_SESSION['otp'].' Enter the OTP and have a great shopping experience at Poppy. ';
	    
		if($_SESSION['mobileno']!='')
	    $objAdmin->sendsms($mobileno,$otpmsg);
	    
	}

	$data = array("message" => $message, 'error'=>$error);
$json = json_encode($data);
echo $json;

} else if($type=='otp_validate'){		// Registration OTP Validate
	$return_url=''; 
	if($otp==$_SESSION['otp']) {
		$status='success';
		$objMain->Query("insert into customers set customer_name='".$_SESSION['name']."', mobileno='".$_SESSION['mobileno']."', emailid='".$_SESSION['emailid']."',  userpassword='".$_SESSION['userpassword']."', subscription='".$_SESSION['subscription']."', join_date='".date("Y-m-d H:i:s")."'");
		$userid=$objMain->insertID();
		if($_SESSION['emailid']!='')
		$objAdmin->welcomeEmail($_SESSION['emailid']);
	    
		$_SESSION['userid']=$userid;
		unset($_SESSION['otp']); unset($_SESSION['name']); unset($_SESSION['mobileno']); unset($_SESSION['emailid']); unset($_SESSION['userpassword']);
		if(isset($_SESSION['items']) && count($_SESSION['items'])>0) $return_url='cart.php';
		else $return_url='index.php';
	} else $status='failure';


	$data = array("status" => $status, 'return_url'=>$return_url);
$json = json_encode($data);
echo $json;

} else if($type=='reset_otpvalidate'){			// Reset OTP Validate
	if($_SESSION['otp']==$otp){
		echo "success";
	} else echo "failure";

} else if($type=='otp_resend'){	 print_r($_SESSION);			// Resend OTP
	$_SESSION['otp']=rand(1000,9999);
	if($_SESSION['emailid']!='') { echo "Email";
		$objAdmin->OTPMail($_SESSION['emailid'],$_SESSION['otp']);
	}
		$otpmsg='Hi! Welcome to Poppy Sleep World. Thank you for signing up with us. Your OTP is '.$_SESSION['otp'].' Enter the OTP and have a great shopping experience at Poppy. ';
	    
		if($_SESSION['mobileno']!='') {  echo "Mobile";
	    $objAdmin->sendsms($_SESSION['mobileno'],$otpmsg);
		}

} else if($type=='forget_otp_resend'){	 print_r($_SESSION);			// Resend OTP
	$_SESSION['otp']=rand(1000,9999);
	if($_SESSION['emailid']!='') { echo "Email";
		$objAdmin->OTPMail($_SESSION['emailid'],$_SESSION['otp']);
	}
		$otpmsg='To reset your Poppy Account password enter your OTP : '.$_SESSION['otp'].' and have a great shopping experience at Poppy. ';
	    
		if($_SESSION['mobileno']!='') {  echo "Mobile";
	    $objAdmin->sendsms($_SESSION['mobileno'],$otpmsg);
		}

} else if($type=='validate_login'){				// Login Validate
	$user=$objMain->getRow("select * from customers where (email='".$username."' or mobileno='".$username."') and userpassword='".$userpassword."'");
	if(!empty($user)){
		if(isset($_SESSION['items']) && count($_SESSION['items'])>0) $return_url='cart.php';
		else $return_url='dashboard.php';
	} else {
		$status='failure';
	}

}else if($type=='productfilter'){				// Login Validate
	 $prices=$objMain->getResults("select * from product_price where product_id=".$productid." and dimension=".$dimension);
if(!empty($prices))
{ $i=0;
    foreach($prices as $price){ $i++; 
    	if($price['size_name']==$size){
        echo '<option value="'.$price['id'].'" data-count="'.$i.'" data-content="'.$price['size_inch_w'].'x '.$price['size_inch_b'].'in | '.$price['size_mm_w'].' x '.$price['size_mm_b'].'mm">'.$price['size_name'].'</option>';
    }
 
    }
    } 

}else if($type=='validate_coupon'){ //print_r($_SESSION);		// Validate Coupon
	$status=''; $discount_value=0; $net_amount=0;
	//echo "select * from coupon where coupon_code='".$coupon."' and start_date<='".date("Y-m-d")."' and expire_date>='".date("Y-m-d")."'";
	$res=$objMain->getRow("select * from coupon where coupon_code='".$coupon."' and start_date<='".date("Y-m-d")."' and expire_date>='".date("Y-m-d")."'");
	if(!empty($res)){
		$_SESSION['discount_coupon']=$coupon;
		$_SESSION['discount_type']=$res['discount_type'];
		if($res['discount_type']=='flat'){
			$_SESSION['discount_value']=$res['discount_value'];
			$_SESSION['discount_val']=$res['discount_value'];
			$_SESSION['net_amount']=$_SESSION['sub_total']-$res['discount_value'];
		} else if($res['discount_type']=='percentage'){		
			$_SESSION['discount_val']=$res['discount_value'];	
			$_SESSION['discount_value']=round($_SESSION['sub_total']*$res['discount_value']/100);
			$_SESSION['net_amount']=$_SESSION['sub_total']-$_SESSION['discount_value'];
		}
		$status='success';
		$discount_value=$objMain->INR($_SESSION['discount_value']);
		$net_amount=$objMain->INR($_SESSION['net_amount']);
	} else {
		$status='failure';
	}
	$data = array("status" => $status, 'discount_value'=>$discount_value, 'net_amount'=>$net_amount);
$json = json_encode($data);
echo $json;
} else if($type=='subscription'){

	if($mobileno!='')
	$cnt=$objMain->getResultsCount("select * from subscription where mobileno='".$mobileno."'");
	else if($emailid!='')
	$cnt=$objMain->getResultsCount("select * from subscription where emailid='".$emailid."'");

if($cnt==0){
	$objMain->Query("insert into subscription set mobileno='".$mobileno."', emailid='".$emailid."', subscription_date='".date("Y-m-d H:i:s")."'");
	$status='success';
} else $status='exist';

	$data = array("status" => $status);
$json = json_encode($data);
echo $json;
} else if($type=='payment_success'){

	if(isset($razorpay_order_id) && $razorpay_order_id==$_SESSION['order_token']) {

	$id=$_SESSION['order_id'];
	$order_total=0;
	
         
         $qry="";
         if(isset($_SESSION['discount_coupon'])){
         	$qry.=", coupon_code='".$_SESSION['discount_coupon']."', coupon_value='".$_SESSION['discount_value']."',  net_amount='".$_SESSION['net_amount']."'";
         } else {
         	$qry.=", coupon_code='', coupon_value='0',  net_amount='".$_SESSION['sub_total']."'";         	
         }
         
        // echo "update orders set sub_total='".$_SESSION['sub_total']."', tracking_id='".ID_PREFIX.$id."'".$qry." where id=".$id;
        $objMain->Query("update orders set sub_total='".$_SESSION['sub_total']."', tracking_id='".ID_PREFIX.$id."'".$qry.", status='verification-process' where id=".$id);
        
        
        $order=$objMain->getRow("select * from orders where id=".$id);
        if($order['userid']!=0) {
            $user=$objMain->getRow("select * from customers where id=".$order['userid']);
            if($user['emailid']!='') {
                $objAdmin->sendOrderemail($id, $user['emailid']);
            } 
	    
            $userid=$_SESSION['userid'];
            session_destroy();
            session_start();
            $_SESSION['userid']=$userid;
        } else {
            session_destroy();
        }
        
        $msg='Hey! Thank you for purchasing with Poppy\'s. Your order for the '.$order['tracking_id'].' mattress has been confirmed. Check the link below to track the order https://bit.ly/2ZVPezL ';
    	    
    	if($order['mobileno']!='')
    	$objAdmin->sendsms($order['mobileno'],$msg);
    

    $data = array("status" => "success", 'id'=> ID_PREFIX.$id);
$json = json_encode($data);
echo $json;
	} else {
	 $data = array("status" => "failure");
$json = json_encode($data);
echo $json;
}
}
?>