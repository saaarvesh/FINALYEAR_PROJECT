<?php
require_once '../includes/DbOperation.php';

	function isTheseParametersAvailable($params){
		$available = true;
		$missingparams = "";
		foreach($params as $param) {
			if(!isset($_POST[$param]) || strlen($_POST[$param]) <= 0) {
				$available =false;
				$missingparams = $missingparams.", ".$param;
			
			}
		}
		
		if(!$available) {
			$response = array();
			$response['error'] = true;
			$response['message'] = 'Parameters '.substr($missingparams, 1, strlen($missingparams)).' missing';
			
			echo json_encode($response);
			die();
		
		}
	}
	
	$response = array();
	if(isset($_GET['apicall'])) {
		switch ($_GET['apicall']) {
			case 'register':
				isTheseParametersAvailable(array('cust_name', 'cust_email', 'cust_password', 'cust_contact', 'cust_address', 'registration_time'));
				$db = new DbOperation();

				$result = $db->cust_insert(
					
					$_POST['cust_name'],
					$_POST['cust_email'],
					$_POST['cust_password'],
					$_POST['cust_contact'],
					$_POST['cust_address'],
					$_POST['registration_time']
				);

				if($result){
					$response['error'] = false;
					$response['message'] = 'Registered successfully';
				} else {
					$response['error'] = true;
					$response['message'] = 'Already Registered';	
				}
				break;
			
			case 'login':
				isTheseParametersAvailable(array('cust_name', 'cust_email', 'cust_password', 'cust_contact', 'cust_address'));
				$db = new DbOperation();
				$result = $db->Login($_POST['cust_email'], $_POST['cust_password']);

				if($result){
					$response['error'] = false;
					$response['message'] = 'Login successfully';
					$response['records'] = $db->getUData($_POST['cust_email']);
				} else {
					$response['error'] = true;
					$response['message'] = 'Email or password is invalid';
				}
				break;
			default:
				# code...
				break;
		}
	}

?>