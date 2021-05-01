<?php
require_once "lib/functions.php";
global $objFeatures;
class Features extends Main
{
	public function UpdatePassword(){
		extract($_REQUEST);
		$res=$this->getRow("select * from pu_admin where username='".$username."' and userpassword='".md5($olduserpassword)."'");
		if(!empty($res)){
			$this->Query("update pu_admin set username='".$username."',userpassword='".md5($userpassword)."' where admin_id=".$_SESSION['admin_id']);
			session_destroy();
			$this->redirectUrl("index.php?logout");
		}
		else $this->redirectUrl("change_password.php?msg=invalid");
	}

	public function ChangePasswordUsers($id){
		extract($_REQUEST);
		$this->Query("update pu_admin set userpassword='".md5($userpassword)."' where admin_id=".$id);
		header("location:users.php?msg=pass");
	}
	
	// Instant car
	public function AddInstantCar(){ extract($_REQUEST);
		$model_year=$this->clean('model_year');
		$maker=$this->clean('maker');
		$model=$this->clean('model');
		$varient=$this->clean('varient');
		$selling_price=$this->clean_amount('selling_price');
		$km=$this->clean_amount('km');
		$regno_code1=$this->clean('regno_code1');
		$regno_code2=$this->clean('regno_code2');
		$regno_code3=$this->clean('regno_code3');
		$fuel=$this->clean('fuel');
		$vehicle_type=$this->clean('vehicle_type');
		$gear=$this->clean('gear');
		$owner_type=$this->clean('owner_type');
		$insurance_type=$this->clean('insurance_type');
		$insurance_expire=date("Y-m-d",strtotime($insurance_expire));
		$board=$this->clean('board');
		$description=$this->clean('description');

		$cname=$this->clean('username');
		$mobileno=$this->clean('mobileno');
		$emailid=$this->clean('emailid');
		$res=$this->getRow("select * from customer where mobileno='".$mobileno."'");
		if(!empty($res)){
			$parent_id=$res['id'];
		} else {
			$this->Query("insert into customer set cname='".$cname."', mobileno='".$mobileno."', emailid='".$emailid."', customer_type='customer', join_date='".date("Y-m-d H:i:s")."', last_visited='".date("Y-m-d H:i:s")."', userpassword='".md5($userpassword)."'");
			$parent_id=$this->insertID();
		}
$qry="";

		$destinationpath=DIR_CAR;
		if(isset($_FILES['cover_photo']) && $_FILES['cover_photo']['name']!=""){
				$rnd=rand(999,10000);
				$image_path =$rnd."_".basename($_FILES['cover_photo']['name']);
				$targetpath=$destinationpath.$rnd."_".basename($_FILES['cover_photo']['name']);
				$res=move_uploaded_file($_FILES['cover_photo']['tmp_name'],$targetpath);			
				$qry.=",image_path='".$image_path."'";
		}


		$sqry="insert into car set  customer_type='customer', customer='".$parent_id."', model_year='".$model_year."',maker='".$maker."', model='".$model."', varient='".$varient."',  gear='".$gear."', fuel='".$fuel."', posted_date='".date("Y-m-d H:i:s")."', km='".$km."', regno_code1='".$regno_code1."', regno_code2='".$regno_code2."', regno_code3='".$regno_code3."', selling_price='".$selling_price."', insurance_expire='".$insurance_expire."', insurance_type='".$insurance_type."', owner_type='".$owner_type."', board='".$board."', vehicle_type='".$vehicle_type."', description='".$description."', posted_type='instant', status='instant' ".$qry;

		$this->Query($sqry); 
		$id=$this->insertID();

			$count=0;
	if(isset($_FILES['image_path'])) {
	foreach ($_FILES['image_path']['name'] as $filename) 
            {
			 if($filename!="")
			 {
				$rnd=rand(999,10000);
				$image_path =$rnd."_".basename($_FILES['image_path']['name'][$count]);
				$tmp=$_FILES['image_path']['tmp_name'][$count];
				$targetpath=$destinationpath.$image_path;
				move_uploaded_file($tmp,$targetpath);
				$this->Query("insert into carimages set parent_id=".$id.",image_path='".$image_path."'");
				$rid=$this->insertID();
				$count++;
			 }
            }
}
		header("location:instant-sell-car.php?msg=success");
	}


