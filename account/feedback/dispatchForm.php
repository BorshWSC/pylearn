<?php 

	require_once 'includes/db.php';
	require_once 'includes/config.php';

	$id = $_COOKIE['user']; 

	$query = "SELECT * FROM sender WHERE user_sender_id = '$id';"; 
	$result = pg_query($dbconnect, $query); 

	$result_array = array();

	$i = 0;
	while($row = pg_fetch_assoc($result)){
		$result_array[$i] = $row;
		$i++;
	}
?>

<div class="tabcontent-feedback" id="dispatch">
		
		<?php 
		if(empty($result_array)){

			?>
			<div class="message__empty">
				<p>История пуста</p>
			</div>
			<?php

		}
		else{

			foreach ($result_array as $value) : 

			$message_id = $value['message_id'];

			$query = "SELECT * FROM message WHERE message_id = '$message_id';"; 
			$result_message = pg_query($dbconnect, $query); 
			$result_message = pg_fetch_assoc($result_message);

			$user_recipient_id = $result_message['user_recipient_id'];

			$query = "SELECT login FROM users_data WHERE id = '$user_recipient_id';"; 
			$result_login = pg_query($dbconnect, $query); 
			$result_login = pg_fetch_assoc($result_login);

			?>

		<div class="dispatch" id="<?= $message_id ?>">
			<div class="message__fonts">
				<i class="fas fa-redo-alt" id="repeat"></i>
				<i class="fas fa-trash" id="delete"></i>
			</div>
			<div class="message__inner">
				<div class="message__info">
					<div class="message__info__date">
						<p><?= get_date($result_message['date'],'MM/dd/yyyy') ?></p>
					</div>
					<div class="message__info__status">
						<p></p>
					</div>
				</div>
				<div class="message__header">
					<div class="message__sender">
						<p>Кому: <?= $result_login['login'] ?></p>
					</div>
					<div class="message__title">
						<p><?= $result_message['title'] ?></p>
					</div>
					<div class="message__read">
						<p data-modal ="#modal<?= $message_id ?>"></p>
					</div>
				</div>
				
			</div>
		</div>

		<div class="modal" id="modal<?= $message_id ?>">
			<div class="modal__inner">
				<div class="modal__icons">
					<div class="modal__icons__fonts">
						<i class="fas fa-redo-alt" id="repeat"></i>
						<i class="fas fa-trash" id="delete" data-modal="#modal<?= $message_id ?>"></i>
						<p></p>
					</div>
					<div class="modal__info__status">
						<p></p>
					</div>
					<div class="modal__icons__close" data-modal="#modal<?= $message_id ?>">
						<p></p>
					</div>
				</div>
				<div class="modal__header">
					<div class="modal__header__title">
						<p><?= $result_message['title'] ?></p>
					</div>
					<div class="modal__header__subtitle">
						<p>Кому: <?= $result_login['login'] ?></p>
						<p><?= get_date($result_message['date'],'MM/dd/yyyy') ?></p>
					</div>
				</div>
				<div class="modal__text">
					<p><?= $result_message['text'] ?></p>
				</div>
			</div>
		</div>
		
		<?php 
			endforeach; 
		}	
		?>


</div>