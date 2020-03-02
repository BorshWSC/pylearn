<?php 
	session_start();
	require_once("confirm.php");

?> 

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Exo+2|Open+Sans|Rubik&display=swap&subset=cyrillic" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/style_confirm.css?version=3"/>
	<title>PyLearn - Регистрация</title>
</head>
<body>
	
	<?php 
		if(empty($error)){ session_destroy();
	?>
		<div class="block">
			<p class="title">Спасибо за регистрацию</p>
			<p>Через пару секунид вы будете перенаправлены на страницу авторизации</p>
			<img src="../video/reboot.gif" alt="">
		</div>
	<?php echo '<script>setTimeout( function(){window.location.replace("authForm.php")}, 3000)</script>';
		}else{ 
			session_destroy();
					 ?>
		<div class="block">
			<p class="title">Что - то пошло не так</p>
			<p>Пожалуйста, попробуйте зарегистрироваться заново</p>
			<div class="reference">
				<div class="reference__inner">
					<img src="" alt="">
					<a href="regForm.php">Вернуться на страницу регистрации</a>
				</div>
				<div class="reference__inner">
					<img src="" alt="">
					<a href="../">Перейти на главную</a>
				</div>
			</div>
		</div>
	<?php

		}
	?>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	
</body>
</html>