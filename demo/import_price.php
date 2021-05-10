<?php require_once 'lib/common.php';
if(isset($_REQUEST['submit'])){
	 $row = 1;
$filename=$_FILES['file']['name'];
$target=$filename;
move_uploaded_file($_FILES['file']['tmp_name'],$target);
//For Make & Model

if (($handle = fopen($target, "r")) !== FALSE) { $i=0; $sno=0;
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) { $i++; 
    
    	
	$size_mm_w=trim($data[0]);
	$size_mm_b=trim($data[1]);
	$size_inch_w=trim($data[2]);
	$size_inch_b=trim($data[3]);
	$size_sqft=trim($data[4]);
	$product_price_6=trim($data[5]);
	//$product_price_8=trim($data[6]);
	//$product_price_10=trim($data[7]);

	if($size_inch_b<42) $size_name='Single';
	else if($size_inch_b<60) $size_name='Double';
	else if($size_inch_b<72) $size_name='Queen';
	else $size_name='King';

//echo "<br>insert into product_price set product_id=11, dimension=6, size_inch_w='".$size_inch_w."', size_inch_b='".$size_inch_b."', size_mm_w='".$size_mm_w."', size_mm_b='".$size_mm_b."', size_sqft='".$size_sqft."', size_name='".$size_name."', product_price='".$product_price_6."'";

	$objMain->Query("insert into product_price set product_id=27, dimension=5, size_inch_w='".$size_inch_w."', size_inch_b='".$size_inch_b."', size_mm_w='".$size_mm_w."', size_mm_b='".$size_mm_b."', size_sqft='".$size_sqft."', size_name='".$size_name."', product_price='".$product_price_6."'");
	//$objMain->Query("insert into product_price set product_id=25, dimension=6, size_inch_w='".$size_inch_w."', size_inch_b='".$size_inch_b."', size_mm_w='".$size_mm_w."', size_mm_b='".$size_mm_b."', size_sqft='".$size_sqft."', size_name='".$size_name."', product_price='".$product_price_8."'");
	//$objMain->Query("insert into product_price set product_id=16, dimension=10, size_inch_w='".$size_inch_w."', size_inch_b='".$size_inch_b."', size_mm_w='".$size_mm_w."', size_mm_b='".$size_mm_b."', size_sqft='".$size_sqft."', size_name='".$size_name."', product_price='".$product_price_10."'");


}} fclose($handle); echo "Done";   }
 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form method="post" action=""  enctype="multipart/form-data">
	<input type="file" name="file" id="file">
	<input type="submit" name="submit" id="submit" value="Submit">
</form>
</body>
</html>