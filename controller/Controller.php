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
		header("Location: /PDSys/hq_view_ticket.php");
		die();
	} else if ($userType === "D") {
		header("Location: /PDSys/dealer_view_ticket.php");
		die();
	} else if ($userType === "C") {
		header("Location: /PDSys/contractor_view_ticket.php");
		die();
	} 
} else if ( strpos($operation, 'Register') !== false ){
	
	require __DIR__ . '/UserController.php';
	require __DIR__ . '/../model/UserModelClass.php';
	require __DIR__ . '/GeneralController.php';

	$branch = NULL;
	$companyname = NULL;
	$compaddr1 = NULL;
	$compaddr2 = NULL;
	$postalcode = NULL;


	if ($_POST['usertype'] === "HQ") {
		$fullname    = $_POST['fullnameHQ'];
		$contactno   = $_POST['contactnoHQ'];
		$email       = $_POST['emailHQ'];
		$password    = $_POST['passwordHQ'];
	} else if ($_POST['usertype'] === "D"){
		$fullname    = $_POST['fullnameD'];
		$contactno   = $_POST['contactnoD'];
		$email       = $_POST['emailD'];
		$password    = $_POST['passwordD'];
		$compaddr1   = $_POST['compaddr1D'];
		$compaddr2   = $_POST['compaddr2D'];
		$postalcode  = $_POST['postalcodeD'];
	} else { // $_POST['usertype'] === "C"
		$fullname    = $_POST['fullnameC'];
		$contactno   = $_POST['contactnoC'];
		$email       = $_POST['emailC'];
		$password    = $_POST['passwordC'];
		$compaddr1   = $_POST['compaddr1C'];
		$compaddr2   = $_POST['compaddr2C'];
		$postalcode  = $_POST['postalcodeC'];
	}

	if ($_POST['usertype'] === "D") {
		$branch      = $_POST['branch'];
	}else{
		$companyname = $_POST['companyname'];
	}

	$usertype    = $_POST['usertype'];

	//hardcode region, get from state
	$state       = $_POST['state'];

	$data = new GeneralController();
	$region = $data->getRegion($state);

	$registeration = new UserController();
	$registeration->register ($usertype, $fullname, $contactno, $companyname, $compaddr1, $compaddr2, $state, $postalcode, $region, $email, $password, $branch);

	// no check function whether register success or not.
	 

	$status = "success";
	header("Location: /PDSys/index.php?status=$status");
	die();
} else if ( strpos($operation, 'LogOut') !== false ){
	require __DIR__ . '/UserController.php';
	$req = new UserController();
	$req->logout();
	header("Location: /PDSys/");
	die();
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
	$State 			= $_POST['state'];

	//check category & details make sure not empty
	if ( ($Detail === "") || ($CategoryID === "-Please select-") ) {
		//field is required, return to page
		$status = "error";
		header("Location: /PDSys/dealer_add_ticket.php?status=$status");
		die();
	}

	//open ticket function
	require __DIR__ . '/TicketController.php';
	$TicketController = new TicketController();
	//$CategoryID = $TicketController->getCategoryID($CategoryType);

	//open new tiket
	$boolOpenTicket = $TicketController->openTicket($TicketID, $UserID, $DateTime, $State, $CategoryID, $StatusID, $Detail, $UIDContractor);

	if ($boolOpenTicket){
		//if success create ticket then log the ticket
	    $postponeDateTime   = NULL;
	    $reason             = "";
		$boolLogTickets = $TicketController->logTickets($TicketID, $UserID, $DateTime, $StatusID, $UIDContractor, $postponeDateTime, $reason);

		//success create and log, then return to view
		if ($boolLogTickets){
			header("Location: /PDSys/dealer_view_ticket.php");
			die();
		} else {
			//else log failed, delete ticket n return failed
			$status = "log_ticket_failed";
			header("Location: /PDSys/dealer_add_ticket.php?status=$status");
			die();
		}
		
	} else {
		$status = "open_ticket_failed";
		header("Location: /PDSys/dealer_add_ticket.php?status=$status");
		die();
	}

} else if ( strpos($operation, 'CloseTicket') !== false ){
	//do update postpone logic here
	require_once __DIR__ . '/TicketController.php';

	$TicketController = new TicketController();

	//get $_post
	$TicketID 			= $_POST['ticketID'];
	$StatusID 			= $_POST['statusDone'];
	$URL	  			= $_POST['URL'];
	$UserID 	   		= $_POST['userID'];
	$DateTime      		= $_POST['dateTime'];
	$CategoryID    		= $_POST['category'];
	$Detail  	   		= $_POST['detail']; 
	$UIDContractor 		= $_POST['uidContractorDone'];
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
			die();
		} else {
			//else log failed, delete ticket n return failed
			$status = "log_ticket_failed";
			header("Location: ".$_POST['URL']."?status=$status");
			die();
		}
		
	} else {
		$status = "close_ticket_failed";
		header("Location: ".$_POST['URL']."?status=$status");
		die();
	}

} else if ( strpos($operation, 'UpdatePostponeTicket') !== false ){
	//do update postpone logic here
	require_once __DIR__ . '/TicketController.php';

	$TicketController = new TicketController();

	//get $_post
	$TicketID 	   = $_POST['ticketID'];
	$UserID 	   = $_POST['userID'];
	$DateTime      = $_POST['dateTime'];
	$Detail  	   = $_POST['detail']; 
	$StatusID 	   = "IP"; //change from postpone to IP
	$UIDContractor = $_POST['uidContractor'];
	$postponeDateTime = $_POST['postponeDateTime'];

	//update ticket
    $reason 			= "";

    if ($postponeDateTime == '' ){
		$status = "error_update";
	}else{
		//update ticket status and contractor
		$boolTicketStatus	= $TicketController->updateTicketStatus($TicketID, $StatusID);
		$boolTicketUID	 	= $TicketController->updateTicketUID($TicketID, $UIDContractor);

		if ($boolTicketUID && $boolTicketStatus){
			$boolLogTickets 	= $TicketController->logTickets($TicketID, $UserID, $DateTime, $StatusID, $UIDContractor, $postponeDateTime, $reason);
		} else {
			$status = "error_update";
		}
		
	}

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
	die();

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
	$UIDContractor = $_POST['uidContractorIP'];
	$postponeDateTime = $_POST['appoimentDateTimeIP'];

	//var_dump($UIDContractor);

	if ($postponeDateTime == ''){
		$status = "error_update";
	}else{
		$boolTicket 	= $TicketController->updateTicketUID($TicketID, $UIDContractor);
	}

	//update ticket
    $reason 			= "";

    if ($boolTicket){
	    //update logtickets
		$boolLogTicket 	= $TicketController->logTickets($TicketID, $UserID, $DateTime, $StatusID, $UIDContractor, $postponeDateTime, $reason);

		//success create and log, then return to view
		if ($boolLogTicket){
			//success log, no need to do anything
			$status = "updated";
		} else {
			//else log failed, delete ticket n return failed
			$status = "error_update";
		}
    }else{
    	$status = "error_update";
    }

	//return to URL
	header("Location: ".$_POST['URL']."?status=$status");
	die();
} else if ( strpos($operation, 'UpdateTicketStatus') !== false ){
	//do update postpone logic here
	require_once __DIR__ . '/TicketController.php';

	$TicketController = new TicketController();

	//get $_post
	$TicketID 	   = $_POST['ticketID'];
	$StatusID 	   = $TicketController->getStatusID($_POST['statusIP']); //get statusID from status
	$UserID 	   = $_POST['userID'];
	$DateTime      = $_POST['dateTime'];
	$CategoryID    = $_POST['category'];
	$Detail  	   = $_POST['detail']; 
	$UIDContractor = $_POST['uidContractorIP'];
	$postponeDateTime = $_POST['appoimentDateTimeIP'];

	//update ticket
    $boolTicket 	= $TicketController->updateTicketStatus($TicketID, $StatusID);

    if ($boolTicket){
	    //update logtickets
	    $reason             = "";
		$boolLogTicket 	= $TicketController->logTickets($TicketID, $UserID, $DateTime, $StatusID, $UIDContractor, $postponeDateTime, $reason);
		//success create and log, then return to view
		if ($boolLogTicket){
			//success log, no need to do anything
			$status = "updated";
		} else {
			//else log failed, delete ticket n return failed
			$status = "log_ticket_failed";
		}
    }else{
    	$status = "error_update";
    }

	//return to URL
	header("Location: ".$_POST['URL']."?status=$status");
	die();
} else if ( strpos($operation, 'UpdateIncompleteTicket') !== false ){
	//do update postpone logic here
	require_once __DIR__ . '/TicketController.php';

	$TicketController = new TicketController();

	//get $_post
	$TicketID 	   = $_POST['ticketID'];
	$UserID 	   = $_POST['userID'];
	$DateTime      = $_POST['dateTime'];
	$CategoryID    = $_POST['category'];
	$Detail  	   = $_POST['detail']; 
	//$StatusID 	   = $TicketController->getStatusID($_POST['status']); //get statusID from status
	$UIDContractor = $_POST['uidContractor'];
	$PostponeDateTime = $_POST['postponeDateTime'];
	$IncompleteReason = $_POST['incompleteReason'];
	$StatusID  		  = 'IC';

	// //var_dump($UIDContractor);

	if ($PostponeDateTime == '' || $IncompleteReason == '' || $Detail == ''){
		$status = "error_update";
	}else{
		$boolLogTicket 	= $TicketController->logTickets($TicketID, $UserID, $DateTime, $StatusID, $UIDContractor, $PostponeDateTime, $IncompleteReason);
	}

	//success create and log, then return to view
	if ($boolLogTicket){
		//success log, no need to do anything
		$status = "updated";
	} else {
		//else log failed, delete ticket n return failed
		$status = "error_update";
	}

	//return to URL
	header("Location: ".$_POST['URL']."?status=$status");
	die();
} else if ( strpos($operation, 'DoneTicket') !== false ){
	//do update postpone logic here
	require_once __DIR__ . '/TicketController.php';

	$TicketController = new TicketController();

	//get $_post
	$TicketID 	   = $_POST['ticketID'];
	$StatusID 	   = "D";
	$UserID 	   = $_POST['userID'];
	$DateTime      = $_POST['dateTime'];
	$CategoryID    = $_POST['category'];
	$Detail  	   = $_POST['detail']; 
	$UIDContractor = $_POST['uidContractor'];
	$postponeDateTime = $_POST['postponeDateTime'];
	$reason = $_POST['incompleteReason'];


	//update ticket
    $boolTicket 	= $TicketController->updateTicketStatus($TicketID, $StatusID);

    if ($boolTicket){
	    //update logtickets
		$boolLogTicket 	= $TicketController->logTickets($TicketID, $UserID, $DateTime, $StatusID, $UIDContractor, $postponeDateTime, $reason);
		//success create and log, then return to view
		if ($boolLogTicket){
			//success log, no need to do anything
			$status = "updated";
		} else {
			//else log failed, delete ticket n return failed
			$status = "log_ticket_failed";
		}
    }else{
    	$status = "error_update";
    }

	//return to URL
	header("Location: ".$_POST['URL']."?status=$status");
	die();
}


?>
