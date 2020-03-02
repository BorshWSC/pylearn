<?php

	require_once "add.php";

?>

<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="../css/article.css">
		<link href="https://fonts.googleapis.com/css?family=Nanum+Gothic:400,700|Noto+Sans+JP:400,500,700|Exo+2|Open+Sans|Rubik:400,500&amp;display=swap&amp;subset=cyrillic" rel="stylesheet">
		<title>PyLearn</title>
	</head>
	<body>
		<div class="article-form">
			<form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>"  method="POST">
						<h2 class="form-title">Добавить статью</h2>
						<div class="input-textarea">
							<textarea placeholder="Заголовок" cols=100 rows=1 type="text" name="title" maxlength="50"></textarea>
						</div>
						<div class="input-textarea">
							<textarea placeholder="Описание" cols=100 rows=5 type="text" name="subtitle" maxlength="128"></textarea>
						</div>
						<div class="input-textarea">
							<textarea  placeholder="Текст статьи"cols=100 rows=10 type="text" name="content"></textarea>
						</div>
						<div class="input-textarea">
							<input placeholder="ID курса" type="text" name="id_course">
						</div>
						<div class="input-textarea">
							<input  placeholder="ID секции" type="text" name="id_section">
						</div>
						<div class="input-textarea">
							<input  placeholder="Путь к изображению" type="text" name="img">
						</div>
						<center><button class="article-confirm-button" type="submit" name="add">Добавить статью</button><center>
			</form>
		</div>
	</body>
</html>