	// Car
	public function AddCar(){ extract($_REQUEST);
		$model_year=$this->clean('model_year');
		$maker=$this->clean('maker');
		$model=$this->clean('model');
		$varient=$this->clean('varient');
		$fuel=$this->clean('fuel');
		$posted_date=date("Y-m-d H:i:s");
		$color=$this->clean('color');
		$km=$this->clean_amount('km');
		$regno_code1=$this->clean('regno_code1');
		$regno_code2=$this->clean('regno_code2');
		$regno_code3=strtoupper($this->clean('regno_code3'));
		$regno_code4=$this->clean('regno_code4');
		$insurance_expire=date("Y-m-d",strtotime($insurance_expire));
		$insurance_type=$this->clean('insurance_type');
		$selling_price=$this->clean_amount('selling_price');
		$owner_type=$this->clean('owner_type');
		$board=$this->clean('board');
		$vehicle_type=$this->clean('vehicle_type');
		$gear=$this->clean('gear');
		$sell_priority=$this->clean('sell_priority');
		$description=$this->clean('description');

		$new_maker=""; $new_model=""; $new_varient="";

if(isset($new_maker)) $new_maker=$this->clean('new_maker');
if(isset($new_model)) $new_model=$this->clean('new_model');
if(isset($new_varient)) $new_varient=$this->clean('new_varient');

$qry="";
		if($board=='t'){
			$fc_date=date("Y-m-d",strtotime($fc_date));
			$tax_date=date("Y-m-d",strtotime($tax_date));
			$permit=$this->clean_amount('permit');
			$qry=", fc_date='".$fc_date."',  tax_date='".$tax_date."',  permit='".$permit."'";
		}

		$destinationpath=DIR_CAR;
		if($_FILES['image_path']['name']!=""){
				$rnd=rand(999,10000);
				$image_path =$rnd."_".basename($_FILES['image_path']['name']);
				$targetpath=$destinationpath.$rnd."_".basename($_FILES['image_path']['name']);
				$res=move_uploaded_file($_FILES['image_path']['tmp_name'],$targetpath);	
				
				$this->ResizeImage($targetpath,$targetpath,1200,900);
				$savepath=$destinationpath."thumbnail_".$image_path; 
				$this->ResizeImage($targetpath,$savepath,322,242);	
				$qry.=",image_path='".$image_path."'";

		}
		$sqry="insert into car set  customer_type='dealer',customer='".$_SESSION['userid']."',model_year='".$model_year."',maker='".$maker."', model='".$model."', varient='".$varient."',  gear='".$gear."', fuel='".$fuel."', posted_date='".date("Y-m-d H:i:s")."',  color='".$color."', km='".$km."', regno_code1='".$regno_code1."', regno_code2='".$regno_code2."', regno_code3='".$regno_code3."', regno_code4='".$regno_code4."', selling_price='".$selling_price."',  insurance_expire='".$insurance_expire."', insurance_type='".$insurance_type."', owner_type='".$owner_type."', board='".$board."', vehicle_type='".$vehicle_type."', description='".$description."', sell_priority='".$sell_priority."', status='available', date_updated='".date("Y-m-d H:i:s")."', reposted_date='".date("Y-m-d H:i:s")."' ".$qry;

		$this->Query($sqry); 
		$id=$this->insertID();

		if($qry!="") {
			$this->Query("insert into carimages set parent_id=".$id.", sort_order=1 ".$qry);
		}

		if($new_maker!="" || $new_model!="" || $new_varient!=""){
			$this->Query("insert into bmv_new set carid=".$id.", maker='".$new_maker."', model='".$new_model."', varient='".$new_varient."'");
		}

		header("location:car_images.php?id=".$id);
	}

