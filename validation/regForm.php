<?php
	
	require "reg.php";

?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Exo+2|Open+Sans|Rubik&display=swap&subset=cyrillic" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/style_auth.css?version=13"/>
	<link rel="stylesheet" href="../fonts/fontawesom/all.min.css">
	<title>PyLearn - Регистрация</title>
</head>
<body>

	<?php if(!isset($_SESSION['success_reg'])) {

		require_once ("regForm/regForm_fill.php");

	}else{

		require_once ("regForm/regForm_confirm.php");
				
 	}
 	?>

	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="../js/app_auth.js"></script>
	<script type="text/javascript">
		$(function(){
			var $login = '<?php echo $error['login']?>',
				$email = '<?php echo $error['email']?>',
				$password = '<?php echo $error['password']?>',
				$password_2 = '<?php echo $error['password_2']?>';
			$('span').removeClass('error');	
			if($login  == '1'){
				$('input[name=login]').next().addClass('error');
			}
			if($email == '1'){
				$('input[name=email]').next().addClass('error');
			}
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