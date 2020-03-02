<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Nanum+Gothic:400,700|Noto+Sans+JP:400,500,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/slick.css"/>
	<link rel="stylesheet" type="text/css" href="../css/slick-theme.css"/>
	<link rel="stylesheet" type="text/css" href="../css/style.css?version=1.04">
	<script src="https://kit.fontawesome.com/e406f6031b.js"></script>
	<title>PyLearn</title>
</head>
<body>

	<?php

		include "../includes/header.php";
		include "../includes/db.php";
		include "../includes/functions.php";
		$id = $_GET['id'];
		$article = get_article($id, $dbconnect);		

	?>
	
	<!-- /Header -->

	<div class="article">
		<div class=article_title>
			<?php echo $article['title']; ?>
		</div>
		<div class=article_date>
			<?php echo get_date($article['add_date'], 'MM/dd/yyyy HH:mm:ss'); ?>
		</div>
		<img class=article_img src="../img/<?php echo $article['img']?>">
		<div class=article_content>
			<?php echo $article['content']; ?>
		</div>
	</div>

	<?php

		include "../includes/footer.html";

	?>
	<!--Footer-->

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script type="text/javascript" src="../js/slick.min.js"></script>
	<script src="../js/app.js"></script>

</body>
</html>