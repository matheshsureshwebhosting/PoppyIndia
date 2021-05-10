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
		public function deleteenquiry($id)
	{
    extract($_REQUEST);
	mysql_query("delete from  tbl_req_quote where enq_id =".$id."") or die(mysql_error());
	header("location: enquiry.php?msg=del");
	}
	public function updateImages($id)
	{
    extract($_REQUEST);
	//die("update carimages set status='yes' where id =".$image_id);
	mysql_query("update carimages set status='no' where car_id =".$id) or die(mysql_error());
	mysql_query("update carimages set status='yes' where id =".$image_id) or die(mysql_error());
	header("location: images.php?msg=upd&id=".$id);
	}
	public function deleteImages($id)
	{
    extract($_REQUEST);
	$carid=$this->getRow("select * from carimages where id =".$id);
	unlink("../imgs/".$carid['image_name']);
	mysql_query("delete from  carimages where id =".$id."") or die(mysql_error());
	header("location: images.php?msg=del&id=".$carid['car_id']);
	}
	public function getCustomerID($id){ extract($_REQUEST);
		$cus=$this->getRow("select * from customer where id=".$id);
		if($cus['customer_type']=='dealer') $prefix=ID_PREFIX."DL";
		else if($cus['customer_type']=='mediator') $prefix=ID_PREFIX."DL";
		else if($cus['customer_type']=='customer') $prefix=ID_PREFIX."CS";
		if($cus['customer_id'] <10) $id="000".$cus['customer_id'];
		else if($cus['customer_id'] <100) $id="00".$cus['customer_id'];
		else if($cus['customer_id'] <1000) $id="0".$cus['customer_id'];
		else $id=$cus['customer_id'];
		return $prefix.$id;
	}
	public function getID($id){ //get id from customer ID		
		$type=substr($id, strlen(ID_PREFIX),2);
		$aid=substr($id, (strlen(ID_PREFIX)+2));
		return ltrim($aid, '0');
	}
	
	public function sendsms($mobileno,$message){
        $apiKey = urlencode('228872ASgiBEkS5b5eac6f');
    
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
	
	public function DeliveryOutEmail($address){
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

        <td bgcolor="#84226D" align="left" class="m_26581947998977289h1-primary-mobile" style="padding-top:60px;padding-bottom:0;padding-right:40px;padding-left:40px;text-align:left;background-color:#84226D;font-size:36px;line-height:46px;font-weight:bold;font-family:\'Times New Roman\',Times,serif,\'gd-sage-bold\'">

                

          <span>Good News! Next stop is your DreamLand </span>

                        

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

    A shipment from Poppy’s is headed your way now<br><br>

    You are few nights away from sleeping on your favorite choice of mattress from Poppy’s<br><br>
    
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

	    $mail->AddReplyTo("no-reply@poppyindia.com","Poppy Mattress");

$mail->SetFrom('no-reply@poppyindia.com', 'Poppy Mattress');
$mail->AddAddress($address, '');
//$mail->AddAddress('techaveo@gmail.com', '');


$mail->Subject    = 'Out For delivery - Poppy Mattress';

$mail->MsgHTML($body);

@$mail->Send();
	}
	
	public function DeliveredEmail($address){
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

        <td bgcolor="#84226D" align="left" class="m_26581947998977289h1-primary-mobile" style="padding-top:60px;padding-bottom:0;padding-right:40px;padding-left:40px;text-align:left;background-color:#84226D;font-size:36px;line-height:46px;font-weight:bold;font-family:\'Times New Roman\',Times,serif,\'gd-sage-bold\'">

                

          <span>Wohoo! Finally we met you </span>

                        

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

    Your Order has been delivered – It was indeed a pleasure<br><br>

    Our mattresses, sheets, pillows are engineered for outrageous comfort.<br><br>
    
    Together we can create sleep environments that love your back. <br><br>
    
    Your best nights are our dream nights. Sleep Well <br><br>
    
    But don\'t forget to tell us how you loved sleeping <br><br>
    
    You can also follow the sleep story of our customers <br><br>

    
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

	    $mail->AddReplyTo("no-reply@poppyindia.com","Poppy Mattress");

$mail->SetFrom('no-reply@poppyindia.com', 'Poppy Mattress');
$mail->AddAddress($address, '');
//$mail->AddAddress('techaveo@gmail.com', '');


$mail->Subject    = 'Order Delivered - Poppy Mattress';

$mail->MsgHTML($body);

@$mail->Send();
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
    

    As requested by you, Poppy’s team has processed your cancellation order. We have verified the details for the  <br><br>
    
    


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

  <td bgcolor="#F5F5F5" style="background-color:#f5f5f5;padding-top:0;padding-right:0;padding-left:0;padding-bottom:0">

    <div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;padding-left:20px;padding-right:20px">

      

<table bgcolor="#84226D" width="100%" align="center" border="0" cellspacing="0" cellpadding="0" style="font-family:sans-serif;color:#ffffff">

  <tbody><tr>

  <td dir="ltr" bgcolor="#84226D" align="left" style="padding-top:40px;padding-bottom:40px;padding-right:40px;padding-left:40px;text-align:left;background-color:#84226D">



    <p style="Margin-top:0px;Margin-bottom:0px;font-family:\'gdsherpa\',Helvetica,Arial,sans-serif;font-size:16px;line-height:26px">

    We are sad to see you go, but we hope that we will have the opportunity to serve you soon. We have processed for the refund, and it should reflect in your bank account in 3-5 Business days <br><br>

    If you are still looking out for another option, please let us know. We will help you choose the right sleep comfort for you. Share your feedback, if any.
Have a good sleep. <br><br>
  

  Thanks,<br>
Poppy’s Mattress <br>

    
    


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


$mail->Subject    = 'Order Cancelled - Poppy Mattress';

$mail->MsgHTML($body);

@$mail->Send();
  }


}
$objAdmin = new Admin();
?>