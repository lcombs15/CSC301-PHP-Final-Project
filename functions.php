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

function getAllItems($database){
	return query('sql/getAllItems.sql', $database, null);
}


?>
