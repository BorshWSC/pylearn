<?php 
	
	session_start();

	require "../includes/db.php";
	require "../includes/config.php";
	require "../includes/functions.php";
	require "email.php";

	if(isset($_COOKIE['user'])){
		header("Location: ../index.php");
	}

	$reg_info_ph = "Введите логин или email";

	$data = $_POST;

	$error = array(
		'reg_info' => false
	);

	$reg_info = '';

	if(isset($data['recover'])){

		$reg_info = htmlspecialchars(trim($data['reg_info']));

		if(empty($reg_info)){
			$reg_info_ph = "Введите почту или логин";
			$error['reg_info'] = true;
		}

		if(check_errors($error) == true){
			return;
		}

		$query = "SELECT id, email FROM users_data WHERE email = '$reg_info' OR login = '$reg_info';";
		$result = pg_query($dbconnect, $query); 
		$result = pg_fetch_assoc($result);

		$email_mask = "/^[a-z0-9][a-z0-9\._-]*[a-z0-9]*@([a-z0-9]+([a-z0-9-]*[a-z0-9]+)*\.)+[a-z]+/i";
		if(preg_match($email_mask, $reg_info)){
			if(empty($result)){
				$reg_info_ph = "Email не существует";
				$error['reg_info'] = true;
			}
		}
		else{
			if(empty($result)){
				$reg_info_ph = "Login не существует";
				$error['reg_info'] = true;
			}
		}

		if(check_errors($error) == true){
			return;
		}

		$user_id = $result['id'];
		$code = code_generate();
		$email = $result['email'];

		$query = "UPDATE users_valid SET code = '$code' WHERE user_id = '$user_id';";
		$result = pg_query($dbconnect, $query);

		$_SESSION['id'] = $user_id;
		$_SESSION['code'] = $code;
		$_SESSION['email'] = $email;

		post_email('rec');

		pg_close($dbconnect);

	}

	function check_errors($error){
		if($error['reg_info']){
			return true;
		}
		else{ 
			return false;
		}
	}

?>