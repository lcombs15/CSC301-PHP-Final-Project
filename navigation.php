<ul>
	<li><a href="index.php">Home</a></li>
	<li><a href="">Link</a></li>
	<li><a href="">Link</a></li>
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
</ul>