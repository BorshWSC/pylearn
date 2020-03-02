<?php 

	include "../includes/db.php";
	include "../includes/functions.php";

	if(!isset($_GET['id_course']) && !isset($_GET['id_section'])){
		header('Location: article.php ');					
	}
	else{
		$id_course_cr = $_GET['id_course'];
		$id_section_cr = $_GET['id_section'];
		$id_article_cr = $_GET['id_article'];
	}

	$query = "SELECT name FROM course WHERE id = '$id_course_cr';"; 
	$result = pg_query($dbconnect, $query); 
	$result = pg_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Nanum+Gothic:400,700|Noto+Sans+JP:400,500,700|Exo+2|Open+Sans|Rubik:400,500&display=swap&subset=cyrillic" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../css/style_account.css">
	<link rel="stylesheet" type="text/css" href="../css/style_articles.css?version=32">
	<link rel="stylesheet" href="../fonts/fontawesom/all.min.css">
	<title>PyLearn - <?=$result['name']?></title>
</head>
<body>

	<?php

		include "../includes/header.php";

	?>
	
	<!-- /Header -->

	<div class="article">
		<div class="container-main">
			<div class="article__inner-course">
				<div class="article__sidebar">
					
					
					<div class="sidebar">

						<?php 

						$query = "SELECT * FROM section WHERE id_course = '$id_course_cr';"; 
						$course = pg_query($dbconnect, $query); 

						$result_array_section = array();

						$i = 0;
						while($row = pg_fetch_assoc($course)){
							$result_array_section[$i] = $row;
							$i++;
						}

						foreach ($result_array_section as $value_section) :

							$id_section = $value_section['id'];
							$name_section = $value_section['name'];

							$query = "SELECT * FROM article WHERE id_section = '$id_section' AND id_course = '$id_course_cr';"; 
							$article = pg_query($dbconnect, $query);

							

							if(pg_num_rows($article) == 1){

								$article = pg_fetch_assoc($article);
								$id_article = $article['id'];

								$href = htmlspecialchars($_SERVER["PHP_SELF"])."?id_course=$id_course_cr&id_section=$id_section&id_article=$id_article";

								?>

									<a href="<?=$href?>"  >
										<div class="sidebar__section <?php if($id_section == $id_section_cr) echo 'sidebar__section-active'?>  sidebar__section-after" >
											<p><?=$name_section?></p>
										</div>
									</a>

								<?php
							}
							else{

								$result_array_article = array();

								$i = 0;
								while($row = pg_fetch_assoc($article)){
									$result_array_article[$i] = $row;
									$i++;
								}


								?>
									<div class="sidebar__section <?php if($id_section == $id_section_cr) echo 'sidebar__section-active' ?>" data-hide = '#<?=$id_section?>' >
										<p><?=$name_section?></p>
									</div>
									<div class="stablinks <?php if($id_section == $id_section_cr) echo 'stablinks-active' ?>" id="<?=$id_section?>">
										<div class="stablinks__inner">

								<?php

								foreach ($result_array_article as  $value_article) :

									$article_name = $value_article['name'];
									$id_article = $value_article['id'];

									$href = htmlspecialchars($_SERVER["PHP_SELF"])."?id_course=$id_course_cr&id_section=$id_section&id_article=$id_article";

						?>
										<a href="<?=$href?>" class="<?php if($id_article == $id_article_cr) echo 'stablinks__a-active' ?>"> <p><?=$article_name?></p></a>
											
									

						<?php 

								endforeach;

								?>
										</div>
									</div>

								<?php
							}

						endforeach;
						?>

					</div>

					
				</div>
				<div class="article__content">

					<?php  

						$query = "SELECT * FROM article WHERE id = '$id_article_cr';"; 
						$result = pg_query($dbconnect, $query); 
						$result = pg_fetch_assoc($result);

					?>
					<div class="article__header">
						<p class="title"><?= $result['title'] ?></p>
						<p> <?= $result['subtitle']?> </p>
					</div>
					<div class="article__body">
						
					</div>
				</div>
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
	<script src="../js/app_article.js?version=7"></script>

</body>
</html>