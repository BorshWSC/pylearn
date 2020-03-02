<?php

	require "../includes/db.php";
	require "../includes/config.php";

	if(isset($_COOKIE['user'])){
		header("Location: ../index.php");
	}

	$reg_info_ph = "Логин или Email";
	$password_ph = "Пароль";

	$data = $_POST;

	$error = array(
		'reg_info' => false,
		'password' => false
	);

	$reg_info = "";
	$password = "";

	if(isset($data['sign_in'])){

		$reg_info = htmlspecialchars(trim($data['reg_info']));
		$password = htmlspecialchars($data['password']);

		if(empty($reg_info)){
			$reg_info_ph = "Введите почту или логин";
			$error['reg_info'] = true;
		}
		if(empty($password)){
			$password_ph = "Введите пароль";
			$error['password'] = true;
		}

		if(check_errors($error) == true){
			return;
		}

		$query = "SELECT * FROM users_data WHERE email = '$reg_info' OR login = '$reg_info';"; 
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

		if($result['valid'] == 'f'){
			$reg_info_ph = "Почта не подтверждена";
			$error['reg_info'] = true;
		}

		if(check_errors($error) == true){
			return;
		}


		if(md5($password.$str_hash) !== $result['password']){
			$password_ph = "Неверный пароль";
			$error['password'] = true;
		}

		if(check_errors($error) == true){
			return;
		}

		pg_close($dbconnect);

		setcookie('user',$result['id'],time() + 60*60*24*7, "/");	

		header("Location: /home.php");

	}


	function check_errors($error){
		if($error['reg_info'] ||  $error['password']){
			return true;
		}
		else{ 
			return false;
		}
	}
?>