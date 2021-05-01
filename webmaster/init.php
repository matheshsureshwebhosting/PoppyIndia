<?php
require_once 'lib/common.php'; 
$module = @$_REQUEST['module'];
$action = @$_REQUEST['action'];
switch ($module) {

	case 'login': 
	switch ($action) {
	case 'validate': 
	$objMain->checkLogin();	
	break;
	case 'logout':
	$objMain->logout();
	break;
	}
	break;
	case 'admin':
		switch($action)
		{
			//ACCOUNT SETTINGS 
			case 'accountsettings':
			$do = @$_REQUEST['do'];
			if($do == 'update')
			{
			$objAdmin->accountSettings();
			}
			break;
			case 'images':
			$do = @$_REQUEST['do'];
			$id = @$_REQUEST['id']; 			
			if($do == 'update')
			{
			$objAdmin->updateImages($id);
			}
			if($do == 'delete')
			{
			$objAdmin->deleteImages($id);
			}
			break;
			
		}
		break;
	}	

?>