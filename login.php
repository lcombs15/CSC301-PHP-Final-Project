<?php

// Include a configuration file with the database connection
include('config.php');

// If form submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	//Setup login variables
	$email = $_POST['email'];
	$password = $_POST['password'];
	$action = $_POST['action'];
	
	if($action == 'signup'){
		//Setup signup variables
		$first = $_POST['first'];
		$last = $_POST['last'];
		$address1 = $_POST['address1'];
		$address2 = $_POST['address2'];
		$city = $_POST['city'];
		$state = $_POST['state'];
		$zip = $_POST['zip'];
		$action = $_POST['action'];

		//Add user to database
		addNewUser($email,password_hash($password,PASSWORD_DEFAULT), $first, $last,$address1,$address2,$city,$state,$zip,$database);
				
	}else{ //Normal Login
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
				<!-- Include Nav-->
				<?php
					include('navigation.php');
				?>	
        </div>
        <div id="content">
			<div id="formArea">
				<h1 id="formTitle">Login</h1>
				<!-- Form one, for login only-->
				<form id="loginForm" method="POST">
					<input type="text" name="action"  value="login" hidden/>
					<table>
						<tbody class="formTableBody">
							<tr>
								<td><label>Email:</label></td>
								<td colspan=6><input required type="email" name="email" placeholder="handle@domain.com" /></td>
							</tr>
							<tr>
								<td><label>Password:</label></td>
								<td colspan=6><input required type="password" name="password" placeholder="*****" /></td>
							</tr>
							<tr>
								<td colspan=4>
									<input type="submit" value="Login" />
								</td>
								<td colspan=4>
									<input id="showSignUp" type="button" value="Sign-up!" />
								</td>
							</tr>
						</tbody>
					</table>
				</form>
				<!-- Form 2, for sign-up only-->
				<form id="signupForm" method="POST" hidden>
					<input type="text" name="action" value="signup" hidden/>
					<table>
						<tbody class="formTableBody">
						<tr>
							<td>
								<label>Name:</label>
							</td>
							<td colspan="3">
								<input required type="text" name="first" placeholder="John" />
							</td>
							<td colspan="3">
								<input required type="text" name="last" placeholder="Doe" />
							</td>
						</tr>
						<tr>
							<td><label>Email:</label></td>
							<td colspan=6><input required type="email" name="email" placeholder="handle@domain.com" /></td>
						</tr>
						<tr>
							<td><label>Password:</label></td>
							<td colspan=6><input required id="password" type="password" name="password" placeholder="*****" /></td>
						</tr>
						<tr>
							<td><label>Confirm Password:</label></td>
							<td colspan=6><input required id="password_verify" type="password" name="passwordConfirm" placeholder="*****" /></td>
						</tr>
						<tr>
							<td><label>Address 1:</label></td>
							<td colspan=6><input required type="text" name="address1" placeholder="100 West Main Street" /></td>
						</tr>
						<tr>
							<td><label>Address 2:</label></td>
							<td colspan=6><input type="text" name="address2" placeholder="Apartment #4E" /></td>
						</tr>
						<tr>
							<td><label>City, State, Zip: </label></td>
							<td colspan=4><input required type="text" name="city" placeholder="Louisville" /></td>
							<td colspan=1><input required type="text" name="state" placeholder="KY" pattern="[A-Za-z]{2}" size="2" /></td>
							<td colspan=1><input required type="text" name="zip" placeholder="40272" size=10 /></td>
						</tr>
						<tr>
							<td colspan=4>
								<input id="signupSubmitButton" type="submit" value="Create Account" />
							</td>
							<td colspan=4>
								<input id="showLogin" type="button" value="Exisiting User" />
							</td>
						</tr>
						</tbody>
					</table>
				</form>
			</div>
        </div>
	<script type="text/javascript">
	//Define all element variables
	var showLoginButton = document.querySelector("#showLogin");
	var showSignUpButton = document.querySelector("#showSignUp");
	var signupForm = document.querySelector("#signupForm");
	var loginForm = document.querySelector("#loginForm");
	var signupSubmitButton = document.querySelector("#signupSubmitButton");
	var password = document.querySelector("#password");
	var password_verify = document.querySelector("#password_verify");
	var formTitle = document.querySelector("#formTitle");
	
	
		
	//Listen for when someone wants to switch forms
	showSignUpButton.addEventListener("click",showSignUp,false);	
	showLoginButton.addEventListener("click",showLogin,false);	
	password_verify.addEventListener("change",password_match,false);
	password.addEventListener("change",password_match,false);

	function showSignUp(){
		loginForm.hidden = true;
		signupForm.hidden = false;
		formTitle.textContent = "Sign-up";
	}
		
	function showLogin(){		
		loginForm.hidden = false;
		signupForm.hidden = true;
		formTitle.textContent = "Login";
	}		
	
	//Make sure user has passwords that match
	function password_match(){
		if(password.value === password_verify.value){
			signupSubmitButton.disabled = false;
			signupSubmitButton.value = "Create Account";
		}else{
			signupSubmitButton.disabled = true;
			signupSubmitButton.value = "Passwords do not match!";
		}	
	}
</script>
</body>
</html>