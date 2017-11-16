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
			<div id="formArea">
				<h1 id="formTitle">Login</h1>
				<form id="loginForm" method="POST">
					<input id="formAction" type="text" name="action" hidden/>
					<table>
						<tbody id="formTableBody">
						<tr class="signup">
							<td>
								<label>Name:</label>
							</td>
							<td colspan="3">
								<input type="text" name="first" placeholder="John" />
							</td>
							<td colspan="3">
								<input type="text" name="last" placeholder="Doe" />
							</td>
						</tr>
						<tr>
							<td><label>Email:</label></td>
							<td colspan=6><input type="email" name="email" placeholder="handle@domain.com" /></td>
						</tr>
						<tr>
							<td><label>Password:</label></td>
							<td colspan=6><input type="password" name="password" placeholder="*****" /></td>
						</tr>
						<tr class="signup">
							<td><label>Confirm Password:</label></td>
							<td colspan=6><input type="password" name="passwordConfirm" placeholder="*****" /></td>
						</tr>
						<tr class="signup">
							<td><label>Address 1:</label></td>
							<td colspan=6><input type="text" name="address1" placeholder="100 West Main Street" /></td>
						</tr>
						<tr class="signup">
							<td><label>Address 2:</label></td>
							<td colspan=6><input type="text" name="address2" placeholder="Apartment #4E" /></td>
						</tr>
						<tr class="signup">
							<td><label>City, State, Zip: </label></td>
							<td colspan=4><input type="text" name="city" placeholder="Louisville" /></td>
							<td colspan=1><input type="text" name="state" placeholder="KY" pattern="[A-Za-z]{2}" size=2/></td>
							<td colspan=1><input type="text" name="zip" placeholder="40272" size=10 /></td>
						</tr>
						<tr>
							<td colspan=4>
								<input id="submitButton" type="submit" value="Login" />
							</td>
							<td colspan=4>
								<input id="signupButton" type="button" value="Sign-Up!" />
							</td>
						</tr>
						</tbody>
					</table>
				</form>
			</div>
        </div>
	<script type="text/javascript">
	//Define all element variables
	var children = document.querySelector("#formTableBody").children;
	var signupButton = document.querySelector("#signupButton");
	var submitButton = document.querySelector("#submitButton");
	var loginForm = document.querySelector("#loginForm");
	var formTitle = document.querySelector("#formTitle");
	var formAction = document.querySelector("#formAction");
	
	//Start off in login mode
	formAction.textContent = 'login';	
	
	//Listen for when someone wants to switch to sign up (Or go back)
	signupButton.addEventListener("click",signupButtonClick,false);

	//helper function, returns true if elem has klass (Class is reserved word)
	function hasClass( elem, klass ) {
     return (" " + elem.classList + " " ).indexOf( " "+klass+" " ) > -1;
	}
	
	//Called everytime button it clicked
	function signupButtonClick(){
		
		//Loop through all children
		for(var i = 0; i < children.length; i++){
			//current child
			var child = children[i];
			
			if(hasClass(child,'signup')){
				//Flip between inherit and none
				child.style.display = child.style.display==='inherit'? 'none' : 'inherit';
			}else{
				//This helps the boxes that weren't orginally hidden re-size
				repaint(child);
			}
			
		}
		
		//Flip values to reflect changed form
		if(formAction.textContent === 'login'){
		   formAction.textContent = 'signup';
		   formTitle.textContent = 'Sign-Up';
		   signupButton.value = "Returning User";
		   submitButton.value = "Create Account";
		}else{
		   formAction.textContent = 'login';
		   formTitle.textContent = 'Login';
		   signupButton.value = "Sign-Up!";
		   submitButton.value = "Login";
		}
		
		//Fix size, ext
		repaint(signupButton);
		repaint(submitButton);
	}
	
	//Helper function, makes browser re-draw to fix CSS re-size issues
	function repaint(elem){
		elem.style.display = 'none';
		elem.style.display = 'inherit';
	}	
</script>
</body>
</html>