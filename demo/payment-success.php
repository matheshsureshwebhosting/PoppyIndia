<?php include("lib/common.php");

// echo "<pre>";

// print_r($_REQUEST);

// print_r($_GET);

// print_r($_POST);

// exit;

if(isset($_REQUEST['razorpay_order_id']) && $razorpay_order_id==$_SESSION['order_token']) {
    $id=$_SESSION['order_id'];
	$order_total=0;
		foreach($_SESSION['items'] as $key=>$item){       

            $product_size=$objMain->getRow("select * from product_price where id=".$item['product_size']);
            $prodcut_price=$objMain->clean_text($item['price']);
            $order_total+=$item['qty']*$prodcut_price;

            $product=$objMain->getRow("select * from product where id=".$item['productid']);
            $category=$objMain->getRow("select * from category where id=".$product['category']);
            if($category['parent_id']!=0){
                $parent=$objMain->getRow("select * from category where id=".$category['parent_id']);
                $category_name=$parent['category_name']." / ".$category['category_name'];
            } else $category_name=$category['category_name'];
if($product['category']!=15){
if($item['product_type']=='normal'){            
            $product_size=$objMain->getRow("select * from product_price where id=".$item['product_size']);
            $prod_size=$product_size['size_name']." - ".$product_size['size_inch_w']." x ".$product_size['size_inch_b']." in | ".$product_size['size_mm_w']." x ".$product_size['size_mm_b']." mm  X ".$item['dimension'];
        } else if($item['product_type']=='custom'){
            $prod_size="Custom Size : ".$item['custom_length']." in X ".$item['custom_width']." in";
        }
} else $prod_size='';
//echo "insert into orders_items set order_id='".$id."', product_id='".$item['productid']."', cover_image='".$product['cover_image']."', category='".$category_name."', product_name='".$product['product_name']."', product_size='".$prod_size."', price='".$prodcut_price."', qty='".$item['qty']."', amount='".($item['qty']*$prodcut_price)."', product_type='".$item['product_type']."', custom_length='".$item['custom_length']."', custom_width='".$item['custom_width']."', product_height='".$item['dimension']."'<br<br>";

            $objMain->Query("insert into orders_items set order_id='".$id."', product_id='".$item['productid']."', cover_image='".$product['cover_image']."', category='".$category_name."', product_name='".$product['product_name']."', product_siez='".$prod_size."', price='".$prodcut_price."', qty='".$item['qty']."', amount='".($item['qty']*$prodcut_price)."', product_type='".$item['product_type']."', product_color='".$item['product_color']."', custom_length='".$item['custom_length']."', custom_width='".$item['custom_width']."', product_height='".$item['dimension']."'");

            $freebis=$objMain->getResults("select * from product_free where parent_id=".$product['id']);
            if(!empty($freebis)){
                foreach($freebis as $free){ 
                    $free_color='';

                     $prod=$objMain->getRow("select * from product where id=".$free['free_product_id']);

                	 $cat=$objMain->getRow("select * from category where id=".$prod['category']);
            		 $cat_name=$cat['category_name'];
//echo "insert into orders_items set order_id='".$id."', product_id='".$prod['id']."', cover_image='".$prod['cover_image']."', category='".$cat_name."', product_name='".$prod['product_name']."', product_size='', price='', qty='".$free['qty']*$item['qty']."', amount='0', product_type='free', custom_length='', custom_width='', product_height=''<br>";
                     if(isset($item['product_free_color']) && !empty($item['product_free_color'])){
                        $free_color=",product_color='".$item['product_free_color']."'";
                     }
                    $objMain->Query("insert into orders_items set order_id='".$id."', product_id='".$prod['id']."', cover_image='".$prod['cover_image']."', category='".$cat_name."', product_name='".$prod['product_name']."', product_size='', price='', qty='".$free['qty']*$item['qty']."', amount='0', product_type='free', custom_length='', custom_width='', product_height=''".$free_color);
                }
            }

        }
         
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
    
       	header("location:success.php?msg=placed&tracking_id=".ID_PREFIX.$id);
} else {
    	header("location:cart.php?msg=error");
}
?>