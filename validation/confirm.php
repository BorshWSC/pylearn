<?php 

	require '../includes/db.php';

	if(!isset($_GET['id']) && !isset($_GET['code'])){
		header("Location: ../index.php");
	}

	$id = $_GET['id'];
	$confirm_code = $_GET['code'];
	$error = "";

	$query = "SELECT code FROM users_valid WHERE id = '$id';"; 
	$result = pg_query($dbconnect, $query); 
	$result = pg_fetch_assoc($result);

	$code = $result['code'];

	if(empty($code)){
		$error = 'Срок подтверждения истек';
	}elseif($confirm_code != $code){
		$error = 'Код подтверждения передан не верно';
	}

	if(!empty($error)){
		
	}else{
		$query = "UPDATE users_data SET valid = true WHERE id = 
		(SELECT user_id FROM users_valid WHERE id = '$id')";
		$result = pg_query($dbconnect, $query); 
	}

	pg_close($dbconnect);

?>