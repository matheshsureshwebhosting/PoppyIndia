<script src="js/jquery.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script src="js/owl.js"></script>
<script src="js/wow.js"></script>
<script src="js/validation.js"></script>
<script src="js/jquery.fancybox.js"></script>
<script src="js/appear.js"></script>
<script src="js/parallax.min.js"></script>
<script src="js/isotope.js"></script>
<script src="js/jquery-ui.js"></script>  
<script src="js/jquery.bootstrap-touchspin.js"></script> 
<!--toastr-->
    <script src="vendor/toastr-master/toastr.js"></script>
    <script src="vendor/toastr-master/toastr-init.js"></script>

<!-- main-js -->
<script src="js/script.js"></script>

<script type="text/javascript" src="vendor/slick/slick.min.js"></script>
<script src="vendor/bootstrap-select/js/bootstrap-select.min.js"></script>

 <!-- Sweet Alert-->
 <script src="vendor/sweetalert/sweetalert.min.js"></script>

<script type="text/javascript">
	function addtocart(productid){ var error=0;
		var dimension=$('input[name=size]:checked').val();
		var product_size=$("#product_size").val();
        var qty=$("#qty").val();
        var price=$("#product_amount").val();
        var custom_length=$("#length").val();
        var custom_width=$("#width").val();

        var size_type=$("#product_size_type").val();

            $("#length_error").hide(); 
            $("#width_error").hide(); 

if(size_type=='custom'){ 
        if(price==''){ 
    if(custom_length==""){
        $("#length_error").show();
    } else if(custom_length!=""){
        if(!(custom_length>=68 && custom_length<=78)) { error=1; $("#length_error").show(); }
    } 
    if(custom_width==""){
        $("#width_error").show();
    } else if(custom_width!=""){
        if(!(custom_width>=30 && custom_width<=72)) { error=1; $("#width_error").show(); }       
    }
            error=1;
        }
}

if(error==0){
		$.ajax({
            url: 'lib/ajax.php',
            type: 'post',
            data: { 'type' : 'addtocart', 'productid' : productid, 'dimension' : dimension, 'product_size' : product_size, 'qty' : qty, 'price' : price, 'custom_width' : custom_width, 'custom_length' : custom_length, 'product_type' : size_type},
                beforeSend: function(){
                },
            success: function(obj) { 
                    data = jQuery.parseJSON(obj);
                    //eval(data['alert']);
                    $("#cart_top").html(data['total_qty']);
                    $("#cart_bottom").html(data['total_qty']);
                    if(data['free_amount']==0)
                        eval(data['alert']);
                    else {
                        $("#freeamount").html(INR(data['free_amount']));
                        $('#myModal').modal();
                    }
                }
          });
	}
}

    function updatecart(productid, key, qty){
        var price=$("#product_price_"+key).val();
        $.ajax({
            url: 'lib/ajax.php',
            type: 'post',
            data: { 'type' : 'updatecart', 'productid' : productid, 'qty' : qty, 'prodkey' : key},
                beforeSend: function(){
                },
            success: function(obj) { 
                    data = jQuery.parseJSON(obj);
                    eval(data['alert']);
                    $("#cart_top").html(data['total_qty']);
                    $("#cart_bottom").html(data['total_qty']);
                    $("#sub_total").html('₹ '+data['total_price']);
                    $("#product_total_"+key).html('₹ '+data['price']);
                    $("#discount_value").html(INR(data['discount_amount']));
                    $("#net_amount").html(INR(data['net_amount']));
                    if(data['free_1']!=0) $("#free_1_"+key).val(data['free_1']);
                    if(data['free_2']!=0) $("#free_2_"+key).val(data['free_2']);
                    if(data['free_3']!=0) $("#free_3_"+key).val(data['free_3']);
                }
          });
    }

     function removecart(key){
        $.ajax({
            url: 'lib/ajax.php',
            type: 'post',
            data: { 'type' : 'removecart', 'key' : key},
                beforeSend: function(){
                },
            success: function(obj) { 
                    data = jQuery.parseJSON(obj);
                    eval(data['alert']);
                    $("#cart_top").html(data['total_qty']);
                    $("#cart_bottom").html(data['total_qty']);
                    $("#sub_total").html('₹ '+data['total_price']);
                    $("#product_"+key).hide();
                    $(".product_"+key).remove();
                    $("#discount_value").html(INR(data['discount_amount']));
                    $("#net_amount").html(INR(data['net_amount']));
                    if(data['total_price']==0) window.location.href='cart.php';
                }
          });
    }

     function couponvalidate(){
        var coupon=$("#coupon").val();
        $("#coupon_error").hide();
    if(coupon!=""){ 
        $.ajax({
            url: 'lib/ajax.php',
            type: 'post',
            data: { 'type' : 'validate_coupon', 'coupon' : coupon},
                beforeSend: function(){
                },
            success: function(obj) { 
                    data = jQuery.parseJSON(obj);
                    if(data['status']=='success'){
                        $("#coupon_det").show();
                        $("#net_det").show();
                        $("#coupon_code").html(coupon);
                        $("#discount_value").html(data['discount_value']);
                        $("#net_amount").html(data['net_amount']);
                        $("#coupon_error").show();
                        $("#coupon_error").html('<i class="fa fa-thumbs-up"></i> Coupon Applied Successfully');
                        $("#coupon_error").attr('class','text coupon-success');
                    } else {
                        $("#coupon_det").hide();
                        $("#net_det").hide();
                        $("#coupon_error").show();
                        $("#coupon_error").html('* Invalid Coupon Code');
                        $("#coupon_error").attr('class','text coupon-error');
                    }
                }
          });
    }
}

