<?php

// Connecting to the MySQL database
	$username = "combsl10";
	$password = "sPIe3lar";
	$hostname = "csweb.hh.nku.edu";
	$schema = "db_fall17_combsl10";
	$database = new PDO('mysql:host=' . $hostname . ';dbname=' . $schema,$username,$password);

//Auto load
function autoloader($class){
	include 'class.' . $class . '.php';
}

spl_autoload_register('autoloader');

//echo password_hash("password", PASSWORD_DEFAULT);
//echo "<br/>" . password_verify("password1","$2y$10$4Sr90T384SIm0li15s5.A.xr7Yu5Kdx.1cLaQAJCB1HxTsDKcLeJq");
/*
// Start the session
session_start();

$current_url = basename($_SERVER['REQUEST_URI']);

// if customerID is not set in the session and current URL not login.php redirect to login page
if (!isset($_SESSION["customerID"]) && $current_url != 'login.php') {
    header("Location: login.php");
}

// Else if session key customerID is set get $customer from the database
elseif (isset($_SESSION["customerID"])) {
	
	
	$sql = file_get_contents('sql/getCustomer.sql');
	$params = array(
		'customerid' => $_SESSION["customerID"]
	);
	$statement = $database->prepare($sql);
	$statement->execute($params);
	$customers = $statement->fetchAll(PDO::FETCH_ASSOC);
	$customer = new Customer($customers[0]['customerid'],$database);

}*/
?>