<?php

function query($sqlFilePath,$database,$QueryParams){
	
	$sql = file_get_contents($sqlFilePath);
		$statement = $database->prepare($sql);
		$statement->execute($QueryParams);
	
	$results = $statement->fetchAll(PDO::FETCH_ASSOC);
	
	return $results;
}

function execute($sqlFilePath,$database,$QueryParams){
	$sql = file_get_contents($sqlFilePath);
		$statement = $database->prepare($sql);
		$statement->execute($QueryParams);
	
	return $database->lastInsertId();
}
	
function searchBooks($term, $database) {
	if (is_null($term) || strcmp($term,'') == 0){
		return array();
	}
	
	$params = array(
		'pattern' => '%' . $term . '%'
	);
	
	return query('sql/searchBooks.sql',$database,$params);
}


function get($var_key){
	return isset($_GET[$var_key])? $_GET[$var_key] : '';
}

function getUserByEmail($email, $database){
	$params = array(
		'email' => $email
		);
	return query('sql/UserInfoFromEmail.sql',$database, $params);
}

function getUserBySessionID($database){
	$params = array(
		'userid' => $_SESSION['userid']
		);
	return query('sql/getUserByID.sql',$database,$params)[0];
}

function addNewUser($email,$password_hash, $first, $last,$address1,$address2,$city,$state,$zip,$database){
	$params = array(
		'email' => $email,
		'password_hash' => $password_hash,
		'first' => $first,
		'last' => $last,
		'address1' => $address1,
		'address2' => $address2,
		'city' => $city,
		'state' => $state,
		'zip' => $zip,
		'usertype' => '1'
		);
	execute('sql/addNewUser.sql',$database,$params);
}

function getAllItems($database, $searchTerm){
	$searchTerm = str_replace(" ", "%", $searchTerm);
	$params = array(
		'searchTerm' => '%' . $searchTerm . '%'
	);
	return query('sql/getAllItems.sql', $database, $params);
}

function getItemByItemnmbr($itemnmbr,$database){
	$params = array(
		'itemnmbr' => $itemnmbr
	);
	return query('sql/getItemByItemnmbr.sql',$database,$params)[0];
}

function createOrder($customerID,$shipping,$subtotal,$total, $database){
	$params = array(
		'customer_id' => $customerID,
		'shipping' => $shipping,
		'subtotal' => $subtotal,
		'total' => $total
	);
	return execute('sql/createOrder.sql',$database,$params);
}

function addItemToOrder($order_number,$itemnmbr,$quantity,$database){
	$params = array(
		'order_number' => $order_number,
		'itemnmbr' => $itemnmbr,
		'qty' => $quantity
	);
	execute('sql/addItemToOrder.sql',$database,$params);
}

function getInvoiceHeader($order_number,$customerID, $database){
	$params = array(
		'order_number' => $order_number,
		'customer_id' => $customerID
	);
	return query('sql/getInvoiceHeader.sql',$database,$params)[0];
}

function getInvoiceDetail($order_number,$customerID,$database){
	$params = array(
		'order_number' => $order_number,
		'customer_id' => $customerID
	);
	return query('sql/getInvoiceDetail.sql',$database,$params);
}


function getOrdersByCustomer($customerID, $database){
	$params = array(
		'customer_id' => $customerID
	);
	return query('sql/getOrdersByCustomer.sql', $database,$params);
}

function updateUser($userid, $email, $first, $last,$address1,$address2,$city,$state,$zip,$database){
	$params = array(
		'email' => $email,
		'first' => $first,
		'last' => $last,
		'address1' => $address1,
		'address2' => $address2,
		'city' => $city,
		'state' => $state,
		'zip' => $zip,
		'userid' => $userid
		);
	execute('sql/updateUser.sql',$database,$params);
}
?>
