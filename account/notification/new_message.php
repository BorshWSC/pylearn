<?php 

	require_once '../../includes/db.php';
	require_once '../../includes/config.php';


	$data = $_POST;
	$json = array(
		'data' => '',
		'error' => '',
		'success' => ''
	);

	if(isset($data['icon_id'])){

		$icon_id = $data['icon_id'];
		$id = $data['id'];

		if($icon_id === 'delete'){

			$query = "DELETE FROM notification WHERE message_id = '$id';";
			$result = pg_query($dbconnect, $query); 

			if($result){

				$query = "SELECT COUNT(*) FROM notification WHERE message_id = '$id';";
				$result = pg_query($dbconnect, $query); 
				$result = pg_fetch_assoc($result);

				$json['success'] = $result['count'];
				
			}
			else{
				$json['error'] = "Увы, что-то пошло не так";
			}

			echo json_encode($json);
		}
	
		if($icon_id === 'chosen'){

			$query = "SELECT chosen FROM notification WHERE message_id = '$id';"; 
			$result = pg_query($dbconnect, $query); 
			$result = pg_fetch_assoc($result);

			$chosen;

			if($result['chosen'] == 0){
				$chosen = 1;
				$json['success'] = 'Добавлено в избранное';
			}
			else{
				$chosen = 0;
				$json['success'] = 'Убрано из избранного';
			} 

			$query = "UPDATE notification SET chosen = '$chosen' WHERE message_id = '$id';";
			$result = pg_query($dbconnect, $query); 

			if($result ){

			}
			else{
				$json['error'] = "Увы, что-то пошло не так";
			}

			echo json_encode($json);

		}

		if($icon_id === 'read'){

			$query = "UPDATE notification SET valid = '1' WHERE message_id = '$id';";
			$result = pg_query($dbconnect, $query);

			if($result){
				$json['success'] = 'Отмечено как прочитанное. Вы всегда сможете найти это сообщение во вкладке история';
			}
			else{
				$json['error'] = "Увы, что-то пошло не так";
			}

			echo json_encode($json);

		}

	}

	
?>