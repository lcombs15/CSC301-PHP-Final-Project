<?php

// Include a configuration file with the database connection
include('config.php');

$items = getAllItems($database);
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
				<?php
					include('navigation.php');
				?>		
        </div>
        <div id="content">
			<?php foreach($items as $item) : ?>
				<div class="listing">
					<img src="images/32.png"/>
					<h2><?php echo $item['desc']; ?></h2>
					<p>$<?php echo $item['price']; ?></p>
				</div>
			<?php endforeach; ?>
        </div>
</body>
</html>