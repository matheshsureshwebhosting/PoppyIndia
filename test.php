<?php include("lib/common.php"); /*

$objMain->Query("insert into coupon set coupon_code='ABCD', description='', discount_type='flat', discount_value='10', start_date='2021-01-01', expire_date='2021-01-08'"); */


$otpmsg='Hi! Welcome to Poppy Sleep World. Thank you for signing up with us. Your OTP is 1234 Enter the OTP and have a great shopping experience at Poppy.';
$apiKey = urlencode('335958AEcvLtgyxyS5f112ac4P1');
    
    // Message details
    $numbers = urlencode('9566330303');
    $sender = urlencode('POPPYM');
    $message = rawurlencode($otpmsg);
 
    // Prepare data for POST request
    $data = 'authkey=' . $apiKey . '&route=4&country=91&mobiles=' . $numbers . "&sender=" . $sender . "&message=" . $message;

    // Send the GET request with cURL
    $ch = curl_init('http://api.msg91.com/api/sendhttp.php?' . $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    
    print_r($response);
    
    echo "<br><br>";
    
    echo 'http://api.msg91.com/api/sendhttp.php?' . $data; 
    
 ?>

 <?php /* include("inc/footer_scripts.php"); ?>

 <script type="text/javascript">
     $.ajax({
url: 'https://poppyindia.com/lib/ajax.php',
type: 'post',
dataType: 'json',
data: {
type:"payment_success",razorpay_payment_id: '' , razorpay_order_id : 'order_H0WLgVJiYP2EnQ' ,razorpay_signature : '',
}, 
success: function (obj) {
    console.log("welcome");
    console.log("========"+obj);
    data = JSON.parse(JSON.stringify(obj));
  console.log("====="+data['status']+"=======");
  
}
});
 </script>

