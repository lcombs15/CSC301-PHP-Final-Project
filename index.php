<?php

// Include a configuration file with the database connection
include('config.php');



// If search submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$term = $_POST['search'];
	$items = getAllItems($database, $term);	
}else{
	$items = getAllItems($database,NULL);
	$term = "";
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
			<br/>
			<form method="post" id="searchBar">
				<table>
					<tr>
																									<!-- Save search term when page is loaded-->
						<td><input type="text" name="search" placeholder="Search....." value="<?php echo $term; ?>"></td>
						<td><input type="submit" id="searchBarSubmit" value="Search"></td>
					</tr>
				</table>
			</form>
        </div>
        <div id="content">
				<!-- Print out all items -->
			<?php foreach($items as $item) : ?>
				<div class="listing">
					<a href="item.php?itemnmbr=<?php echo $item['itemnmbr']; ?>"><img src="images/<?php echo $item['image_path']?>.png"/></a>
					<h2><?php echo $item['desc']; ?></h2>
					<p>$<?php echo $item['price']; ?></p>
				</div>
			<?php endforeach; ?>
        </div>
</body>
</html>