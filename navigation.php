<div id="nav-bar">
	<h2 id="welcomeMessage" <?php if(!isset($user['first'])){ echo "hidden"; } ?>>Welcome, <?php echo $user['first'];?>!</h2>
	<img src="images/Logo.png"/>
	<ul>
		<li><a href="index.php">Home</a></li>
		<li><a href="account.php"><?php 
			if(isset($_SESSION['userid'])){
				echo "My Account";
			}else{
				echo "Login / Signup";
			}
			?></a></li>
		<li <?php if(!isset($_SESSION['userid'])){
				echo "hidden";
			}?>><a href='logout.php'>Logout</a></li>
		
		<li><a href="cart.php">Shopping Cart</a></li>
	</ul>
</div>