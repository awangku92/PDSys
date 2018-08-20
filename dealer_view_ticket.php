<?php

//call ticket
require __DIR__ . '/controller/TicketController.php';
require __DIR__ . '/controller/UserController.php';
require __DIR__ . '/model/TicketModelClass.php';
require __DIR__ . '/model/UserModelClass.php';
require __DIR__ . '/model/StatusModelClass.php';
require __DIR__ . '/model/CategoryModelClass.php';

session_start();

//call session user
$user = $_SESSION["user"];

if (!isset($_SESSION["user"]) && $user->getUserType() !== "D"){
	header("Location: /PDsys/");
	die();
}

$allTicket = new TicketController();
$allUser = new UserController();

//get ticket
$ticket = new stdClass();
$ticketArr = $allTicket->getAllTicket();

//get category
$category = new stdClass();
$CategoryArr = $allTicket->getAllCategory();
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="./icon/favicon_logo.ico" type="image/x-icon">
	<title>Dealer | View ticket</title>

	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/font-awesome.min.css" rel="stylesheet"> -->
    <link href="./css/main.css" rel="stylesheet">
    <script type="text/javascript" src="./js/date_time.js"></script>

    <!-- FOR DATETIME PICKER -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">

    <!-- FOR DATETIME PICKER -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>

	<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/alertify.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="./js/date_time.js"></script>
    <script src="./js/main.js"></script>

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
									    //var_dump($row["Detail"]);

									    //dealer can only view their ticket only
									    if ($row["UID"] === $user->getUID()){
										    //get Status from StatusID
									    	$status = $allTicket->getStatus($row["StatusID"]);

									    	//get state info
									    	//$state = $allTicket->getState( $row["BranchID"]);
									    	$state = $row["StatusID"];

								    		//get category info
									    	$category = $allTicket->getCategoryType( $row["CategoryID"]);

									    	//get Contractor info in user table
									    	$contractorInfo = $allUser->getContractor( $row["UIDContractor"]);
									    	$contractorUID  = $row["UIDContractor"];

									    	/* associative array */
									    	$contractor = $contractorInfo->fetch_array(MYSQLI_ASSOC);
									    	$CompanyName = $contractor["CompanyName"];
									    	$FullName = $contractor["FullName"];
											$Contact = $contractor["Contact"];

											$appoimentDateTime = $allTicket->getAppoimentDateTime($ticket->getTicketID());

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
									    //echo $modal;
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
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<h4 class="modal-title">TICKET'S DETAILS</h4>
														</div>
														<div class="modal-body">
														<form>
															<div class="form-group row">
																<label class="col-sm-2 col-form-label">ID TICKET</label>
																<div class="col-sm-6">
																	<input class="form-control" type="text" name="" value="<?php echo $ticket->getTicketID() ?>" readonly>
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
																<label class="col-sm-2 col-form-label">CATEGORY</label>
																<div class="col-sm-6">
																	<input class="form-control" type="text" name="" value="<?php echo $category ?>" readonly>
																</div>
															</div>
															<div class="form-group row">
																<label class="col-sm-2 col-form-label">DETAILS</label>
																<div class="col-sm-6">
																	<textarea class="form-control" placeholder="Please describe the issue here..." readonly><?php echo $ticket->getDetail() ?></textarea>
																</div>
															</div>
															<div class="form-group row">
																<label class="col-sm-2 col-form-label">STATUS</label>
																<div class="col-sm-6">
																	<select class="form-control" id="status" disabled="true">
																		<option selected><?php echo $status ?></option>
																	</select>
																</div>
															</div>
															<?php 
																//$contractorUID = $allTicket->getTicketContractor($ticket->getTicketID());	
																//$appoimentDateTime = $allTicket->getAppoimentDateTime($ticket->getTicketID());			
															?>
															<hr>
															<p>CONTRACTOR'S DETAILS</p><br>
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
																<label class="col-sm-2 col-form-label">APPOINMENT DATE & TIME</label>
																<div class="col-sm-6">
																	<div class="form-group">
															               <div class="input-group date" >
															                   <input type="text" class="form-control" name="appoimentDateTime" value="<?php echo $appoimentDateTime ?>" />
															                   <span class="input-group-addon" readonly>
															                       <span class="glyphicon glyphicon-calendar"></span>
															                   </span>
															               </div>
															           </div>
																</div>
															</div>
														</form>
														</div>
														<div class="modal-footer">
															<!-- <button type="submit" class="btn tckt-btn" value="CloseTicket" name="operation" style="display: none;">Save</button> -->
															<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
														</div>
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
																<input class="form-control" type="text" name="" value="<?php echo $ticket->getUID(); ?>" readonly>
															</div>
														</div>
															<div class="form-group row">
															<label class="col-sm-2 col-form-label">DATE & TIME</label>
															<div class="col-sm-6">
																<input class="form-control" type="text" name="" value="<?php echo $ticket->getDateTime(); ?>" readonly>
															</div>
														</div>
															<div class="form-group row">
															<label class="col-sm-2 col-form-label">CATEGORY</label>
															<div class="col-sm-6">
																<input class="form-control" type="text" name="" value="<?php echo $category ?>" readonly>
																<!-- <select class="form-control">
																	<option></option>
																</select> -->
															</div>
														</div>
															<div class="form-group row">
															<label class="col-sm-2 col-form-label">DETAILS</label>
															<div class="col-sm-6">
																<textarea class="form-control" placeholder="Please describe the issue here..."><?php echo $ticket->getDetail() ?></textarea>
															</div>
														</div>
														<hr>
														<p>INCOMPLETE REASON</p><br>
														<div class="form-group row">
															<label class="col-sm-2 col-form-label">REASON</label>
															<div class="col-sm-6">
																<textarea class="form-control" placeholder="Describe the reason here"></textarea>
															</div>
														</div>
														<div class="form-group row">
															<label class="col-sm-2 col-form-label">NEXT APPOINMENT DATE & TIME</label>
															<div class="col-sm-6">
																<div class="form-group">
													               <div class="input-group date" id='datetimepickerIC<?php echo $ticket->getTicketID(); ?>'>
													                   <input type="text" class="form-control" name="postponeDateTimeIC" value="" />
													                   <span class="input-group-addon">
													                       <span class="glyphicon glyphicon-calendar"></span>
													                   </span>
													               </div>
														        </div>
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
															<label class="col-sm-2 col-form-label">APPOINMENT DATE & TIME</label>
															<div class="col-sm-6">
																<div class="form-group">
													               <div class="input-group date" >
													                   <input type="text" class="form-control" name="appoimentDateTime" value="<?php echo $appoimentDateTime ?>" />
													                   <span class="input-group-addon" readonly>
													                       <span class="glyphicon glyphicon-calendar"></span>
													                   </span>
													               </div>
														        </div>
															</div>
														</div>
													</form>
														</div>
														<div class="modal-footer">
															<button type="submit" class="btn tckt-btn" value="" name="operation" style="display: none;">Save</button>
															<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
														</div>
													</div>
												</div>
											</div>

											<?php
								            break;
								        case "#modal-inprogress":
								           	//put html modal here ?>
								           	<!-- Modal inprogresse-->
											<div class="modal fade" id="modal-inprogress<?php echo $ticket->getTicketID(); ?>" role="dialog">
												<div class="modal-dialog">
													<!-- Modal content-->
													<form method="post" action="controller/Controller.php" autocomplete="off">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal">&times;</button>
																<h4 class="modal-title">TICKET'S DETAILS</h4>
															</div>
															<div class="modal-body">
																	<div class="form-group row">
																		<label class="col-sm-2 col-form-label">ID TICKET</label>
																		<div class="col-sm-6">
																			<input class="form-control" type="text" name="ticketID" value="<?php echo $ticket->getTicketID(); ?>" readonly>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-sm-2 col-form-label">USER ID</label>
																		<div class="col-sm-6">
																			<input class="form-control" type="text" name="userID" value="<?php echo $ticket->getUID(); ?>" readonly>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-sm-2 col-form-label">DATE & TIME</label>
																		<div class="col-sm-6">
																			<input class="form-control" type="text" name="dateTime" value="<?php echo $ticket->getDateTime(); ?>" readonly>
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
																			<textarea class="form-control" name="detail" placeholder="Description of the issue here" readonly><?php echo $ticket->getDetail() ?></textarea>
																		</div>
																	</div>

																	<!-- check here if got contractor or not-->
																	<?php 
																		//$contractorUID = $allTicket->getTicketContractor($ticket->getTicketID());
																		if ($contractorUID != 0){
																			//$appoimentDateTime = $allTicket->getAppoimentDateTime($ticket->getTicketID());
																	 ?>

																	<!-- change value to be same as DB -->
																	<div class="form-group row">
																		<label class="col-sm-2 col-form-label">STATUS</label>
																		<div class="col-sm-6">
																			<select class="form-control" id="statusIP<?php echo $ticket->getTicketID(); ?>">
																				<option hidden selected>IN PROGRESS</option>
																				<option>INCOMPLETE</option>
																				<option>POSTPONE</option>
																				<option>DONE</option>
																			</select>
																		</div>
																	</div>
																	<hr>
																	<p>CONTRACTOR'S DETAILS</p><br>
																	<div class="form-group row">
																		<label class="col-sm-2 col-form-label">COMPANY NAME</label>
																		<div class="col-sm-6">
																			<input class="form-control" type="text" name="companyNameIP" value="<?php echo $CompanyName ?>" readonly>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-sm-2 col-form-label">FULL NAME</label>
																		<div class="col-sm-6">
																			<input class="form-control" type="text" name="fullNameIP" value="<?php echo $FullName ?>" readonly>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-sm-2 col-form-label">CONTACT NO</label>
																		<div class="col-sm-6">
																			<input class="form-control" type="text" name="contactIP" value="<?php echo $Contact ?>" readonly>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-sm-2 col-form-label">APPOINMENT DATE & TIME</label>
																		<div class="col-sm-6">
																			<div class="form-group">
																	               <div class="input-group date" >
																	                   <input type="text" class="form-control" name="appoimentDateTimeIP" value="<?php echo $appoimentDateTime ?>" />
																	                   <span class="input-group-addon" readonly>
																	                       <span class="glyphicon glyphicon-calendar"></span>
																	                   </span>
																	               </div>
																	           </div>
																		</div>
																	</div>
																	<?php 
																		}
																	 ?>
															</div>
															<div class="modal-footer">
																<button type="submit" class="btn tckt-btn btn-id<?php echo $ticket->getTicketID(); ?>" value="UpdateTicketStatus" name="operation" style="display: none;">Save</button>
																<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
															</div>
														</div>
														<!-- hidden input -->
														<input class="form-control" type="hidden" name="URL" value="/PDSys/dealer_view_ticket.php" readonly>
														<input class="form-control statusIP" type="hidden" id="statusIP" name="statusIP" value="" readonly>
														<input class="form-control" type="hidden" id="uidContractorIP" name="uidContractorIP" value="<?php echo $contractorUID ?>" readonly>
													</form>
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
																<input class="form-control" type="text" name="" value="<?php echo $ticket->getUID(); ?>" readonly>
															</div>
														</div>
														<div class="form-group row">
															<label class="col-sm-2 col-form-label">DATE & TIME</label>
															<div class="col-sm-6">
																<input class="form-control" type="text" name="" value="<?php echo $ticket->getDateTime(); ?>" readonly>
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
																<textarea class="form-control" placeholder="Please describe the issue here..."></textarea>
															</div>
														</div>
														<hr>
														<p>CONTRACTOR'S DETAILS</p><br>
														<div class="form-group row">
															<label class="col-sm-2 col-form-label">COMPANY NAME</label>
															<div class="col-sm-6">
																<input class="form-control" type="text" name="uidContractor" value="" readonly>
															</div>
														</div>
														<div class="form-group row">
															<label class="col-sm-2 col-form-label">FULL NAME</label>
															<div class="col-sm-6">
																<input class="form-control" type="text" name="fullName" value="" readonly>
															</div>
														</div>
														<div class="form-group row">
															<label class="col-sm-2 col-form-label">CONTACT NO</label>
															<div class="col-sm-6">
																<input class="form-control" type="text" name="contact" value="" readonly>
															</div>
														</div>
														<div class="form-group row">
															<label class="col-sm-2 col-form-label">APPOINMENT DATE & TIME</label>
															<div class="col-sm-6">
																<div class="form-group">
														               <div class="input-group date" >
														                   <input type="text" class="form-control" name="appoimentDateTime" value="" />
														                   <span class="input-group-addon" readonly>
														                       <span class="glyphicon glyphicon-calendar"></span>
														                   </span>
														               </div>
														            </div>
															</div>
														</div>
													</form>
														</div>
														<div class="modal-footer">
															<button type="submit" class="btn tckt-btn" value="CloseTicket" name="operation" style="display: none;">Save</button>
															<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
															<!-- save button -->
														</div>
													</div>
												</div>
											</div>

								            <?php
								            break;
								    }
									}
								}
							    ?>

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
				<div class="col-sm-2">
					<div class="tckt-btn" style="margin-left: 0px">
						<a href="dealer_add_ticket.php"><button type="submit" class="btn btn-default">ADD TICKET</button></a>
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

    <script type="text/javascript">
		var selects = document.querySelectorAll('select');

		for (var i=0; i<selects.length; ++i) {
		  selects[i].addEventListener('click', clickFunc);
		}

		function clickFunc() {
		  	//alert(this.id); 
		  	var id = this.id.replace("statusIP","");
		  	//alert(id);
		  	// onselect unhide button
	  		$('#'+this.id).change(function(){
		       var stat = $(this).val();
		        if(stat != 'IN PROGRESS'){
		        	//alert(stat);
		            $('.btn-id'+id).show();
		            $('.statusIP').val(stat);
		        }
		    });
		}

		// $(function() {
		// 	$('#datetimepickerIC<?php echo $ticket->getTicketID(); ?>').datetimepicker({
		// 		format : 'YYYY-MM-DD HH:mm'
		// 	});
		// });

    </script>
</body>
</html>