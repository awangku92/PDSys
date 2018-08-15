<?php

//call ticket
require __DIR__ . '/controller/TicketController.php';
require __DIR__ . '/controller/UserController.php';
require __DIR__ . '/controller/GeneralController.php';
require __DIR__ . '/model/TicketModelClass.php';
require __DIR__ . '/model/UserModelClass.php';
require __DIR__ . '/model/StatusModelClass.php';
require __DIR__ . '/model/CategoryModelClass.php';

session_start();

//call session user
$user = $_SESSION["user"];

if ( !isset($_SESSION["user"]) && $user->getUserType() !== "D"){
	header("Location: /PDsys/");
	die();
}

$allTicket = new TicketController();
$allUser = new UserController();
$generalController = new GeneralController();
$ticket = new stdClass();
$ticketArr = $allTicket->getAllTicket();

//get ticket id
$ticketID = $allTicket->generateTicketId($user->getUID());
//var_dump($ticketID);

//get category
$category = new stdClass();
$CategoryArr = $allTicket->getAllCategory();

//get current dateTime
$datetime = $generalController->getDateTime();

$branchID = $user->getBranch();
$state 	  = $user->getState();
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="./icon/favicon_logo.ico" type="image/x-icon">
	<title>Dealer | Add ticket</title>

	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/css/alertify.min.css"/>
<!-- 	<link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/font-awesome.min.css" rel="stylesheet"> -->
    <link href="./css/main.css" rel="stylesheet">

    <script type="text/javascript" src="./js/date_time.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/alertify.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <script type="text/javascript">
	    var urlParams = new URLSearchParams(window.location.search);
	    $(function() {
	  		//(urlParams.get('status') === "error") ? alertify.error('Invalid account') : alertify.success('Register success'); //alert('Invalid account'); 
	  		if (urlParams.get('status') === "error"){
	  			//alert("error");
	  			alertify.warning('Please fill in all the required field!');
	  		} else if (urlParams.get('status') === "open_ticket_failed"){
	  			alertify.error('Create ticket failed!');
	  		} else if (urlParams.get('status') === "log_ticket_failed"){
	  			alertify.error('Logging ticket failed!');
	  		}
	  	});
	  	// $( document ).ready(function() {
    //     	alertify.success('Normal message');
    // 	});
	</script>

</head>
<body>

	<section class="first">
		<div class="container-fluid">
			<div class="navbar-first">
				<img src="./img/Petronas-Logo.png">
				<p class="main-title">Solution for your Solution, View Services</p>
				<p id="date_time" class="clock"></p><script type="text/javascript">window.onload = date_time('date_time');</script>
			</div>
		</div>
	</section>

	<section class="second">
		<div class="navbar-second">
			<div class="container-fluid">
				<div class="menu-left">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">Dealer</li>
						<li class="breadcrumb-item"><a href="dealer_view_ticket.php"> Report / Issue</a></li>
						<li class="breadcrumb-item active"> New Ticket</li>
					</ol>
				</div>
				<div class="menu-right">
					<ul type="none" class="menu">
						<li><a href=""><i class="fa fa-user"></i> <?php echo $user->getFullName() ?></a></li>
						<li><a href=""><i class="fa fa-folder badge1" data-badge="13"></i>	Message Notification</a></li>
						<li>
							<!-- <button type="submit" class="btn btn-default btn-logout"><i class="fa fa-sign-out fa-rotate-270"></i> Log Out</button> -->
							<form action="controller/Controller.php" method="get">
								<button type="submit" name="operation" value="LogOut" class="btn btn-default btn-logout">
									<i class="fa fa-sign-out fa-rotate-270"></i> Log Out
								</button>
							</form>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</section>

	<section class="third">
		<div class="container-fluid">
			<div class="content-content">
				<div class="col-sm-10 detail">
					<div class="container">
						<form method="post" action="controller/Controller.php" autocomplete="off">
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">ID TICKET</label>
								<div class="col-sm-6">
									<input class="form-control" type="text" name="ticketID" value="<?php echo $ticketID ?>" readonly>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">USER ID</label>
								<div class="col-sm-6">
									<input class="form-control" type="text" name="userID" value="<?php echo $user->getUID() ?>" readonly>
								</div>
							</div>
								<div class="form-group row">
								<label class="col-sm-2 col-form-label">DATE & TIME</label>
								<div class="col-sm-6">
									<input class="form-control" type="text" id="dateTime" name="dateTime" value="<?php echo $datetime ?>" readonly>
								</div>
							</div>
								<div class="form-group row">
								<label class="col-sm-2 col-form-label">CATEGORY</label>
								<div class="col-sm-6">
									<select class="form-control" id="category" name="category">
										<option hidden selected>-Please select-</option>
										<!-- get category then loop the option -->
										<?php 
											foreach ($CategoryArr as $cRow) {
												$category = new category($cRow["CategoryID"], $cRow["CategoryType"], $cRow["Priority"]);
												?>
													<option value="<?php echo $category->getCategoryID() ?>"><?php echo $category->getCategoryType() ?></option>
												<?php
											}
										?>	
									</select>
								</div>
							</div>
								<div class="form-group row">
								<label class="col-sm-2 col-form-label">DETAILS</label>
								<div class="col-sm-6">
									<textarea class="form-control" name="detail" placeholder="Please describe the issue here..."></textarea>
								</div>
							</div>

							<!-- hidden input -->
							<input class="form-control" type="hidden" name="branchID" value="<?php echo $branchID ?>" readonly> <!-- how to get branchID? -->
							<input class="form-control" type="hidden" name="state" value="<?php echo $state ?>" readonly>
							<input class="form-control" type="hidden" name="statusID" value="IP" readonly>

							<div class="col-sm-8">
								<div class="tckt-btn" style="float: right;">
									<button type="submit" name="operation" value="OpenTicket" class="btn btn-default" >SUBMIT</button>
								</div>
							</div>
						</form>
					</div>
				</div>				
			</div>
		</div>
	</section>

	<footer>
		<p><i class="fa fa-copyright"></i> Copyright Reserved Petronas Trading @ 2018. Best viewed using Google Chrome's web browser.</p>
	</footer>


	<!-- <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
    <script src="./js/jquery-3.2.1.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/main.js"></script>

</body>
</html>