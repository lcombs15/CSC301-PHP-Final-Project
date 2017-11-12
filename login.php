<?php

// Include a configuration file with the database connection
include('config.php');

// If form submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// Get username and password from the form as variables
	$email = $_POST['email'];
	$password = $_POST['password'];
	
	// Query users that have this email
	$users = getUserByEmail($email,$database);
	
	// If $users is not empty
	if(!empty($users)) {
		// Set $user equal to the first result of $users
		$user = $users[0];
		if(password_verify($password,$user['password_hash'])){			
			// Set a session variable with a key of userID for given user
			$_SESSION['userid'] = $user['userid'];
			
			// Redirect to the index.php file
			header('location: index.php');	
			}
		}
	}

?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	
  	<title>Home</title>

	<link rel="stylesheet" href="css/style.css">

	<!--[if lt IE 9]>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  	<![endif]-->
</head>
<body>
		<div id="title-bar">
			<img src="images/Logo.png"/>
			<div id="nav-bar">
				<?php
					include('navigation.php');
					 ?>
			</div>
        </div>
        <div id="content">
			<div id="left">
			<h1>Login</h1>
			<form method="POST">
				<input type="text" name="email" placeholder="Email" /><br/>
				<input type="password" name="password" placeholder="Password" /><br/>
				<input type="submit" value="Log In" />
			</form>
			</div>
			<div id="right">
				<h1>Sign Up</h1>
				<form method="POST">
					<input type="text" name="email" placeholder="Email" /><br/>
					<input type="password" name="password" placeholder="Password" /><br/>
					<input type="submit" value="Sign Up" />
				</form>
			</div>
        </div>
</body>
</html>