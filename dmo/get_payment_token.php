<?php extract($_REQUEST); 
//Generation of REQUEST_SIGNATURE for a POST Request

$amount=10; $receipt='poppy_1';

// Get Payment Token

$url='https://api.razorpay.com/v1/orders';
$headers[]='Accept: */*';
$headers[]='Content-Type: application/json';

$data = '{"amount": 100,"currency": "INR","receipt": "Receipt no. 1","payment_capture": 1}';

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
echo "<pre>";
print_r($result);

echo $result['status'];

echo "==".$result['id']."==";



//print_r($result);

//echo "<pre>";
//echo "<br> Data : ".$data;
//echo "<br> Headers : ";
//print_r($headers);


if($result['id']!=null) $token=$result['id'];
else $token='0';

$data = array(
			'token_id' 			=>	$token,
		);
		
$result = array( 'res'=>$data);
echo json_encode($result );
?>