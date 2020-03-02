<?php
	
	session_start();
	
	require "../includes/db.php";
	require "../includes/functions.php";
	require "../includes/config.php";
	require "email.php";

	if(isset($_COOKIE['user'])){
		header("Location: ../index.php");
	}

	$login_ph = "Логин";
	$email_ph = "Email";
	$password_ph = "Пароль";
	$passwor_2_ph = "Пароль еще раз";

	$data = $_POST;

	$reg_date = time();
	$code = code_generate();
	
	$error = array(
		'login' => false,
		'email' => false,
		'password' => false,
		'password_2' => false
	);

	$login = "";
	$email = "";
	$password = "";
	$password_2 = "";

	if(isset($data['sign_up'])){

		$login = htmlspecialchars(trim($data['login']));
		$email = htmlspecialchars(trim($data['email']));
		$password = htmlspecialchars($data['password']);
		$password_2 = htmlspecialchars($data['password_2']);
	
		if(empty($login)){
			$login_ph = "Введите логин";
			$error['login'] = true;
		}
		if(empty($email)){
			$email_ph = "Введите почту";
			$error['email'] = true;
		}
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

		$login_mask = '/^[a-zA-Z0-9-_\.]+$/';

		if(preg_match_all($login_mask, $login)){

		}
		else{
			$login_ph = "Недопустимые символы";
			$error['login'] = true;
		}

		$password_mask = '/[а-яё]/iu';

		if(preg_match_all($password_mask, $password)){
			$password_ph = "Недопустимые символы";
			$error['password'] = true;
		}

		$email_mask = "/^[a-z0-9][a-z0-9\._-]*[a-z0-9]*@([a-z0-9]+([a-z0-9-]*[a-z0-9]+)*\.)+[a-z]+/i";

		if(preg_match($email_mask, $email)){

		}
		else{
			$email_ph = "Некорректная почта";
			$error['email'] = true;
		}

		if(check_errors($error) == true){
			return;
		}

		$query = "SELECT * FROM users_data WHERE login = '$login';"; 
		$result = pg_query($dbconnect, $query); 
		$result = pg_fetch_assoc($result);
		
		if(!empty($result)){
			$login_ph = "Логин уже занят";
			$error['login'] = true;
		}

		
		if(check_errors($error) == true){
			return;
		}

		$query = "SELECT * FROM users_data WHERE email = '$email';"; 
		$result = pg_query($dbconnect, $query); 
		$result = pg_fetch_assoc($result);

		if(!empty($result)){
			$email_ph = "Почта уже зарегистрирована";
			$error['email'] = true;
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
		else{
			
			$password_reg=md5($password.$str_hash);

			$date = get_date(time(),'MM/dd/yyyy HH:mm:ss (O)');
			$query = "INSERT INTO users_data (email, password, login, pw_update, last_update) VALUES ('$email', '$password_reg', '$login','$date','$date' );";
			pg_query($dbconnect, $query);

			$query = "SELECT id FROM users_data WHERE email ='".$email."';";
			$result = pg_query($dbconnect, $query);
			$result = pg_fetch_assoc($result);

			$query = "INSERT INTO users_valid (user_id, code, reg_date) VALUES ('".$result['id']."', '".$code."', '".$reg_date."');";
			pg_query($dbconnect, $query);

			$query = "SELECT id FROM users_valid WHERE user_id = (SELECT id FROM users_data WHERE email ='".$email."');"; 
			$result = pg_query($dbconnect, $query); 
			$result = pg_fetch_assoc($result);

			$id = $result['id'];

			$_SESSION['success_reg'] = true;
			$_SESSION['email'] = $email;
			$_SESSION['id'] = $id;
			$_SESSION['code'] = $code;
			$_SESSION['login'] = $login;
			

			post_email();

			pg_close($dbconnect);

		}
	}

	function check_errors($error){
		if($error['login'] || $error['email'] || $error['password'] || $error['password_2'] == true){
			return true;
		}
		else{ 
			return false;
		}
	}


?>