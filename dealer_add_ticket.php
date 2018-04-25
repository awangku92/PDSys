<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="./icon/favicon_logo.ico" type="image/x-icon">
	<title>Dealer | Add ticket</title>

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
						<li class="breadcrumb-item">Dealer</li>
						<li class="breadcrumb-item"><a href="dealer_view_ticket.html"> Report / Issue</a></li>
						<li class="breadcrumb-item active"> New Ticket</li>
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
								<label class="col-sm-2 col-form-label">CATEGORY</label>
								<div class="col-sm-6">
									<select class="form-control">
										<option></option>
									</select>
								</div>
							</div>
								<div class="form-group row">
								<label class="col-sm-2 col-form-label">DETAILS</label>
								<div class="col-sm-6">
									<textarea class="form-control" placeholder="Please describe the issue here..."></textarea>
								</div>
							</div>
							
						</form>
						<div class="col-sm-8">
							<div class="tckt-btn" style="float: right;">
								<button type="submit" class="btn btn-default">SUBMIT</button>
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