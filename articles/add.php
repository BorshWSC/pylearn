<?php

	require_once "../includes/db.php";
	require_once "../includes/functions.php";

	$data = $_POST;

	if(isset($data['add']))
	{

		$title = $data['title'];
		$subtitle = $data['subtitle'];
		$content = $data['content'];
		$add_date = get_date(time(), "dd MM yyyy");
		$id_course = $data['id_course'];
		$id_section = $data['id_section'];
		$img = $data['img'];

		$query = "INSERT INTO article (title, name, subtitle, content, date, id_course, id_section, img) VALUES ('".$title."', '".$title."', '".$subtitle."', '".$content."', '".$add_date."', '".$id_course."', '".$id_section."', '".$img."');";
		$result = pg_query($dbconnect, $query);
	}

?>
