<?php require_once '../lib/connection.php'; require_once DIR_LIB.'functions.php'; extract($_REQUEST); ?>
<table class="table table-stripped">
	<?php
if($type=='selllead') { 
	$result=$objMain->getRow("select * from lead_buy where id=".$id);
	if(!empty($result)) {
$maker=$objMain->getRow("select * from maker where id=".$result['maker']);
                                            $model=$objMain->getRow("select * from model where id=".$result['model']);
                                           $varient=$objMain->getRow("select * from varient where id='".$result['varient']."'");
                                             
	 ?>
	<tr>
		<td>Car Model</td>
		<td><?php echo $maker['maker_name']."-".$model['model_name']."-".$varient['varient_name']; ?></td>
	</tr>
	<tr>
		<td>Year</td>
		<td><?php echo $result['model_year']; ?></td>
	</tr>
	<tr>
		<td>Exp Price</td>
		<td><?php echo $result['exp_price']; ?></td>
	</tr>
	<tr>
		<td>Ownership</td>
		<td><?php echo $result['owner_type']; ?></td>
	</tr>
	<tr>
		<td>Color</td>
		<td><?php echo $result['color']; ?></td>
	</tr>
	<tr>
		<td>Insurance</td>
		<td><?php echo date("Y M",strtotime($result['insurance_to'])); ?></td>
	</tr>
	<tr>
		<td>Fuel</td>
		<td><?php echo $result['fuel']; ?></td>
	</tr>
	<tr>
		<td>KM</td>
		<td><?php echo $result['km']; ?></td>
	</tr>
	<tr>
		<td>Reg No</td>
		<td><?php echo $result['regno']; ?></td>
	</tr>
<?php } }?>
</table>