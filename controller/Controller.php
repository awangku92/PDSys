<?php

session_start();

require __DIR__ . '/../util/db.php';
require __DIR__ . '/../util/config.php';

$operation = "";

if ( isset($_POST['operation']) ){
	$operation = $_POST['operation']; 
} else if ( isset($_GET['operation']) ) {
	$operation = $_GET['operation']; 
}

//operation type
if ( strpos($operation, 'LogIn') !== false  ) {
	
	require __DIR__ . '/UserController.php';
	require __DIR__ . '/../model/UserModelClass.php';

	$email = $_POST['email'];
	$password = $_POST['password'];

	$crendential = new UserController();
	$userType = $crendential->login($email,$password);

	if ($userType === "HQ"){
		// header("Location: /PdagangSystem/hq_index.php");
		header("Location: /PDsys/hq_view_ticket.php");
		die();
	} else if ($userType === "D") {
		//header("Location: /PdagangSystem/dealer_index.php");
		header("Location: /PDsys/dealer_view_ticket.php");
		die();
	} else if ($userType === "C") {
		//header("Location: /PdagangSystem/c_index.php");
		header("Location: /PDsys/contractor_view_ticket.php");
		die();
	} 
} else if ( strpos($operation, 'Register') !== false ){
	
	require __DIR__ . '/UserController.php';
	require __DIR__ . '/../model/UserModelClass.php';

	if ($_POST['usertype'] === "HQ") {
		$fullname    = $_POST['fullnameH'];
		$contactno   = $_POST['contactnoH'];
		$email       = $_POST['emailH'];
		$password    = $_POST['passwordH'];
	} else {
		$fullname    = $_POST['fullname'];
		$contactno   = $_POST['contactno'];
		$email       = $_POST['email'];
		$password    = $_POST['password'];
	}

	$usertype    = $_POST['usertype'];
	$companyname = $_POST['companyname'];
	$compaddr1   = $_POST['compaddr1'];
	$compaddr2   = $_POST['compaddr2'];
	$postalcode  = $_POST['postalcode'];

	//hardcode region, get from state
	$state       = $_POST['state'];
	//$region      = $_POST['region'];
	$data = new GeneralController();
	$region = $data->getRegion($state);

	$registeration = new UserController();
	$registeration->register ($usertype, $fullname, $contactno, $companyname, $compaddr1, $compaddr2, $state, $postalcode, $region, $email, $password);

	$status = "success";
	header("Location: /PDsys/status=$status");
} else if ( strpos($operation, 'LogOut') !== false ){
	require __DIR__ . '/UserController.php';
	$req = new UserController();
	$req->logout();
	header("Location: /PDsys/");
}


?>
