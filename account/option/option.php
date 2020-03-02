<?php 

	require_once '../../includes/db.php';
	require_once '../../includes/config.php';
	require_once '../../includes/functions.php';


	$data = $_POST;
	$id = $_COOKIE['user'];

	$json = array(
			'date' => '',
			'error' => '',
			'success' => ''
		);

	if(isset($data['login'])){

		$json['date'] = htmlspecialchars(trim($data['login']));
		$login = $json['date'];

		$login_mask = '/^[a-zA-Z0-9-_\.]+$/';

		if(preg_match_all($login_mask, $login)){

		}
		else{
			$json['error'] = "Логин может содержать только <br> символы латинского алфавита, цифры и символы -_.";
			echo json_encode($json);
			exit;
		}

		$query = "SELECT id FROM users_data WHERE login = '$login';"; 
		$result = pg_query($dbconnect, $query); 
		$result = pg_fetch_assoc($result);

		if(!empty($result)){
			$json['error'] = $json['date']." уже занят";
			echo json_encode($json);
			exit;
		}

		$query = "UPDATE users_data SET login = '$login' WHERE id = '$id';";
		$result = pg_query($dbconnect, $query); 

		if($result){
			$json['success'] = 'Ваш логин успешно изменен';
		}
		else{
			$json['error'] = "Увы, что-то пошло не так";
		}

		echo json_encode($json);
	}

	if(isset($data['password_old']) || isset($data['password_new']) ){

		$password_old = htmlspecialchars($data['password_old']);
		$password_new = htmlspecialchars($data['password_new']);

		$password_mask = '/[а-яё]/iu';

		if(preg_match_all($password_mask, $password_new)){
			$json['error'] = "Пароль может содержать только <br> символы латинского алфавита, цифры и спецсимволы";
			echo json_encode($json);
			exit;
		}

		if(strlen($password_new) < 6){
			$json['error'] = "Длина пароля не менее 6 символов";
			echo json_encode($json);
			exit;
		}

		$query = "SELECT password FROM users_data WHERE id = '$id';"; 
		$result = pg_query($dbconnect, $query); 
		$result = pg_fetch_assoc($result);

		$password_hash = $result['password'];

		if($password_hash !== md5($password_old.$str_hash)){
			$json['error'] = "Старый пароль введен неверно";
			echo json_encode($json);
			exit;
		}

		$password_new_chg = md5($password_new.$str_hash);

		$date = get_date(time(),'MM/dd/yyyy HH:mm:ss (O)');

		$query = "UPDATE users_data SET password = '$password_new_chg', pw_update = '$date' WHERE id = '$id';";
		$result = pg_query($dbconnect, $query); 

		if($result){
			$json['success'] = 'Пароль успешно изменен';
			$json['date'] = 'Последнее изменение '.$date;
		}else{
			$json['error'] = "Увы, что-то пошло не так";
			
		}

		echo json_encode($json);

	}

	if(isset($data['name'])){

		$name = htmlspecialchars($data['name']);

		$query = "UPDATE users_data SET name = '$name' WHERE id = '$id';";
		$result = pg_query($dbconnect, $query); 

		if($result){
			$json['success'] = 'Ваше имя было успешно изменено';
			$json['date'] = $name;
		}else{
			$json['error'] = "Увы, что-то пошло не так";
			
		}

		echo json_encode($json);
	}

	if(isset($data['age_day'])){

		$day = $data['age_day'];
		$month = $data['age_month'];
		$year = $data['age_year'];

		$month_text;

		$cr_year = date("Y");
		$cr_month = date("m");
		$cr_day = date("d");

		if((int)$day === 0){

			$json['error'] = 'В месяце не может быть 0 дней';
			echo json_encode($json);
			exit;

		}

		if((int)$year < $cr_year - 100){

			$json['error'] = 'Хмм, вам более 100 лет? <br> Подумайте еще';
			echo json_encode($json);
			exit;

		}

		if( (int)$year > $cr_year || ($cr_year == (int)$year && $cr_month < (int)$month) || ($cr_year == (int)$year && $cr_month == (int)$month && $cr_day < (int)$day)){
			$json['error'] = 'По нашим данным вы еще не родились <br> Подумайте еще';
			echo json_encode($json);
			exit;

		}

		switch ($month) {
			case 1:
				if((int)$day > 31){

					$json['error'] = 'В Январе не может быть более 31 дня';
					echo json_encode($json);
					exit;

				}
				$month_text = 'Января';
				break;
			case 2:
				if(($year % 4 == 0 && $year % 100 != 0) || ($year % 4 == 0 && $year % 100 == 0 && $year % 400 == 0)){
						if((int)$day > 29){

							$json['error'] = 'В Феврале не может быть более 29 дней <br> Год високосный';
							echo json_encode($json);
							exit;

						}
					}
					else{
						if((int)$day > 28){

						$json['error'] = 'В Феврале не может быть более 28 дней <br> Не високосный год';
						echo json_encode($json);
						exit;
						}
					}
					$month_text = 'Февраля';
				break;
			case 3:
				if((int)$day > 31){

					$json['error'] = 'В Марте не может быть более 31 дня';
					echo json_encode($json);
					exit;

				}
				$month_text = 'Марта';
				break;
			case 4:
				if((int)$day > 30){

					$json['error'] = 'В Апреле не может быть более 30 дней';
					echo json_encode($json);
					exit;

				}
				$month_text = 'Апреля';
				break;
			case 5:
				if((int)$day > 31){

					$json['error'] = 'В Мае не может быть более 31 дня';
					echo json_encode($json);
					exit;

				}
				$month_text = 'Мая';
				break;
			case 6:
				if((int)$day > 30){

					$json['error'] = 'В Июне не может быть более 30 дней';
					echo json_encode($json);
					exit;

				}
				$month_text = 'Июня';
				break;
			case 7:
				if((int)$day > 31){

					$json['error'] = 'В Июле не может быть более 31 дня';
					echo json_encode($json);
					exit;

				}
				$month_text = 'Июля';
				break;
			case 8:
				if((int)$day > 31){

					$json['error'] = 'В Августе не может быть более 31 дня';
					echo json_encode($json);
					exit;

				}
				$month_text = 'Августа';
				break;
			case 9:
				if((int)$day > 30){

					$json['error'] = 'В Сентябре не может быть более 30 дней';
					echo json_encode($json);
					exit;

				}
				$month_text = 'Сентября';
				break;
			case 10:
				if((int)$day > 31){

					$json['error'] = 'В Октябре не может быть более 31 дня';
					echo json_encode($json);
					exit;

				}
				$month_text = 'Октября';
				break;
			case 11:
				if((int)$day > 30){

					$json['error'] = 'В Ноябре не может быть более 30 дней';
					echo json_encode($json);
					exit;

				}
				$month_text = 'Ноября';
				break;
			case 12:
				if((int)$day > 31){

					$json['error'] = 'В Декабре не может быть более 31 дня';
					echo json_encode($json);
					exit;

				}
				$month_text = 'Декабря';
				break;
		}

		$date = $day.' '.$month_text.' '.$year;

		$query = "UPDATE users_data SET birth_date = '$date' WHERE id = '$id';";
		$result = pg_query($dbconnect, $query); 

		if($result){
			$json['date'] = $day.' '. $month_text.' '.$year;
			$json['success'] = 'Ваша дата рождения успешно изменена';
		}else{
			$json['error'] = "Увы, что-то пошло не так";
			
		}

		echo json_encode($json);
	}

	if(isset($data['sex'])){

		$sex = $data['sex'];;

		$query = "UPDATE users_data SET sex = '$sex' WHERE id = '$id';";
		$result = pg_query($dbconnect, $query); 

		if($result){
			$json['success'] = 'Ваш пол успешно изменен';
		}
		else{
			$json['error'] = "Увы, что-то пошло не так";
		}

		echo json_encode($json);

	}

	$date = get_date(time(),'MM/dd/yyyy HH:mm:ss');

	$query = "UPDATE users_data SET last_update = '$date' WHERE id = '$id';";
	$result = pg_query($dbconnect, $query); 


?>