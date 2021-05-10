<?php
$module = @$_REQUEST['module'];
$action = @$_REQUEST['action'];
switch ($module) 
	{
	case 'admin':
		switch($action)
			{
			case 'slider':
			$do = @$_REQUEST['do'];
			$id = @$_REQUEST['id'];
			if($do=='add'){
				$objFeatures->AddSlider();
			} else if($do=='update'){
				$objFeatures->UpdateSlider($id);
			} else if($do=='delete'){
				$objFeatures->DeleteSlider($id);
			}
			break;
			case 'coupon':
			$do = @$_REQUEST['do'];
			$id = @$_REQUEST['id'];
			if($do=='add'){
				$objFeatures->AddCoupon();
			} else if($do=='update'){
				$objFeatures->UpdateCoupon($id);
			} else if($do=='delete'){
				$objFeatures->DeleteCoupon($id);
			}
			break;
			case 'miscellaneous':
			$do = @$_REQUEST['do'];
			$id = @$_REQUEST['id'];
			if($do=='update'){
				$objFeatures->UpdateMiscellaneous($id);
			}
			break;

			case 'products':
			$do = @$_REQUEST['do'];
			$id = @$_REQUEST['id'];
			if($do=='meta'){
				$objFeatures->UpdateMeta($id);
			}
			break;

			case 'page':
			$do = @$_REQUEST['do'];
			$id = @$_REQUEST['id'];
			if($do=='update'){
				$objFeatures->UpdatePage($id);
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