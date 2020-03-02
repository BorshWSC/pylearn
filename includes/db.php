<?php
	include "config.php";
	$host=$config['db']['host'];
	$port=$config['db']['port'];
	$dbname=$config['db']['dbname'];
	$user=$config['db']['user'];
	$password=$config['db']['password'];
	$connect_string ='host='.$host.' port='.$port.' dbname='.$dbname.' user='.$user.' password='.$password;
	$dbconnect = pg_connect($connect_string); 
?>