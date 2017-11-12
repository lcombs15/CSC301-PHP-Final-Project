<?php

function query($sqlFilePath,$database,$QueryParams){
	
	$sql = file_get_contents($sqlFilePath);
		$statement = $database->prepare($sql);
		$statement->execute($QueryParams);
	
	$results = $statement->fetchAll(PDO::FETCH_ASSOC);
	
	return $results;
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



?>