	public function UpdateCar($id){ extract($_REQUEST);
		$model_year=$this->clean('model_year');
		$maker=$this->clean('maker');
		$model=$this->clean('model');
		$varient=$this->clean('varient');
		$fuel=$this->clean('fuel');
		$posted_date=date("Y-m-d H:i:s");
		$color=$this->clean('color');
		$km=$this->clean_amount('km');
		$regno_code1=$this->clean('regno_code1');
		$regno_code2=$this->clean('regno_code2');
		$regno_code3=strtoupper($this->clean('regno_code3'));
		$regno_code4=$this->clean('regno_code4');
		$insurance_expire=date("Y-m-d",strtotime($insurance_expire));
		$insurance_type=$this->clean('insurance_type');
		$selling_price=$this->clean_amount('selling_price');
		$owner_type=$this->clean('owner_type');
		$board=$this->clean('board');
		$vehicle_type=$this->clean('vehicle_type');
		$gear=$this->clean('gear');
		$sell_priority=$this->clean('sell_priority');
		$description=$this->clean('description');

		$new_maker=""; $new_model=""; $new_varient="";

if(isset($new_maker)) $new_maker=$this->clean('new_maker');
if(isset($new_model)) $new_model=$this->clean('new_model');
if(isset($new_varient)) $new_varient=$this->clean('new_varient');

$qry="";
		if($board=='t'){
			$fc_date=date("Y-m-d",strtotime($fc_date));
			$tax_date=date("Y-m-d",strtotime($tax_date));
			$permit=$this->clean_amount('permit');
			$qry=", fc_date='".$fc_date."',  tax_date='".$tax_date."',  permit='".$permit."'";
		}
		$destinationpath=DIR_CAR;
		if($_FILES['image_path']['name']!=""){
				$rnd=rand(999,10000);
				$image_path =$rnd."_".basename($_FILES['image_path']['name']);
				$targetpath=$destinationpath.$rnd."_".basename($_FILES['image_path']['name']);
				$res=move_uploaded_file($_FILES['image_path']['tmp_name'],$targetpath);	
				
				$this->ResizeImage($targetpath,$targetpath,1200,900);
				$savepath=$destinationpath."thumbnail_".$image_path; 
				$this->ResizeImage($targetpath,$savepath,322,242);	
				$qry.=",image_path='".$image_path."'";
		}
		$sqry="update car set model_year='".$model_year."',maker='".$maker."', model='".$model."', varient='".$varient."',  gear='".$gear."', fuel='".$fuel."', date_updated='".date("Y-m-d H:i:s")."',  color='".$color."', km='".$km."', regno_code1='".$regno_code1."', regno_code2='".$regno_code2."', regno_code3='".$regno_code3."',  regno_code4='".$regno_code4."', selling_price='".$selling_price."',  insurance_expire='".$insurance_expire."', insurance_type='".$insurance_type."', owner_type='".$owner_type."', board='".$board."', vehicle_type='".$vehicle_type."', description='".$description."', sell_priority='".$sell_priority."'".$qry." where id=".$id;

		$this->Query($sqry); 
		$this->RecordLog('car','car',$id,'update');

		if($new_maker!="" || $new_model!="" || $new_varient!=""){
			$this->Query("update bmv_new set maker='".$new_maker."', model='".$new_model."', varient='".$new_varient."' where carid=".$id);
		}

		header("location:sell-cars.php?msg=upd");

	}

