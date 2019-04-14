<?php
include('./includes/mysqli.php');
include('./includes/tablescreator.php');
include('./includes/tablesinjector.php');

function db_make()
{
	$server = "db";
	$user = "root";
	$passwd = "test";
	$dbname = "ftminishop";
	$port = 3306;
	$query = "DROP database if exists $dbname;";
	$conn = mysqli_connect($server, $user, $passwd, '', $port);
	if (!$conn)
	die("Connection failed: " . mysqli_connect_error());
		echo "Connected successfully\n";
	?><br /><br /><?php
	if (mysqli_query($conn, $query))
	{
		echo "Db deleted";
		?><br /><br /><?php
	}
	else
	{
		echo "Error deleting";
		?><br /><br /><?php
	}
	$sql = "CREATE DATABASE $dbname";
	$check = mysqli_query($conn, $sql) ? "Database created successfully\n" : "Error creating database: " . mysqli_error($conn);
	echo $check;
	?><br /><br /><?php
}

function db_install()
{
	db_make();
	$conn = db_connect();
	createtables($conn);
	tabinject_articles($conn);
	tabinject_categories($conn);
	tabinject_users($conn);
	return ($conn);
}

db_install();

?>