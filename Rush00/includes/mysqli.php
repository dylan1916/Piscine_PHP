<?php

function db_connect()
{
	$server = "db";
	$user = "root";
	$passwd = "test";
	$dbname = "ftminishop";
	$port = 3306;

	static $conn;

	if (!isset($conn))
		if (!($conn = mysqli_connect($server, $user, $passwd, $dbname, $port)))
			die("Connection failed: " . mysqli_error($conn));
	?><br /><br /><?php
	return $conn;
}

function db_security($conn, $string)
{
	if (ctype_digit($string))
	{
		$string = intval($string);
	}
	else
	{
		$string = mysqli_real_escape_string($conn, $string);
		$string = addcslashes($string, '%_');
	}

	return ($string);
}

?>