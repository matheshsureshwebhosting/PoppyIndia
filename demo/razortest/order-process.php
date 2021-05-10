<?php include("lib/common.php"); session_start();
$order=$objMain->getRow("select * from orders where id=".$_SESSION['order_id']);
$address=$order['address'].",".$order['city'].",".$order['state']."-".$order['pincode'];
$user=$objMain->getRow("select * from customers where id=".$_SESSION['userid']);
if($user['emailid']!='') $emailid=$user['emailid'];
else $emailid='techaveo@gmail.com';
?>
<html>
  <head>
<TITLE>Pay Now</title>
<?php include("inc/facebook_script.php"); ?>
  </head>
  <body>
    <h2 style="font-family:'Palatino Linotype', 'Book Antiqua', Palatino, serif; font-size:80px; text-align:center; margin-top:100px;"><img src="http://poppyindia.com/images/icons/poppy-logo.gif" style="max-width:300px;"></h2>
    <div style="margin-top:20px; text-align:center; font-size:26px;"><br>Loading Please Wait</div>
    <br/>
    
    <form action="https://localhost/poppy/payment-success.php" method="POST"> // Replace this with your website's success callback URL
<script
    src="https://checkout.razorpay.com/v1/checkout.js"
    data-key="rzp_live_urMd6CrygUGJK6" // Enter the Key ID generated from the Dashboard
    data-amount="<?php echo $_SESSION['sub_total']*100; ?>" // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
    data-currency="INR"
    data-order_id="<?php echo $_SESSION['order_token']; ?>"//This is a sample Order ID. Pass the `id` obtained in the response of the previous step.
    data-buttontext="Pay with Razorpay"
    data-name="Poppy Mattress"
    data-description="Sleep Well to Live and Fully Awake!"
    data-image="http://poppyindia.com/images/logo.png"
    data-prefill.name="Krishnan"
    data-prefill.email="<?php echo $emailid; ?>"
    data-prefill.contact="<?php echo $order['mobileno']; ?>"
    data-theme.color="#84226D"
></script>
<input type="hidden" custom="Hidden Element" name="hidden">
</form>
    
  </body>
  <script language='javascript'>document.redirect.submit();</script>
</html>

