<?php

session_start();

require_once __DIR__ . '/../util/db.php';
require_once __DIR__ . '/../util/config.php';

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

	$email = $_POST['emailLogin'];
	$password = $_POST['passwordLogin'];

	$crendential = new UserController();
	$userType = $crendential->login($email,$password);

	if ($userType === "HQ"){
		// header("Location: /PdagangSystem/hq_index.php");
		header("Location: /PDSys/hq_view_ticket.php");
		die();
	} else if ($userType === "D") {
		//header("Location: /PdagangSystem/dealer_index.php");
		header("Location: /PDSys/dealer_view_ticket.php");
		die();
	} else if ($userType === "C") {
		//header("Location: /PdagangSystem/c_index.php");
		header("Location: /PDSys/contractor_view_ticket.php");
		die();
	} 
} else if ( strpos($operation, 'Register') !== false ){
	
	require __DIR__ . '/UserController.php';
	require __DIR__ . '/../model/UserModelClass.php';
	require __DIR__ . '/GeneralController.php';

	if ($_POST['usertype'] === "HQ") {
		$fullname    = $_POST['fullnameHQ'];
		$contactno   = $_POST['contactnoHQ'];
		$email       = $_POST['emailHQ'];
		$password    = $_POST['passwordHQ'];
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

	// no check function whether register success or not.
	 

	$status = "success";
	header("Location: /PDSys/index.php?status=$status");
} else if ( strpos($operation, 'LogOut') !== false ){
	require __DIR__ . '/UserController.php';
	$req = new UserController();
	$req->logout();
	header("Location: /PDSys/");
}
else if ( strpos($operation, 'OpenTicket') !== false ){
	//get $_post
	$TicketID   	= $_POST['ticketID'];
	$UserID 		= $_POST['userID'];
	$DateTime  		= $_POST['dateTime'];
	$CategoryID   	= $_POST['category'];
	$Detail  		= $_POST['detail'];
	$BranchID 		= $_POST['branchID'];
	$StatusID 		= $_POST['statusID'];
	$UIDContractor 	= "";

	//var_dump($BranchID);

	//check category & details make sure not empty
	if (($Detail === "") || ($CategoryID === "-Please select-")){
		//field is required, return to page
		$status = "error";
		header("Location: /PDSys/dealer_add_ticket.php?status=$status");
	}

	//open ticket function
	require __DIR__ . '/TicketController.php';
	$TicketController = new TicketController();
	//$CategoryID = $TicketController->getCategoryID($CategoryType);

	//open new tiket
	$boolOpenTicket = $TicketController->openTicket($TicketID, $UserID, $DateTime, $BranchID, $CategoryID, $StatusID, $Detail, $UIDContractor);

	if ($boolOpenTicket){
		//if success create ticket then log the ticket
	    $postponeDateTime   = NULL;
	    $reason             = "";
		$boolLogTickets = $TicketController->logTickets($TicketID, $UserID, $DateTime, $StatusID, $UIDContractor, $postponeDateTime, $reason);

		//success create and log, then return to view
		if ($boolLogTickets){
			header("Location: /PDSys/dealer_view_ticket.php");
		} else {
			//else log failed, delete ticket n return failed
			$status = "log_ticket_failed";
			header("Location: /PDSys/dealer_add_ticket.php?status=$status");
		}
		
	} else {
		$status = "open_ticket_failed";
		header("Location: /PDSys/dealer_add_ticket.php?status=$status");
	}
} else if ( strpos($operation, 'CloseTicket') !== false ){
	//do update postpone logic here
	require_once __DIR__ . '/TicketController.php';

	$TicketController = new TicketController();

	//get $_post
	$TicketID 			= $_POST['ticketID'];
	$StatusID 			= $_POST['status'];
	$URL	  			= $_POST['URL'];
	$UserID 	   		= $_POST['userID'];
	$DateTime      		= $_POST['dateTime'];
	$CategoryID    		= $_POST['category'];
	$Detail  	   		= $_POST['detail']; 
	$UIDContractor 		= $_POST['uidContractor'];
	$postponeDateTime  	= $_POST['appoimentDateTime'];

	//close DONE tiket
	$boolCloseTicket = $TicketController->closeTicket($TicketID, $StatusID);

	if ($boolCloseTicket){
		//if success close ticket then log the ticket
	    $reason             = "";
		$boolLogTickets = $TicketController->logTickets($TicketID, $UserID, $DateTime, $StatusID, $UIDContractor, $postponeDateTime, $reason);

		//success create and log, then return to view
		if ($boolLogTickets){
			$status = "close_ticket_success";
			header("Location: ".$_POST['URL']."?status=$status");
		} else {
			//else log failed, delete ticket n return failed
			$status = "log_ticket_failed";
			header("Location: ".$_POST['URL']."?status=$status");
		}
		
	} else {
		$status = "close_ticket_failed";
		header("Location: ".$_POST['URL']."?status=$status");
	}

} else if ( strpos($operation, 'UpdatePostponeTicket') !== false ){
	//do update postpone logic here
	require_once __DIR__ . '/TicketController.php';

	$TicketController = new TicketController();

	//get $_post
	$TicketID 	   = $_POST['ticketID'];
	$UserID 	   = $_POST['userID'];
	$DateTime      = $_POST['dateTime'];
	$CategoryID    = $_POST['category'];
	$Detail  	   = $_POST['detail']; 
	$StatusID 	   = $TicketController->getStatusID($_POST['status']); //get statusID from status
	$UIDContractor = $_POST['uidContractor'];
	$postponeDateTime  = $_POST['appoimentDateTime'];

	//update ticket
    $reason 			= "";
	$boolLogTickets 	= $TicketController->logTickets($TicketID, $UserID, $DateTime, $StatusID, $UIDContractor, $postponeDateTime, $reason);

	//success create and log, then return to view
	if ($boolLogTickets){
		//success log, no need to do anything
		$status = "updated";
	} else {
		//else log failed, delete ticket n return failed
		$status = "error_update";
	}

	//return to URL
	header("Location: ".$_POST['URL']."?status=$status");

} else if ( strpos($operation, 'UpdateInprogressTicket') !== false ){
	//do update postpone logic here
	require_once __DIR__ . '/TicketController.php';

	$TicketController = new TicketController();

	//get $_post
	$TicketID 	   = $_POST['ticketID'];
	$UserID 	   = $_POST['userID'];
	$DateTime      = $_POST['dateTime'];
	$CategoryID    = $_POST['category'];
	$Detail  	   = $_POST['detail']; 
	$StatusID 	   = $TicketController->getStatusID($_POST['status']); //get statusID from status
	$UIDContractor = $_POST['uidContractor'];
	$postponeDate  = $_POST['appoimentDate'];
	$postponeTime  = $_POST['appoimentTime'];

	//update ticket
	//$boolUpdateTicket = $TicketController->updateTicket($TicketID, $postponeDate, $postponeTime);
	$postponeDateTime   = $postponeDate." ".$postponeTime;
    $reason 			= "";
	$boolLogTickets 	= $TicketController->logTickets($TicketID, $UserID, $DateTime, $StatusID, $UIDContractor, $postponeDateTime, $reason);

	//success create and log, then return to view
	if ($boolLogTickets){
		//success log, no need to do anything
		$status = "updated";
	} else {
		//else log failed, delete ticket n return failed
		$status = "error_update";
	}

	//return to URL
	header("Location: ".$_POST['URL']."?status=$status");
}

?>
