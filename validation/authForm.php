<?php
	
	require_once "auth.php";

?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Exo+2|Open+Sans|Rubik&display=swap&subset=cyrillic" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/style_auth.css?version=13"/>
	<title>PyLearn - Авторизация</title>
</head>
<body>

	<form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" class="form" method="post">
		<p>Вход</p>
		<div class="input-text">
			<input type="text" name="reg_info" value="<?php echo $reg_info ?>" maxlength="20">
			<span data-placeholder="<?php echo $reg_info_ph ?>"></span>
		</div>
		<div class="input-text">
			<input type="password" name="password" value="<?php echo $password ?>" maxlength="16">
			<span data-placeholder="<?php echo $password_ph ?>"></span>
		</div>
		<div class="recovery">
			<p>Забыли пароль?</p>
			<a href="recoverForm.php">Жми</a>
		</div>
		<button type="submit" name="sign_in">Отправить</button>
		<div class="inform">
			<p>Еще нет своего аккаунта?</p>
			<p>Самое время его создать</p>
			<a href="regForm.php">Регистрация</a>
		</div>
	</form>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="../js/app_auth.js"></script>
	<script type="text/javascript">
		$(function(){
			var reg_info = '<?php echo $error['reg_info'];?>',
				password = '<?php echo $error['password'];?>';
			$('span').removeClass('error');	
			if(reg_info){
				$('input[name=reg_info]').next().addClass('error');
			}
			if(password){
				$('input[name=password]').next().addClass('error');
			}
		})
	</script>

</body>
</html>