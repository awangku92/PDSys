<?php

//call ticket
require __DIR__ . '/controller/TicketController.php';
require __DIR__ . '/controller/UserController.php';
require __DIR__ . '/model/TicketModelClass.php';
require __DIR__ . '/model/UserModelClass.php';
require __DIR__ . '/model/StatusModelClass.php';

session_start();

//call session user
$user = $_SESSION["user"];

if (!isset($_SESSION["user"]) && $user->getUserType() !== "HQ"){
	header("Location: /PDsys/");
	die();
}

$allTicket = new TicketController();
$allUser = new UserController();
$ticket = new stdClass();
$ticketArr = $allTicket->getAllTicket();
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="./icon/favicon_logo.ico" type="image/x-icon">
	<title>HQ | View ticket</title>

	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/css/alertify.min.css"/>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="./css/main.css" rel="stylesheet">

    <!-- FOR DATETIME PICKER -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">

    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/alertify.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="./js/date_time.js"></script>
    <script src="./js/main.js"></script>

    <!-- FOR DATETIME PICKER -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>

    <script type="text/javascript">
	    var urlParams = new URLSearchParams(window.location.search);
	    $(function() {
	  		//(urlParams.get('status') === "error") ? alertify.error('Invalid account') : alertify.success('Register success'); //alert('Invalid account'); 
	  		if (urlParams.get('status') === "updated"){
	  			alertify.success('Ticket Updated!');
	  		} else if (urlParams.get('status') === "close_ticket_success"){
  				alertify.success('Ticket Closed!');
	  		} else if (urlParams.get('status') === "error_update"){
  				alertify.error('Update failed!');
	  		} else if (urlParams.get('status') === "close_ticket_failed"){
  				alertify.error('Close ticket failed!');
	  		} else if (urlParams.get('status') === "log_ticket_failed"){
  				alertify.error('Close ticket failed!');
	  		} 
	  	});

		// onselect unhide button
		$(function(){
		    $('#status').change(function(){
		       var stat = $(this).val();
		        if(stat == 'C'){
		            $('.tckt-btn').show();
		        }
		    });
		});

		// onchange button
		$(function(){
		    $('#companyName').change(function(){
		       var strValue = $(this).val();

		       	myArray = strValue.split("/");
			
				// var uid 		= myArray[0];
				// var companyname = myArray[1];
				// var fullname 	= myArray[2];
				// var contact 	= myArray[3];

				document.getElementById("uidContractorIP").value = myArray[0];
				document.getElementById("fullNameIP").value = myArray[2];
				document.getElementById("contactIP").value = myArray[3];
		    });
		});
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
						<li class="breadcrumb-item">HQ</li>
						<li class="breadcrumb-item active"> Report / Issue</li>
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
						<table class="table table-bordered">
						    <thead>
						      <tr>
						        <th>ID</th>
						        <th>Date & Time</th>
						        <th>Status</th>
						      </tr>
						    </thead>
						    <tbody>
						    	<?php 
						    		foreach ($ticketArr as $row) {
									    //var_dump( $ticket );
									    $ticket = new ticket($row["UID"], $row["TicketID"], $row["SearchID"], $row["DateTime"], $row["State"], $row["CategoryID"], $row["StatusID"], $row["Detail"], $row["UIDContractor"]);

									    //get Status from StatusID
								    	$status = $allTicket->getStatus($row["StatusID"]);

								    	//get state info
								    	$state = $row["State"];
								    	//var_dump($state);

							    		//get category info
								    	$category = $allTicket->getCategoryType( $row["CategoryID"]);
								    	//var_dump($category);

								    	//get Contractor info in user table
								    	$contractorInfo = $allUser->getContractor( $row["UIDContractor"]);

								    	/* associative array */
								    	$contractor = $contractorInfo->fetch_array(MYSQLI_ASSOC);
								    	$CompanyName = $contractor["CompanyName"];
								    	$FullName = $contractor["FullName"];
										$Contact = $contractor["Contact"];

								    	//case for status
									    switch ($status) {
									        case "Done":
									        case "Close":
									        	$id = "done";
									        	$modal = "#modal-done";
									            break;
									        case "Incomplete":
									            $id = "incomplete";
									        	$modal = "#modal-incomplete";
									            break;
									        case "Inprogress":
									           	$id = "inprogress";
									        	$modal = "#modal-inprogress";
									            break;
									        case "Postpone":
									            $id = "postpone";
									        	$modal = "#modal-postpone";
									            break;
									    }
									//}

									    //get URL
									    //$uri = $_SERVER['REQUEST_URI'];
						    	?>
						    	<!-- GET StatusID.. need to change in id -->
							    <tr id="<?php echo $id ?>" data-toggle="modal" data-target="<?php echo $modal.$ticket->getTicketID() ?>">
							   	<!-- <?php $statusStr ?> -->
							        <td><?php echo $ticket->getTicketID() ?></td> <!-- ID -->
							        <td><?php echo $ticket->getDateTime() ?></td> <!-- Date & Time -->
							        <td><?php echo $status ?></td> <!-- Status -->
							    </tr>

							    <?php 
							    	//case statement for modal
								    switch ($modal) {
								        case "#modal-done":
											//put html modal here ?>
											<!-- Modal Done-->
											<div class="modal fade" id="modal-done<?php echo $ticket->getTicketID(); ?>" role="dialog">
												<div class="modal-dialog">
													<!-- Modal content-->
													<div class="modal-content">
														<form class="form-inline"  method="post" action="controller/Controller.php" autocomplete="off">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal">&times;</button>
																<h4 class="modal-title">TICKET'S DETAILS</h4>
															</div>
															<div class="modal-body">
																<div class="form-group row">
																	<label class="col-sm-2 col-form-label">ID TICKET</label>
																	<div class="col-sm-6">
																		<input class="form-control" type="text" name="ticketID" value="<?php echo $ticket->getTicketID() ?>" readonly>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-2 col-form-label">USER ID</label>
																	<div class="col-sm-6">
																		<input class="form-control" type="text" name="userID" value="<?php echo $ticket->getUID() ?>" readonly>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-2 col-form-label">DATE & TIME</label>
																	<div class="col-sm-6">
																		<input class="form-control" type="text" name="dateTime" value="<?php echo $ticket->getDateTime() ?>" readonly>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-2 col-form-label">STATUS</label>
																	<!-- (status == close) ? //no option : //show option ; -->
																	<div class="col-sm-6">
																<?php 
																	if ($status !== "Close"){

																?>
																	<select class="form-control" id="status" name="status">
																		<option hidden selected>DONE</option>
																		<option value="C">CLOSE</option>
																	</select>
																<?php 
																	} else {
																?>
																	<input class="form-control" type="text" name="status" value="<?php echo $status ?>" readonly>
																<?php 
																	}
																?>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-2 col-form-label">STATE</label>
																	<div class="col-sm-6">
																		<input class="form-control" type="text" name="state" value="<?php echo $state ?>" readonly>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-2 col-form-label">CATEGORY</label>
																	<div class="col-sm-6">
																		<input class="form-control" type="text" name="category" value="<?php echo $category ?>" readonly>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-2 col-form-label">DETAILS</label>
																	<div class="col-sm-6">
																		<textarea class="form-control" placeholder="Describe the issue here" name="detail" readonly><?php echo $ticket->getDetail() ?></textarea>
																	</div>
																</div>
																<hr>
																<p>CONTRACTOR'S DETAILS</p><br>
																<div class="form-group row">
																	<label class="col-sm-2 col-form-label">COMPANY NAME</label>
																	<div class="col-sm-6">
																		<input class="form-control" type="text" name="uidContractor" value="<?php echo $CompanyName ?>" readonly>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-2 col-form-label">FULL NAME</label>
																	<div class="col-sm-6">
																		<input class="form-control" type="text" name="fullName" value="<?php echo $FullName ?>" readonly>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-2 col-form-label">CONTACT NO</label>
																	<div class="col-sm-6">
																		<input class="form-control" type="text" name="contact" value="<?php echo $Contact ?>" readonly>
																	</div>
																</div>
																<div class="form-group row">
																	<?php 
																		// get date & time from log to here
																		$dateTime = $allTicket->getAppoimentDateTime($ticket->getTicketID());
																		//$str = explode(" ", $dateTime);
																		if (empty($dateTime)) {
																			$dateTime = ""; 
																		}
																	?>
																	<label class="col-sm-2 col-form-label">APPOINMENT DATE & TIME</label>
																	<div class="col-sm-6">
																		<!-- <script type="text/javascript">
																			$(function() {
																				$('#datetimepicker<?php //echo $ticket->getTicketID(); ?>').datetimepicker({
																					format : 'YYYY-MM-DD HH:mm'
																				});
																			});
																		</script> -->
																		<div class="form-group">
															                <div class='input-group date' id='datetimepicker<?php echo $ticket->getTicketID(); ?>'>
															                    <input type="text" class="form-control" name="appoimentDateTime" value="<?php echo $dateTime ?>" />
															                    <span class="input-group-addon" readonly>
															                        <span class="glyphicon glyphicon-calendar"></span>
															                    </span>
															                </div>
															            </div>
																	</div>
																</div>
																<!-- hidden input -->
																<input class="form-control" type="hidden" name="URL" value="/PDSys/hq_view_ticket.php" readonly>
															</div>
															<div class="modal-footer">
																<!-- if status = close then unhide button -->
																<button type="submit" class="btn tckt-btn" value="CloseTicket" name="operation" style="display: none;">Save</button>
																<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
															</div>
														</form>
													</div>
												</div>
											</div>

											<?php 
								            break;
								        case "#modal-incomplete":
								            //put html modal here ?>
								            <!-- Modal incomplete-->
											<div class="modal fade" id="modal-incomplete<?php echo $ticket->getTicketID(); ?>" role="dialog">
												<div class="modal-dialog">
													<!-- Modal content-->
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<h4 class="modal-title">TICKET'S DETAILS</h4>
														</div>
														<div class="modal-body">
															<form>
																<div class="form-group row">
																	<label class="col-sm-2 col-form-label">ID TICKET</label>
																	<div class="col-sm-6">
																		<input class="form-control" type="text" name="" value="<?php echo $ticket->getTicketID(); ?>" readonly>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-2 col-form-label">USER ID</label>
																	<div class="col-sm-6">
																		<input class="form-control" type="text" name="" value="<?php echo $ticket->getUID() ?>" readonly>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-2 col-form-label">DATE & TIME</label>
																	<div class="col-sm-6">
																		<input class="form-control" type="text" name="" value="<?php echo $ticket->getDateTime() ?>" readonly>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-2 col-form-label">STATUS</label>
																	<div class="col-sm-6">
																		<input class="form-control" type="text" name="" value="<?php echo $status ?>" readonly>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-2 col-form-label">STATE</label>
																	<div class="col-sm-6">
																		<input class="form-control" type="text" name="" value="<?php echo $state ?>" readonly>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-2 col-form-label">CATEGORY</label>
																	<div class="col-sm-6">
																		<input class="form-control" type="text" name="" value="<?php echo $category ?>" readonly>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-2 col-form-label">DETAILS</label>
																	<div class="col-sm-6">
																		<textarea class="form-control" placeholder="Describe the issue here" readonly><?php echo $ticket->getDetail() ?>
																		</textarea>
																	</div>
																</div>
																<hr>
																<p>INCOMPLETE REASON</p><br>
																<div class="form-group row">
																	<label class="col-sm-2 col-form-label">REASON</label>
																	<div class="col-sm-6">
																		<textarea class="form-control" placeholder="Describe the reason here" readonly></textarea>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-2 col-form-label">APPOINMENT DATE & TIME</label>
																	<div class="col-sm-6">
																		<input class="form-control" type="date" name="" readonly>
																	</div>
																	<div class="col-sm-6">
																		<input class="form-control" type="time" name="" readonly>
																	</div>
																</div>
																<hr>
																<p>CONTRACTOR'S DETAILS</p><br>
																<div class="form-group row">
																	<label class="col-sm-2 col-form-label">COMPANY NAME</label>
																	<div class="col-sm-6">
																		<input class="form-control" type="text" name="" value="<?php echo $CompanyName ?>" readonly>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-2 col-form-label">FULL NAME</label>
																	<div class="col-sm-6">
																		<input class="form-control" type="text" name="" value="<?php echo $FullName ?>" readonly>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-2 col-form-label">CONTACT NO</label>
																	<div class="col-sm-6">
																		<input class="form-control" type="text" name="" value="<?php echo $Contact ?>" readonly>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-2 col-form-label">APPOINMENT DATE & TIME</label>
																	<div class="col-sm-6">
																		<input class="form-control" type="date" name="" readonly>
																	</div>
																	<div class="col-sm-6">
																		<input class="form-control" type="time" name="" readonly>
																	</div>
																</div>
															</form>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
														</div>
													</div>
												</div>
											</div>

								            <?php
								            break;
								        case "#modal-inprogress":
								           	//put html modal here ?>
											<!-- Modal inprogress-->
											<div class="modal fade" id="modal-inprogress<?php echo $ticket->getTicketID(); ?>" role="dialog">
												<div class="modal-dialog">
													<!-- Modal content-->
													<div class="modal-content">
														<form class="form-inline"  method="post" action="controller/Controller.php" autocomplete="off">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal">&times;</button>
																<h4 class="modal-title">TICKET'S DETAILS</h4>
															</div>
															<div class="modal-body">
																<div class="form-group row">
																	<label class="col-sm-2 col-form-label">ID TICKET</label>
																	<div class="col-sm-6">
																		<input class="form-control" type="text" name="ticketID" value="<?php echo $ticket->getTicketID() ?>" readonly>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-2 col-form-label">USER ID</label>
																	<div class="col-sm-6">
																		<input class="form-control" type="text" name="userID" value="<?php echo $ticket->getUID() ?>" readonly>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-2 col-form-label">DATE & TIME</label>
																	<div class="col-sm-6">
																		<input class="form-control" type="text" name="dateTime" value="<?php echo $ticket->getDateTime() ?>" readonly>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-2 col-form-label">STATUS</label>
																	<div class="col-sm-6">
																		<input class="form-control" type="text" name="status" value="<?php echo $status ?>" readonly>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-2 col-form-label">STATE</label>
																	<div class="col-sm-6">
																		<input class="form-control" type="text" name="state" value="<?php echo $state ?>" readonly>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-2 col-form-label">CATEGORY</label>
																	<div class="col-sm-6">
																		<input class="form-control" type="text" name="category" value="<?php echo $category ?>" readonly>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-2 col-form-label">DETAILS</label>
																	<div class="col-sm-6">
																		<textarea class="form-control" name="detail" placeholder="Describe the issue here" readonly><?php echo $ticket->getDetail() ?></textarea>
																	</div>
																</div>
																<hr>
																<p>CONTRACTOR'S DETAILS</p><br>
																<?php
																//CHOOSE COMPANY NAME BY STATE; DO getContractorCompanyName function as dropdown
																$company = new stdClass();
																$companyNameArr = $allUser->getCompany($state);

																$uidContractor 	= "";
															    $CompanyName 	= "";
															    $FullName 		= "";
																$Contact 		= "";

																if ($companyNameArr->num_rows === 0) {
																	echo "no contractor available!";
																} else {
																	?>
																		<div class="form-group row">
																			<label class="col-sm-2 col-form-label">COMPANY NAME</label>
																			<div class="col-sm-6">
																				<select class="form-control" id="companyName" name="companyName">
																					<option hidden selected>-Assign Contractor-</option>
		 																			<?php 
																					    //get companyName by state then loop the option
		 																				for ($i = 0; $i < $companyNameArr->num_rows; $i++){

																							$company = $companyNameArr->fetch_array(MYSQLI_ASSOC);
																					    	$uidC 	 = $company["UID"];
																					    	$CN 	 = $company["CompanyName"];
																					    	$FN 	 = $company["FullName"];
																					        $C 		 = $company["Contact"];

																							?>
																								<option value="<?php echo $uidC.'/'.$CN.'/'.$FN.'/'.$C ?>"><?php echo $CN ?></option>
																							<?php
																						}
																					?>
																				</select>
																			</div>
																		</div>
																	<?php
																}
																?>
																<!-- </div> -->
																<!-- auto get from company name -->
																<div class="form-group row">
																	<label class="col-sm-2 col-form-label">CONTRACTOR ID</label>
																	<div class="col-sm-6">
																		<input class="form-control" type="text" id="uidContractorIP" name="uidContractorIP" value="" readonly>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-2 col-form-label">FULL NAME</label>
																	<div class="col-sm-6">
																		<input class="form-control" type="text" id="fullNameIP" name="fullNameIP" value="" readonly>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-2 col-form-label">CONTACT NO</label>
																	<div class="col-sm-6">
																		<input class="form-control" type="text" id="contactIP" name="contactIP" value="" readonly>
																	</div>
																</div>
																<div class="form-group row">
																	<?php 
																		// get date & time from log to here
																		$dateTime = $allTicket->getAppoimentDateTime($ticket->getTicketID());
																		//$str = explode(" ", $dateTime);
																		if (empty($dateTime)) {
																			$dateTime = ""; 
																		}
																	?>
																	<?php 
																		if ($companyNameArr->num_rows === 0){
																			?>
																			<?php
																		}else{
																			?>
																			<label class="col-sm-2 col-form-label">APPOINMENT DATE & TIME</label>
																				<!-- <div class="col-sm-6">
																					<input class="form-control" type="date" name="appoimentDate" value="<?php //echo $date ?>">
																				</div>
																				<div class="col-sm-6">
																					<input class="form-control" type="time" name="appoimentTime" value="<?php //echo $time ?>">
																				</div> -->
																				<div class="col-sm-6">
																					<script type="text/javascript">
																						$(function() {
																							$('#datetimepicker<?php echo $ticket->getTicketID(); ?>').datetimepicker({
																								format : 'YYYY-MM-DD HH:mm'
																							});
																						});
																					</script>
																					<div class="form-group">
																		                <div class='input-group date' id='datetimepicker<?php echo $ticket->getTicketID(); ?>'>
																		                    <input type='text' class="form-control" name="appoimentDateTimeIP" value="<?php //echo $dateTime ?>" />
																		                    <span class="input-group-addon">
																		                        <span class="glyphicon glyphicon-calendar"></span>
																		                    </span>
																		                </div>
																		            </div>
																				</div>
																			<?php
																		}
																	?>
																</div>
																<!-- hidden input -->
																<input class="form-control" type="hidden" name="URL" value="/PDSys/hq_view_ticket.php" readonly>
															</div>
															<div class="modal-footer">
																<button type="submit" class="btn tckt-btn" value="UpdateInprogressTicket" name="operation">Save</button>
																<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
															</div>
														</form>
													</div>
												</div>
											</div>

							           		<?php
								            break;
								        case "#modal-postpone":
								            //put html modal here ?>
											<!-- Modal postpone-->
											<div class="modal fade" id="modal-postpone<?php echo $ticket->getTicketID(); ?>" role="dialog">
												<div class="modal-dialog">
													<!-- Modal content-->
													<div class="modal-content">
														<form class="form-inline"  method="post" action="controller/Controller.php" autocomplete="off">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal">&times;</button>
																<h4 class="modal-title">TICKET'S DETAILS</h4>
															</div>
															<div class="modal-body">
																<div class="form-group row">
																	<label class="col-sm-2 col-form-label">ID TICKET</label>
																	<div class="col-sm-6">
																		<input class="form-control" type="text" name="ticketID" value="<?php echo $ticket->getTicketID() ?>" readonly>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-2 col-form-label">USER ID</label>
																	<div class="col-sm-6">
																		<input class="form-control" type="text" name="userID" value="<?php echo $ticket->getUID() ?>" readonly>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-2 col-form-label">DATE & TIME</label>
																	<div class="col-sm-6">
																		<input class="form-control" type="text" name="dateTime" value="<?php echo $ticket->getDateTime() ?>" readonly>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-2 col-form-label">STATUS</label>
																	<div class="col-sm-6">
																		<input class="form-control" type="text" name="status" value="<?php echo $status ?>" readonly>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-2 col-form-label">STATE</label>
																	<div class="col-sm-6">
																		<input class="form-control" type="text" name="state" value="<?php echo $state ?>" readonly>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-2 col-form-label">CATEGORY</label>
																	<div class="col-sm-6">
																		<input class="form-control" type="text" name="category" value="<?php echo $category ?>" readonly>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-2 col-form-label">DETAILS</label>
																	<div class="col-sm-6">
																		<textarea class="form-control" placeholder="Describe the issue here" name="detail" readonly><?php echo $ticket->getDetail() ?>
																		</textarea>
																	</div>
																</div>
																<hr>
																<p>CONTRACTOR'S DETAILS</p><br>
																<div class="form-group row">
																	<label class="col-sm-2 col-form-label">CONTRACTOR ID</label>
																	<div class="col-sm-6">
																		<input class="form-control" type="text" name="uidContractor" value="<?php echo $ticket->getUIDContractor() ?>" readonly>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-2 col-form-label">COMPANY NAME</label>
																	<div class="col-sm-6">
																		<input class="form-control" type="text" name="companyName" value="<?php echo $CompanyName ?>" readonly>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-2 col-form-label">FULL NAME</label>
																	<div class="col-sm-6">
																		<input class="form-control" type="text" name="fullName" value="<?php echo $FullName ?>" readonly>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-sm-2 col-form-label">CONTACT NO</label>
																	<div class="col-sm-6">
																		<input class="form-control" type="text" name="contact" value="<?php echo $Contact ?>" readonly>
																	</div>
																</div>
																<div class="form-group row">
																	<?php 
																		// get date & time from log to here
																		$dateTime = $allTicket->getAppoimentDateTime($ticket->getTicketID());
																		//$str = explode(" ", $dateTime);
																		if (empty($dateTime)) {
																			$dateTime = ""; 
																		}
																	?>
																	<label class="col-sm-2 col-form-label">APPOINMENT DATE & TIME</label>
																	<!-- <div class="col-sm-6">
																		<input class="form-control" type="date" name="appoimentDate" value="<?php //echo $date ?>">
																	</div> -->
																	<div class="col-sm-6">
																		<script type="text/javascript">
																			$(function() {
																				$('#datetimepicker<?php echo $ticket->getTicketID(); ?>').datetimepicker({
																					format : 'YYYY-MM-DD HH:mm'
																				});
																			});
																		</script>
																		<div class="form-group">
															                <div class='input-group date' id='datetimepicker<?php echo $ticket->getTicketID(); ?>'>
															                    <input type='text' class="form-control" name="appoimentDateTime" value="<?php //echo $dateTime ?>" />
															                    <span class="input-group-addon">
															                        <span class="glyphicon glyphicon-calendar"></span>
															                    </span>
															                </div>
															            </div>
																	</div>
																</div>
																<!-- hidden input -->
																<input class="form-control" type="hidden" name="URL" value="/PDSys/hq_view_ticket.php" readonly>
															</div>
															<div class="modal-footer">
																<button type="submit" class="btn tckt-btn" value="UpdatePostponeTicket" name="operation">Save</button>
																<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
															</div>
														</form>
													</div>
												</div>
											</div>

								            <?php
								            break;
								    }
								}
							    ?>
						    	<!-- DO NOT DELETE!!! use as guide. -->
								<!-- <tr id="incomplete" data-toggle="modal" data-target="#modal-incomplete">
							        <td>PTRNS0258</td>
							        <td>25 Jan 2018, 22:04:15</td>
							        <td>INCOMPLETE</td>
							    </tr>
							    <tr id="done" data-toggle="modal" data-target="#modal-done">
							        <td>PTRNS0259</td>
							        <td>04 Apr 2018, 15:46:35</td>
							        <td>DONE</td>
							    </tr>
							    <tr id="postpone" data-toggle="modal" data-target="#modal-postpone">
							        <td>PTRNS0260</td>
							        <td>19 Apr 2018, 07:32:47</td>
							        <td>POSTPONE</td>
							    </tr>
							    <tr id="inprogress" data-toggle="modal" data-target="#modal-inprogress">
							        <td>PTRNS0260</td>
							        <td>19 Apr 2018, 07:32:47</td>
							        <td>IN PROGRESS</td>
							    </tr> -->
						    </tbody>
						</table>
					</div>

				</div>
			</div>
		</div>
	</section>

	<footer>
		<p><i class="fa fa-copyright"></i> Copyright Reserved Petronas Trading @ 2018. Best viewed using Google Chrome's web browser.</p>
	</footer>

</body>
</html>