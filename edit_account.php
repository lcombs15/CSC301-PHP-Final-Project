<?php

// Include a configuration file with the database connection
include('config.php');

// If form submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	//Setup form variables
	$email = $_POST['email'];
	$first = $_POST['first'];
	$last = $_POST['last'];
	$address1 = $_POST['address1'];
	$address2 = $_POST['address2'];
	$city = $_POST['city'];
	$state = $_POST['state'];
	$zip = $_POST['zip'];
	
	updateUser($user['userid'], $email, $first, $last,$address1,$address2,$city,$state,$zip,$database);
	$user = getUserBySessionID($database);
	header("Location: account.php");
}

?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	
  	<title>Edit Account</title>

	<link rel="stylesheet" href="css/style.css">

	<!--[if lt IE 9]>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  	<![endif]-->
</head>
<body>
		<div id="title-bar">
				<?php
					include('navigation.php');
				?>	
        </div>
        <div id="content">
			<div id="formArea">
				<h1 id="formTitle">Edit Information</h1>
				<form id="loginForm" method="POST">
					<table>
						<tbody id="formTableBody">
						<tr>
							<td>
								<label>Name:</label>
							</td>
							<td colspan="3">
								<input required type="text" name="first" placeholder="John" value="<?php echo $user['first'];?>" />
							</td>
							<td colspan="3">
								<input required type="text" name="last" placeholder="Doe" value="<?php echo $user['last'];?>" />
							</td>
						</tr>
						<tr>
							<td><label>Email:</label></td>
							<td colspan=6><input required type="email" name="email" placeholder="handle@domain.com" value="<?php echo $user['email'];?>" /></td>
						</tr>
						<tr>
							<td><label>Address 1:</label></td>
							<td colspan=6><input required type="text" name="address1" placeholder="100 West Main Street" value="<?php echo $user['address1'];?>" /></td>
						</tr>
						<tr>
							<td><label>Address 2:</label></td>
							<td colspan=6><input type="text" name="address2" placeholder="Apartment #4E" value="<?php echo $user['address2'];?>" /></td>
						</tr>
						<tr>
							<td><label>City, State, Zip: </label></td>
							<td colspan=4><input required type="text" name="city" placeholder="Louisville" value="<?php echo $user['city'];?>" /></td>
							<td colspan=1><input required type="text" name="state" placeholder="KY" pattern="[A-Za-z]{2}" size=2 value="<?php echo $user['state'];?>"/></td>
							<td colspan=1><input required type="text" name="zip" placeholder="40272" size=10 value="<?php echo $user['zip'];?>" /></td>
						</tr>
						<tr>
							<td colspan=10>
								<input id="submitButton" type="submit" value="Update" />
							</td>
						</tr>
						</tbody>
					</table>
				</form>
			</div>
        </div>
</body>
</html>