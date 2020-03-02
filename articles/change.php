<?php

	require_once "../includes/db.php";

	$data = $_POST;

	if(isset($data['change']))
	{
		$id = $data['id'];
		$title = $data['title'];
		$subtitle = $data['subtitle'];
		$content = $data['content'];
		$change_date = get_date(time(), "dd MM yyyy");
		$id_course = $data['id_course'];
		$id_section = $data['id_section'];

		$query = "UPDATE articles SET title = '".$title."', name = '".$title."' subtitle = '".$subtitle."', content = '".$content."' date = '".$change_date."' id_course = '".$id_course."' id_section = '".$id_section."' img = '".$img."' where id = $id;"; 
		$result = pg_query($dbconnect, $query);
	}


?>