	public function DeleteCar($id) { extract($_REQUEST);
		$res=$this->getRow("update car set status='deleted' where id=".$id);
		header("location:sell-cars.php?msg=del");
	}
	public function UpdateImages($id){ extract($_REQUEST);
		$destinationpath=DIR_CAR;
		$count=0;
	foreach ($_FILES['image_path']['name'] as $filename) 
            {
			 if($filename!="")
			 {
				$rnd=rand(999,10000);
				$image_path =$rnd."_".basename($_FILES['image_path']['name'][$count]);
				$tmp=$_FILES['image_path']['tmp_name'][$count];
				$targetpath=$destinationpath.$image_path;
				move_uploaded_file($tmp,$targetpath);
				$this->Query("insert into carimages set parent_id=".$id.",image_path='".$image_path."'");
				echo "insert into carimages set parent_id=".$id.",image_path='".$image_path."'";
				$rid=$this->insertID();
		$this->RecordLog('carimages','carimages',$rid,'add');
				$count++;
			 }
            }
	}

	function DeleteImages($id){
		$res=$this->getRow("select * from carimages where id=".$id);
		$this->Query("delete from carimages where id=".$id);
		unlink(DIR_CAR.$res['image_path']);
		header("location:buy_car_images.php?id=".$res['parent_id']);
	}

	// Buy Lead
	public function AddBuyLead($id){ extract($_REQUEST);
		$maker=$this->clean('maker');
		$model=$this->clean('model');
		if(isset($varient)) $varient=implode(",",$varient);
		else $varient="";
		
		$year_from=$this->clean('year_from');
		$year_to=$this->clean('year_to');
		$km=$this->clean_amount('km');
		$color=$this->clean('color');
		$price_from=$this->clean_amount('price_from');
		$price_to=$this->clean_amount('price_to');
		$description=$this->clean('description');
		$finance_required=$this->clean('finance_required');
		
		$puchase_plan=$this->clean('puchase_plan');
		
		if(isset($fuel)){	$fuel=implode(",", $fuel);}
		if(isset($gear)){	$gear=implode(",", $gear);}
		if(isset($vehicle_type)){	$vehicle_type=implode(",", $vehicle_type);}
		if(isset($board)){	$board=implode(",", $board);}

		$this->Query("insert into lead_buy set  lead_date='".date("Y-m-d")."', parent_id='".$_SESSION['userid']."', maker='".$maker."', model='".$model."', varient='".$varient."', year_from='".$year_from."', year_to='".$year_to."', km='".$km."', color='".$color."', price_from='".$price_from."', price_to='".$price_to."', lead_type='".$lead_type."', description='".$description."', finance_required='".$finance_required."', fuel='".$fuel."',   gear='".$gear."',  vehicle_type='".$vehicle_type."',  board='".$board."', puchase_plan='".$puchase_plan."', posted_by='".$_SESSION['userid']."', posted_date='".date("Y-m-d H:i:s")."'");
		header("location:buy_lead.php?msg=success");	
	}
	public function UpdateBuyLead(){ extract($_REQUEST);
		
		$maker=$this->clean('maker');
		$model=$this->clean('model');
		
		if(isset($varient)) $varient=implode(",",$varient);
		else $varient="";
		
		$year_from=$this->clean('year_from');
		$year_to=$this->clean('year_to');
		$km=$this->clean_amount('km');
		$color=$this->clean('color');
		$price_from=$this->clean_amount('price_from');
		$price_to=$this->clean_amount('price_to');
		$lead_type=$this->clean('lead_type');
		$description=$this->clean('description');
		$stretch_budget=$this->clean_amount('stretch_budget');
		$finance_required=$this->clean('finance_required');
		$puchase_plan=$this->clean('puchase_plan');

		if(isset($fuel)){	$fuel=implode(",", $fuel);}
		if(isset($gear)){	$gear=implode(",", $gear);}
		if(isset($vehicle_type)){	$vehicle_type=implode(",", $vehicle_type);}
		if(isset($board)){	$board=implode(",", $board);}

		$this->Query("update lead_buy set   maker='".$maker."', model='".$model."', varient='".$varient."', year_from='".$year_from."', year_to='".$year_to."', km='".$km."', color='".$color."', price_from='".$price_from."', price_to='".$price_to."', lead_type='".$lead_type."', description='".$description."', stretch_budget='".$stretch_budget."', finance_required='".$finance_required."',  fuel='".$fuel."',   gear='".$gear."',  vehicle_type='".$vehicle_type."',  board='".$board."', puchase_plan='".$puchase_plan."' where parent_id=".$_SESSION['userid']);
		$this->RecordLog('lead_buy','lead_buy',$id,'update');
		$res=$this->getRow("select * from lead_buy where id=".$id);
		header("location:buy_lead.php?msg=success");
	}

