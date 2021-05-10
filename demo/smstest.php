<?php

$message='To reset your Poppy Account password enter your OTP : '.$_SESSION['otp'].' and have a great shopping experience at Poppy. ';

$apiKey = urlencode('335958AEcvLtgyxyS5f112ac4P1');
    
    // Message details
    $numbers = urlencode("9566330303");
    $sender = urlencode('POPPYS');
    $message = rawurlencode($message);
 
    // Prepare data for POST request
    $data = 'authkey=' . $apiKey . '&route=4&country=91&mobiles=' . $numbers . "&sender=" . $sender . "&message=" . $message;

    // Send the GET request with cURL
    $ch = curl_init('http://api.msg91.com/api/sendhttp.php?' . $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    print_r($response);
?>