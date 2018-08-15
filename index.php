<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="./icon/favicon_logo.ico" type="image/x-icon">
	<title>PETRONAS DAGANGAN BERHAD</title>

	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/css/alertify.min.css"/>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="./css/main.css" rel="stylesheet">

    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/alertify.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <script type="text/javascript">
	    var urlParams = new URLSearchParams(window.location.search);
	    $(function() {
	  		//(urlParams.get('status') === "error") ? alertify.error('Invalid account') : alertify.success('Register success'); //alert('Invalid account'); 
	  		if (urlParams.get('status') === "error"){
	  			alertify.error('Invalid account');
	  		} else if (urlParams.get('status') === "success"){
  				alertify.success('Register success');
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
			</div>
		</div>
	</section>

	<section class="second">
		<div class="container-fluid">
			<div class="navbar-second">
				<div class="container">
					<div>
						<form class="form-inline"  method="post" action="controller/Controller.php" autocomplete="off">
							<div class="form-group">
								<div class="input-case">
									<input type="email" class="form-control" id="email" placeholder="Email" name="emailLogin">
								</div>
							</div>
							<div class="form-group">
							    <div class="input-case">   
							    	<input type="password" class="form-control" id="password" placeholder="Password" name="passwordLogin">
							    </div>
						    </div>
						    <div class="form-group"> 
								<div class="btn-case">
									<button type="submit" class="btn btn-default btn-login" value="LogIn" name="operation">Log In</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="third">
		<div class="container-fluid">
			<div class="content-third">
				<div class="container">
					<div class="left">
						<div class="top-style"></div>
						<div class="clip-wrap">
							<div class="border-style"></div>
							<div class="clip-square shadow">
								<p class="top-text">Sign Up To Get Your</p>
								<p class="bottom-text">PROBLEM SOLVED..</p>
							</div>
						</div>
					</div>
				</div>

				<div class="container">
					<div class="right">
						<p>Create An Account</p>
						<form method="post" action="controller/Controller.php" autocomplete="off">
							<div class="input-group col-sm-3">
								<span class="input-group-addon" id="basic-addon1"><img src="./icon/icon_shake.png"></span>
								<select class="form-control user-type" id="usertype" onchange="javascript: showform();" name="usertype">
									<option value="HQ">HQ</option>
									<option value="D">Dealer</option>
									<option value="C">Contractor</option>
								</select>
							</div>

							<div id="hq">
								<div class="input-group col-sm-7">
									<span class="input-group-addon" id="basic-addon1"><img src="./icon/icon_user.png"></span>
									<input type="text" class="form-control" placeholder="Full Name" aria-describedby="basic-addon1" name="fullnameHQ">
								</div>
								<div class="input-group col-sm-7">
									<span class="input-group-addon" id="basic-addon1"><img src="./icon/icon_mail.png"></span>
									<input type="email" class="form-control" placeholder="Email" aria-describedby="basic-addon1" name="emailHQ">
								</div>
								<div class="input-group col-sm-7">
									<span class="input-group-addon" id="basic-addon1"><img src="./icon/icon_lock.png"></span>
									<input type="password" class="form-control" placeholder="Password" aria-describedby="basic-addon1" name="passwordHQ">
								</div>
								<div class="input-group col-sm-7">
									<span class="input-group-addon" id="basic-addon1"><img src="./icon/icon_tel.png"></span>
									<input type="text" class="form-control" placeholder="Contact No" aria-describedby="basic-addon1" name="contactnoHQ">
								</div>
							</div>

							<div id="dealer" style="display: none;">
								<div class="input-group col-sm-7">
									<span class="input-group-addon" id="basic-addon1"><img src="./icon/icon_user.png"></span>
									<input type="text" class="form-control" placeholder="Full Name" aria-describedby="basic-addon1" name="fullname">
								</div>
								<div class="input-group col-sm-7">
									<span class="input-group-addon" id="basic-addon1"><img src="./icon/icon_mail.png"></span>
									<input type="email" class="form-control" placeholder="Email" aria-describedby="basic-addon1" name="email">
								</div>
								<div class="input-group col-sm-7">
									<span class="input-group-addon" id="basic-addon1"><img src="./icon/icon_lock.png"></span>
									<input type="password" class="form-control" placeholder="Password" aria-describedby="basic-addon1" name="password">
								</div>
								<div class="input-group col-sm-7">
									<span class="input-group-addon" id="basic-addon1"><img src="./icon/icon_home.png"></span>
									<input type="text" class="form-control" placeholder="Branch Name" aria-describedby="basic-addon1" name="branch">
								</div>
								<div class="input-group col-sm-7">
									<span class="input-group-addon" id="basic-addon1"><img src="./icon/icon_locate.png"></span>
									<input type="text" class="form-control" placeholder="Address 1" aria-describedby="basic-addon1" name="compaddr1">
								</div>
								<div class="input-group col-sm-7">
									<span class="input-group-addon" id="basic-addon1"><img src="./icon/icon_locate.png"></span>
									<input type="text" class="form-control" placeholder="Address 2" aria-describedby="basic-addon1" name="compaddr2">
								</div>
								<div class="input-group col-sm-7">
									<span class="input-group-addon" id="basic-addon1"><img src="./icon/icon_locate1.png"></span>
									<input type="text" class="form-control" placeholder="Postal Code" aria-describedby="basic-addon1" name="postalcode">
								</div>
								<div class="input-group col-sm-7">
									<span class="input-group-addon" id="basic-addon1"><img src="./icon/icon_company.png"></span>
									<!-- <input type="text" class="form-control" placeholder="State" aria-describedby="basic-addon1" name="state"> -->
									<select class="form-control" id="state" name="state">
										<option hidden selected>-Select State-</option>
										<option value="Wilayah Persekutuan Kuala Lumpur">Wilayah Persekutuan Kuala Lumpur</option>
										<option value="Wilayah Persekutuan Labuan">Wilayah Persekutuan Labuan</option>
										<option value="Wilayah Persekutuan Putrajaya">Wilayah Persekutuan Putrajaya</option>
										<option value="Johor">Johor</option>
										<option value="Kedah">Kedah</option>
										<option value="Kelantan">Kelantan</option>
										<option value="Melaka">Melaka</option>
										<option value="Negeri Sembilan">Negeri Sembilan</option>
										<option value="Pahang">Pahang</option>
										<option value="Perak">Perak</option>
										<option value="Perlis">Perlis</option>
										<option value="Penang">Penang</option>
										<option value="Sabah">Sabah</option>
										<option value="Sarawak">Sarawak</option>
										<option value="Selangor">Selangor</option>
										<option value="Terengganu">Terengganu</option>
									</select>
								</div>
<!-- 							<div class="input-group col-sm-7">
									<span class="input-group-addon" id="basic-addon1"><img src="./icon/icon_map.png"></span>
									<select class="form-control" id="region" name="region">
										<option hidden selected>Region</option>
										<option>Northern Region</option>
										<option>Central Region</option>
										<option>Southern Region</option>
										<option>East Coast</option>
										<option>Sabah</option>
										<option>Sarawak</option>
									</select>
								</div> -->
								<div class="input-group col-sm-7">
									<span class="input-group-addon" id="basic-addon1"><img src="./icon/icon_tel.png"></span>
									<input type="text" class="form-control" placeholder="Contact No" aria-describedby="basic-addon1" name="contactno">
								</div>
							</div>

							<div id="contractor" style="display: none;">
								<div class="input-group col-sm-7">
									<span class="input-group-addon" id="basic-addon1"><img src="./icon/icon_user.png"></span>
									<input type="text" class="form-control" placeholder="Full Name" aria-describedby="basic-addon1" name="fullname">
								</div>
								<div class="input-group col-sm-7">
									<span class="input-group-addon" id="basic-addon1"><img src="./icon/icon_mail.png"></span>
									<input type="email" class="form-control" placeholder="Email" aria-describedby="basic-addon1" name="email">
								</div>
								<div class="input-group col-sm-7">
									<span class="input-group-addon" id="basic-addon1"><img src="./icon/icon_lock.png"></span>
									<input type="password" class="form-control" placeholder="Password" aria-describedby="basic-addon1" name="password">
								</div>
								<div class="input-group col-sm-7">
									<span class="input-group-addon" id="basic-addon1"><img src="./icon/icon_home.png"></span>
									<input type="text" class="form-control" placeholder="Company Name" aria-describedby="basic-addon1" name="companyname">
								</div>
								<div class="input-group col-sm-7">
									<span class="input-group-addon" id="basic-addon1"><img src="./icon/icon_locate.png"></span>
									<input type="text" class="form-control" placeholder="Address 1" aria-describedby="basic-addon1" name="compaddr1">
								</div>
								<div class="input-group col-sm-7">
									<span class="input-group-addon" id="basic-addon1"><img src="./icon/icon_locate.png"></span>
									<input type="text" class="form-control" placeholder="Address 2" aria-describedby="basic-addon1" name="compaddr2">
								</div>
								<div class="input-group col-sm-7">
									<span class="input-group-addon" id="basic-addon1"><img src="./icon/icon_locate1.png"></span>
									<input type="text" class="form-control" placeholder="Postal Code" aria-describedby="basic-addon1" name="postalcode">
								</div>
								<div class="input-group col-sm-7">
									<span class="input-group-addon" id="basic-addon1"><img src="./icon/icon_company.png"></span>
									<!-- <input type="text" class="form-control" placeholder="State" aria-describedby="basic-addon1" name="state"> -->
									<select class="form-control" id="state" name="state">
										<option hidden selected>-Select State-</option>
										<option value="Wilayah Persekutuan Kuala Lumpur">Wilayah Persekutuan Kuala Lumpur</option>
										<option value="Wilayah Persekutuan Labuan">Wilayah Persekutuan Labuan</option>
										<option value="Wilayah Persekutuan Putrajaya">Wilayah Persekutuan Putrajaya</option>
										<option value="Johor">Johor</option>
										<option value="Kedah">Kedah</option>
										<option value="Kelantan">Kelantan</option>
										<option value="Melaka">Melaka</option>
										<option value="Negeri Sembilan">Negeri Sembilan</option>
										<option value="Pahang">Pahang</option>
										<option value="Perak">Perak</option>
										<option value="Perlis">Perlis</option>
										<option value="Penang">Penang</option>
										<option value="Sabah">Sabah</option>
										<option value="Sarawak">Sarawak</option>
										<option value="Selangor">Selangor</option>
										<option value="Terengganu">Terengganu</option>
									</select>
								</div>
<!-- 							<div class="input-group col-sm-7">
									<span class="input-group-addon" id="basic-addon1"><img src="./icon/icon_map.png"></span>
									<select class="form-control" id="region" name="region">
										<option hidden selected>Region</option>
										<option>Northern Region</option>
										<option>Central Region</option>
										<option>Southern Region</option>
										<option>East Coast</option>
										<option>Sabah</option>
										<option>Sarawak</option>
									</select>
								</div> -->
								<div class="input-group col-sm-7">
									<span class="input-group-addon" id="basic-addon1"><img src="./icon/icon_tel.png"></span>
									<input type="text" class="form-control" placeholder="Contact No" aria-describedby="basic-addon1" name="contactno">
								</div>
							</div>

							<div class="input-group col-sm-7">
								<div class="submit-case">
									<!-- <button class="submit-btn" type="submit" value="Submit">REGISTER NOW</button> -->
									 <button class="submit-btn" type="submit" value="Register" name="operation">REGISTER NOW</button>
									 <!-- <input type="submit" class="submit-btn" value="Register" name="operation"> -->
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

    <!-- JavaScript -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
    
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/main.js"></script>

</body>
</html>