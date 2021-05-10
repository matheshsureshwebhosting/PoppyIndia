<?php include("lib/common.php"); 
$order=$objMain->getRow("select * from orders where id=".$_SESSION['order_id']);
$address=$objMain->clean_text($order['address'].",".$order['city'].",".$order['state']."-".$order['pincode']);
$user=$objMain->getRow("select * from customers where id=".$_SESSION['userid']);
if($user['emailid']!='') $emailid=$user['emailid'];
else $emailid='techaveo@gmail.com';
?>
<?php include("inc/facebook_script.php"); ?>
<!--
<html>
  <head>
<TITLE>Pay Now</title>
  </head>
  <body>
    <h2 style="font-family:'Palatino Linotype', 'Book Antiqua', Palatino, serif; font-size:80px; text-align:center; margin-top:100px;"><img src="http://poppyindia.com/images/icons/poppy-logo.gif" style="max-width:300px;"></h2>
    <div style="margin-top:20px; text-align:center; font-size:26px;"><br>Loading Please Wait</div>
    <br/>
    
    <form method="POST" action="https://api.razorpay.com/v1/checkout/embedded" name="redirect" id="redirect">
  <input type="hidden" name="key_id" value="rzp_live_urMd6CrygUGJK6">
  <input type="hidden" name="order_id" value="<?php echo $_SESSION['order_token']; ?>">
  <input type="hidden" name="name" value="Poppy Mattress">
  <input type="hidden" name="description" value="Sleep Well to Live and Fully Awake!">
  <input type="hidden" name="image" value="http://poppyindia.com/images/logo.png">
  <input type="hidden" name="prefill[name]" value="">
  <input type="hidden" name="prefill[contact]" value="<?php echo $order['mobileno']; ?>">
  <input type="hidden" name="prefill[email]" value="<?php echo $emailid; ?>">
  <input type="hidden" name="notes[shipping address]" value="<?php echo $address; ?>">
  <input type="hidden" name="callback_url" value="https://www.poppyindia.com/payment-success.php">
<input type="hidden" name="cancel_url" value="https://www.poppyindia.com/payment-failure.php">
</form>
    
  </body>
  <script language='javascript'>document.redirect.submit();</script>
</html>
 -->
<html>
  <head>
<TITLE>Pay Now</title>
<script src="js/jquery.js"></script>
  </head>
  <body>
    <button id="rzp-button1">Pay</button>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
var options = {
    "key": "rzp_live_urMd6CrygUGJK6", // Enter the Key ID generated from the Dashboard
    "amount": "<?php echo $order['net_amount']*100; ?>", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
    "currency": "INR",
    "name": "Poppy Mattress",
    "description": "Sleep Well to Live and Fully Awake!",
    "image": "http://poppyindia.com/images/logo.png",
    "order_id": "<?php echo $_SESSION['order_token']; ?>", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
    "handler": function (response){
$.ajax({
url: 'https://poppyindia.com/demo/lib/ajax.php',
type: 'post',
dataType: 'json',
data: {
type:"payment_success",razorpay_payment_id: response.razorpay_payment_id , razorpay_order_id : response.razorpay_order_id ,razorpay_signature : response.razorpay_signature,
}, 
success: function (obj) {
  data = JSON.parse(JSON.stringify(obj));
  if(data['status']=='success')
  window.location.href = 'https://poppyindia.com/demo/success.php?msg=placed&tracking_id='+data['id'];
  else 
  window.location.href = 'https://poppyindia.com/demo/payment-failure.php';
}
});
},
    "prefill": {
        "name": "",
        "email": "<?php echo $emailid; ?>",
        "contact": "<?php echo $order['mobileno']; ?>"
    },
    "notes": {
        "address": "<?php echo $address; ?>"
    },
    "theme": {
        "color": "#84226D"
    },
    "modal": {
        "ondismiss": function(){
            window.location.replace("https://poppyindia.com/demo/payment-failure.php");
        }
    }
};
var rzp1 = new Razorpay(options);
rzp1.on('payment.failed', function (response){
    window.location.replace("https://poppyindia.com/demo/payment-failure.php?type="+response.error.description);
});
document.getElementById('rzp-button1').onclick = function(e){
    rzp1.open();
    e.preventDefault();
}
 $( document ).ready(function() {
    rzp1.open();
});

    function preventBack() { window.history.forward(); }  
    setTimeout("preventBack()", 0);  
    window.onunload = function () { null };  
</script>
  </body>
</html>