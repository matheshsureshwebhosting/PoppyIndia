<?php  
require_once 'lib/common.php'; 
$module = @$_REQUEST['module'];
$action = @$_REQUEST['action'];
switch ($module) {

	case 'user': 
	switch ($action) {
		case 'validate': 
			$objAdmin->checkLogin();	
		break;
		case 'forgot': 
			$objAdmin->forgotpassword();	
		break;
		case 'changepassword': 
			$objAdmin->changepassword();	
		break;
		case 'resetpassword': 
			$objAdmin->resetPassword();	
		break;
		case 'myprofile': 
			$objAdmin->UpdateProfile();	
		break;
		case 'trial': 
			$objAdmin->trialregister();	
		break;
		case 'logout':
			$objMain->logout();
		break;
		case 'cancel_order':
		$id = @$_REQUEST['id'];
			$objAdmin->CancelOrder($id);
		break;
		case 'checkout':
			$objAdmin->checkout();
		break;
	}
	break;
}	

?>