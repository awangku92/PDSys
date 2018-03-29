<!DOCTYPE html>
<html>
<head>
	<title>PDagang</title>
</head>

<body>
	<form method="post" action="controller/Controller.php" autocomplete="off">
		<table border="4">
			<tr>
				<td>Username</td>
				<td><input type="text" name="username"></td>
			</tr>
			<tr>
				<td>Password</td>
				<td><input type="password" name="password"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" value="LogIn" name="operation"></td>
			</tr>	
		</table>
	</form>

	<h3>User Registration</h3>
	<form method="post" action="controller/Controller.php" autocomplete="off">
		<table border="4">
			<tr>
				<td>Type User*</td>
				<td>
					<select name="usertype">
						<option value="NULL">-Select Type-</option>
						<option value="HQ">HQ</option>
						<option value="D">Dealer</option>
						<option value="C">Constructor</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Full Name*</td>
				<td><input type="text" name="fullname"></td>
			</tr>
			<tr>
				<td>Contact No*</td>
				<td><input type="text" name="contactno"></td>
			</tr>
			<tr>
				<td>Company Name</td>
				<td><input type="text" name="companyname"></td>
			</tr>
			<tr>
				<td>Company/Branch Address*</td>
				<td><input type="text" name="compaddr1" placeholder="Address 1"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="text" name="compaddr2" placeholder="Address 2"></td>
			</tr>
			<tr>
				<td></td>
				<td>
					<select name="state">
						<option value="NULL">-Select State-</option>
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
				</td>
			</tr>
			<tr>
				<td></td>
				<td><input type="text" name="postalcode" placeholder="Postal Code"></td>
			</tr>
			<tr>
				<td></td>
				<td>
					<select name="region">
						<option value="NULL">-Select Region-</option>
						<option value="N">Northern</option>
						<option value="C">Central</option>
						<option value="S">Southern</option>
						<option value="E">East Coast</option>
						<option value="SB">Sabah</option>
						<option value="SK">Sarawak</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Username*</td>
				<td><input type="text" name="username"></td>
			</tr>		
			<tr>
				<td>Password*</td>
				<td><input type="password" name="password"></td>
			</tr>	
			<tr>
				<td></td>
				<td><input type="submit" value="Register" name="operation"></td>
			</tr>	
		</table>
	</form>	
</body>
</html>