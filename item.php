<?php

// Include a configuration file with the database connection
include('config.php');

$item = getItemByItemnmbr($_GET['itemnmbr'],$database);

// If form submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$cart = $_SESSION["ShoppingCart"];
	$cart->addItemQuantity($item['itemnmbr'],$_POST['quantity']);
	header('Location: cart.php');
}

?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	
  	<title><?php echo $item['desc'];?></title>

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
				<div class="listing">
					<img src="images/<?php echo $item['image_path']?>.png"/>
					<h2><?php echo $item['desc']; ?></h2>
					<p>$<?php echo $item['price']; ?></p>
				</div>
				<form method="POST" id="listingForm">
					<input type="number" name="quantity"
					min="1" max="99" step=1 value=1>
					<br/>
					<input type="submit" value="Add to Cart" />
				</form>
        </div>
</body>
</html>