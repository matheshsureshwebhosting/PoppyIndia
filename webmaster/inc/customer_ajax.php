<?php require_once '../lib/connection.php'; require_once DIR_LIB.'functions.php'; extract($_REQUEST); ?>
<table class="table table-stripped">
	<?php $customer=$objMain->getRow("select * from customer where id=".$id);
	if(!empty($customer)) { ?>
	<tr>
		<td>Name</td>
		<td><?php echo $customer['cname']; ?></td>
	</tr>
	<tr>
		<td>Type</td>
		<td><?php echo $customer['customer_type']; ?></td>
	</tr>
	<tr>
		<td>Mobile No</td>
		<td><?php echo $customer['mobileno']; ?></td>
	</tr>
	<tr>
		<td>Address</td>
		<td><?php echo $customer['door_no'].",".$customer['building_name'].$customer['street_name']." ".$customer['landmark']." ".$customer['area_name']; ?></td>
	</tr>

<?php } ?>
</table>