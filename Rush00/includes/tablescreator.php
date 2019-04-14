<?php
function createtables($conn)
{
    $sql1 = "CREATE TABLE `users` (
		`id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
		`login` VARCHAR(30) NOT NULL UNIQUE, 
		`passwd` VARCHAR(255) NOT NULL,
		`lastname` text,
		`firstname` text,
		`email` varchar(255) DEFAULT NULL,
		`address` varchar(255) DEFAULT NULL,
		`admin` TINYINT DEFAULT 0 
	) ENGINE=InnoDB DEFAULT CHARSET=utf8";
	$sql2 = "CREATE TABLE `categories` (
		`id_cat` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		`cat_name` VARCHAR(30) NOT NULL UNIQUE,
		`cat_path` varchar(255) NOT NULL,
		`cat_des` varchar(255) NOT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=utf8";
	$sql3 = "CREATE TABLE `items` (
		`id_item` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		`item_name` VARCHAR(30) NOT NULL UNIQUE,
		`item_des` varchar(255) NOT NULL,
		`item_qty` smallint(3) UNSIGNED NOT NULL,
		`item_price` int(10) UNSIGNED NOT NULL,
		`item_path` varchar(255) NOT NULL,
		`item_cat` bigint(20) NOT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=utf8";	
	$sql4 = "CREATE TABLE `cart` (
		`id_cart` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		`id_order` int(10) UNSIGNED NOT NULL DEFAULT '0',
		`log_user` VARCHAR(30) NOT NULL DEFAULT '0',
		`id_item` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
		`cart_name` varchar(255) NOT NULL DEFAULT '0',
		`cart_qty` smallint(3) UNSIGNED NOT NULL DEFAULT '0',
		`cart_price` int(10) UNSIGNED NOT NULL DEFAULT '0',
		`bought` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
	) ENGINE=InnoDB DEFAULT CHARSET=utf8";

	if (mysqli_query($conn, $sql1))
	echo "Table 'users' created successfully<br>";
	else
	die ("Error creating table 'users': " . mysqli_error($conn));
	if (mysqli_query($conn, $sql2))
	echo "Table 'security' created successfully<br>";
	else
	die ("Error creating table 'categories': " . mysqli_error($conn));
	if (mysqli_query($conn, $sql3))
	echo "Table 'categories' created successfully<br>";
	else
	die ("Error creating table 'items': " . mysqli_error($conn));
	if (mysqli_query($conn, $sql4))
	echo "Table 'items' created successfully<br>";
	else
	die ("Error creating table 'cart': " . mysqli_error($conn));
}

?>