	public function UpdateAccount(){ extract($_REQUEST);
		
		$cname=$this->clean('cname');
		$mobileno=$this->clean('mobileno');
		$mobileno1=$this->clean('mobileno1');
		$emailid=$this->clean('emailid');
		$emailid1=$this->clean('emailid1');
		$whatsappno=$this->clean('whatsappno');
		$door_no=$this->clean('door_no');
		$building_name=$this->clean('building_name');
		$street_name=$this->clean('street_name');
		$landmark=$this->clean('landmark');
		$area_name=$this->clean('area_name');

		$pan_no=$this->clean('pan_no');
		$aadhar_no=$this->clean('aadhar_no');
		$state=$this->clean('state');
		$district=$this->clean('district');
		$city=$this->clean('city');
		$postcode=$this->clean('postcode');	

		$destinationpath=DIR_CUSTOMER; $qry=""; 
		if($_FILES['image_path']['name']!=""){ 
				$rnd=rand(999,10000);
				$image_path =$rnd."_".basename($_FILES['image_path']['name']);
				$targetpath=$destinationpath.$rnd."_".basename($_FILES['image_path']['name']);
				$res=move_uploaded_file($_FILES['image_path']['tmp_name'],$targetpath);	
				$this->ResizeImage($targetpath,$targetpath,200,200);
				$qry.=",photo='".$image_path."'";
				$_SESSION['user_photo']=HTTP_CUSTOMER.$image_path;
		}
		$this->Query("update customer set cname='".$cname."', emailid='".$emailid."', emailid1='".$emailid1."', whatsappno='".$whatsappno."', door_no='".$door_no."', building_name='".$building_name."', street_name='".$street_name."', landmark='".$landmark."', area_name='".$area_name."', state='".$state."', district='".$district."', city='".$city."', postcode='".$postcode."', pan_no='".$pan_no."', aadhar_no='".$aadhar_no."'".$qry." where id=".$_SESSION['userid']);

		$usr=$this->getRow("select mobileno from customer where id=".$_SESSION['userid']);
		if($usr['mobileno']!=$mobileno) { 
			$_SESSION['new_mobile']=$mobileno;
			$this->Query("update customer set otp='0000' where id=".$_SESSION['userid']);
			header("location:my-account-otp.php?msg=success"); exit;
		} else
		header("location:my-account.php?msg=success");

	}
	public function DeleteEnquiry($id){ extract($_REQUEST);
		$this->Query("update enquiry set status='deleted' where id=".$id);
		$this->Query("update enquiry_followup set status='deleted' where enquiry_id=".$id);
		header("location:buy_enquires.php?msg=del");

	}
	public function OTPCheck(){ extract($_REQUEST);
		$res=$this->getRow("select id from customer where otp='".$otp."' and id=".$_SESSION['userid']);
		if(!empty($res)){
			$this->Query("update customer set mobileno='".$_SESSION['new_mobile']."' where id=".$_SESSION['userid']);
			header("location:my-account.php?msg=otpsuccess"); exit;
		} else header("location:my-account-otp.php?msg=otpfailure");
	}
}
$objFeatures = new Features();
?>