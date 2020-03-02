<?php 

	require_once '../../includes/db.php';
	require_once '../../includes/config.php';

	$user_sender_id = $_COOKIE['user'];

	$data = $_POST;
	$json = array(
		'data' => '',
		'error' => '',
		'success' => ''
	);

	if(isset($data['icon_id'])){

		$icon_id = $data['icon_id'];
		$message_id = $data['id'];

		if($icon_id == 'repeat'){

			$query = "SELECT * FROM notification WHERE message_id = '$message_id';"; 
			$result_message = pg_query($dbconnect, $query); 
			$result_message = pg_fetch_assoc($result_message);

			if($result_message){

				$query = "UPDATE notification SET valid = '0' WHERE message_id = '$message_id';";
				$result = pg_query($dbconnect, $query); 

			}else{

				$query = "SELECT user_recipient_id FROM message WHERE message_id = '$message_id';"; 
				$result_message = pg_query($dbconnect, $query); 
				$result_message = pg_fetch_assoc($result_message);

				$user_recipient_id = $result_message['user_recipient_id'];

				$query = "INSERT INTO notification ('user_recipient_id', 'message_id') VALUES ('$user_recipient_id','$message_id');"; 
				$result_message = pg_query($dbconnect, $query);

			}

			$json['success'] = 'Сообщение отправлено повторно';
		}

		if($icon_id == 'delete'){

			$query = "DELETE FROM sender WHERE message_id = '$message_id';";
			$result = pg_query($dbconnect, $query); 

			if($result){

				$query = "SELECT COUNT(*) FROM sender WHERE user_sender_id = '$user_sender_id';";
				$result = pg_query($dbconnect, $query); 
				$result = pg_fetch_assoc($result);

				$json['success'] = $result['count'];
				
			}
			else{
				$json['error'] = "Увы, что-то пошло не так";
			}

		}

	}

	echo json_encode($json);
	
?>