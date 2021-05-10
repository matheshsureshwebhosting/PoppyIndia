<?php
global $objAdmin;
class Admin extends Main
{
	public function Postvalue($x)
	{
	$x = $_POST[$x];
	/*$x = str_replace("'","&#39;",$x);
	$x = str_replace("<","",$x);
	$x = str_replace(">","",$x);
	$x = htmlentities($x, ENT_QUOTES); //ENT_QUOTES – Decodes double and single quotes*/
	$x = mysql_real_escape_string($x); 
	return $x;
	}
	public function rand_string( $length ) {
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";	

	$size = strlen( $chars );
	for( $i = 0; $i < $length; $i++ ) {
		$str .= $chars[ rand( 0, $size - 1 ) ];
	}

	return $str;
    }
	public function gen_md5_password($len = 6)
	{
	// function calculates 32-digit hexadecimal md5 hash
	// of some random data
	return substr(md5(rand().rand()), 0, $len);
	}
    
	public function redirectUrl($url){
		echo '<SCRIPT language="JavaScript">
			<!--
			window.location="'.$url.'";
			//-->
		</SCRIPT>';
	}
	public function ajaxredirectUrl($url){
		echo 'window.location="'.$url.'";';
	}
	
	public function checkout(){ extract($_REQUEST);
		$name=$this->clean('username');
		$mobileno=$this->clean_amount('mobileno');
		$emailid=$this->clean_amount('emailid');
		$mobileno_alt=$this->clean_amount('mobileno_alt');
		$address=$this->clean('address');
		$city=$this->clean('city');
		$state=$this->clean('state');
		$pincode=$this->clean_amount('pincode');
		$order_notes=$this->clean('order_notes');
		$order_date=date("Y-m-d H:i:s");
		if(isset($_SESSION['userid'])) $userid=$_SESSION['userid'];
		else {
			$usr=$this->getRow("select * from customers where mobileno='".$mobileno."'");
			if(!empty($usr)){
				$userid=$usr['id'];
				$_SESSION['userid']=$userid;
			} else {
				$permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            	$userpassword=substr(str_shuffle($permitted_chars), 0, 6);

				$this->Query("insert into customers set customer_name='".$name."', mobileno='".$mobileno."', emailid='".$emailid."',  userpassword='".$userpassword."', join_date='".date("Y-m-d H:i:s")."'");
				$userid=$this->insertID();
				if($emailid!='')
				$this->GuestwelcomeEmail($emailid,$userpassword);
				$otpmsg='Hi! Welcome to Poppy Sleep World. Thank you for signing up with us. Use your Mobile No or Email as username and Password is :'.$userpassword.'. Have a great shopping experience at Poppy. ';
    	  		$this->sendsms($mobileno,$otpmsg);
    	  		$_SESSION['userid']=$userid;
				}
		}
		$this->Query("insert into orders set userid='".$userid."', status='initiated', name='".$name."', mobileno='".$mobileno."', emailid='".$emailid."', mobileno_alt='".$mobileno_alt."', address='".$address."', city='".$city."', state='".$state."', pincode='".$pincode."', order_notes='".$order_notes."', order_date='".$order_date."'");
		//die("insert into orders set userid='".$userid."', status='initiated', name='".$name."', mobileno='".$mobileno."', emailid='".$emailid."', mobileno_alt='".$mobileno_alt."', address='".$address."', city='".$city."', state='".$state."', pincode='".$pincode."', order_notes='".$order_notes."', order_date='".$order_date."'");
		$id=$this->insertID();
		if(isset($_SESSION['net_amount']) && $_SESSION['net_amount']!=0)
		$amount=$_SESSION['net_amount'];
		else 
		$amount=$_SESSION['sub_total'];
		

//if($userid==9 || $userid==18 || $userid==27) $amount=1;

		//$amount=1;
		$token=$this->getOrderID($amount,$id);
		$_SESSION['order_id']=$id;

		if($token!='error'){  
		$_SESSION['order_id']=$id;
		$_SESSION['order_token']=$token;

	$order_total=0;
		foreach($_SESSION['items'] as $key=>$item){       

            $product_size=$this->getRow("select * from product_price where id=".$item['product_size']);
            $prodcut_price=$this->clean_text($item['price']);
            $order_total+=$item['qty']*$prodcut_price;

            $product=$this->getRow("select * from product where id=".$item['productid']);
            $category=$this->getRow("select * from category where id=".$product['category']);
            if($category['parent_id']!=0){
                $parent=$this->getRow("select * from category where id=".$category['parent_id']);
                $category_name=$parent['category_name']." / ".$category['category_name'];
            } else $category_name=$category['category_name'];

if($item['product_type']=='normal'){            
            $product_size=$this->getRow("select * from product_price where id=".$item['product_size']);
            $prod_size=$product_size['size_name']." - ".$product_size['size_inch_w']." x ".$product_size['size_inch_b']." in | ".$product_size['size_mm_w']." x ".$product_size['size_mm_b']." mm  X ".$item['dimension'];
        } else if($item['product_type']=='custom'){
            $prod_size="Custom Size : ".$item['custom_length']." in X ".$item['custom_width']." in";
        }

//echo "insert into orders_items set order_id='".$id."', product_id='".$item['productid']."', cover_image='".$product['cover_image']."', category='".$category_name."', product_name='".$product['product_name']."', product_size='".$prod_size."', price='".$prodcut_price."', qty='".$item['qty']."', amount='".($item['qty']*$prodcut_price)."', product_type='".$item['product_type']."', custom_length='".$item['custom_length']."', custom_width='".$item['custom_width']."', product_height='".$item['dimension']."'<br<br>";

            $this->Query("insert into orders_items set order_id='".$id."', product_id='".$item['productid']."', cover_image='".$product['cover_image']."', category='".$category_name."', product_name='".$product['product_name']."', product_size='".$prod_size."', price='".$prodcut_price."', qty='".$item['qty']."', amount='".($item['qty']*$prodcut_price)."', product_type='".$item['product_type']."', custom_length='".$item['custom_length']."', custom_width='".$item['custom_width']."', product_height='".$item['dimension']."'");

            $freebis=$this->getResults("select * from product_free where parent_id=".$product['id']);
            if(!empty($freebis)){
                foreach($freebis as $free){ 

                     $prod=$this->getRow("select * from product where id=".$free['free_product_id']);

                	 $cat=$this->getRow("select * from category where id=".$prod['category']);
            		 $cat_name=$cat['category_name'];
//echo "insert into orders_items set order_id='".$id."', product_id='".$prod['id']."', cover_image='".$prod['cover_image']."', category='".$cat_name."', product_name='".$prod['product_name']."', product_size='', price='', qty='".$free['qty']*$item['qty']."', amount='0', product_type='free', custom_length='', custom_width='', product_height=''<br>";
                    $this->Query("insert into orders_items set order_id='".$id."', product_id='".$prod['id']."', cover_image='".$prod['cover_image']."', category='".$cat_name."', product_name='".$prod['product_name']."', product_size='', price='', qty='".$free['qty']*$item['qty']."', amount='0', product_type='free', custom_length='', custom_width='', product_height=''");
                }
            }

        }
         
         $qry="";
         if(isset($_SESSION['discount_coupon'])){
         	$qry.=", coupon_code='".$_SESSION['discount_coupon']."', coupon_value='".$_SESSION['discount_value']."',  net_amount='".$_SESSION['net_amount']."'";
         } else {
         	$qry.=", coupon_code='', coupon_value='0',  net_amount='".$_SESSION['sub_total']."'";         	
         }
        
        
        $this->Query("update orders set sub_total='".$_SESSION['sub_total']."', tracking_id='".ID_PREFIX.$id."'".$qry.", razorpay_order_id='".$token."' where id=".$id);
		
		//$this->Query("update orders set razorpay_order_id='".$token."' where id=".$id);
       	header("location:order-process.php");
		} else {
		    header("location:cart.php?msg=error");
} 
		
		
	}

	 public function checkLogin() { extract($_REQUEST);
		$result = $this->getRow("SELECT * FROM customers WHERE (mobileno='".$username."' or emailid='".$username."') and userpassword = '".md5($userpassword)."'");
		
		if (!empty($result)) {
			$_SESSION['userid'] = $result['id'];
			if(isset($_SESSION['items']) && count($_SESSION['items'])>0) $return_url='cart.php';
			else $return_url='index.php';

			$this->Query("update customer set last_visited='".date("Y-m-d H:i:s")."' where id=".$result['id']);
			$this->redirectUrl($return_url); 
		} else {

		$this->redirectUrl("login.php?msg=failed");
	} }

	public function forgotpassword(){ extract($_REQUEST);
		$result = $this->getRow("SELECT * FROM customers WHERE (mobileno='".$username."' or emailid='".$username."')");
		if(!empty($result)){  
			$_SESSION['id']=$result['id'];
			$_SESSION['otp']=rand(1000,9999);
			
			if($result['emailid']!='') {
        		$this->ForgotPasswordOTPMail($result['emailid'], $_SESSION['otp']);
        		$_SESSION['emailid']=$result['emailid'];
			}
		
		$otpmsg='To reset your Poppy Account password enter your OTP : '.$_SESSION['otp'].' and have a great shopping experience at Poppy. ';
	    
		if($result['mobileno']!='') {
    	   $this->sendsms($result['mobileno'],$otpmsg);
    		$_SESSION['mobileno']=$result['mobileno'];
		}
			header("location:reset-password.php?msg=sent");
		} else {   header("location:forgot-password.php?msg=wrong"); }
	}

	public function resetPassword(){ extract($_REQUEST);
		$userpassword=md5($this->clean('userpassword'));
		$this->Query("update customers set userpassword='".$userpassword."' where id=".$_SESSION['id']);
		$_SESSION['userid']=$_SESSION['id']; 
		if(isset($_SESSION['items']) && count($_SESSION['items'])>0) { $return_url='cart.php'; }
		else $return_url='index.php';

		$this->redirectUrl($return_url); 
	}

	public function changepassword(){ extract($_REQUEST);
		$userpassword=md5($this->clean('oldpassword'));
		$newpassword=md5($this->clean('newpassword'));
		$res=$this->getRow("select * from customers where userpassword='".$userpassword."' and id='".$_SESSION['userid']."'");
		if(!empty($res)){			
			$this->Query("update customers set userpassword='".$newpassword."' where id=".$_SESSION['userid']);
			header("location:change-password.php?msg=success");
		} else {
			header("location:change-password.php?msg=failed");
		}

	}

	public function UpdateProfile(){ extract($_REQUEST); $qry=""; 
		$customer_name=$this->clean('customer_name');
		$userpassword=$this->clean('userpassword');
		$address=$this->clean('address');
		$city=$this->clean('city');
		$state=$this->clean('state');
		$pincode=$this->clean('pincode');
		if(isset($checkbox)) $subscription='yes';
		else $subscription='no';
		if(isset($emailid)) $qry.=", emailid='".$emailid."'";
		if(isset($mobileno)) $qry.=", mobileno='".$mobileno."'";
		$this->Query("update customers set customer_name='".$customer_name."', address='".$address."', city='".$city."', state='".$state."',subscription='".$subscription."', pincode='".$pincode."'".$qry." where id=".$_SESSION['userid']);
		header("location:myprofile.php?msg=success");

	}
	
