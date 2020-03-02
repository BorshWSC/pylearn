<?php
	
	require_once('account/account.php');
	require_once ('includes/functions.php');
	
?>


<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Nanum+Gothic:400,700|Noto+Sans+JP:400,500,700|Exo+2|Open+Sans|Rubik&display=swap&subset=cyrillic" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/style_account.css">
	<link rel="stylesheet" href="fonts/fontawesom/all.min.css">
	<title>PyLearn - Home</title>
</head>
<body>

	<?php
		require_once('includes/header.php'); 
	?>
	<!-- Header -->
	<?php if(isset($_COOKIE['user'])) { ?>
	<div class="account">
		<div class="container-main">
			<div class="account__inner">
				<div class="account__info">

					<div class="account__img">
						<img src="https://via.placeholder.com/300" alt="">
					</div>

					<div class="account__data">
						<div class="tab">
							<div class="tablinks tablinks-active" name="notification">
								<p>Уведомления</p>
							</div>
							<div class="tablinks" name="option">
								<p>Настройки</p>
							</div>
							<div class="tablinks" name="feedback">
								<p>Обратная связь</p>
							</div>
							<div class="tablinks" name="favorites-section">
								<p>Избранное</p>
							</div>
							<div class="tablinks" name='notes'>
								<p>Заметки</p>
							</div>
						</div>
					</div>

				</div>

				<div class="account__description">

					<div class="content">
						
						<?php require_once 'account/notification/notificationForm.php'?>
						<?php require_once 'account/option/optionForm.php'?>
						<?php require_once 'account/feedback/feedbackForm.php'?>
						<?php require_once 'account/favorites/favoritesForm.php'?>
						<?php require_once 'account/notes/notesForm.php'?>

					</div>

					<!-- content -->

				</div>

			</div>
		</div>
	</div>
	<!-- Account -->

	<?php } ?>

	<?php
		require_once('includes/footer.html'); 
	?>
	<!--Footer-->
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<script src="js/app_auth.js"></script>	

	<script src="account/option/ajax.js?version=20"></script>

	<script src="account/notification/ajax-message.js?version=17"></script>
	<script src="account/notification/modal.js"></script>

	<script src="account/feedback/ajax-feedback.js?version=17"></script>
	<script src="account/feedback/ajax-dispatch.js?version=4"></script>

	<script>
		$(function(){
			var $sex = '<?= $sex_val?>';
			if($sex != ''){
				if($sex == 0){
					$('#radio_male').prop('checked', true);
				}
				if($sex == 1){
					$('#radio_female').prop('checked', true);
				}
			}
		})
	</script>
</body>
</html>