function INR(value){
    x=value.toString();
    var lastThree = x.substring(x.length-3);
    var otherNumbers = x.substring(0,x.length-3);
    if(otherNumbers != '')
        lastThree = ',' + lastThree;
    var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
    return res;
}

$(".image-checkbox").on("click", function (e) { 

  var $checkbox = $(this).find('input[type="radio"]');
  uncheckradio1(); 

  if ($(this).find('input[type="radio"]').is(':checked')) { 
   
    $(this).addClass('image-checkbox-checked');    
    $checkbox.prop("checked",true);
  } else { 
    $(this).addClass('image-checkbox-checked');    
    $checkbox.prop("checked",true);
  } 

  var size_type=$("#product_size_type").val();

  if(size_type=='normal')
  calculate();
    else
customprice();

  e.preventDefault();
});

function uncheckradio1(){ 
    $('.image-checkbox').removeClass('image-checkbox-checked');
}
<?php if(isset($product_id)) { ?>
function calculate(){ console.log("welcome");
    var size=$('input[name=size]:checked').val();
    //var size_value=$("#product_size").val();    
var size_value = $("#product_size option:selected").attr('data-count');
console.log("--Size Value --"+size_value+"---Size--"+size);
    var price=[];
  <?php $product_size=$objMain->getResults("select * from product_price where product_id=".$product_id." group by dimension");
if(!empty($product_size)){ $i=0;
    foreach($product_size as $psize){ $product_price='price['.$psize['dimension'].']=[0'; 
        $prices=$objMain->getResults("select * from product_price where product_id=".$product_id." and dimension=".$psize['dimension']);
if(!empty($prices)){ $i=0;
    foreach($prices as $price){ $product_price=$product_price.',"'.$objMain->INR($price['product_price']).'"'; }
}
$product_price.='];'; 
echo $product_price;
}} 
    ?>  
    
    $("#product_price").html(price[size][size_value]);
    $("#product_amount").val(price[size][size_value])
}

$('.my-select').selectpicker();

function customprice(){
    $("#length_error").hide();
    $("#width_error").hide();


    $("#product_price").html('');
    $("#product_amount").val('');

    var length_selected=0;
    var width_selected=0;
    var size=$('input[name=size]:checked').val();
    var size_price=0;
    var sqft=0;

    var error=0;
    var length_sizes=[];
    <?php $product_size=$objMain->getResults("select * from product_price where product_id=".$product_id." group by size_inch_w");
        if(!empty($product_size)){ $i=0; $length_sizes='length_sizes=[0';
            foreach($product_size as $psize){  
                $length_sizes=$length_sizes.','.$psize['size_inch_w'];       
        }
        $length_sizes.='];'; 
        echo $length_sizes;
    } 
    ?> 

    var width_sizes=[];
    <?php $product_size=$objMain->getResults("select * from product_price where product_id=".$product_id." group by size_inch_b");
        if(!empty($product_size)){ $i=0; $width_sizes='width_sizes=[0';
            foreach($product_size as $psize){  
                $width_sizes=$width_sizes.','.$psize['size_inch_b'];       
        }
        $width_sizes.='];'; 
        echo $width_sizes;
    } 
    ?> 

     var price=[]; 

    <?php 
 if($product_id==29 || $product_id==30 || $product_id==31) {
    $product_size=$objMain->getResults("select * from product_price where product_id=".$product_id." group by dimension");
if(!empty($product_size)){ $i=0;
    foreach($product_size as $psize){ $product_price='price['.$psize['dimension'].']=[0'; 
        $prices=$objMain->getResults("select * from product_price where product_id=".$product_id." and dimension=".$psize['dimension']);
if(!empty($prices)){ $i=0;
    foreach($prices as $price){ $product_price=$product_price.',"'.$objMain->INR($price['product_price']).'"'; }
}
$product_price.='];'; 
echo $product_price;
}} 
} else {
    $product_size=$objMain->getResults("select * from product_dimension where product_id='".$product_id."'");
    if(!empty($product_size)){ $i=0; $product_price='';
        foreach($product_size as $psize) { 
            $product_price.='price['.$psize['dimension'].']='.$psize['sqft_rate'].';'; 
        }
        echo $product_price;
    } }
    ?>  

    size_price=price[size];

    var length=$("#length").val();
    var width=$("#width").val();
    if(length!=""){
        if(!(length>=68 && length<=78)) { error=1; $("#length_error").show(); }
    } 
    if(width!=""){
        if(!(width>=30 && width<=72)) { error=1; $("#width_error").show(); }       
    }

    console.log(length+"=="+width);

    if(error==0 && length!="" && width!=""){
        // Length Calc
        for(var i=1;i<length_sizes.length;i++){
            if(parseInt(length_sizes[i])>=parseInt(length)) {
                length_selected=length_sizes[i];
                break;
            }
        }

        if(length_selected==0) length_selected=length;

         // Width Calc
        for(var i=1;i<width_sizes.length;i++){
            if(parseInt(width_sizes[i])>=parseInt(width)) {
                width_selected=width_sizes[i];
                break;
            }
        }

        if(width_selected==0) width_selected=length;

        <?php if($product_id==29 || $product_id==30 || $product_id==31) { ?>

        console.log("Price Size 1 : "+price[size][1]);


        if(length_selected<=72 && width_selected<=36) { console.log("====1===");  pricev=price[size][1];  }
        else if(length_selected<=72 && width_selected<=48) { console.log("====2===");  pricev=price[size][2]; }
        else if(length_selected<=72 && width_selected<=60) { console.log("====2===");  pricev=price[size][3]; }
        else if(length_selected<=72 && width_selected<=72) { console.log("====2===");  pricev=price[size][4]; }
        else if(length_selected<=75 && width_selected<=36) { console.log("====2===");  pricev=price[size][5]; }
        else if(length_selected<=75 && width_selected<=48) { console.log("====2===");  pricev=price[size][6]; }
        else if(length_selected<=75 && width_selected<=60) { console.log("====2===");  pricev=price[size][7]; }
        else if(length_selected<=75 && width_selected<=72) { console.log("====2===");  pricev=price[size][8]; }
        else if(length_selected<=78 && width_selected<=36) { console.log("====2===");  pricev=price[size][9]; }
        else if(length_selected<=78 && width_selected<=48) { console.log("====2===");  pricev=price[size][10]; }
        else if(length_selected<=78 && width_selected<=60) { console.log("====3===");  pricev=price[size][11]; }
        else { console.log("====4===");  pricev=price[size][12]; }

        var price=pricev;

        $("#product_price").html(price);
        $("#product_amount").val(price);

        <?php } else { ?>        

        var sqft=parseFloat((parseInt(length_selected)*parseInt(width_selected))/144);

        var price=parseInt(parseFloat(sqft)*parseInt(size_price));

        $("#product_price").html(INR(price));
    $("#product_amount").val(price);

        <?php } ?>

        

        console.log("=== L : "+length_selected+"===");

        console.log("=== L : "+width_selected+"===");

        console.log("=== Size Price : "+size_price+"===");

        console.log("=== SQFT : "+sqft+"===");

        console.log("=== Price : "+INR(price)+"===");

    }
}

<?php } ?>

