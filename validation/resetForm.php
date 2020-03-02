<?php

	session_start();
	require_once "reset.php";

?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Exo+2|Open+Sans|Rubik&display=swap&subset=cyrillic" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/style_auth.css?version=16"/>
	<link rel="stylesheet" type="text/css" href="../css/style_confirm.css?version=2"/>
	<link rel="stylesheet" href="../fonts/fontawesom/all.min.css">
	<title>PyLearn - Восстановление пароля</title>
</head>
<body>

	<?php if(empty($error_log)) {

		require_once 'resetForm/resetForm_fill.php';

	}else{

		require_once 'resetForm/resetForm_error.php';
		session_destroy();		
 	}
 	?>

	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="../js/app_auth.js"></script>
	<script type="text/javascript">
		$(function(){
			var $password = '<?php echo $error['password']?>',
				$password_2 = '<?php echo $error['password_2']?>';
			$('span').removeClass('error');	
			if($password == '1'){
				$('input[name=password]').next().addClass('error');
			}
			if($password_2 == '1'){
				$('input[name=password_2]').next().addClass('error');
			} 
		})
	</script>
</body>
</html>