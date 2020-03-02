<?php 
	
	require_once('includes/db.php');
	require_once('includes/functions.php');

	if(!isset($_COOKIE['user']))
		exit;

	$id = $_COOKIE['user'];

	$query = "SELECT email, login, pw_update, name, birth_date, sex FROM users_data WHERE id = '$id';"; 
	$result = pg_query($dbconnect, $query); 
	$result = pg_fetch_assoc($result);

	$login_info = $result['login'];
	$password_info = 'Последнее изменение '.$result['pw_update'];

	if($result['name'] === null){
		$name_info = 'Увы, но мы ничего не знаем о вашем имени';
	}else{
		$name_info = $result['name'];
	}

	if($result['birth_date'] === null){
		$birth_date = 'Увы, но мы ничего не знаем о вашем возрасте';
	}else{
		$birth_date = $result['birth_date'];
	}

	if($result['sex'] === null){
		$sex_info = 'Увы, но мы этого не знаем';
	}else{
		$sex_info = "";
	}

	$sex_val = $result['sex'];

	$email_info = $result['email'];


?>