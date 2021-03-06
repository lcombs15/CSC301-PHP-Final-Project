<?php

// Include a configuration file with the database connection
include('config.php');

//If we don't have an order, redirect home
if(!isset($_SESSION['order'])){
	header("Location: index.php");
	//Stop running code on this page
	die();
}
	
	
$order_num = $_SESSION['order'];
//Clear items out of shopping cart since user bought them
$_SESSION['ShoppingCart'] = new ShoppingCart();

?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	
  	<title>Order Confirmation</title>

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
			<h1>Thank you, <?php echo $user['first'];?>!</h1>
			<h2>Order #<?php echo $order_num;?> has been placed.</h2>
			<a target="_blank" href="invoice.php?order=<?php echo $order_num;?>"><p>View Invoice</p></a>
        </div>
</body>
</html>