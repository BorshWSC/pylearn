<?php 

	require_once '../../includes/db.php';
	require_once '../../includes/config.php';

	$user_sender_id = $_COOKIE['user'];

	$data = $_POST;
	$json = array(
		'data' => '',
		'error' => '',
		'success' => '',
		'error_login' => '',
		'error_title' => ''
	);

	if(isset($data['login']) && !empty($data['message_content'])){

		$login = htmlspecialchars($data['login']);
		$title = htmlspecialchars($data['title']);
		$text = nl2br(htmlspecialchars($data['message_content'], ENT_QUOTES, 'UTF-8'));

		$query = "SELECT id FROM users_data WHERE login = '$login';"; 
		$result = pg_query($dbconnect, $query); 
		$result = pg_fetch_assoc($result);

		if(empty($result)){
			$json['error_login'] = "Пользователя с таким логином не существует";
			echo json_encode($json);
			exit;
		}

		$user_recipient_id = $result['id'];

		if($user_recipient_id == $user_sender_id){
			$json['error_login'] = "Вы уверены, что хотите отравить самому себе сообщение?<br> Если вы хотите сохранить для себя какую либо информацию, то пожалуйста воспользуйтесь заметками.";
			echo json_encode($json);
			exit;
		}

		$date = time();

		$query = "INSERT INTO sender (user_sender_id) VALUES ('$user_sender_id')";
		$result = pg_query($dbconnect, $query); 

		$query = "SELECT MAX(message_id) as message_id FROM sender WHERE user_sender_id = '$user_sender_id' ;"; 
		$result = pg_query($dbconnect, $query); 
		$result = pg_fetch_assoc($result);

		$message_id = $result['message_id'];

		$query = "INSERT INTO message (message_id, user_recipient_id, user_sender_id, title, "." text, date ".") VALUES ($message_id,'$user_recipient_id', '$user_sender_id', '$title', '$text', '$date')";
		$result = pg_query($dbconnect, $query); 

		$query = "INSERT INTO notification (user_recipient_id, message_id) VALUES 
		('$user_recipient_id', '$message_id')";
		$result = pg_query($dbconnect, $query); 

		if($result){

			$json['success'] = "Сообщение успешно отправлено";

		}
		else{
			$json['error'] = "Увы что-то пошло не так";
			echo json_encode($json);
			exit;
		}

	}
	else{
		$json['error'] = "Пожалуйста, введите сообщение";
	}

	echo json_encode($json);
	
?>