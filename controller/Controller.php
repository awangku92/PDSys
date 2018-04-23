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
		header("Location: /PdagangSystem/hq_view_ticket.html");
		die();
	} else if ($userType === "D") {
		//header("Location: /PdagangSystem/dealer_index.php");
		header("Location: /PdagangSystem/dealer_view_ticket.html");
		die();
	} else if ($userType === "C") {
		//header("Location: /PdagangSystem/c_index.php");
		header("Location: /PdagangSystem/contractor_view_ticket.html");
		die();
	} 
} else if ( strpos($operation, 'Register') !== false ){
	
	require __DIR__ . '/UserController.php';
	require __DIR__ . '/../model/UserModelClass.php';

	$usertype    = $_POST['usertype'];
	$fullname    = $_POST['fullname'];
	$contactno   = $_POST['contactno'];
	$companyname = $_POST['companyname'];
	$compaddr1   = $_POST['compaddr1'];
	$compaddr2   = $_POST['compaddr2'];
	$state       = $_POST['state'];
	$postalcode  = $_POST['postalcode'];
	$region      = $_POST['region'];
	$email       = $_POST['email'];
	$password    = $_POST['password'];

	$registeration = new UserController();
	$registeration->register ($usertype, $fullname, $contactno, $companyname, $compaddr1, $compaddr2, $state, $postalcode, $region, $email, $password);

	header("Location: /PdagangSystem/");
}


?>