$('.sizes').on('keypress', function(e){
  return e.metaKey || // cmd/ctrl
    e.which <= 0 || // arrow keys
    e.which == 8 || // delete key
    /[0-9]/.test(String.fromCharCode(e.which)); // numbers
})

function showcustomsize(){
    $("#normal_sizes").hide();
    $("#custom_sizes").show();
    $("#product_size_type").val('custom');
    $("#product_price").html('');
    $("#product_amount").val('');
}

function shownormalsize(){
    $("#normal_sizes").show();
    $("#custom_sizes").hide();
    $("#product_size_type").val('normal');
    calculate();

}

function subscribe(){ 
    
                        toastr.success("Thanks for your subscription","");
    var subs_value=$("#subs_value").val();
    var mobileno='';
    var emailid='';
    var re = /\S+@\S+\.\S+/;
    var error=0;
    
    if(subs_value==''){ error=1;
        $("#subs_error").html('* Enter your details');
        $("#subs_error").show();
    } else {

    if(subs_value.match(/^\d+/)){
        if(subs_value.length>0 && subs_value.length!=10) { error=1; user=1; console.log("Mobile");
            $("#subs_error").html('* Enter valid 10 Digit Mobile No');
            $("#subs_error").show();
        } else {
            mobileno=subs_value;
            emailid='';
        }
    } else { 

        if(subs_value!="" && !re.test(subs_value)){  user=1; error=1; console.log("Email");
            $("#subs_error").html('* Enter Valid Email ID');
            $("#subs_error").show();
        } else {
            emailid=subs_value;
            mobileno='';
        }
}
}

 if(error==0){ 
        $.ajax({
            url: 'lib/ajax.php',
            type: 'post',
            data: { 'type' : 'subscription', 'mobileno' : mobileno, 'emailid' : emailid},
                beforeSend: function(){
                },
            success: function(obj) { 
                    data = jQuery.parseJSON(obj);
                    if(data['status']=='success'){
                        $("#subs_error").html('Subscribed Successfully!!!');
                        $("#subs_error").show(); 
                        $("#subs_value").val('');                       
                        toastr.success("Thanks for your subscription","");
                    } else {
                        $("#subs_error").html('You Already Subscribed with Us');
                        $("#subs_error").show();
                    }
                }
          });
    }

}
</script>