	public function getOrderID($amount, $receipt){
    $amount=$amount*100;
    $url='https://api.razorpay.com/v1/orders';
    $headers[]='Accept: */*';
    $headers[]='Content-Type: application/json';
     //$data = '{"amount": "'.$amount.'","currency": "INR","receipt": "'.$receipt.'","payment_capture": 1}';

    $data = '{"amount": "'.$amount.'","currency": "INR","receipt": "'.$receipt.'","payment_capture": 1}';
//die($data);
    $s = curl_init();
    curl_setopt($s, CURLOPT_URL,$url);
    curl_setopt($s, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($s, CURLOPT_USERPWD, "rzp_live_urMd6CrygUGJK6:JhamGOlkt1V8Zbv0KBRvRRVL");
    curl_setopt($s, CURLOPT_POST, 1);
    curl_setopt($s, CURLOPT_POSTFIELDS, $data);
    curl_setopt($s, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($s);
    curl_close($s);
    $result = json_decode($response, true);

    if($result['id']!=null) $token=$result['id'];
    else $token='error';
   /*
    echo $token;
    echo "<pre>";
print_r($result);
*/
    return $token;
	}
	
	public function sendOrderemail($id, $address){
	$order=$this->getRow("select * from orders where id=".$id);
	$mail = new PHPMailer(); 

//MAIL WRITTEN 
$body='<table width="100%" cellpadding="0" cellspacing="0" bgcolor="#F5F5F5" style="text-align:center">

<tbody><tr>

<td>      

<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">

    <tbody><tr>

	<td bgcolor="#F5F5F5" style="background-color:#f5f5f5;padding-top:0;padding-right:0;padding-left:0;padding-bottom:0">

		<div style="max-width:640px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:0;padding-right:0">

			

			<table cellpadding="0" cellspacing="0" border="0" align="center" width="100%" style="font-family:sans-serif;color:#111111">

				<tbody><tr>

					<td style="padding-top:10px;padding-right:0;padding-bottom:20px;padding-left:0">

						<table cellpadding="0" cellspacing="0" border="0" align="center" width="100%">

                          <tbody><tr>

                             <td width="174" align="left" class="m_26581947998977289stretch" style="padding-top:10px;padding-bottom:0;padding-right:0;padding-left:0">

                                <table width="100%" cellpadding="0" cellspacing="0" border="0" align="left">

                                   <tbody><tr>

                                      <td class="m_26581947998977289mobile-padding-fix m_26581947998977289mobiletextalign" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:16px">

                                         <a href="https://www.poppyindia.com"><img class="m_26581947998977289stretch-img CToWUd" src="http://poppyindia.com/demo/images/logo.png" width="158" height="54" border="0" alt="Poppy Mattress" style="display:block;color:#111111;font-family:Arial,sans-serif;font-size:12px;border:0;width:100%;max-width:158px;min-width:20px;height:auto"></a>

                                      </td>

                                   </tr>

                                </tbody></table>

                             </td>

                             <td align="right" class="m_26581947998977289stretch" style="padding-top:10px;padding-bottom:0;padding-right:0;padding-left:0">

                                <table width="100%" cellpadding="0" cellspacing="0" border="0">

                                   <tbody><tr>

                                      <td align="right" class="m_26581947998977289mobile-padding-fix-right m_26581947998977289mobiletextalign" style="padding-top:0;padding-bottom:0px;padding-left:0;padding-right:20px;text-align:right">

                                         <p class="m_26581947998977289mobiletextalign" style="margin-top:0px;margin-bottom:0px;font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;font-size:13px;line-height:21px">

                                            Need help? <a href="https://www.poppyindia.com/contactus.php">Contact us.</a><br>Customer Number: +91 96429 11441

                                         </p>

                                      </td>

                                   </tr>

                                </tbody></table>

                             </td>

                          </tr>

                       </tbody></table>

                    </td>

                          </tr>

                       </tbody></table>

			

		</div>

	</td>

	</tr>

</tbody></table>





<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">

    <tbody><tr>

	<td bgcolor="#F5F5F5" style="background-color:#f5f5f5;padding-top:0;padding-right:0;padding-left:0;padding-bottom:0">

		<div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

			

			<table bgcolor="#84226D" width="100%" align="center" border="0" cellspacing="0" cellpadding="0" style="font-family:serif;color:#ffffff">

				<tbody><tr>

				<td bgcolor="#84226D" align="left" class="m_26581947998977289h1-primary-mobile" style="padding-top:60px;padding-bottom:0;padding-right:40px;padding-left:40px;text-align:left;background-color:#84226D;font-size:36px;line-height:46px;font-weight:bold;font-family:\'Times New Roman\',Times,serif,\'gd-sage-bold\'">

                

					<span>Thanks for your <span class="il">order</span>, '.$order['name'].'.</span>

                        

				</td>

				</tr>

			</tbody></table>

            

		</div>

	</td>

	</tr>

</tbody></table>





<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">

    <tbody><tr>

	<td bgcolor="#F5F5F5" style="background-color:#f5f5f5;padding-top:0;padding-right:0;padding-left:0;padding-bottom:0">

		<div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">
    
			

<table bgcolor="#84226D" width="100%" align="center" border="0" cellspacing="0" cellpadding="0" style="font-family:sans-serif;color:#ffffff">

	<tbody><tr>

	<td dir="ltr" bgcolor="#84226D" align="left" style="padding-top:40px;padding-bottom:0;padding-right:40px;padding-left:40px;text-align:left;background-color:#84226D">



		<p style="Margin-top:0px;Margin-bottom:0px;font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;font-size:16px;line-height:26px; color:#ffffff;">

		Here\'s your <span class="il">confirmation</span> for <span class="il">order</span> Tracking No : '.$order['tracking_id'].'. <br><br>

		You are few nights away from sleeping on your favorite choice of mattress from Poppy’s <br><br>

		We are looking forward to being your sleep companion <br>

		</p>

                        

	</td>

	</tr>

</tbody></table>

            

		</div>

	</td>

	</tr>

</tbody></table>





<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">

    <tbody><tr>

	<td bgcolor="#F5F5F5" style="background-color:#f5f5f5;padding-top:0;padding-right:0;padding-left:0;padding-bottom:0">

		<div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

			

                      <table bgcolor="#84226D" width="100%" align="left" border="0" cellspacing="0" cellpadding="0" style="font-family:sans-serif;color:#111111">

                        <tbody><tr>

                           <td bgcolor="#84226D" align="left" style="background-color:#84226D;padding-top:40px;padding-bottom:0;padding-right:40px;padding-left:40px;text-align:left">

                              <table border="0" cellpadding="0" cellspacing="0" align="left" width="100%">

                                <tbody><tr>

                                   <td align="left" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0">

                                      <table border="0" cellspacing="0" cellpadding="0" align="left">

                                        <tbody><tr>

                                           <td align="center" bgcolor="#FFFFFF" style="border:1px solid #ffffff;font-size:16px;line-height:20px;font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;background-color:#ffffff">

										   <span>

										   <a href="https://www.poppyindia.com/demo/tracking.php?trackingno='.$order['tracking_id'].'" style="text-decoration:none;background-color:#ffffff;border-top:20px solid #ffffff;border-bottom:20px solid #ffffff;border-left:40px solid #ffffff;border-right:40px solid #ffffff;display:inline-block;color:#111111;text-align:center" target="_blank" data-saferedirecturl="https://www.poppyindia.com/demo/tracking.php?trackingno='.$order['tracking_id'].'">Track Order</a>

										   </span></td>

                                        </tr>

                                      </tbody></table>

                                   </td>

                                </tr>

                              </tbody></table>

                           </td>

                        </tr>

                      </tbody></table>

            

		</div>

	</td>

	</tr>

</tbody></table>





  <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">

     <tbody><tr>

        <td bgcolor="#F5F5F5" style="padding-top:0px;padding-bottom:0px">

           <div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

              

                       <table bgcolor="#84226D" align="center" style="border-spacing:0;font-family:sans-serif;color:#111111;margin:0 auto;width:100%;max-width:600px">

                          <tbody><tr>

                             <td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0">

                                <table width="100%" style="border-spacing:0;font-family:sans-serif;color:#111111">

                                   <tbody><tr>

                                      <td style="padding-top:60px;padding-bottom:0px;padding-left:40px;padding-right:40px;background-color:#84226D;width:100%;text-align:left">

                                         <p style="margin-top:0px;line-height:0px;margin-bottom:0px;font-size:4px">&nbsp;</p>

                                      </td>

                                   </tr>

                                </tbody></table>

                             </td>

                          </tr>

                       </tbody></table>

                       

           </div>

        </td>

     </tr>

  </tbody></table>







<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">

    <tbody><tr>

	<td bgcolor="#F5F5F5" style="background-color:#f5f5f5;padding-top:0;padding-right:0;padding-left:0;padding-bottom:0">

		<div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

			

			<table bgcolor="#FFFFFF" width="100%" align="center" border="0" cellspacing="0" cellpadding="0" style="font-family:sans-serif">

				<tbody><tr>

				<td bgcolor="#FFFFFF" align="left" style="padding-top:60px;padding-bottom:0;padding-right:40px;padding-left:40px;text-align:left;background-color:#ffffff;font-weight:bold;font-family:Arial,sans-serif,\'Arial Bold\',\'gdsherpa-bold\';font-size:21px;line-height:31px;color:#111111">

                

					<span><span class="il">Order Details</span>

                 

				</td>

				</tr>

			</tbody></table>

			            

		</div>

	</td>

	</tr>

</tbody></table>





<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">

    <tbody><tr>

	<td bgcolor="#F5F5F5" style="background-color:#f5f5f5;padding-top:0;padding-right:0;padding-left:0;padding-bottom:0">

		<div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

			

<table bgcolor="#FFFFFF" width="100%" align="center" border="0" cellspacing="0" cellpadding="0" style="font-family:sans-serif;color:#111111">

	<tbody>

	<tr>
		<td colspan="2" style="padding-top:20px;padding-bottom:0;padding-right:40px;padding-left:40px;text-align:left;background-color:#ffffff">
			
			<table cellpadding="0" cellspacing="0" width="100%">
				<tr>
		<td style="padding:6px 6px 6px 6px; border-collapse:collapse; border-top:1px solid #cccccc;   border-left:1px solid #cccccc; border-bottom:1px solid #cccccc; width:200px;vertical-align:middle;">Order Date </td>
		<td style="padding:6px 6px 6px 6px; border-collapse:collapse; border-top:1px solid #cccccc;   border-left:1px solid #cccccc; border-right:1px solid #cccccc;  border-bottom:1px solid #cccccc; width:200px;vertical-align:middle"> '.date("d-m-Y h:i A",strtotime($order['order_date'])).'</td>
	</tr>

	<tr>
		<td style="padding:6px 6px 6px 6px; border-collapse:collapse; border-left:1px solid #cccccc; border-bottom:1px solid #cccccc; width:200px;vertical-align:middle;">Name</td>
		<td style="padding:6px 6px 6px 6px; border-collapse:collapse; border-left:1px solid #cccccc; border-right:1px solid #cccccc;  border-bottom:1px solid #cccccc; width:200px;vertical-align:middle"> '.$order['name'].'</td>
	</tr>

	<tr>
		<td style="padding:6px 6px 6px 6px; border-collapse:collapse; border-left:1px solid #cccccc; border-bottom:1px solid #cccccc; width:200px;vertical-align:middle;">Mobile No</td>
		<td style="padding:6px 6px 6px 6px; border-collapse:collapse; border-left:1px solid #cccccc; border-right:1px solid #cccccc;  border-bottom:1px solid #cccccc; width:200px;vertical-align:middle"> '.$order['mobileno'].' / '.$order['mobileno_alt'].'</td>
	</tr>

	<tr>
		<td style="padding:6px 6px 6px 6px; border-collapse:collapse; border-left:1px solid #cccccc; border-bottom:1px solid #cccccc; width:200px;vertical-align:middle;">Email ID</td>
		<td style="padding:6px 6px 6px 6px; border-collapse:collapse; border-left:1px solid #cccccc; border-right:1px solid #cccccc;  border-bottom:1px solid #cccccc; width:200px;vertical-align:middle"> '.$order['emailid'].'</td>
	</tr>

	<tr>
		<td style="padding:6px 6px 6px 6px; border-collapse:collapse; border-left:1px solid #cccccc; border-bottom:1px solid #cccccc; width:200px;vertical-align:middle;">Address</td>
		<td style="padding:6px 6px 6px 6px; border-collapse:collapse; border-left:1px solid #cccccc; border-right:1px solid #cccccc;  border-bottom:1px solid #cccccc; width:200px;vertical-align:middle"> '.$order['address'].'</td>
	</tr>

	<tr>
		<td style="padding:6px 6px 6px 6px; border-collapse:collapse; border-left:1px solid #cccccc; border-bottom:1px solid #cccccc; width:200px;vertical-align:middle;">City</td>
		<td style="padding:6px 6px 6px 6px; border-collapse:collapse; border-left:1px solid #cccccc; border-right:1px solid #cccccc;  border-bottom:1px solid #cccccc; width:200px;vertical-align:middle"> '.$order['city'].'</td>
	</tr>

	<tr>
		<td style="padding:6px 6px 6px 6px; border-collapse:collapse; border-left:1px solid #cccccc; border-bottom:1px solid #cccccc; width:200px;vertical-align:middle;">State</td>
		<td style="padding:6px 6px 6px 6px; border-collapse:collapse; border-left:1px solid #cccccc; border-right:1px solid #cccccc;  border-bottom:1px solid #cccccc; width:200px;vertical-align:middle"> '.$order['state'].'</td>
	</tr>

	<tr>
		<td style="padding:6px 6px 6px 6px; border-collapse:collapse; border-left:1px solid #cccccc; border-bottom:1px solid #cccccc; width:200px;vertical-align:middle;">Pincode</td>
		<td style="padding:6px 6px 6px 6px; border-collapse:collapse; border-left:1px solid #cccccc; border-right:1px solid #cccccc;  border-bottom:1px solid #cccccc; width:200px;vertical-align:middle"> '.$order['pincode'].'</td>
	</tr>

	<tr>
		<td colspan="2" style="padding:6px 6px 6px 6px; border-collapse:collapse; border-left:1px solid #cccccc; border-right:1px solid #cccccc; width:200px;vertical-align:middle;">Notes:</td>
	</tr>
	<tr>
		<td colspan="2" style="padding:6px 6px 6px 6px; border-collapse:collapse; border-left:1px solid #cccccc; border-right:1px solid #cccccc;  border-bottom:1px solid #cccccc; width:200px;vertical-align:middle;">'.$order['order_notes'].'</td>
	</tr>
			</table>
		</td>
	</tr>

	

</tbody></table>

            

		</div>

	</td>

	</tr>

</tbody></table>







<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">

    <tbody><tr>

	<td bgcolor="#F5F5F5" style="background-color:#f5f5f5;padding-top:0;padding-right:0;padding-left:0;padding-bottom:0">

		<div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

			

			<table bgcolor="#FFFFFF" width="100%" align="center" border="0" cellspacing="0" cellpadding="0" style="font-family:sans-serif;color:#111111">

				<tbody><tr>

				<td bgcolor="#FFFFFF" align="center" style="padding-top:0;padding-bottom:0;padding-right:40px;padding-left:40px;text-align:center;background-color:#ffffff">

                

                	<table width="100%" align="center" border="0" cellspacing="0" cellpadding="0">

                		<tbody>

                		<tr>

                		<td height="60" style="border-bottom:2px solid #111111;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0">

							<p style="Margin-top:0px;Margin-bottom:0px;font-size:0px;line-height:0px">

							&nbsp;

							</p>

						</td>

						</tr>

						</tbody>

					</table>

                        

				</td>

				</tr>

			</tbody></table>

            

		</div>

	</td>

	</tr>

</tbody></table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">

    <tbody><tr>

	<td bgcolor="#F5F5F5" style="background-color:#f5f5f5;padding-top:0;padding-right:0;padding-left:0;padding-bottom:0">

		<div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

			

			<table bgcolor="#FFFFFF" width="100%" align="center" border="0" cellspacing="0" cellpadding="0" style="font-family:sans-serif">

				<tbody><tr>

				<td bgcolor="#FFFFFF" align="left" style="padding-top:60px;padding-bottom:0;padding-right:40px;padding-left:40px;text-align:left;background-color:#ffffff;font-weight:bold;font-family:Arial,sans-serif,\'Arial Bold\',\'gdsherpa-bold\';font-size:21px;line-height:31px;color:#111111">

                

					<span><span class="il">Order Items</span>

                 

				</td>

				</tr>

			</tbody></table>

			            

		</div>

	</td>

	</tr>

</tbody></table>



<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">

    <tbody><tr>

	<td bgcolor="#F5F5F5" style="background-color:#f5f5f5;padding-top:0;padding-right:0;padding-left:0;padding-bottom:0">

		<div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

			

			<table bgcolor="#ffffff" width="100%" align="center" border="0" cellspacing="0" cellpadding="0" style="font-family:sans-serif;color:#111111">

				<tbody><tr>

				<td bgcolor="#ffffff" align="left" style="padding-top:20px;padding-bottom:0;padding-right:40px;padding-left:40px;text-align:left;background-color:#ffffff">

                

					<table style="table-layout:fixed;width:520px;border-collapse:collapse" cellspacing="0" cellpadding="0" border="0">

  <tbody><tr style="width:100%">

    <td bgcolor="#767676" style="border-collapse:collapse;border-left:1px solid #cccccc;border-top:1px solid #cccccc;border-bottom:1px solid #cccccc;width:50px" align="center" valign="middle">

      <div style="width:100%;height:100%;overflow:hidden;font-size:14px;font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;color:#ffffff">

            &nbsp;

          </div>

    </td>

    <td bgcolor="#767676" style="border-collapse:collapse;border-left:1px solid #cccccc;border-top:1px solid #cccccc;border-bottom:1px solid #cccccc;width:200px; padding:8px; " align="center" valign="middle">

      <div style="width:100%;height:100%;overflow:hidden;font-size:14px;font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;color:#ffffff">

            Product

          </div>

    </td>

    <td bgcolor="#767676" style="border-collapse:collapse;border-left:1px solid #cccccc;border-top:1px solid #cccccc;border-bottom:1px solid #cccccc;width:57px" align="center" valign="middle">

      <div style="width:100%;height:100%;overflow:hidden;font-size:14px;font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;color:#ffffff">

            Qty

          </div>

    </td>

    <td bgcolor="#767676" style="border-collapse:collapse;border:1px solid #cccccc;width:65px" align="center" valign="middle">

      <div style="width:100%;height:100%;overflow:hidden;font-size:14px;font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;color:#ffffff">

            Price

          </div>

    </td>

  </tr>';


$order_items=$this->getResults("select * from orders_items where order_id='".$order['id']."'");
if(!empty($order_items)){ $i=0;
    foreach($order_items as $item) { $i++;

if($item['product_type']=='free') {
	$label="<label><b style='color:#84226D'>FREE</b></label>";
	$pname=$item['product_name'];
}
else { $label='';
	$pname=$item['product_name'].' '.$item['product_height'].'"';
}

if($item['product_type']!='free') $price="₹ ".$this->INR($item['amount']);
else $price='';

$body.='

  <tr style="width:100%">

    <td style="padding:6px 6px 6px 6px;border-collapse:collapse;border-left:1px solid #cccccc;border-bottom:1px solid #cccccc;width:50px;vertical-align:top">

      <div style="width:100%;height:100%;overflow:hidden;font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;font-size:14px">

          <img src="'.HTTP_SERVER.'images/products/'.$item['cover_image'].'" alt="" style="width: 80px;">

        </div>

    </td>

    <td style="padding-top:6px; padding-left: 10px; border-collapse:collapse;border-left:1px solid #cccccc;border-bottom:1px solid #cccccc;width:200px;vertical-align:top" align="left">

      <div style="width:100%;height:100%;overflow:hidden;font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;font-size:12px; line-height: 18px;">
      		'.$pname.' <br>
      		'.$label.'
      		'.$item['category'].' <br>
      		'.$item['product_size'].'

      </div>

    </td>

    <td style="padding-top:6px;border-collapse:collapse;border-left:1px solid #cccccc;border-bottom:1px solid #cccccc;width:57px;vertical-align:top" align="center">

      <div style="width:100%;height:100%;overflow:hidden;font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;font-size:14px">
      		'.$item['qty'].'
      </div>

    </td>

    <td style="padding-left:10px;padding-right:10px;padding-top:6px;padding-bottom:2px;text-align:right;vertical-align:top;border-collapse:collapse;border-left:1px solid #cccccc;border-right:1px solid #cccccc;border-bottom:1px solid #cccccc;width:65px">

      <div style="width:100%;height:100%;overflow:hidden;font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;font-size:14px">

              '.$price.'

            </div>

    </td>

  </tr>';

	}
}




if($order['coupon_value']!=0) {

  $body.='<tr style="width:520px">

    <td colspan="2" bgcolor="#f5f5f5" align="right" style="padding-top:15px;padding-right:10px;padding-bottom:6px;border-collapse:collapse;border-top:1px solid #cccccc;border-right:1px solid #cccccc;border-bottom:1px solid #cccccc;text-align:right;vertical-align:top;height:20px">

      <div style="width:100%;height:100%;overflow:hidden;font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;font-size:14px;color:#666666">

            Order Total

          </div>

    </td>

    <td align="right" colspan="2" bgcolor="#f5f5f5" style="padding-top:15px;padding-right:10px;padding-bottom:6px;border-collapse:collapse;border-top:1px solid #cccccc;border-right:1px solid #cccccc;border-bottom:1px solid #cccccc;text-align:right;vertical-align:top;height:20px">

      <div style="width:100%;height:100%;overflow:hidden;font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;font-size:14px;color:#666666">

            ₹ '.$this->INR($order['sub_total']).'

          </div>

    </td>

  </tr>';

$body.='<tr style="width:520px">

    <td colspan="2" align="right" bgcolor="#f5f5f5" style="padding-top:15px;padding-right:10px;padding-bottom:6px;border-collapse:collapse;border-top:1px solid #cccccc;border-right:1px solid #cccccc;border-bottom:1px solid #cccccc;text-align:right;vertical-align:top;height:20px">

      <div style="width:100%;height:100%;overflow:hidden;font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;font-size:14px;color:#666666">

                   Coupon Discount

                  </div>

    </td>

    <td align="right" colspan="2" bgcolor="#f5f5f5" style="padding-top:15px;padding-right:10px;padding-bottom:6px;border-collapse:collapse;border-top:1px solid #cccccc;border-right:1px solid #cccccc;border-bottom:1px solid #cccccc;text-align:right;vertical-align:top;height:20px">

      <div style="width:100%;height:100%;overflow:hidden;font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;font-size:14px;color:#666666">

                ₹ '.$this->INR($order['coupon_value']).'

              </div>

    </td>

  </tr>

  <tr style="width:520px">

    <td colspan="2" bgcolor="#f5f5f5" style="padding-top:15px;padding-right:10px;padding-bottom:6px;border-collapse:collapse;border-top:1px solid #cccccc;border-right:1px solid #cccccc;border-bottom:1px solid #cccccc;text-align:right;vertical-align:top;height:20px">

      <div style="height:100%;overflow:hidden">

        <font style="font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;font-size:14px;color:#666666">

              Net Amount

            </font>

      </div>

    </td>

    <td bgcolor="#f5f5f5" colspan="2" style="padding-top:15px;padding-right:10px;padding-bottom:6px;border-collapse:collapse;border-top:1px solid #cccccc;border-right:1px solid #cccccc;border-bottom:1px solid #cccccc;text-align:right;vertical-align:top;height:20px">

      <div style="height:100%;overflow:hidden">

        <font style="font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;font-size:18px;color:#84226D">

              ₹ '.$this->INR($order['net_amount']).'

            </font>

      </div>

    </td>

  </tr>';
 } else {
       $body.='<tr style="width:520px">

    <td colspan="2" bgcolor="#f5f5f5" align="right" style="padding-top:15px;padding-right:10px;padding-bottom:6px;border-collapse:collapse;border-top:1px solid #cccccc;border-right:1px solid #cccccc;border-bottom:1px solid #cccccc;text-align:right;vertical-align:top;height:20px">

      <div style="width:100%;height:100%;overflow:hidden;font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;font-size:14px;color:#666666">

            Order Total

          </div>

    </td>

    <td align="right" colspan="2" bgcolor="#f5f5f5" style="padding-top:15px;padding-right:10px;padding-bottom:6px;border-collapse:collapse;border-top:1px solid #cccccc;border-right:1px solid #cccccc;border-bottom:1px solid #cccccc;text-align:right;vertical-align:top;height:20px">

      <div style="width:100%;height:100%;overflow:hidden;font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;font-size:14px;color:#666666">

           <font style="font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;font-size:18px;color:#84226D">

              ₹ '.$this->INR($order['sub_total']).'

            </font>

          </div>

    </td>

  </tr>';
 }

$body.='</tbody></table>

                        

				</td>

				</tr>

			</tbody></table>

            

		</div>

	</td>

	</tr>

</tbody></table>





  <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">

     <tbody><tr>

        <td bgcolor="#F5F5F5" style="padding-top:0px;padding-bottom:0px">

           <div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

              

                       <table bgcolor="#FFFFFF" align="center" style="border-spacing:0;font-family:sans-serif;color:#111111;margin:0 auto;width:100%;max-width:600px">

                          <tbody><tr>

                             <td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0">

                                <table width="100%" style="border-spacing:0;font-family:sans-serif;color:#111111">

                                   <tbody><tr>

                                      <td style="padding-top:60px;padding-bottom:0px;padding-left:40px;padding-right:40px;background-color:#ffffff;width:100%;text-align:left">

                                         <p style="margin-top:0px;line-height:0px;margin-bottom:0px;font-size:4px">&nbsp;</p>

                                      </td>

                                   </tr>

                                </tbody></table>

                             </td>

                          </tr>

                       </tbody></table>

                       

           </div>

        </td>

     </tr>

  </tbody></table>



  <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">

     <tbody><tr>

        <td bgcolor="#F5F5F5" style="padding-top:0px;padding-bottom:0px">

           <div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

              

                       <table bgcolor="#F5F5F5" align="center" style="border-spacing:0;font-family:sans-serif;color:#111111;margin:0 auto;width:100%;max-width:600px">

                          <tbody><tr>

                             <td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0">

                                <table width="100%" style="border-spacing:0;font-family:sans-serif;color:#111111">

                                   <tbody><tr>

                                      <td style="padding-top:30px;padding-bottom:0px;padding-left:40px;padding-right:40px;background-color:#f5f5f5;width:100%;text-align:left">

                                         <p style="margin-top:0px;line-height:0px;margin-bottom:0px;font-size:4px">&nbsp;</p>

                                      </td>

                                   </tr>

                                </tbody></table>

                             </td>

                          </tr>

                       </tbody></table>

                       

           </div>

        </td>

     </tr>

  </tbody></table>




<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">

    <tbody><tr>

	<td bgcolor="#F5F5F5" style="background-color:#f5f5f5;padding-top:0;padding-right:0;padding-left:0;padding-bottom:0">

		<div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

			

			<table width="100%" align="left" border="0" cellspacing="0" cellpadding="0" style="font-family:sans-serif;color:#767676">

				<tbody><tr>

				<td align="left" style="padding-top:10px;padding-bottom:0;padding-right:0;padding-left:0;text-align:left">

                

					<p style="text-align:left;Margin-top:0px;Margin-bottom:0px;font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;font-size:12px;line-height:22px">

						We believe everyone deserves a perfect sleep. Hence we create the world’s best mattresses, comforters, blankets, pillows, bed spreads. We are making various ranges of products that are designed to give you the best bed time and waking-up experience.

					</p>

                        

				</td>

				</tr>

			</tbody></table>

            

		</div>

	</td>

	</tr>

</tbody></table>



<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">

    <tbody><tr>

	<td bgcolor="#F5F5F5" style="background-color:#f5f5f5;padding-top:0;padding-right:0;padding-left:0;padding-bottom:0">

		<div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

			

			<table width="100%" align="left" border="0" cellspacing="0" cellpadding="0" style="font-family:sans-serif;color:#767676">

				<tbody><tr>

				<td align="left" style="padding-top:10px;padding-bottom:0;padding-right:0;padding-left:0;text-align:left">

                

					<p style="text-align:left;Margin-top:0px;Margin-bottom:0px;font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;font-size:12px;line-height:22px">

						Poppy’s Lab is always active ! <br>
Every product here is manufactured with the right ingredient. We also help customers to customize their home mattresses


					</p>

                        

				</td>

				</tr>

			</tbody></table>

            

		</div>

	</td>

	</tr>

</tbody></table>



<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">

    <tbody><tr>

	<td bgcolor="#F5F5F5" style="background-color:#f5f5f5;padding-top:0;padding-right:0;padding-left:0;padding-bottom:0">

		<div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

			

			<table width="100%" align="left" border="0" cellspacing="0" cellpadding="0" style="font-family:sans-serif;color:#767676">

				<tbody><tr>

				<td align="left" style="padding-top:10px;padding-bottom:0;padding-right:0;padding-left:0;text-align:left">

                

					<p style="text-align:left;Margin-top:0px;Margin-bottom:0px;font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;font-size:12px;line-height:22px">

						Please do not reply to this email. Emails sent to this address will not be answered.

					</p>

                        

				</td>

				</tr>

			</tbody></table>

            

		</div>

	</td>

	</tr>

</tbody></table>



<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">

    <tbody><tr>

	<td bgcolor="#F5F5F5" style="background-color:#f5f5f5;padding-top:0;padding-right:0;padding-left:0;padding-bottom:0">

		<div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

			

			<table width="100%" align="left" border="0" cellspacing="0" cellpadding="0" style="font-family:sans-serif;color:#767676">

				<tbody><tr>

				<td align="left" style="padding-top:10px;padding-bottom:0;padding-right:0;padding-left:0;text-align:left">

                

					<p style="text-align:left;Margin-top:0px;Margin-bottom:0px;font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;font-size:12px;line-height:22px">

						Copyright © 1999-2020 Poppy Mattress Pvt Ltd. All rights reserved.

					</p>

                        

				</td>

				</tr>

			</tbody></table>

            

		</div>

	</td>

	</tr>

</tbody></table>





  <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">

     <tbody><tr>

        <td bgcolor="#F5F5F5" style="padding-top:0px;padding-bottom:0px">

           <div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

              

                       <table bgcolor="#F5F5F5" align="center" style="border-spacing:0;font-family:sans-serif;color:#111111;margin:0 auto;width:100%;max-width:600px">

                          <tbody><tr>

                             <td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0">

                                <table width="100%" style="border-spacing:0;font-family:sans-serif;color:#111111">

                                   <tbody><tr>

                                      <td style="padding-top:40px;padding-bottom:0px;padding-left:40px;padding-right:40px;background-color:#f5f5f5;width:100%;text-align:left">

                                         <p style="margin-top:0px;line-height:0px;margin-bottom:0px;font-size:4px">&nbsp;</p>

                                      </td>

                                   </tr>

                                </tbody></table>

                             </td>

                          </tr>

                       </tbody></table>

                       

           </div>

        </td>

     </tr>

  </tbody></table>





</td>

</tr>

</tbody></table>';

$mail->AddReplyTo("support@poppyindia.com","Poppy Mattress");

$mail->SetFrom('support@poppyindia.com', 'Poppy Mattress');
$mail->AddAddress($address, '');
//$mail->AddAddress('techaveo@gmail.com', '');


$mail->Subject    = 'Order Confirmation - Poppy Mattress';

$mail->MsgHTML($body);

@$mail->Send();
/*
$res=$mail->Send();

if($res) echo "Email Sent";
else echo "Emai Not Send;";

print_r($res); */

	}

	public function GuestwelcomeEmail($address,$password){
	    $mail = new PHPMailer(); 
	    
	    $body='<table width="100%" cellpadding="0" cellspacing="0" bgcolor="#F5F5F5" style="text-align:center">

<tbody><tr>

<td>      

<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">

    <tbody><tr>

	<td bgcolor="#F5F5F5" style="background-color:#f5f5f5;padding-top:0;padding-right:0;padding-left:0;padding-bottom:0">

		<div style="max-width:640px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:0;padding-right:0">

			

			<table cellpadding="0" cellspacing="0" border="0" align="center" width="100%" style="font-family:sans-serif;color:#111111">

				<tbody><tr>

					<td style="padding-top:10px;padding-right:0;padding-bottom:20px;padding-left:0">

						<table cellpadding="0" cellspacing="0" border="0" align="center" width="100%">

                          <tbody><tr>

                             <td width="174" align="left" class="m_26581947998977289stretch" style="padding-top:10px;padding-bottom:0;padding-right:0;padding-left:0">

                                <table width="100%" cellpadding="0" cellspacing="0" border="0" align="left">

                                   <tbody><tr>

                                      <td class="m_26581947998977289mobile-padding-fix m_26581947998977289mobiletextalign" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:16px">

                                         <a href="https://www.poppyindia.com"><img class="m_26581947998977289stretch-img CToWUd" src="http://poppyindia.com/demo/images/logo.png" width="158" height="54" border="0" alt="Poppy Mattress" style="display:block;color:#111111;font-family:Arial,sans-serif;font-size:12px;border:0;width:100%;max-width:158px;min-width:20px;height:auto"></a>

                                      </td>

                                   </tr>

                                </tbody></table>

                             </td>

                             <td align="right" class="m_26581947998977289stretch" style="padding-top:10px;padding-bottom:0;padding-right:0;padding-left:0">

                                <table width="100%" cellpadding="0" cellspacing="0" border="0">

                                   <tbody><tr>

                                      <td align="right" class="m_26581947998977289mobile-padding-fix-right m_26581947998977289mobiletextalign" style="padding-top:0;padding-bottom:0px;padding-left:0;padding-right:20px;text-align:right">

                                         <p class="m_26581947998977289mobiletextalign" style="margin-top:0px;margin-bottom:0px;font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;font-size:13px;line-height:21px">

                                            Need help? <a href="https://www.poppyindia.com/contactus.php">Contact us.</a><br>Customer Number: +91 96429 11441

                                         </p>

                                      </td>

                                   </tr>

                                </tbody></table>

                             </td>

                          </tr>

                       </tbody></table>

                    </td>

                          </tr>

                       </tbody></table>

			

		</div>

	</td>

	</tr>

</tbody></table>





<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">

    <tbody><tr>

	<td bgcolor="#F5F5F5" style="background-color:#f5f5f5;padding-top:0;padding-right:0;padding-left:0;padding-bottom:0">

		<div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

			

			<table bgcolor="#84226D" width="100%" align="center" border="0" cellspacing="0" cellpadding="0" style="font-family:serif;color:#ffffff">

				<tbody><tr>

				<td bgcolor="#84226D" align="left" class="m_26581947998977289h1-primary-mobile" style="padding-top:60px;padding-bottom:0;padding-right:40px;padding-left:40px;text-align:left;background-color:#84226D;font-size:36px;line-height:46px;font-weight:bold;font-family:\'Times New Roman\',Times,serif,\'gd-sage-bold\'">

                

					<span>You are our Favorite Kind of Dream </span>

                        

				</td>

				</tr>

			</tbody></table>

            

		</div>

	</td>

	</tr>

</tbody></table>





<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">

    <tbody><tr>

	<td bgcolor="#F5F5F5" style="background-color:#f5f5f5;padding-top:0;padding-right:0;padding-left:0;padding-bottom:0">

		<div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

			

<table bgcolor="#84226D" width="100%" align="center" border="0" cellspacing="0" cellpadding="0" style="font-family:sans-serif;color:#ffffff">

	<tbody><tr>

	<td dir="ltr" bgcolor="#84226D" align="left" style="padding-top:40px;padding-bottom:0;padding-right:40px;padding-left:40px;text-align:left;background-color:#84226D">



		<p style="Margin-top:0px;Margin-bottom:0px;font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;font-size:16px;line-height:26px">

		Welcome to your dream world of sleep. We can’t wait for you to get to know us. This is the safe space and we are now a family. Not to forget, in our family everyone gets equal attention.  <br><br>

		Login with Your Mobile No or Email ID as user and Password : '.$password.' <br><br>

		<b style="font-size:18px;">SEE WHAT’S TRENDING WITH US </b><br>
		
		We believe everyone deserves a perfect sleep. Hence we create the world’s best mattresses, comforters, blankets, pillows, bed spreads. We are making various ranges of products that are designed to give you the best bed time and waking-up experience <br><br>

		<b style="font-size:17px">We know your sleep Technique</b> <br>

		At Poppy’s we know that the better the sleep at night, brighter the day. Thus we bring the premium sleep products that can help you achieve the best life possible. <br><br>

		You are in <br> <br>

		Poppy’s Lab is always active <br><br>

		Every product here is manufactured with the right ingredient. We also help customers to customize their home mattresses. <br><br>

		Make your mattress <br><br>

		Mattresses that you can trust <br><br>

		We have been in the industry for more than 10 years and we have trusted customers across the globe. 

		</p>

                        

	</td>

	</tr>

</tbody></table>

            

		</div>

	</td>

	</tr>

</tbody></table>





<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">

    <tbody><tr>

	<td bgcolor="#F5F5F5" style="background-color:#f5f5f5;padding-top:0;padding-right:0;padding-left:0;padding-bottom:0">

		<div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

			

                      <table bgcolor="#84226D" width="100%" align="left" border="0" cellspacing="0" cellpadding="0" style="font-family:sans-serif;color:#111111">

                        <tbody><tr>

                           <td bgcolor="#84226D" align="left" style="background-color:#84226D;padding-top:40px;padding-bottom:0;padding-right:40px;padding-left:40px;text-align:left">

                              <table border="0" cellpadding="0" cellspacing="0" align="left" width="100%">

                                <tbody><tr>

                                   <td align="left" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0">

                                      <table border="0" cellspacing="0" cellpadding="0" align="left">

                                        <tbody><tr>

                                           <td align="center" bgcolor="#FFFFFF" style="border:1px solid #ffffff;font-size:16px;line-height:20px;font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;background-color:#ffffff">

										   <span>

										   <a href="https://www.poppyindia.com/demo/" style="text-decoration:none;background-color:#ffffff;border-top:20px solid #ffffff;border-bottom:20px solid #ffffff;border-left:40px solid #ffffff;border-right:40px solid #ffffff;display:inline-block;color:#111111;text-align:center" target="_blank" data-saferedirecturl="https://www.poppyindia.com/demo/">Shop with Us</a>

										   </span></td>

                                        </tr>

                                      </tbody></table>

                                   </td>

                                </tr>

                              </tbody></table>

                           </td>

                        </tr>

                      </tbody></table>

            

		</div>

	</td>

	</tr>

</tbody></table>



<table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#F5F5F5">

     <tbody><tr>

        <td style="padding-top:0px;padding-bottom:0px" bgcolor="#F5F5F5">

           <div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

              

                       <table style="border-spacing:0;font-family:sans-serif;color:#111111;margin:0 auto;width:100%;max-width:600px" bgcolor="#84226D" align="center">

                          <tbody><tr>

                             <td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0">

                                <table style="border-spacing:0;font-family:sans-serif;color:#111111" width="100%">

                                   <tbody><tr>

                                      <td style="padding-top:60px;padding-bottom:0px;padding-left:40px;padding-right:40px;background-color:#84226D;width:100%;text-align:left">

                                         <p style="margin-top:0px;line-height:0px;margin-bottom:0px;font-size:4px">&nbsp;</p>

                                      </td>

                                   </tr>

                                </tbody></table>

                             </td>

                          </tr>

                       </tbody></table>

                       

           </div>

        </td>

     </tr>

  </tbody></table>








  <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">

     <tbody><tr>

        <td bgcolor="#F5F5F5" style="padding-top:0px;padding-bottom:0px">

           <div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

              

                       <table bgcolor="#F5F5F5" align="center" style="border-spacing:0;font-family:sans-serif;color:#111111;margin:0 auto;width:100%;max-width:600px">

                          <tbody><tr>

                             <td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0">

                                <table width="100%" style="border-spacing:0;font-family:sans-serif;color:#111111">

                                   <tbody><tr>

                                      <td style="padding-top:30px;padding-bottom:0px;padding-left:40px;padding-right:40px;background-color:#f5f5f5;width:100%;text-align:left">

                                         <p style="margin-top:0px;line-height:0px;margin-bottom:0px;font-size:4px">&nbsp;</p>

                                      </td>

                                   </tr>

                                </tbody></table>

                             </td>

                          </tr>

                       </tbody></table>

                       

           </div>

        </td>

     </tr>

  </tbody></table>




<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">

    <tbody><tr>

	<td bgcolor="#F5F5F5" style="background-color:#f5f5f5;padding-top:0;padding-right:0;padding-left:0;padding-bottom:0">

		<div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

			

			<table width="100%" align="left" border="0" cellspacing="0" cellpadding="0" style="font-family:sans-serif;color:#767676">

				<tbody><tr>

				<td align="left" style="padding-top:10px;padding-bottom:0;padding-right:0;padding-left:0;text-align:left">

                

					<p style="text-align:left;Margin-top:0px;Margin-bottom:0px;font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;font-size:12px;line-height:22px">

						Please do not reply to this email. Emails sent to this address will not be answered.

					</p>

                        

				</td>

				</tr>

			</tbody></table>

            

		</div>

	</td>

	</tr>

</tbody></table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">

    <tbody><tr>

	<td bgcolor="#F5F5F5" style="background-color:#f5f5f5;padding-top:0;padding-right:0;padding-left:0;padding-bottom:0">

		<div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

			

			<table width="100%" align="left" border="0" cellspacing="0" cellpadding="0" style="font-family:sans-serif;color:#767676">

				<tbody><tr>

				<td align="left" style="padding-top:10px;padding-bottom:0;padding-right:0;padding-left:0;text-align:left">

                

					<p style="text-align:left;Margin-top:0px;Margin-bottom:0px;font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;font-size:12px;line-height:22px">

						Copyright © 1999-2020 Poppy Mattress Pvt Ltd. All rights reserved.

					</p>

                        

				</td>

				</tr>

			</tbody></table>

            

		</div>

	</td>

	</tr>

</tbody></table>





  <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">

     <tbody><tr>

        <td bgcolor="#F5F5F5" style="padding-top:0px;padding-bottom:0px">

           <div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

              

                       <table bgcolor="#F5F5F5" align="center" style="border-spacing:0;font-family:sans-serif;color:#111111;margin:0 auto;width:100%;max-width:600px">

                          <tbody><tr>

                             <td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0">

                                <table width="100%" style="border-spacing:0;font-family:sans-serif;color:#111111">

                                   <tbody><tr>

                                      <td style="padding-top:40px;padding-bottom:0px;padding-left:40px;padding-right:40px;background-color:#f5f5f5;width:100%;text-align:left">

                                         <p style="margin-top:0px;line-height:0px;margin-bottom:0px;font-size:4px">&nbsp;</p>

                                      </td>

                                   </tr>

                                </tbody></table>

                             </td>

                          </tr>

                       </tbody></table>

                       

           </div>

        </td>

     </tr>

  </tbody></table>





</td>

</tr>

</tbody></table>';

	    $mail->AddReplyTo("support@poppyindia.com","Poppy Mattress");

$mail->SetFrom('support@poppyindia.com', 'Poppy Mattress');
$mail->AddAddress($address, '');
//$mail->AddAddress('techaveo@gmail.com', '');


$mail->Subject    = 'Welcome to Poppy Mattress';

$mail->MsgHTML($body);

@$mail->Send();
	}
	
	public function welcomeEmail($address){
	    $mail = new PHPMailer(); 
	    
	    $body='<table width="100%" cellpadding="0" cellspacing="0" bgcolor="#F5F5F5" style="text-align:center">

<tbody><tr>

<td>      

<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">

    <tbody><tr>

	<td bgcolor="#F5F5F5" style="background-color:#f5f5f5;padding-top:0;padding-right:0;padding-left:0;padding-bottom:0">

		<div style="max-width:640px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:0;padding-right:0">

			

			<table cellpadding="0" cellspacing="0" border="0" align="center" width="100%" style="font-family:sans-serif;color:#111111">

				<tbody><tr>

					<td style="padding-top:10px;padding-right:0;padding-bottom:20px;padding-left:0">

						<table cellpadding="0" cellspacing="0" border="0" align="center" width="100%">

                          <tbody><tr>

                             <td width="174" align="left" class="m_26581947998977289stretch" style="padding-top:10px;padding-bottom:0;padding-right:0;padding-left:0">

                                <table width="100%" cellpadding="0" cellspacing="0" border="0" align="left">

                                   <tbody><tr>

                                      <td class="m_26581947998977289mobile-padding-fix m_26581947998977289mobiletextalign" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:16px">

                                         <a href="https://www.poppyindia.com"><img class="m_26581947998977289stretch-img CToWUd" src="http://poppyindia.com/demo/images/logo.png" width="158" height="54" border="0" alt="Poppy Mattress" style="display:block;color:#111111;font-family:Arial,sans-serif;font-size:12px;border:0;width:100%;max-width:158px;min-width:20px;height:auto"></a>

                                      </td>

                                   </tr>

                                </tbody></table>

                             </td>

                             <td align="right" class="m_26581947998977289stretch" style="padding-top:10px;padding-bottom:0;padding-right:0;padding-left:0">

                                <table width="100%" cellpadding="0" cellspacing="0" border="0">

                                   <tbody><tr>

                                      <td align="right" class="m_26581947998977289mobile-padding-fix-right m_26581947998977289mobiletextalign" style="padding-top:0;padding-bottom:0px;padding-left:0;padding-right:20px;text-align:right">

                                         <p class="m_26581947998977289mobiletextalign" style="margin-top:0px;margin-bottom:0px;font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;font-size:13px;line-height:21px">

                                            Need help? <a href="https://www.poppyindia.com/contactus.php">Contact us.</a><br>Customer Number: +91 96429 11441

                                         </p>

                                      </td>

                                   </tr>

                                </tbody></table>

                             </td>

                          </tr>

                       </tbody></table>

                    </td>

                          </tr>

                       </tbody></table>

			

		</div>

	</td>

	</tr>

</tbody></table>





<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">

    <tbody><tr>

	<td bgcolor="#F5F5F5" style="background-color:#f5f5f5;padding-top:0;padding-right:0;padding-left:0;padding-bottom:0">

		<div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

			

			<table bgcolor="#84226D" width="100%" align="center" border="0" cellspacing="0" cellpadding="0" style="font-family:serif;color:#ffffff">

				<tbody><tr>

				<td bgcolor="#84226D" align="left" class="m_26581947998977289h1-primary-mobile" style="padding-top:60px;padding-bottom:0;padding-right:40px;padding-left:40px;text-align:left;background-color:#84226D;font-size:36px;line-height:46px;font-weight:bold;font-family:\'Times New Roman\',Times,serif,\'gd-sage-bold\'">

                

					<span>You are our Favorite Kind of Dream </span>

                        

				</td>

				</tr>

			</tbody></table>

            

		</div>

	</td>

	</tr>

</tbody></table>





<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">

    <tbody><tr>

	<td bgcolor="#F5F5F5" style="background-color:#f5f5f5;padding-top:0;padding-right:0;padding-left:0;padding-bottom:0">

		<div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

			

<table bgcolor="#84226D" width="100%" align="center" border="0" cellspacing="0" cellpadding="0" style="font-family:sans-serif;color:#ffffff">

	<tbody><tr>

	<td dir="ltr" bgcolor="#84226D" align="left" style="padding-top:40px;padding-bottom:0;padding-right:40px;padding-left:40px;text-align:left;background-color:#84226D">



		<p style="Margin-top:0px;Margin-bottom:0px;font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;font-size:16px;line-height:26px">

		Welcome to your dream world of sleep. We can’t wait for you to get to know us. This is the safe space and we are now a family. Not to forget, in our family everyone gets equal attention.  <br><br>

		<b style="font-size:18px;">SEE WHAT’S TRENDING WITH US </b><br>
		
		We believe everyone deserves a perfect sleep. Hence we create the world’s best mattresses, comforters, blankets, pillows, bed spreads. We are making various ranges of products that are designed to give you the best bed time and waking-up experience <br><br>

		<b style="font-size:17px">We know your sleep Technique</b> <br>

		At Poppy’s we know that the better the sleep at night, brighter the day. Thus we bring the premium sleep products that can help you achieve the best life possible. <br><br>

		You are in <br> <br>

		Poppy’s Lab is always active <br><br>

		Every product here is manufactured with the right ingredient. We also help customers to customize their home mattresses. <br><br>

		Make your mattress <br><br>

		Mattresses that you can trust <br><br>

		We have been in the industry for more than 10 years and we have trusted customers across the globe. 

		</p>

                        

	</td>

	</tr>

</tbody></table>

            

		</div>

	</td>

	</tr>

</tbody></table>





<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">

    <tbody><tr>

	<td bgcolor="#F5F5F5" style="background-color:#f5f5f5;padding-top:0;padding-right:0;padding-left:0;padding-bottom:0">

		<div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

			

                      <table bgcolor="#84226D" width="100%" align="left" border="0" cellspacing="0" cellpadding="0" style="font-family:sans-serif;color:#111111">

                        <tbody><tr>

                           <td bgcolor="#84226D" align="left" style="background-color:#84226D;padding-top:40px;padding-bottom:0;padding-right:40px;padding-left:40px;text-align:left">

                              <table border="0" cellpadding="0" cellspacing="0" align="left" width="100%">

                                <tbody><tr>

                                   <td align="left" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0">

                                      <table border="0" cellspacing="0" cellpadding="0" align="left">

                                        <tbody><tr>

                                           <td align="center" bgcolor="#FFFFFF" style="border:1px solid #ffffff;font-size:16px;line-height:20px;font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;background-color:#ffffff">

										   <span>

										   <a href="https://www.poppyindia.com/demo/" style="text-decoration:none;background-color:#ffffff;border-top:20px solid #ffffff;border-bottom:20px solid #ffffff;border-left:40px solid #ffffff;border-right:40px solid #ffffff;display:inline-block;color:#111111;text-align:center" target="_blank" data-saferedirecturl="https://www.poppyindia.com/demo/">Shop with Us</a>

										   </span></td>

                                        </tr>

                                      </tbody></table>

                                   </td>

                                </tr>

                              </tbody></table>

                           </td>

                        </tr>

                      </tbody></table>

            

		</div>

	</td>

	</tr>

</tbody></table>



<table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#F5F5F5">

     <tbody><tr>

        <td style="padding-top:0px;padding-bottom:0px" bgcolor="#F5F5F5">

           <div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

              

                       <table style="border-spacing:0;font-family:sans-serif;color:#111111;margin:0 auto;width:100%;max-width:600px" bgcolor="#84226D" align="center">

                          <tbody><tr>

                             <td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0">

                                <table style="border-spacing:0;font-family:sans-serif;color:#111111" width="100%">

                                   <tbody><tr>

                                      <td style="padding-top:60px;padding-bottom:0px;padding-left:40px;padding-right:40px;background-color:#84226D;width:100%;text-align:left">

                                         <p style="margin-top:0px;line-height:0px;margin-bottom:0px;font-size:4px">&nbsp;</p>

                                      </td>

                                   </tr>

                                </tbody></table>

                             </td>

                          </tr>

                       </tbody></table>

                       

           </div>

        </td>

     </tr>

  </tbody></table>








  <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">

     <tbody><tr>

        <td bgcolor="#F5F5F5" style="padding-top:0px;padding-bottom:0px">

           <div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

              

                       <table bgcolor="#F5F5F5" align="center" style="border-spacing:0;font-family:sans-serif;color:#111111;margin:0 auto;width:100%;max-width:600px">

                          <tbody><tr>

                             <td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0">

                                <table width="100%" style="border-spacing:0;font-family:sans-serif;color:#111111">

                                   <tbody><tr>

                                      <td style="padding-top:30px;padding-bottom:0px;padding-left:40px;padding-right:40px;background-color:#f5f5f5;width:100%;text-align:left">

                                         <p style="margin-top:0px;line-height:0px;margin-bottom:0px;font-size:4px">&nbsp;</p>

                                      </td>

                                   </tr>

                                </tbody></table>

                             </td>

                          </tr>

                       </tbody></table>

                       

           </div>

        </td>

     </tr>

  </tbody></table>




<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">

    <tbody><tr>

	<td bgcolor="#F5F5F5" style="background-color:#f5f5f5;padding-top:0;padding-right:0;padding-left:0;padding-bottom:0">

		<div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

			

			<table width="100%" align="left" border="0" cellspacing="0" cellpadding="0" style="font-family:sans-serif;color:#767676">

				<tbody><tr>

				<td align="left" style="padding-top:10px;padding-bottom:0;padding-right:0;padding-left:0;text-align:left">

                

					<p style="text-align:left;Margin-top:0px;Margin-bottom:0px;font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;font-size:12px;line-height:22px">

						Please do not reply to this email. Emails sent to this address will not be answered.

					</p>

                        

				</td>

				</tr>

			</tbody></table>

            

		</div>

	</td>

	</tr>

</tbody></table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">

    <tbody><tr>

	<td bgcolor="#F5F5F5" style="background-color:#f5f5f5;padding-top:0;padding-right:0;padding-left:0;padding-bottom:0">

		<div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

			

			<table width="100%" align="left" border="0" cellspacing="0" cellpadding="0" style="font-family:sans-serif;color:#767676">

				<tbody><tr>

				<td align="left" style="padding-top:10px;padding-bottom:0;padding-right:0;padding-left:0;text-align:left">

                

					<p style="text-align:left;Margin-top:0px;Margin-bottom:0px;font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;font-size:12px;line-height:22px">

						Copyright © 1999-2020 Poppy Mattress Pvt Ltd. All rights reserved.

					</p>

                        

				</td>

				</tr>

			</tbody></table>

            

		</div>

	</td>

	</tr>

</tbody></table>





  <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">

     <tbody><tr>

        <td bgcolor="#F5F5F5" style="padding-top:0px;padding-bottom:0px">

           <div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

              

                       <table bgcolor="#F5F5F5" align="center" style="border-spacing:0;font-family:sans-serif;color:#111111;margin:0 auto;width:100%;max-width:600px">

                          <tbody><tr>

                             <td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0">

                                <table width="100%" style="border-spacing:0;font-family:sans-serif;color:#111111">

                                   <tbody><tr>

                                      <td style="padding-top:40px;padding-bottom:0px;padding-left:40px;padding-right:40px;background-color:#f5f5f5;width:100%;text-align:left">

                                         <p style="margin-top:0px;line-height:0px;margin-bottom:0px;font-size:4px">&nbsp;</p>

                                      </td>

                                   </tr>

                                </tbody></table>

                             </td>

                          </tr>

                       </tbody></table>

                       

           </div>

        </td>

     </tr>

  </tbody></table>





</td>

</tr>

</tbody></table>';

	    $mail->AddReplyTo("support@poppyindia.com","Poppy Mattress");

$mail->SetFrom('support@poppyindia.com', 'Poppy Mattress');
$mail->AddAddress($address, '');
//$mail->AddAddress('techaveo@gmail.com', '');


$mail->Subject    = 'Welcome to Poppy Mattress';

$mail->MsgHTML($body);

@$mail->Send();
	}
	
	public function OTPMail($address, $otp){
	    $mail = new PHPMailer(); 
	    
	    $body='<table width="100%" cellpadding="0" cellspacing="0" bgcolor="#F5F5F5" style="text-align:center">

<tbody><tr>

<td>      

<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">

    <tbody><tr>

	<td bgcolor="#F5F5F5" style="background-color:#f5f5f5;padding-top:0;padding-right:0;padding-left:0;padding-bottom:0">

		<div style="max-width:640px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:0;padding-right:0">

			

			<table cellpadding="0" cellspacing="0" border="0" align="center" width="100%" style="font-family:sans-serif;color:#111111">

				<tbody><tr>

					<td style="padding-top:10px;padding-right:0;padding-bottom:20px;padding-left:0">

						<table cellpadding="0" cellspacing="0" border="0" align="center" width="100%">

                          <tbody><tr>

                             <td width="174" align="left" class="m_26581947998977289stretch" style="padding-top:10px;padding-bottom:0;padding-right:0;padding-left:0">

                                <table width="100%" cellpadding="0" cellspacing="0" border="0" align="left">

                                   <tbody><tr>

                                      <td class="m_26581947998977289mobile-padding-fix m_26581947998977289mobiletextalign" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:16px">

                                         <a href="https://www.poppyindia.com"><img class="m_26581947998977289stretch-img CToWUd" src="http://poppyindia.com/demo/images/logo.png" width="158" height="54" border="0" alt="Poppy Mattress" style="display:block;color:#111111;font-family:Arial,sans-serif;font-size:12px;border:0;width:100%;max-width:158px;min-width:20px;height:auto"></a>

                                      </td>

                                   </tr>

                                </tbody></table>

                             </td>

                             <td align="right" class="m_26581947998977289stretch" style="padding-top:10px;padding-bottom:0;padding-right:0;padding-left:0">

                                <table width="100%" cellpadding="0" cellspacing="0" border="0">

                                   <tbody><tr>

                                      <td align="right" class="m_26581947998977289mobile-padding-fix-right m_26581947998977289mobiletextalign" style="padding-top:0;padding-bottom:0px;padding-left:0;padding-right:20px;text-align:right">

                                         <p class="m_26581947998977289mobiletextalign" style="margin-top:0px;margin-bottom:0px;font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;font-size:13px;line-height:21px">

                                            Need help? <a href="https://www.poppyindia.com/contactus.php">Contact us.</a><br>Customer Number: +91 96429 11441

                                         </p>

                                      </td>

                                   </tr>

                                </tbody></table>

                             </td>

                          </tr>

                       </tbody></table>

                    </td>

                          </tr>

                       </tbody></table>

			

		</div>

	</td>

	</tr>

</tbody></table>





<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">

    <tbody><tr>

	<td bgcolor="#F5F5F5" style="background-color:#f5f5f5;padding-top:0;padding-right:0;padding-left:0;padding-bottom:0">

		<div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

			

			<table bgcolor="#84226D" width="100%" align="center" border="0" cellspacing="0" cellpadding="0" style="font-family:serif;color:#ffffff">

				<tbody><tr>

				<td bgcolor="#84226D" align="left" class="m_26581947998977289h1-primary-mobile" style="padding-top:60px;padding-bottom:0;padding-right:40px;padding-left:40px;text-align:left;background-color:#84226D;font-size:36px;line-height:46px;font-weight:bold;font-family:\'Times New Roman\',Times,serif,\'gd-sage-bold\'">

                

					<span>Welcome to Poppy’s </span>

                        

				</td>

				</tr>

			</tbody></table>

            

		</div>

	</td>

	</tr>

</tbody></table>





<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">

    <tbody><tr>

	<td bgcolor="#F5F5F5" style="background-color:#f5f5f5;padding-top:0;padding-right:0;padding-left:0;padding-bottom:0">

		<div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

			

<table bgcolor="#84226D" width="100%" align="center" border="0" cellspacing="0" cellpadding="0" style="font-family:sans-serif;color:#ffffff">

	<tbody><tr>

	<td dir="ltr" bgcolor="#84226D" align="left" style="padding-top:40px;padding-bottom:0;padding-right:40px;padding-left:40px;text-align:left;background-color:#84226D">



		<p style="Margin-top:0px;Margin-bottom:0px;font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;font-size:16px;line-height:26px">

		We are glad that you are here <br><br>

		One quick way to get started <br><br>
		
		Poppy’s is a mattress company that brings products that promises customer with the dream sleep that they have been longing for. Here are in ways to dive right in <br><br>

		<b style="font-size:17px">OTP : '.$otp.' </b> <br><br>

		Start your exploration of products from Poppy’s. You are just one step away from dream sleep. Type the given OTP number and experience the personalized shopping with us. <br><br>

		</p>

                        

	</td>

	</tr>

</tbody></table>

            

		</div>

	</td>

	</tr>

</tbody></table>



<table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#F5F5F5">

     <tbody><tr>

        <td style="padding-top:0px;padding-bottom:0px" bgcolor="#F5F5F5">

           <div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

              

                       <table style="border-spacing:0;font-family:sans-serif;color:#111111;margin:0 auto;width:100%;max-width:600px" bgcolor="#84226D" align="center">

                          <tbody><tr>

                             <td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0">

                                <table style="border-spacing:0;font-family:sans-serif;color:#111111" width="100%">

                                   <tbody><tr>

                                      <td style="padding-top:60px;padding-bottom:0px;padding-left:40px;padding-right:40px;background-color:#84226D;width:100%;text-align:left">

                                         <p style="margin-top:0px;line-height:0px;margin-bottom:0px;font-size:4px">&nbsp;</p>

                                      </td>

                                   </tr>

                                </tbody></table>

                             </td>

                          </tr>

                       </tbody></table>

                       

           </div>

        </td>

     </tr>

  </tbody></table>








  <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">

     <tbody><tr>

        <td bgcolor="#F5F5F5" style="padding-top:0px;padding-bottom:0px">

           <div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

              

                       <table bgcolor="#F5F5F5" align="center" style="border-spacing:0;font-family:sans-serif;color:#111111;margin:0 auto;width:100%;max-width:600px">

                          <tbody><tr>

                             <td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0">

                                <table width="100%" style="border-spacing:0;font-family:sans-serif;color:#111111">

                                   <tbody><tr>

                                      <td style="padding-top:30px;padding-bottom:0px;padding-left:40px;padding-right:40px;background-color:#f5f5f5;width:100%;text-align:left">

                                         <p style="margin-top:0px;line-height:0px;margin-bottom:0px;font-size:4px">&nbsp;</p>

                                      </td>

                                   </tr>

                                </tbody></table>

                             </td>

                          </tr>

                       </tbody></table>

                       

           </div>

        </td>

     </tr>

  </tbody></table>




<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">

    <tbody><tr>

	<td bgcolor="#F5F5F5" style="background-color:#f5f5f5;padding-top:0;padding-right:0;padding-left:0;padding-bottom:0">

		<div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

			

			<table width="100%" align="left" border="0" cellspacing="0" cellpadding="0" style="font-family:sans-serif;color:#767676">

				<tbody><tr>

				<td align="left" style="padding-top:10px;padding-bottom:0;padding-right:0;padding-left:0;text-align:left">

                

					<p style="text-align:left;Margin-top:0px;Margin-bottom:0px;font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;font-size:12px;line-height:22px">

						Please do not reply to this email. Emails sent to this address will not be answered.

					</p>

                        

				</td>

				</tr>

			</tbody></table>

            

		</div>

	</td>

	</tr>

</tbody></table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">

    <tbody><tr>

	<td bgcolor="#F5F5F5" style="background-color:#f5f5f5;padding-top:0;padding-right:0;padding-left:0;padding-bottom:0">

		<div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

			

			<table width="100%" align="left" border="0" cellspacing="0" cellpadding="0" style="font-family:sans-serif;color:#767676">

				<tbody><tr>

				<td align="left" style="padding-top:10px;padding-bottom:0;padding-right:0;padding-left:0;text-align:left">

                

					<p style="text-align:left;Margin-top:0px;Margin-bottom:0px;font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;font-size:12px;line-height:22px">

						Copyright © 1999-2020 Poppy Mattress Pvt Ltd. All rights reserved.

					</p>

                        

				</td>

				</tr>

			</tbody></table>

            

		</div>

	</td>

	</tr>

</tbody></table>





  <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">

     <tbody><tr>

        <td bgcolor="#F5F5F5" style="padding-top:0px;padding-bottom:0px">

           <div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

              

                       <table bgcolor="#F5F5F5" align="center" style="border-spacing:0;font-family:sans-serif;color:#111111;margin:0 auto;width:100%;max-width:600px">

                          <tbody><tr>

                             <td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0">

                                <table width="100%" style="border-spacing:0;font-family:sans-serif;color:#111111">

                                   <tbody><tr>

                                      <td style="padding-top:40px;padding-bottom:0px;padding-left:40px;padding-right:40px;background-color:#f5f5f5;width:100%;text-align:left">

                                         <p style="margin-top:0px;line-height:0px;margin-bottom:0px;font-size:4px">&nbsp;</p>

                                      </td>

                                   </tr>

                                </tbody></table>

                             </td>

                          </tr>

                       </tbody></table>

                       

           </div>

        </td>

     </tr>

  </tbody></table>





</td>

</tr>

</tbody></table>';

	    $mail->AddReplyTo("support@poppyindia.com","Poppy Mattress");

$mail->SetFrom('support@poppyindia.com', 'Poppy Mattress');
$mail->AddAddress($address, '');
//$mail->AddAddress('techaveo@gmail.com', '');


$mail->Subject    = 'OTP - Poppy Mattress';

$mail->MsgHTML($body);

@$mail->Send();
	}
	
		public function ForgotPasswordOTPMail($address, $otp){
	    $mail = new PHPMailer(); 
	    
	    $body='<table width="100%" cellpadding="0" cellspacing="0" bgcolor="#F5F5F5" style="text-align:center">

<tbody><tr>

<td>      

<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">

    <tbody><tr>

	<td bgcolor="#F5F5F5" style="background-color:#f5f5f5;padding-top:0;padding-right:0;padding-left:0;padding-bottom:0">

		<div style="max-width:640px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:0;padding-right:0">

			

			<table cellpadding="0" cellspacing="0" border="0" align="center" width="100%" style="font-family:sans-serif;color:#111111">

				<tbody><tr>

					<td style="padding-top:10px;padding-right:0;padding-bottom:20px;padding-left:0">

						<table cellpadding="0" cellspacing="0" border="0" align="center" width="100%">

                          <tbody><tr>

                             <td width="174" align="left" class="m_26581947998977289stretch" style="padding-top:10px;padding-bottom:0;padding-right:0;padding-left:0">

                                <table width="100%" cellpadding="0" cellspacing="0" border="0" align="left">

                                   <tbody><tr>

                                      <td class="m_26581947998977289mobile-padding-fix m_26581947998977289mobiletextalign" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:16px">

                                         <a href="https://www.poppyindia.com"><img class="m_26581947998977289stretch-img CToWUd" src="http://poppyindia.com/demo/images/logo.png" width="158" height="54" border="0" alt="Poppy Mattress" style="display:block;color:#111111;font-family:Arial,sans-serif;font-size:12px;border:0;width:100%;max-width:158px;min-width:20px;height:auto"></a>

                                      </td>

                                   </tr>

                                </tbody></table>

                             </td>

                             <td align="right" class="m_26581947998977289stretch" style="padding-top:10px;padding-bottom:0;padding-right:0;padding-left:0">

                                <table width="100%" cellpadding="0" cellspacing="0" border="0">

                                   <tbody><tr>

                                      <td align="right" class="m_26581947998977289mobile-padding-fix-right m_26581947998977289mobiletextalign" style="padding-top:0;padding-bottom:0px;padding-left:0;padding-right:20px;text-align:right">

                                         <p class="m_26581947998977289mobiletextalign" style="margin-top:0px;margin-bottom:0px;font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;font-size:13px;line-height:21px">

                                            Need help? <a href="https://www.poppyindia.com/contactus.php">Contact us.</a><br>Customer Number: +91 96429 11441

                                         </p>

                                      </td>

                                   </tr>

                                </tbody></table>

                             </td>

                          </tr>

                       </tbody></table>

                    </td>

                          </tr>

                       </tbody></table>

			

		</div>

	</td>

	</tr>

</tbody></table>





<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">

    <tbody><tr>

	<td bgcolor="#F5F5F5" style="background-color:#f5f5f5;padding-top:0;padding-right:0;padding-left:0;padding-bottom:0">

		<div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

			

			<table bgcolor="#84226D" width="100%" align="center" border="0" cellspacing="0" cellpadding="0" style="font-family:serif;color:#ffffff">

				<tbody><tr>

				<td bgcolor="#84226D" align="left" class="m_26581947998977289h1-primary-mobile" style="padding-top:60px;padding-bottom:0;padding-right:40px;padding-left:40px;text-align:left;background-color:#84226D;font-size:36px;line-height:46px;font-weight:bold;font-family:\'Times New Roman\',Times,serif,\'gd-sage-bold\'">

                

					<span>Welcome to Poppy’s </span>

                        

				</td>

				</tr>

			</tbody></table>

            

		</div>

	</td>

	</tr>

</tbody></table>





<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">

    <tbody><tr>

	<td bgcolor="#F5F5F5" style="background-color:#f5f5f5;padding-top:0;padding-right:0;padding-left:0;padding-bottom:0">

		<div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

			

<table bgcolor="#84226D" width="100%" align="center" border="0" cellspacing="0" cellpadding="0" style="font-family:sans-serif;color:#ffffff">

	<tbody><tr>

	<td dir="ltr" bgcolor="#84226D" align="left" style="padding-top:40px;padding-bottom:0;padding-right:40px;padding-left:40px;text-align:left;background-color:#84226D">



		<p style="Margin-top:0px;Margin-bottom:0px;font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;font-size:16px;line-height:26px">

		You are requested to reset your password <br><br>
		
		<b style="font-size:17px">OTP : '.$otp.' </b> <br><br>

		Please note that this OTP will be expired 30 minutes after this email is sent.  <br><br><br>
		
		Please don\'t worry, If you didn\'t request to reset your password. It\'s still secure and no one has been given access to it. 
		Most likely, someone else must have mistyped their email address while trying to reset their own password. <br><br>

		</p>

                        

	</td>

	</tr>

</tbody></table>

            

		</div>

	</td>

	</tr>

</tbody></table>



<table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#F5F5F5">

     <tbody><tr>

        <td style="padding-top:0px;padding-bottom:0px" bgcolor="#F5F5F5">

           <div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

              

                       <table style="border-spacing:0;font-family:sans-serif;color:#111111;margin:0 auto;width:100%;max-width:600px" bgcolor="#84226D" align="center">

                          <tbody><tr>

                             <td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0">

                                <table style="border-spacing:0;font-family:sans-serif;color:#111111" width="100%">

                                   <tbody><tr>

                                      <td style="padding-top:60px;padding-bottom:0px;padding-left:40px;padding-right:40px;background-color:#84226D;width:100%;text-align:left">

                                         <p style="margin-top:0px;line-height:0px;margin-bottom:0px;font-size:4px">&nbsp;</p>

                                      </td>

                                   </tr>

                                </tbody></table>

                             </td>

                          </tr>

                       </tbody></table>

                       

           </div>

        </td>

     </tr>

  </tbody></table>








  <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">

     <tbody><tr>

        <td bgcolor="#F5F5F5" style="padding-top:0px;padding-bottom:0px">

           <div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

              

                       <table bgcolor="#F5F5F5" align="center" style="border-spacing:0;font-family:sans-serif;color:#111111;margin:0 auto;width:100%;max-width:600px">

                          <tbody><tr>

                             <td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0">

                                <table width="100%" style="border-spacing:0;font-family:sans-serif;color:#111111">

                                   <tbody><tr>

                                      <td style="padding-top:30px;padding-bottom:0px;padding-left:40px;padding-right:40px;background-color:#f5f5f5;width:100%;text-align:left">

                                         <p style="margin-top:0px;line-height:0px;margin-bottom:0px;font-size:4px">&nbsp;</p>

                                      </td>

                                   </tr>

                                </tbody></table>

                             </td>

                          </tr>

                       </tbody></table>

                       

           </div>

        </td>

     </tr>

  </tbody></table>




<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">

    <tbody><tr>

	<td bgcolor="#F5F5F5" style="background-color:#f5f5f5;padding-top:0;padding-right:0;padding-left:0;padding-bottom:0">

		<div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

			

			<table width="100%" align="left" border="0" cellspacing="0" cellpadding="0" style="font-family:sans-serif;color:#767676">

				<tbody><tr>

				<td align="left" style="padding-top:10px;padding-bottom:0;padding-right:0;padding-left:0;text-align:left">

                

					<p style="text-align:left;Margin-top:0px;Margin-bottom:0px;font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;font-size:12px;line-height:22px">

						Please do not reply to this email. Emails sent to this address will not be answered.

					</p>

                        

				</td>

				</tr>

			</tbody></table>

            

		</div>

	</td>

	</tr>

</tbody></table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">

    <tbody><tr>

	<td bgcolor="#F5F5F5" style="background-color:#f5f5f5;padding-top:0;padding-right:0;padding-left:0;padding-bottom:0">

		<div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

			

			<table width="100%" align="left" border="0" cellspacing="0" cellpadding="0" style="font-family:sans-serif;color:#767676">

				<tbody><tr>

				<td align="left" style="padding-top:10px;padding-bottom:0;padding-right:0;padding-left:0;text-align:left">

                

					<p style="text-align:left;Margin-top:0px;Margin-bottom:0px;font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;font-size:12px;line-height:22px">

						Copyright © 1999-2020 Poppy Mattress Pvt Ltd. All rights reserved.

					</p>

                        

				</td>

				</tr>

			</tbody></table>

            

		</div>

	</td>

	</tr>

</tbody></table>





  <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">

     <tbody><tr>

        <td bgcolor="#F5F5F5" style="padding-top:0px;padding-bottom:0px">

           <div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

              

                       <table bgcolor="#F5F5F5" align="center" style="border-spacing:0;font-family:sans-serif;color:#111111;margin:0 auto;width:100%;max-width:600px">

                          <tbody><tr>

                             <td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0">

                                <table width="100%" style="border-spacing:0;font-family:sans-serif;color:#111111">

                                   <tbody><tr>

                                      <td style="padding-top:40px;padding-bottom:0px;padding-left:40px;padding-right:40px;background-color:#f5f5f5;width:100%;text-align:left">

                                         <p style="margin-top:0px;line-height:0px;margin-bottom:0px;font-size:4px">&nbsp;</p>

                                      </td>

                                   </tr>

                                </tbody></table>

                             </td>

                          </tr>

                       </tbody></table>

                       

           </div>

        </td>

     </tr>

  </tbody></table>





</td>

</tr>

</tbody></table>';

	    $mail->AddReplyTo("support@poppyindia.com","Poppy Mattress");

$mail->SetFrom('support@poppyindia.com', 'Poppy Mattress');
$mail->AddAddress($address, '');
//$mail->AddAddress('techaveo@gmail.com', '');


$mail->Subject    = 'Forgot Password : OTP - Poppy Mattress';

$mail->MsgHTML($body);

@$mail->Send();
	}
	
	public function sendsms($mobileno,$message){ 
        $apiKey = urlencode('335958AEcvLtgyxyS5f112ac4P1');
    
    // Message details
    $numbers = urlencode($mobileno);
    $sender = urlencode('POPPYS');
    $message = rawurlencode($message);
 
    // Prepare data for POST request
    $data = 'authkey=' . $apiKey . '&route=4&country=91&mobiles=' . $numbers . "&sender=" . $sender . "&message=" . $message;

    // Send the GET request with cURL
    $ch = curl_init('http://api.msg91.com/api/sendhttp.php?' . $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    }

    public function CancelOrder($id){ extract($_POST);
    	$cancel_reason=$this->clean('cancel_reason');
    	$this->Query("update orders set cancel_date='".date("Y-m-d H:i:s")."',status='cancel-request',  cancel_reason='".$cancel_reason."' where id=".$id." and userid=".$_SESSION['userid']);
    	$order=$this->getRow("select * from orders where id=".$id);
    	$usr=$this->getRow("select * from customers where id=".$order['userid']);
    	if($usr['emailid']!='')
    	$this->CancelOrderMail($id,$usr['emailid']);
    	else if($order['emailid']!='')
    	$this->CancelOrderMail($id,$order['emailid']);

    	$otpmsg='Hi '.$order['name'].'! Your cancellation requested has been processed for the order number '.$order['tracking_id'].'. It may take up to 5 working days for our team to respond. See the mail for more';
	    
		if($usr['mobileno']!='')
	    $this->sendsms($usr['mobileno'],$otpmsg);

    	header("location:order-detail.php?id=".$id."&msg=cancelled");

    }

    public function CancelOrderMail($id,$address){
    	$order=$this->getRow("select * from orders where id=".$id);
	    $mail = new PHPMailer(); 
	    
	    $body='<table width="100%" cellpadding="0" cellspacing="0" bgcolor="#F5F5F5" style="text-align:center">

<tbody><tr>

<td>      

<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">

    <tbody><tr>

	<td bgcolor="#F5F5F5" style="background-color:#f5f5f5;padding-top:0;padding-right:0;padding-left:0;padding-bottom:0">

		<div style="max-width:640px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:0;padding-right:0">

			

			<table cellpadding="0" cellspacing="0" border="0" align="center" width="100%" style="font-family:sans-serif;color:#111111">

				<tbody><tr>

					<td style="padding-top:10px;padding-right:0;padding-bottom:20px;padding-left:0">

						<table cellpadding="0" cellspacing="0" border="0" align="center" width="100%">

                          <tbody><tr>

                             <td width="174" align="left" class="m_26581947998977289stretch" style="padding-top:10px;padding-bottom:0;padding-right:0;padding-left:0">

                                <table width="100%" cellpadding="0" cellspacing="0" border="0" align="left">

                                   <tbody><tr>

                                      <td class="m_26581947998977289mobile-padding-fix m_26581947998977289mobiletextalign" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:16px">

                                         <a href="https://www.poppyindia.com"><img class="m_26581947998977289stretch-img CToWUd" src="http://poppyindia.com/demo/images/logo.png" width="158" height="54" border="0" alt="Poppy Mattress" style="display:block;color:#111111;font-family:Arial,sans-serif;font-size:12px;border:0;width:100%;max-width:158px;min-width:20px;height:auto"></a>

                                      </td>

                                   </tr>

                                </tbody></table>

                             </td>

                             <td align="right" class="m_26581947998977289stretch" style="padding-top:10px;padding-bottom:0;padding-right:0;padding-left:0">

                                <table width="100%" cellpadding="0" cellspacing="0" border="0">

                                   <tbody><tr>

                                      <td align="right" class="m_26581947998977289mobile-padding-fix-right m_26581947998977289mobiletextalign" style="padding-top:0;padding-bottom:0px;padding-left:0;padding-right:20px;text-align:right">

                                         <p class="m_26581947998977289mobiletextalign" style="margin-top:0px;margin-bottom:0px;font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;font-size:13px;line-height:21px">

                                            Need help? <a href="https://www.poppyindia.com/contactus.php">Contact us.</a><br>Customer Number: +91 96982 80808

                                         </p>

                                      </td>

                                   </tr>

                                </tbody></table>

                             </td>

                          </tr>

                       </tbody></table>

                    </td>

                          </tr>

                       </tbody></table>

			

		</div>

	</td>

	</tr>

</tbody></table>





<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">

    <tbody><tr>

	<td bgcolor="#F5F5F5" style="background-color:#f5f5f5;padding-top:0;padding-right:0;padding-left:0;padding-bottom:0">

		<div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

			

			<table bgcolor="#84226D" width="100%" align="center" border="0" cellspacing="0" cellpadding="0" style="font-family:serif;color:#ffffff">

				<tbody><tr>

				<td bgcolor="#84226D" align="left" class="m_26581947998977289h1-primary-mobile" style="padding-top:60px;padding-bottom:0;padding-right:40px;padding-left:40px;text-align:left;background-color:#84226D;font-size:22px;line-height:46px;font-weight:bold;font-family:\'Times New Roman\',Times,serif,\'gd-sage-bold\'">

                

					<span>WE’ RE SORRY. YOU’VE HAD TO CANCEL  </span>

                        

				</td>

				</tr>

			</tbody></table>

            

		</div>

	</td>

	</tr>

</tbody></table>





<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">

    <tbody><tr>

	<td bgcolor="#F5F5F5" style="background-color:#f5f5f5;padding-top:0;padding-right:0;padding-left:0;padding-bottom:0">

		<div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

			

<table bgcolor="#84226D" width="100%" align="center" border="0" cellspacing="0" cellpadding="0" style="font-family:sans-serif;color:#ffffff">

	<tbody><tr>

	<td dir="ltr" bgcolor="#84226D" align="left" style="padding-top:40px;padding-bottom:0;padding-right:40px;padding-left:40px;text-align:left;background-color:#84226D">



		<p style="Margin-top:0px;Margin-bottom:0px;font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;font-size:16px;line-height:26px">

		Hello '.$order['name'].'! <br><br>
		

		Poppy’s mattress is committed to 100% satisfaction of customers. If you are unsatisfied for any reason, we are processing, the cancellation request to our team. The team shall get in touch with you. Follow the steps and our team is here to help  <br><br>
		
		


		</p>

		<ol style="line-height: 20px;">
			<li style="margin-bottom:20;"> Email support@poppyindia.com or call +91 96429 11441 for processing your cancellation.</li>
		<li style="margin-bottom:20;"> A cancellation ticket will be sent over mail confirming the request from your end.</li>
		<li style="margin-bottom:20;"> Once you have placed the cancellation request, it may take up to 5 working days to complete the process. We will try to respond as quickly as possible to resolve the issue. </li>
		<li style="margin-bottom:20;"> After reviewing the details, if the cancellation order is processed for a refund, you will be notified. </li>
		</ol>

                        

	</td>

	</tr>

</tbody></table>

            

		</div>

	</td>

	</tr>

</tbody></table>



<table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#F5F5F5">

     <tbody><tr>

        <td style="padding-top:0px;padding-bottom:0px" bgcolor="#F5F5F5">

           <div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

              

                       <table style="border-spacing:0;font-family:sans-serif;color:#111111;margin:0 auto;width:100%;max-width:600px" bgcolor="#84226D" align="center">

                          <tbody><tr>

                             <td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0">

                                <table style="border-spacing:0;font-family:sans-serif;color:#111111" width="100%">

                                   <tbody><tr>

                                      <td style="padding-top:60px;padding-bottom:0px;padding-left:40px;padding-right:40px;background-color:#84226D;width:100%;text-align:left">

                                         <p style="margin-top:0px;line-height:0px;margin-bottom:0px;font-size:4px">&nbsp;</p>

                                      </td>

                                   </tr>

                                </tbody></table>

                             </td>

                          </tr>

                       </tbody></table>

                       

           </div>

        </td>

     </tr>

  </tbody></table>

  <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">

    <tbody><tr>

	<td bgcolor="#F5F5F5" style="background-color:#f5f5f5;padding-top:0;padding-right:0;padding-left:0;padding-bottom:0">

		<div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

			

<table bgcolor="#FFFFFF" width="100%" align="center" border="0" cellspacing="0" cellpadding="0" style="font-family:sans-serif;color:#111111">

	<tbody>

	<tr>
		<td colspan="2" style="padding-top:20px;padding-bottom:0;padding-right:40px;padding-left:40px;text-align:left;background-color:#ffffff">
			
			<table cellpadding="0" cellspacing="0" width="100%">
				<tr>
		<td style="padding:6px 6px 6px 6px; border-collapse:collapse; border-top:1px solid #cccccc;   border-left:1px solid #cccccc; border-bottom:1px solid #cccccc; width:200px;vertical-align:middle;">Order Date </td>
		<td style="padding:6px 6px 6px 6px; border-collapse:collapse; border-top:1px solid #cccccc;   border-left:1px solid #cccccc; border-right:1px solid #cccccc;  border-bottom:1px solid #cccccc; width:200px;vertical-align:middle"> '.date("d-m-Y h:i A",strtotime($order['order_date'])).'</td>
	</tr>

	<tr>
		<td style="padding:6px 6px 6px 6px; border-collapse:collapse; border-left:1px solid #cccccc; border-bottom:1px solid #cccccc; width:200px;vertical-align:middle;">Name</td>
		<td style="padding:6px 6px 6px 6px; border-collapse:collapse; border-left:1px solid #cccccc; border-right:1px solid #cccccc;  border-bottom:1px solid #cccccc; width:200px;vertical-align:middle"> '.$order['name'].'</td>
	</tr>

	<tr>
		<td style="padding:6px 6px 6px 6px; border-collapse:collapse; border-left:1px solid #cccccc; border-bottom:1px solid #cccccc; width:200px;vertical-align:middle;">Mobile No</td>
		<td style="padding:6px 6px 6px 6px; border-collapse:collapse; border-left:1px solid #cccccc; border-right:1px solid #cccccc;  border-bottom:1px solid #cccccc; width:200px;vertical-align:middle"> '.$order['mobileno'].' / '.$order['mobileno_alt'].'</td>
	</tr>

	<tr>
		<td style="padding:6px 6px 6px 6px; border-collapse:collapse; border-left:1px solid #cccccc; border-bottom:1px solid #cccccc; width:200px;vertical-align:middle;">Email ID</td>
		<td style="padding:6px 6px 6px 6px; border-collapse:collapse; border-left:1px solid #cccccc; border-right:1px solid #cccccc;  border-bottom:1px solid #cccccc; width:200px;vertical-align:middle"> '.$order['emailid'].'</td>
	</tr>

	<tr>
		<td style="padding:6px 6px 6px 6px; border-collapse:collapse; border-left:1px solid #cccccc; border-bottom:1px solid #cccccc; width:200px;vertical-align:middle;">Address</td>
		<td style="padding:6px 6px 6px 6px; border-collapse:collapse; border-left:1px solid #cccccc; border-right:1px solid #cccccc;  border-bottom:1px solid #cccccc; width:200px;vertical-align:middle"> '.$order['address'].'</td>
	</tr>

	<tr>
		<td style="padding:6px 6px 6px 6px; border-collapse:collapse; border-left:1px solid #cccccc; border-bottom:1px solid #cccccc; width:200px;vertical-align:middle;">City</td>
		<td style="padding:6px 6px 6px 6px; border-collapse:collapse; border-left:1px solid #cccccc; border-right:1px solid #cccccc;  border-bottom:1px solid #cccccc; width:200px;vertical-align:middle"> '.$order['city'].'</td>
	</tr>

	<tr>
		<td style="padding:6px 6px 6px 6px; border-collapse:collapse; border-left:1px solid #cccccc; border-bottom:1px solid #cccccc; width:200px;vertical-align:middle;">State</td>
		<td style="padding:6px 6px 6px 6px; border-collapse:collapse; border-left:1px solid #cccccc; border-right:1px solid #cccccc;  border-bottom:1px solid #cccccc; width:200px;vertical-align:middle"> '.$order['state'].'</td>
	</tr>

	<tr>
		<td style="padding:6px 6px 6px 6px; border-collapse:collapse; border-left:1px solid #cccccc; border-bottom:1px solid #cccccc; width:200px;vertical-align:middle;">Pincode</td>
		<td style="padding:6px 6px 6px 6px; border-collapse:collapse; border-left:1px solid #cccccc; border-right:1px solid #cccccc;  border-bottom:1px solid #cccccc; width:200px;vertical-align:middle"> '.$order['pincode'].'</td>
	</tr>

	<tr>
		<td colspan="2" style="padding:6px 6px 6px 6px; border-collapse:collapse; border-left:1px solid #cccccc; border-right:1px solid #cccccc; width:200px;vertical-align:middle;">Notes:</td>
	</tr>
	<tr>
		<td colspan="2" style="padding:6px 6px 6px 6px; border-collapse:collapse; border-left:1px solid #cccccc; border-right:1px solid #cccccc;  border-bottom:1px solid #cccccc; width:200px;vertical-align:middle;">'.$order['order_notes'].'</td>
	</tr>
			</table>
		</td>
	</tr>

	

</tbody></table>

            

		</div>

	</td>

	</tr>

</tbody></table>

  <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">

    <tbody><tr>

	<td bgcolor="#F5F5F5" style="background-color:#f5f5f5;padding-top:0;padding-right:0;padding-left:0;padding-bottom:0">

		<div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

			

			<table bgcolor="#FFFFFF" width="100%" align="center" border="0" cellspacing="0" cellpadding="0" style="font-family:sans-serif">

				<tbody><tr>

				<td bgcolor="#FFFFFF" align="left" style="padding-top:60px;padding-bottom:0;padding-right:40px;padding-left:40px;text-align:left;background-color:#ffffff;font-weight:bold;font-family:Arial,sans-serif,\'Arial Bold\',\'gdsherpa-bold\';font-size:21px;line-height:31px;color:#111111">

                

					<span><span class="il">Canceled item(s) – Poppy’s Mattress</span>

                 

				</td>

				</tr>

			</tbody></table>

			            

		</div>

	</td>

	</tr>

</tbody></table>



<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">

    <tbody><tr>

	<td bgcolor="#F5F5F5" style="background-color:#f5f5f5;padding-top:0;padding-right:0;padding-left:0;padding-bottom:0">

		<div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

			

			<table bgcolor="#ffffff" width="100%" align="center" border="0" cellspacing="0" cellpadding="0" style="font-family:sans-serif;color:#111111">

				<tbody><tr>

				<td bgcolor="#ffffff" align="left" style="padding-top:20px;padding-bottom:0;padding-right:40px;padding-left:40px;text-align:left;background-color:#ffffff">

                

					<table style="table-layout:fixed;width:520px;border-collapse:collapse" cellspacing="0" cellpadding="0" border="0">

  <tbody><tr style="width:100%">

    <td bgcolor="#767676" style="border-collapse:collapse;border-left:1px solid #cccccc;border-top:1px solid #cccccc;border-bottom:1px solid #cccccc;width:50px" align="center" valign="middle">

      <div style="width:100%;height:100%;overflow:hidden;font-size:14px;font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;color:#ffffff">

            &nbsp;

          </div>

    </td>

    <td bgcolor="#767676" style="border-collapse:collapse;border-left:1px solid #cccccc;border-top:1px solid #cccccc;border-bottom:1px solid #cccccc;width:200px; padding:8px; " align="center" valign="middle">

      <div style="width:100%;height:100%;overflow:hidden;font-size:14px;font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;color:#ffffff">

            Product

          </div>

    </td>

    <td bgcolor="#767676" style="border-collapse:collapse;border-left:1px solid #cccccc;border-top:1px solid #cccccc;border-bottom:1px solid #cccccc;width:57px" align="center" valign="middle">

      <div style="width:100%;height:100%;overflow:hidden;font-size:14px;font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;color:#ffffff">

            Qty

          </div>

    </td>

    <td bgcolor="#767676" style="border-collapse:collapse;border:1px solid #cccccc;width:65px" align="center" valign="middle">

      <div style="width:100%;height:100%;overflow:hidden;font-size:14px;font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;color:#ffffff">

            Price

          </div>

    </td>

  </tr>';


$order_items=$this->getResults("select * from orders_items where order_id='".$order['id']."'");
if(!empty($order_items)){ $i=0;
    foreach($order_items as $item) { $i++;

if($item['product_type']=='free') {
	$label="<label><b style='color:#84226D'>FREE</b></label>";
	$pname=$item['product_name'];
}
else { $label='';
	$pname=$item['product_name'].' '.$item['product_height'].'"';
}

if($item['product_type']!='free') $price="₹ ".$this->INR($item['amount']);
else $price='';

$body.='

  <tr style="width:100%">

    <td style="padding:6px 6px 6px 6px;border-collapse:collapse;border-left:1px solid #cccccc;border-bottom:1px solid #cccccc;width:50px;vertical-align:top">

      <div style="width:100%;height:100%;overflow:hidden;font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;font-size:14px">

          <img src="'.HTTP_SERVER.'images/products/'.$item['cover_image'].'" alt="" style="width: 80px;">

        </div>

    </td>

    <td style="padding-top:6px; padding-left: 10px; border-collapse:collapse;border-left:1px solid #cccccc;border-bottom:1px solid #cccccc;width:200px;vertical-align:top" align="left">

      <div style="width:100%;height:100%;overflow:hidden;font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;font-size:12px; line-height: 18px;">
      		'.$pname.' <br>
      		'.$label.'
      		'.$item['category'].' <br>
      		'.$item['product_size'].'

      </div>

    </td>

    <td style="padding-top:6px;border-collapse:collapse;border-left:1px solid #cccccc;border-bottom:1px solid #cccccc;width:57px;vertical-align:top" align="center">

      <div style="width:100%;height:100%;overflow:hidden;font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;font-size:14px">
      		'.$item['qty'].'
      </div>

    </td>

    <td style="padding-left:10px;padding-right:10px;padding-top:6px;padding-bottom:2px;text-align:right;vertical-align:top;border-collapse:collapse;border-left:1px solid #cccccc;border-right:1px solid #cccccc;border-bottom:1px solid #cccccc;width:65px">

      <div style="width:100%;height:100%;overflow:hidden;font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;font-size:14px">

              '.$price.'

            </div>

    </td>

  </tr>';

	}
}




if($order['coupon_value']!=0) {

  $body.='<tr style="width:520px">

    <td colspan="2" bgcolor="#f5f5f5" align="right" style="padding-top:15px;padding-right:10px;padding-bottom:6px;border-collapse:collapse;border-top:1px solid #cccccc;border-right:1px solid #cccccc;border-bottom:1px solid #cccccc;text-align:right;vertical-align:top;height:20px">

      <div style="width:100%;height:100%;overflow:hidden;font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;font-size:14px;color:#666666">

            Order Total

          </div>

    </td>

    <td align="right" colspan="2" bgcolor="#f5f5f5" style="padding-top:15px;padding-right:10px;padding-bottom:6px;border-collapse:collapse;border-top:1px solid #cccccc;border-right:1px solid #cccccc;border-bottom:1px solid #cccccc;text-align:right;vertical-align:top;height:20px">

      <div style="width:100%;height:100%;overflow:hidden;font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;font-size:14px;color:#666666">

            ₹ '.$this->INR($order['sub_total']).'

          </div>

    </td>

  </tr>';

$body.='<tr style="width:520px">

    <td colspan="2" align="right" bgcolor="#f5f5f5" style="padding-top:15px;padding-right:10px;padding-bottom:6px;border-collapse:collapse;border-top:1px solid #cccccc;border-right:1px solid #cccccc;border-bottom:1px solid #cccccc;text-align:right;vertical-align:top;height:20px">

      <div style="width:100%;height:100%;overflow:hidden;font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;font-size:14px;color:#666666">

                   Coupon Discount

                  </div>

    </td>

    <td align="right" colspan="2" bgcolor="#f5f5f5" style="padding-top:15px;padding-right:10px;padding-bottom:6px;border-collapse:collapse;border-top:1px solid #cccccc;border-right:1px solid #cccccc;border-bottom:1px solid #cccccc;text-align:right;vertical-align:top;height:20px">

      <div style="width:100%;height:100%;overflow:hidden;font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;font-size:14px;color:#666666">

                ₹ '.$this->INR($order['coupon_value']).'

              </div>

    </td>

  </tr>

  <tr style="width:520px">

    <td colspan="2" bgcolor="#f5f5f5" style="padding-top:15px;padding-right:10px;padding-bottom:6px;border-collapse:collapse;border-top:1px solid #cccccc;border-right:1px solid #cccccc;border-bottom:1px solid #cccccc;text-align:right;vertical-align:top;height:20px">

      <div style="height:100%;overflow:hidden">

        <font style="font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;font-size:14px;color:#666666">

              Net Amount

            </font>

      </div>

    </td>

    <td bgcolor="#f5f5f5" colspan="2" style="padding-top:15px;padding-right:10px;padding-bottom:6px;border-collapse:collapse;border-top:1px solid #cccccc;border-right:1px solid #cccccc;border-bottom:1px solid #cccccc;text-align:right;vertical-align:top;height:20px">

      <div style="height:100%;overflow:hidden">

        <font style="font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;font-size:18px;color:#84226D">

              ₹ '.$this->INR($order['net_amount']).'

            </font>

      </div>

    </td>

  </tr>';
 } else {
       $body.='<tr style="width:520px">

    <td colspan="2" bgcolor="#f5f5f5" align="right" style="padding-top:15px;padding-right:10px;padding-bottom:6px;border-collapse:collapse;border-top:1px solid #cccccc;border-right:1px solid #cccccc;border-bottom:1px solid #cccccc;text-align:right;vertical-align:top;height:20px">

      <div style="width:100%;height:100%;overflow:hidden;font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;font-size:14px;color:#666666">

            Order Total

          </div>

    </td>

    <td align="right" colspan="2" bgcolor="#f5f5f5" style="padding-top:15px;padding-right:10px;padding-bottom:6px;border-collapse:collapse;border-top:1px solid #cccccc;border-right:1px solid #cccccc;border-bottom:1px solid #cccccc;text-align:right;vertical-align:top;height:20px">

      <div style="width:100%;height:100%;overflow:hidden;font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;font-size:14px;color:#666666">

           <font style="font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;font-size:18px;color:#84226D">

              ₹ '.$this->INR($order['sub_total']).'

            </font>

          </div>

    </td>

  </tr>';
 }

$body.='</tbody></table>

                        

				</td>

				</tr>

			</tbody></table>

            

		</div>

	</td>

	</tr>

</tbody></table>





  <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">

     <tbody><tr>

        <td bgcolor="#F5F5F5" style="padding-top:0px;padding-bottom:0px">

           <div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

              

                       <table bgcolor="#FFFFFF" align="center" style="border-spacing:0;font-family:sans-serif;color:#111111;margin:0 auto;width:100%;max-width:600px">

                          <tbody><tr>

                             <td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0">

                                <table width="100%" style="border-spacing:0;font-family:sans-serif;color:#111111">

                                   <tbody><tr>

                                      <td style="padding-top:60px;padding-bottom:0px;padding-left:40px;padding-right:40px;background-color:#ffffff;width:100%;text-align:left">

                                         <p style="margin-top:0px;line-height:0px;margin-bottom:0px;font-size:4px">&nbsp;</p>

                                      </td>

                                   </tr>

                                </tbody></table>

                             </td>

                          </tr>

                       </tbody></table>

                       

           </div>

        </td>

     </tr>

  </tbody></table>








  <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">

     <tbody><tr>

        <td bgcolor="#F5F5F5" style="padding-top:0px;padding-bottom:0px">

           <div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

              

                       <table bgcolor="#F5F5F5" align="center" style="border-spacing:0;font-family:sans-serif;color:#111111;margin:0 auto;width:100%;max-width:600px">

                          <tbody><tr>

                             <td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0">

                                <table width="100%" style="border-spacing:0;font-family:sans-serif;color:#111111">

                                   <tbody><tr>

                                      <td style="padding-top:30px;padding-bottom:0px;padding-left:40px;padding-right:40px;background-color:#f5f5f5;width:100%;text-align:left">

                                         <p style="margin-top:0px;line-height:0px;margin-bottom:0px;font-size:4px">&nbsp;</p>

                                      </td>

                                   </tr>

                                </tbody></table>

                             </td>

                          </tr>

                       </tbody></table>

                       

           </div>

        </td>

     </tr>

  </tbody></table>




<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">

    <tbody><tr>

	<td bgcolor="#F5F5F5" style="background-color:#f5f5f5;padding-top:0;padding-right:0;padding-left:0;padding-bottom:0">

		<div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

			

			<table width="100%" align="left" border="0" cellspacing="0" cellpadding="0" style="font-family:sans-serif;color:#767676">

				<tbody><tr>

				<td align="left" style="padding-top:10px;padding-bottom:0;padding-right:0;padding-left:0;text-align:left">

                

					<p style="text-align:left;Margin-top:0px;Margin-bottom:0px;font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;font-size:12px;line-height:22px">

						Thank you for choosing us. If you have further enquiry chat with us support@poppyindia.com or <br>call +91 96429 11441
						<br><br> Please do not reply to this email. Emails sent to this address will not be answered.

					</p>

                        

				</td>

				</tr>

			</tbody></table>

            

		</div>

	</td>

	</tr>

</tbody></table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">

    <tbody><tr>

	<td bgcolor="#F5F5F5" style="background-color:#f5f5f5;padding-top:0;padding-right:0;padding-left:0;padding-bottom:0">

		<div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

			

			<table width="100%" align="left" border="0" cellspacing="0" cellpadding="0" style="font-family:sans-serif;color:#767676">

				<tbody><tr>

				<td align="left" style="padding-top:10px;padding-bottom:0;padding-right:0;padding-left:0;text-align:left">

                

					<p style="text-align:left;Margin-top:0px;Margin-bottom:0px;font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;font-size:12px;line-height:22px">

						Copyright © 1999-2020 Poppy Mattress Pvt Ltd. All rights reserved.

					</p>

                        

				</td>

				</tr>

			</tbody></table>

            

		</div>

	</td>

	</tr>

</tbody></table>





  <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#F5F5F5">

     <tbody><tr>

        <td bgcolor="#F5F5F5" style="padding-top:0px;padding-bottom:0px">

           <div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

              

                       <table bgcolor="#F5F5F5" align="center" style="border-spacing:0;font-family:sans-serif;color:#111111;margin:0 auto;width:100%;max-width:600px">

                          <tbody><tr>

                             <td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0">

                                <table width="100%" style="border-spacing:0;font-family:sans-serif;color:#111111">

                                   <tbody><tr>

                                      <td style="padding-top:40px;padding-bottom:0px;padding-left:40px;padding-right:40px;background-color:#f5f5f5;width:100%;text-align:left">

                                         <p style="margin-top:0px;line-height:0px;margin-bottom:0px;font-size:4px">&nbsp;</p>

                                      </td>

                                   </tr>

                                </tbody></table>

                             </td>

                          </tr>

                       </tbody></table>

                       

           </div>

        </td>

     </tr>

  </tbody></table>





</td>

</tr>

</tbody></table>';

	    $mail->AddReplyTo("support@poppyindia.com","Poppy Mattress");

$mail->SetFrom('support@poppyindia.com', 'Poppy Mattress');
$mail->AddAddress($address, '');
//$mail->AddAddress('techaveo@gmail.com', '');


$mail->Subject    = 'Cancel Order - Poppy Mattress';

$mail->MsgHTML($body);

@$mail->Send();
	}
	
	
}
$objAdmin = new Admin();
?>