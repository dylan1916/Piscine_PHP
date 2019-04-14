<?php
session_start();
include('./includes/mysqli.php');
include('./includes/ifnotadmin.php');

function wrong_email_format()
{
	?>
		<div>
			<p>Wrong email format</p>
		</div>
	</div>
	<?php
}

function display_logout()
{
	?>
		<div>
			<p>Please logout</p>
		</div>
	</div>
	<?php
}

function account_created()
{
	?>
	<html><head></head>
	<body>
			<p>Success!</p>
			<p>Account successfully created.</p>
	</div>
	</body>
	</html>
	<?php
}

function account_already_taken()
{
	?>
	<html><head></head>
	<body>
		<p>The username you have chosen already exists! Please try choosing another one.</p>
	</body>
	</html>
	<?php
}

function display_error()
{
	?>
	<html><head></head>
	<body>
			<p>The username and password are not valid!</p>
			<p>Please try again.</p>
	</div>
	</body>
	</html>
	<?php
}

function display_notsamepasswd()
{
	?>
	<html><head></head>
	<body>
		<p>Password and confirmation password are not the same.</p>
		<p>Please try again.</p>
	</div>
	</body>
	</html>
	<?php
}

if (isset($_POST['login']) AND $_POST['login'] && isset($_POST['passwd']) AND $_POST['passwd'] && isset($_POST['submit']) && $_POST['submit'] === "OK" && $_POST['passwd'] === $_POST['passwd2'])
{
	if (isset($_POST['admin']) && $_POST['admin'] === "oui")
	{
		$admin = 1;
	}
	else
		$admin = 0;
	$regexmail = '/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD';
	$conn = db_connect();
	$login = $_POST['login'];
	$hashed = hash('whirlpool', $_POST['passwd']);
	$lastname = $_POST['lastname'];
	$firstname = $_POST['firstname'];
	$email = $_POST['email'];
	$address = $_POST['address'];
	if (!(preg_match($regexmail, $email)))
		wrong_email_format();
	else
	{
		$query = "INSERT INTO users (`login`, `passwd`, `lastname`, `firstname`, `email`, `address`, `admin`) VALUES ('$login', '$hashed', '$lastname', '$firstname', '$email', '$address', '$admin')";
		$result = mysqli_query($conn, $query);
		if ($result)
		{
			account_created();
			mysqli_close($conn);
		}
		else
		{
			account_already_taken();
			mysqli_close($conn);
		}
	}
}
else if ($_POST['passwd'] !== $_POST['passwd2'])
	display_notsamepasswd();
else if (isset($_POST['submit']) && $_POST['submit'] === "OK")
	display_error();

?>
<html>

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>potatoes</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" media="screen" href="./css/user.css" />
</head>
<body>
	<?php require "./includes/header.php"; ?>
	<div class="main">
		<form method="post">
		<a>Choose login : <input type="text" name="login"/></a>
		<br />
		<a>Name : <input type="text" name="firstname"/></a>
		<br />
		<a>Surname : <input type="text" name="lastname"/></a>
		<br />
		<a>Email : <input type="text" name="email"/></a>
		<br />
		<a>Address : <input type="text" name="address"/></a>
		<br />
		<a>Password : <input type="password" name="passwd"/></a>
		<br />
		<a>Confirm password : <input type="password" name="passwd2"/></a>
		<br />
		<a>Si admin ecrire oui : <input type="text" name="admin"/></a>
   		<input type="submit" name="submit" value="OK" />
		</form>
	</div>
	<?php require "./includes/footer.php"; ?>
</body>
</html>