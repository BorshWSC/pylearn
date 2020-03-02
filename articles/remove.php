<?php

	$id = $_GET['id'];
	if(!is_numeric($id)) exit();

	require_once "../includes/db.php"; 
	$query = "DELETE FROM articles WHERE id = '$id';"; 
	$result = pg_query($dbconnect, $query); 

?>

Удалено