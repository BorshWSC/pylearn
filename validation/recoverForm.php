<?php
	
	require_once 'recover.php';

?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Nanum+Gothic:400,700|Noto+Sans+JP:400,500,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/style_auth.css?version=8"/>
	<link rel="stylesheet" href="../fonts/fontawesom/all.min.css">
	<title>PyLearn - Восстановление пароля</title>
</head>
<body>

	<?php 

	if(!isset($_SESSION['code'])){

		require_once 'recoverForm/recoverForm_fill.php';

	}else{

		require_once 'recoverForm/recoverForm_reset.php';
	}

	?>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="../js/app_auth.js"></script>
	<script type="text/javascript">
		$(function(){
			var reg_info = '<?php echo $error['reg_info'];?>';
			$('span').removeClass('error');	
			if(reg_info){
				$('input[name=reg_info]').next().addClass('error');
			}
		})
	</script>

</body>
</html>