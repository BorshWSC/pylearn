<?php

	$id = $_GET['id'];
	if(!is_numeric($id)) exit();

	require_once "../includes/db.php";
	require_once "change.php";

	$query = "SELECT * FROM article WHERE id = '$id';";
	$result = pg_query($dbconnect, $query);
	$result = pg_fetch_assoc($result);

	$title = $result['title'];
	$subtitle = $result['subtitle'];
	$content = $result['content'];
	$id_course = $result['id_course'];
	$id_section = $result['id_section'];
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
							<h2 class="form-title">Изменить статью</h2>
							<div class="input-textarea">
								<textarea cols=100 rows=1 type="text" name="title" maxlength="50"><?php echo $title ?></textarea>
							</div>
							<div class="input-textarea">
								<textarea cols=100 rows=5 type="text" name="subtitle" maxlength="128"><?php echo $subtitle ?></textarea>
							</div>
							<div class="input-textarea">
								<textarea cols=100 rows=10 type="text" name="content"><?php echo $content ?></textarea>
							</div>
							<div class="input-textarea">
								<input value="<?php echo $id_course ?>" type="text" name="id_course">
							</div>
							<div class="input-textarea">
								<input value="<?php echo $id_section?>" type="text" name="id_section">
							</div>
							<center><button class="article-confirm-button" type="submit" name="add">Изменить статью</button><center>
				</form>
			</div>
		</body>
	</html>
