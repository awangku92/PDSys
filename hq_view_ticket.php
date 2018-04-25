<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="./icon/favicon_logo.ico" type="image/x-icon">
	<title>HQ | View ticket</title>

	<!-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
	<link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/font-awesome.min.css" rel="stylesheet">
    <link href="./css/main.css" rel="stylesheet">
    <script type="text/javascript" src="./js/date_time.js"></script>
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
						<li><a href=""><i class="fa fa-user"></i> User Name</a></li>
						<li><a href=""><i class="fa fa-folder badge1" data-badge="13"></i>	Message Notification</a></li>
						<li><button type="submit" class="btn btn-default btn-logout"><i class="fa fa-sign-out fa-rotate-270"></i> Log Out</button></li>
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
						      <tr id="incomplete" data-toggle="modal" data-target="#modal-incomplete">
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
						      </tr>
						    </tbody>
						</table>
					</div>
				</div>

				<!-- Modal incomplete-->
				<div class="modal fade" id="modal-incomplete" role="dialog">
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
											<input class="form-control" type="text" name="" value="PTRNS0261" readonly>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">USER ID</label>
										<div class="col-sm-6">
											<input class="form-control" type="text" name="" value="DLR995511" readonly>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">DATE & TIME</label>
										<div class="col-sm-6">
											<input class="form-control" type="text" name="" value="19 April 2018, 17:00:16" readonly>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">STATUS</label>
										<div class="col-sm-6">
											<input class="form-control" type="text" name="" value="INCOMPLETE" readonly>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">BRANCH</label>
										<div class="col-sm-6">
											<input class="form-control" type="text" name="" value="BRANCH" readonly>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">CATEGORY</label>
										<div class="col-sm-6">
											<input class="form-control" type="text" name="" value="CATEGORY" readonly>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">DETAILS</label>
										<div class="col-sm-6">
											<textarea class="form-control" placeholder="Describe the issue here" readonly></textarea>
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
											<input class="form-control" type="text" name="" placeholder="Company Name" readonly>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">FULL NAME</label>
										<div class="col-sm-6">
											<input class="form-control" type="text" name="" value="SAMAD BIN AHMAD" readonly>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">CONTACT NO</label>
										<div class="col-sm-6">
											<input class="form-control" type="text" name="" value="012-1592654" readonly>
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

				<!-- Modal Done-->
				<div class="modal fade" id="modal-done" role="dialog">
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
											<input class="form-control" type="text" name="" value="PTRNS0261" readonly>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">USER ID</label>
										<div class="col-sm-6">
											<input class="form-control" type="text" name="" value="DLR995511" readonly>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">DATE & TIME</label>
										<div class="col-sm-6">
											<input class="form-control" type="text" name="" value="19 April 2018, 17:00:16" readonly>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">STATUS</label>
										<div class="col-sm-6">
											<select class="form-control">
												<option>DONE</option>
												<option>CLOSE</option>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">BRANCH</label>
										<div class="col-sm-6">
											<input class="form-control" type="text" name="" value="BRANCH" readonly>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">CATEGORY</label>
										<div class="col-sm-6">
											<input class="form-control" type="text" name="" value="CATEGORY" readonly>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">DETAILS</label>
										<div class="col-sm-6">
											<textarea class="form-control" placeholder="Describe the issue here" readonly></textarea>
										</div>
									</div>
									<hr>
									<p>CONTRACTOR'S DETAILS</p><br>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">COMPANY NAME</label>
										<div class="col-sm-6">
											<input class="form-control" type="text" name="" placeholder="Company Name" readonly>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">FULL NAME</label>
										<div class="col-sm-6">
											<input class="form-control" type="text" name="" value="SAMAD BIN AHMAD" readonly>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">CONTACT NO</label>
										<div class="col-sm-6">
											<input class="form-control" type="text" name="" value="012-1592654" readonly>
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

				<!-- Modal postpone-->
				<div class="modal fade" id="modal-postpone" role="dialog">
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
											<input class="form-control" type="text" name="" value="PTRNS0261" readonly>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">USER ID</label>
										<div class="col-sm-6">
											<input class="form-control" type="text" name="" value="DLR995511" readonly>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">DATE & TIME</label>
										<div class="col-sm-6">
											<input class="form-control" type="text" name="" value="19 April 2018, 17:00:16" readonly>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">STATUS</label>
										<div class="col-sm-6">
											<input class="form-control" type="text" name="" value="POSTPONE" readonly>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">BRANCH</label>
										<div class="col-sm-6">
											<input class="form-control" type="text" name="" value="BRANCH" readonly>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">CATEGORY</label>
										<div class="col-sm-6">
											<input class="form-control" type="text" name="" value="CATEGORY" readonly>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">DETAILS</label>
										<div class="col-sm-6">
											<textarea class="form-control" placeholder="Describe the issue here" readonly></textarea>
										</div>
									</div>
									<hr>
									<p>CONTRACTOR'S DETAILS</p><br>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">COMPANY NAME</label>
										<div class="col-sm-6">
											<input class="form-control" type="text" name="" placeholder="Company Name" readonly>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">FULL NAME</label>
										<div class="col-sm-6">
											<input class="form-control" type="text" name="" value="SAMAD BIN AHMAD" readonly>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">CONTACT NO</label>
										<div class="col-sm-6">
											<input class="form-control" type="text" name="" value="012-1592654" readonly>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">APPOINMENT DATE & TIME</label>
										<div class="col-sm-6">
											<input class="form-control" type="date" name="">
										</div>
										<div class="col-sm-6">
											<input class="form-control" type="time" name="">
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

				<!-- Modal inprogress-->
				<div class="modal fade" id="modal-inprogress" role="dialog">
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
											<input class="form-control" type="text" name="" value="PTRNS0261" readonly>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">USER ID</label>
										<div class="col-sm-6">
											<input class="form-control" type="text" name="" value="DLR995511" readonly>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">DATE & TIME</label>
										<div class="col-sm-6">
											<input class="form-control" type="text" name="" value="19 April 2018, 17:00:16" readonly>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">STATUS</label>
										<div class="col-sm-6">
											<input class="form-control" type="text" name="" value="IN PROGRESS" readonly>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">BRANCH</label>
										<div class="col-sm-6">
											<input class="form-control" type="text" name="" value="BRANCH" readonly>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">CATEGORY</label>
										<div class="col-sm-6">
											<input class="form-control" type="text" name="" value="CATEGORY" readonly>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">DETAILS</label>
										<div class="col-sm-6">
											<textarea class="form-control" placeholder="Describe the issue here" readonly></textarea>
										</div>
									</div>
									<hr>
									<p>CONTRACTOR'S DETAILS</p><br>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">COMPANY NAME</label>
										<div class="col-sm-6">
											<input class="form-control" type="text" name="" placeholder="Company Name">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">FULL NAME</label>
										<div class="col-sm-6">
											<input class="form-control" type="text" name="" value="SAMAD BIN AHMAD" readonly>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">CONTACT NO</label>
										<div class="col-sm-6">
											<input class="form-control" type="text" name="" value="012-1592654" readonly>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">APPOINMENT DATE & TIME</label>
										<div class="col-sm-6">
											<input class="form-control" type="date" name="">
										</div>
										<div class="col-sm-6">
											<input class="form-control" type="time" name="">
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