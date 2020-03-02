<?php 

	include "../includes/db.php";
	include "../includes/functions.php";

?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Nanum+Gothic:400,700|Noto+Sans+JP:400,500,700|Exo+2|Open+Sans|Rubik:400,500&display=swap&subset=cyrillic" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/style.css?version=4">
	<link rel="stylesheet" type="text/css" href="../css/style_articles.css?version=13">
	<link rel="stylesheet" href="../fonts/fontawesom/all.min.css">
	<title>PyLearn - Основы python</title>
</head>
<body>

	<?php

		include "../includes/header.php";

	?>
	
	<!-- /Header -->

	<div class="article">

		<div class="container-main">

			<div class="article__inner">
				
				<?php 

					$query = "SELECT * FROM course;"; 
					$course = pg_query($dbconnect, $query); 

					$result_array = array();

					$i = 0;
					while($row = pg_fetch_assoc($course)){
						$result_array[$i] = $row;
						$i++;
					}

					foreach ($result_array as $value) :
						
						

				?>

				<div class="article__item">
					<a href="articleForm_python.php?id_course=<?=$value['id']?>&id_section=1&id_article=1">
						<div class="article__item__header">
							<img src="" alt="">
							<div class="article__item__title">
								<p><?=$value['name']?></p>
							</div>
						</div>
						
						<div class="article__item__footer">
							<p><?=$value['description']?></p>
						</div>
					</a>
				</div>
				
				<?php 

					endforeach;
				?>

			</div>

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