<?php
error_reporting(E_ALL);
ini_set('displat_errors',1);
// Connecting to the MySQL database
	$username = "combsl10";
	$password = "sPIe3lar";
	$hostname = "csweb.hh.nku.edu";
	$schema = "db_fall17_combsl10";
	$database = new PDO('mysql:host=' . $hostname . ';dbname=' . $schema,$username,$password);
	$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
//include database functions
include ('functions.php');

//Auto load
function autoloader($class){
	include 'class.' . $class . '.php';
}

spl_autoload_register('autoloader');

// Start the session
session_start();

$current_url = basename($_SERVER['REQUEST_URI']);
$user = NULL;

if (!isset($_SESSION["userid"]) && $current_url != 'login.php') { //re-direct user if they need to login
    header("Location: login.php");
}else if(isset($_SESSION["userid"])){
	$user = getUserBySessionID($database);
}

//Initalize Shoppping Cart
if(!isset($_SESSION["ShoppingCart"])){
	$_SESSION["ShoppingCart"] = new ShoppingCart();
}