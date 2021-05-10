<?php include("lib/common.php"); session_start(); ?>
<html>
  <head>
<TITLE>Pay Now</title>
  </head>
  <body>
    <h2 style="font-family:'Palatino Linotype', 'Book Antiqua', Palatino, serif; font-size:80px; text-align:center; margin-top:100px;"><img src="http://poppyindia.com/demo/images/icons/poppy-logo.gif" style="max-width:300px;"></h2>
    <div style="margin-top:20px; text-align:center; font-size:26px;"><br>Loading Please Wait</div>
    <br/>
    
    <form method="POST" action="https://api.razorpay.com/v1/checkout/embedded" id="redirect">
  <input type="text" name="key_id" value="rzp_live_urMd6CrygUGJK6">
  <input type="text" name="order_id" value="<?php echo $_SESSION['order_token']; ?>">
  <input type="text" name="name" value="Poppy Mattress">
  <input type="text" name="description" value="A Wild Sheep Chase">
  <input type="text" name="image" value="http://poppyindia.com/demo/images/logo.png">
  <input type="text" name="prefill[name]" value="Navaneetha Krishnan">
  <input type="text" name="prefill[contact]" value="9566330303">
  <input type="text" name="prefill[email]" value="techaveo@gmail.com">
  <input type="text" name="notes[shipping address]" value="L-16, The Business Centre, 61 Wellfield Road, New Delhi - 110001">
  <input type="text" name="callback_url" value="https://www.poppyinida.com/demo/payment-success.php">
<input type="text" name="cancel_url" value="https://www.poppyinida.com/demo/payment-failure.php">
  <button>Submit</button>
</form>
    
  </body>
  <script language='javascript'>document.redirect.submit();</script>
</html>