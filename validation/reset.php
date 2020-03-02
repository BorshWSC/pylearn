<?php 

	
	require '../includes/db.php';
	require "../includes/functions.php";
	require "../includes/config.php";
	
	if(!isset($_GET['id']) && !isset($_GET['code'])){
		header("Location: ../index.php");
	}

	$id = $_GET['id'];
	$reset_code = $_GET['code'];
	$error_log = "";

	$query = "SELECT code FROM users_valid WHERE user_id = '$id';"; 
	$result = pg_query($dbconnect, $query); 
	$result = pg_fetch_assoc($result);

	$code = $result['code'];

	if(empty($code)){
		$error_log = 'Срок восстановления истек';
	}elseif($reset_code != $code){
		$error_log = 'Код сброса пароля передан не верно';
	}

	$data = $_POST;

	$error = array(
		'password' => false,
		'password_2' => false
	);

	$password = "";
	$password_2 = "";

	$success = "";

	$password_ph = "Введите новый пароль";
	$passwor_2_ph = "Введите пароль еще раз";

	if(isset($data['reset'])){	

		$password = htmlspecialchars($data['password']);
		$password_2 = htmlspecialchars($data['password_2']);

		if(empty($password)){
			$password_ph = "Введите пароль";
			$error['password'] = true;
		}
		if(empty($password_2)){
			$passwor_2_ph = "Введите пароль повторно";
			$error['password_2'] = true;
		}

		if(check_errors($error) == true){
			return;
		}

		$password_mask = '/[а-яё]/iu';

		if(preg_match_all($password_mask, $password)){
			$password_ph = "Недопустимые символы";
			$error['password'] = true;
		}

		if(check_errors($error) == true){
			return;
		}


		if(strlen($password) < 6){
			$error['password'] = true;
			$password_ph = "Длина пароля не менее 6 символов";
		}

		if(check_errors($error) == true){
			return;
		}

		if(strcmp($password,$password_2) !== 0){
			$error['password_2'] = true;
			$passwor_2_ph = "Пароли не совпадают";
		}

		if(check_errors($error) == true){
			return;
		}

		$query = "SELECT password FROM users_data WHERE id = '$id';"; 
		$result = pg_query($dbconnect, $query); 
		$result = pg_fetch_assoc($result);

		$password_reset = md5($password.$str_hash);

		if($password_reset == $result['password']){
			$error['password'] = true;
			$password_ph = "Совпадает со старым паролем";
		}

		if(check_errors($error) == true){
			return;
		}

		$pw_update = get_date(time(), 'MM/dd/yyyy HH:mm:ss (O)');

		$query = "UPDATE users_data SET password = '$password_reset', pw_update = '$pw_update' WHERE id = '$id';"; 
		$result = pg_query($dbconnect, $query); 

		if($result){
			$success = "Пароль успешно изменен<br> Через несколько секунд вы будете перенаправлены<br> на страницу авторизации";
			echo '<script>setTimeout( function(){window.location.replace("authForm.php")}, 3000)</script>';
		}else{
			$error_log = 'Увы, что то пошло не так';
		}

		pg_close($dbconnect);

	}

	

	function check_errors($error){
		if($error['password'] || $error['password_2'] == true){
			return true;
		}
		else{ 
			return false;
		}
	}

?>