<?php
$module = @$_REQUEST['module'];
$action = @$_REQUEST['action'];
switch ($module) 
	{
	case 'user':
		switch($action)
			{
			case 'addcar':
				$objFeatures->AddCar();
			break;
			case 'updatecar':
			$do = @$_REQUEST['do'];
			$id = @$_REQUEST['id'];
				$objFeatures->UpdateCar($id);
			break;
			case 'deletecar':
			$do = @$_REQUEST['do'];
			$id = @$_REQUEST['id'];
				$objFeatures->DeleteCar($id);
			break;

			case 'instant-addcar':
				$objFeatures->AddInstantCar();
			break;

			case 'myaccount':
			$do = @$_REQUEST['do'];
			$id = @$_REQUEST['id'];
			if($do == 'update'){
				$objFeatures->UpdateAccount();
			} else if($do=='otp'){
				$objFeatures->OTPCheck();
			}
			break;

			case 'car':
			$do = @$_REQUEST['do'];
			$id = @$_REQUEST['id'];
			if($do == 'add'){
				$objFeatures->AddCar();
			}
			break;

			case 'enquiry':			
			$do = @$_REQUEST['do'];
			$id = @$_REQUEST['id'];
			if($do == 'delete'){
				$objFeatures->DeleteEnquiry($id);
			}
			break;

			case 'buylead':
			$do = @$_REQUEST['do'];
			$id = @$_REQUEST['id'];
			if($do == 'add'){
				$objFeatures->AddBuyLead($id);
			} else if($do == 'update'){
				$objFeatures->UpdateBuyLead();
			} else if($do == 'delete'){
				$objFeatures->DeleteBuyLead($id);
			} else if($do == 'followup'){
				$objFeatures->AddFollowup($id);
			} 
			break;
			
			case 'changepassword':
			$do = @$_REQUEST['do'];
			$id = @$_REQUEST['id'];
			if($do == 'update'){
				$objFeatures->UpdatePassword();
			} 
			break;
		}
	}
?>