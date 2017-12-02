<?php

// Include a configuration file with the database connection
include('config.php');

//Pull customer order history
$orders = getOrdersByCustomer($user['userid'], $database);

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
			<div id="nav-bar">
				<!-- Include Nav-->
				<?php
					include('navigation.php');
					 ?>
			</div>
        </div>
        <div id="content" class="accountInfo">
			<h1>My Account</h1>
			<p>
				<!-- Print out user info-->				
				<?php
					$address2 = $user['address2']==null? "" : $user['address2'] . "<br/>";

					echo $user['first'] . " " . $user['last'] . "<br/>";
					echo $user['address1'] . "<br/>";
					echo $address2;
					echo $user['city'] . ", " . $user['state'] . " " . $user['zip'] . "<br/>";
					echo $user['email'];
				?>
				<br/>
				<a href="edit_account.php">Edit your information</a>
			</p>
			<br/>
			<br/>
				<!-- Print order history-->
			<h1>Order History</h1>
				<?php foreach($orders as $order): ?>
				<div class="listing">
					<a target="_blank" href="invoice.php?order=<?php echo $order['order_number'];?>"> &#35;<?php echo $order['order_number'] . " | " . $order['order_date'];?></a>
				</div>
				<?php endforeach; ?>
        </div>
</body>
</html>