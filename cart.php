<?php

// Include a configuration file with the database connection
include('config.php');

$cart = $_SESSION["ShoppingCart"];

// If update quantites form submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['form_num'] == 1) {
	foreach($cart as $itemnmbr => $quantity){
		$cart->updateQuantity($itemnmbr,$_POST[$itemnmbr]);
	}
}

// If order is placed
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['form_num'] == 2) {
	$shipping = $_POST['shipping'];
	$total = $_POST['total'];
	$subtotal = $_POST['subtotal'];
	$order_number = createOrder($user['userid'],round($shipping,2),round($subtotal,2),round($total,2), $database);
	
	foreach($cart as $itemnmbr => $quantity){
		addItemToOrder($order_number,$itemnmbr,$quantity,$database);
	}
	
	$_SESSION['order'] = $order_number;
	header("Location: confirmation.php");
}



?>



<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	
  	<title>Shopping Cart</title>

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
			<h1>Shopping Cart</h1>
		<form method="POST">
			<input type="hidden" name="form_num" value="1"/>
			<table>
				<tr>
					<th>
						Item
					</th>
					<th>
						Price / each
					</th>
					<th>
						Quantity
					</th>
					<th>
						Total Price
					</th>
				</tr>
			<?php $grandTotal = 0;
				foreach($cart as $itemnmbr => $quantity) : ?>
				<tr>
					<?php
						$item = getItemByItemnmbr($itemnmbr,$database);					
					?>
					<td>
						<?php echo $item['desc']; ?><br />
						<a target="_blank" href="item.php?itemnmbr=<?php echo $item['itemnmbr'] ?>">View Item</a>
					</td>
					<td>
						<?php echo "$" . $item['price']; ?>
					</td>
					<td>					
						<input name="<?php echo $item['itemnmbr']; ?>" type="number" min="0" max="99" step="1" value="<?php echo $quantity;?>"/>
					</td>
					<td>
						<?php 
						$total = $quantity * $item['price'];
						$grandTotal += $total;
						echo "$" . $total; ?>
					</td>
				</tr>
			<?php endforeach;
				$shipping = .10 * $grandTotal;				
				$subTotal = number_format($grandTotal,2);
				$grandTotal = number_format($grandTotal + $shipping,2);
				$shipping = number_format($shipping,2)
				?>
				<tr>
					<td>

					</td>
				</tr>
			</table>
			<input type="submit" value="Update Quantites">
		</form>
			<h2 style="text-align: right;">Subtotal: $<?php echo $subTotal;?></h2>
			<h2 style="text-align: right;">Shipping &amp; Handling: $<?php echo $shipping;?></h2>
			<h1 style="text-align: right;">Grand Total: $<?php echo $grandTotal;?></h1>
		<form method="post">
			<input type="hidden" name="form_num" value="2"/>
			<input type="hidden" name="subtotal" value="<?php echo $subTotal;?>"/>
			<input type="hidden" name="shipping" value="<?php echo $shipping;?>"/>
			<input type="hidden" name="total" value="<?php echo $grandTotal;?>"/>
			<input type="submit" value="Place Order"/>
		</form>
        </div>
</body>
</html>