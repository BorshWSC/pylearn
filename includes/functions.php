<?php

	function code_generate()
	{

		$result = '';
		$array = array_merge(range('a','z'), range('0','9'));
		for($i = 0; $i < 6; $i++)
		{
			$result .= $array[mt_rand(0, 35)];
		}
		return $result;
	}

	function get_date($timestamp, $pattern)
	{
		$dateFormatter = datefmt_create(
		'ru_RU',
		IntlDateFormatter::FULL,
		IntlDateFormatter::FULL,
		'Europe/Moscow',
		IntlDateFormatter::GREGORIAN,
		$pattern
		);

		return datefmt_format($dateFormatter, $timestamp);
	}

	function get_article($id, $dbconnect)
	{

		$query = "SELECT * FROM articles WHERE id = '$id';"; 
		$result = pg_query($dbconnect, $query); 
		return $result;

	}


?>