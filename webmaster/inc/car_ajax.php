<?php require_once '../lib/connection.php'; require_once DIR_LIB.'functions.php'; extract($_REQUEST); ?>
<table class="table table-stripped">
	<?php
if($type=='selllead') { 
	$result=$objMain->getRow("select * from lead_sell where id=".$id);
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
		<td><?php echo $result['regno_code1']." ".$result['regno_code2']; ?></td>
	</tr>
<?php } } else if($type=='buylead') { 
	$result=$objMain->getRow("select * from lead_buy where id=".$id);
	if(!empty($result)) {
$maker=$objMain->getRow("select * from maker where id=".$result['maker']);
                                            $model=$objMain->getRow("select * from model where id=".$result['model']);
                                          $varient=$objMain->getResults("select * from varient where FIND_IN_SET (id,'".$result['varient']."')");
                                             
	 ?>
	<tr>
		<td>Car Model</td>
		<td><?php echo $maker['maker_name']."-".$model['model_name']."-";
		if(!empty($varient)) { foreach($varient as $vari) { echo $vari['varient_name']." / "; }}  ?></td>
	</tr>
	<tr>
		<td>Year</td>
		<td><?php echo $result['year_from']." - ".$result['year_to']; ?></td>
	</tr>
	<tr>
		<td>Exp Price</td>
		<td><?php echo $objMain->INR($result['price_from'])." - ".$objMain->INR($result['price_to']); ?></td>
	</tr>
	<tr>
		<td>Color</td>
		<td><?php echo $result['color']; ?></td>
	</tr>
	<tr>
		<td>KM</td>
		<td><?php echo $result['km']; ?></td>
	</tr>

	<tr>
		<td>Stretch Budget </td>
		<td><?php echo $objMain->INR($result['stretch_budget']); ?></td>
	</tr>
<?php } } else if($type=='car') { 
	$res=$objMain->getRow("select * from car where id=".$id);
	if(!empty($res)) {
	 ?>
<div class="container-fluid" style="width: 900px;">
                <!-- state start-->
                <div class="row">
                    <div class=" col-md-12">

                           <h4 class="mb-0" style="padding: 10px 20px;"><?php echo $objMain->BMV($res['maker'],$res['model'],$res['varient']); ?> <span style="font-size: 15px;">(<?php echo $res['regno_code1']." ".$res['regno_code2']; ?>)</span>
                    <span class="pull-right"><i class="fa fa-inr" style="font-size: 18px;"></i> <?php echo $objMain->INR($res['car_price']); ?></span>
                </h4>
                        
                            	
                                <table class="table">
                                    <tr>
                                        <td>Buy Date</td>
                                        <td class="bold"><?php echo date("d/m/Y",strtotime($res['buy_date'])); ?></td>
                                        <td>Model Year</td>
                                        <td class="bold"><?php echo $res['model_year']; ?></td>
                                        <td>Fuel Type</td>
                                        <td class="bold"><?php echo ucfirst($res['fuel']); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Color</td>
                                        <td class="bold"><?php echo ucfirst(strtolower($res['color'])); ?></td>
                                        <td>KM</td>
                                        <td class="bold"><?php echo $objMain->INR($res['km']); ?></td>
                                        <td>Gear</td>
                                        <td class="bold"><?php echo ucfirst($res['gear']); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Chassis No</td>
                                        <td class="bold"><?php echo strtoupper($res['chassis_no']); ?></td>
                                        <td>Engine No </td>
                                        <td class="bold"><?php echo strtoupper($res['engine_no']); ?></td>
                                        <td>Vehicle Type</td>
                                        <td class="bold"><?php $vtype=$objMain->getRow("select * from car_type where id=".$res['vehicle_type']); echo $vtype['type_name']; ?></td>

                                    </tr>
                                    <tr>
                                        <td>Insurance Type</td>
                                        <td class="bold"><?php echo strtoupper($res['insurance_type']); ?></td>
                                        <td>Insurance Expire</td>
                                        <td class="bold"><?php if($res['insurance_expire']!='0000-00-00') echo date("d-m-Y",strtotime($res['insurance_expire'])); ?></td>
                                        <td>&nbsp;</td>
                                        <td class="bold">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>Board</td>
                                        <td class="bold"><?php if($res['board']=='own') echo "Own Board"; else echo "T-Board";  ?></td>
                                        <td>Owner</td>
                                        <td class="bold"><?php echo $res['owner_type']; ?></td>
                                        <td>Status</td>
                                        <td class="bold"><?php if($res['status']=='pending') echo "<span class='btn btn-success btn-sm'>Available</span>"; else echo "<span class='btn btn-danger btn-sm'>Sold</span>"; ?> </td>
                                    </tr>
                                </table>
                                
                               
                                <table class="table">
                                <?php $carfeatures=$objMain->getResults("select * from carfeatures where car_id=".$id." order by feature_type");
                                if(!empty($carfeatures)) { 
                                    foreach($carfeatures as $carfeature){
                                        if($carfeature['feature_type']!=-1) {
$feature=$objMain->getRow("select * from features_master where id=".$carfeature['feature_type']);

                                     ?>
                                        <tr>
                                            <td><?php echo $feature['feature_type']; ?></td>
                                            <td><?php $feature_vals=$objMain->getResults("select * from features where FIND_IN_SET (id,'".$carfeature['features']."')");
                                            if(!empty($feature_vals)) { $i=0;
                                                foreach($feature_vals as $vals){
                                                    if($i>0) echo ", "; echo $vals['feature']; $i++;
                                                }
                                            }
                                            ?></td>
                                        </tr>
                                        <?php } else { ?>
                                            <tr>
                                                <td>AirBag</td>
                                                <td><?php echo $carfeature['features']; ?>
                                            </tr>
                                    <?php } }
                                } ?>

                                <tr>
                                    <td style="width: 167px;">Tools</td>
                                    <td style="text-align: left;">
                                        <?php $tools=$features=$objMain->getResults("select * from tools where FIND_IN_SET (id,'".$res['tools']."')");
                                        if(!empty($tools)){ $i=0;
                                            foreach($tools as $tool){
                                                if($i>0) echo ", "; echo $tool['type_name']; $i++;
                                            }
                                        } else echo "--"; ?>
                                    </td>
                                </tr>
                                </table>
                            
                        </div>
                    </div>
                </div>
            </div>
<?php } } ?>
