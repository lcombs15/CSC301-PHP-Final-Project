<?php

// Include a configuration file with the database connection
include('config.php');
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	
  	<title>My Account</title>

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
			<img src="images/32.png"/>
        </div>
</body>
</html>