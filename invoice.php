	<?php

// Include a configuration file with the database connection
include('config.php');

function redirect(){
	header("Location: index.php");
	die();
}

if(!isset($_GET['order'])){
	redirect();
}

$invoice_number = $_GET['order'];

$invoice_header = getInvoiceHeader($invoice_number,$user['userid'], $database);
$invoice_detail = getInvoiceDetail($invoice_number,$user['userid'], $database);

if($invoice_header == null){
	redirect();
}


?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	
  	<title>Invoice #<?php echo $invoice_number;?></title>

	<link rel="stylesheet" href="css/invoice.css">
	<link rel="stylesheet" href="css/print.css" media="print">

	<!--[if lt IE 9]>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  	<![endif]-->
</head>
<body>
		<table>
			<tr>
				<td colspan=10>
					<a href="index.php"><img src="images/Logo.png"/></a>
					<p>Screns R-us LLC | Highland Heights, KY</p>
					<h1>Invoice</h1>
					<div id="billto">
						<h2>Bill to:</h2>
						<p>
							<?php
								$address2 = $user['address2']==null? "" : $user['address2'] . "<br/>";

								echo $user['first'] . " " . $user['last'] . "<br/>";
								echo $user['address1'] . "<br/>";
								echo $address2;
								echo $user['city'] . ", " . $user['state'] . " " . $user['zip'];
							?>
						</p>
					</div>
					<div id="shipto">
						<h2>Ship to:</h2>
						<p>
							<?php
								$address2 = $invoice_header['address2']==null? "" : $invoice_header['address2'] . "<br/>";

								echo $user['first'] . " " . $user['last'] . "<br/>";
								echo $invoice_header['address1'] . "<br/>";
								echo $address2;
								echo $invoice_header['city'] . ", " . $invoice_header['state'] . " " . $invoice_header['zip'];
							?>
						</p>
					</div>
				</td>
			</tr>
			<tr>
				<th>Item #</th>
				<th>Description</th>
				<th>Quantity</th>
				<th>Price/each</th>
				<th>Total</th>
			</tr>
			<?php foreach($invoice_detail as $item): ?>
			<tr>
				<td><a target="_blank" href="item.php?itemnmbr=<?php echo $item['itemnmbr'];?>"><?php echo $item['itemnmbr'];?></a></td>
				<td><a target="_blank" href="item.php?itemnmbr=<?php echo $item['itemnmbr'];?>"><?php echo $item['desc'];?></a></td>
				<td><?php echo $item['qty'];?></td>
				<td>$<?php echo number_format($item['price_each'],2);?></td>
				<td class="total">$<?php echo number_format($item['line_total'],2);?></td>
			</tr>
			<?php endforeach; ?>
			<tr class="filler">
				<td colspan="10">
				</td>
			</tr>
			<tr class="total">
				<td colspan="4">
					Shipping &amp; Handling:
				</td>
				<td>
					$<?php echo number_format($invoice_header["shipping"],2);?>
				</td>
			</tr>
			<tr class="total">
				<td colspan="4">
					Subtotal:
				</td>
				<td>
					$<?php echo number_format($invoice_header["subtotal"],2);?>
				</td>
			</tr>
			<tr class="total">
				<td colspan="4">
					Grand Total:
				</td>
				<td>
					$<?php echo $invoice_header["total"];?>
				</td>
			</tr>
		</table>
</body>
</html>