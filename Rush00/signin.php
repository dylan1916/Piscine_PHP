<?php
session_start();
include('./includes/mysqli.php');

function display_error()
{
	?>
	<div>
		<p>Password and login incorrect !</p>
	</div>
	<?php
}

if (isset($_POST['login']) AND $_POST['login'] && isset($_POST['passwd']) AND $_POST['passwd'] && isset($_POST['submit']) AND $_POST['submit'] === "OK")
{
	$conn = db_connect();
	$login = $_POST['login'];
	$hashed = hash('whirlpool', $_POST['passwd']);
	$query = "SELECT * FROM users WHERE login='$login' AND passwd='$hashed'";
	$data = mysqli_fetch_array(mysqli_query($conn, $query), MYSQLI_ASSOC);
	if (!isset($data['login']))
	{
		mysqli_close($conn);
		display_error();
	}
	else
	{
		$_SESSION['login'] = $login;
		$_SESSION['admin'] = $data['admin'];
		mysqli_close($conn);
		header('Location: ./index.php');
	}
}
else if (isset($_POST['submit']) AND $_POST['submit'] === "OK")
	display_error();
?>

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>potatoes</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" media="screen" href="./css/signin.css" />
</head>

<body>
	<?php require "./includes/header.php"; ?>
	<div class="main">
		<h2>Signin</h2>
		<form method="post">
		Login : <input type="text" name="login" value="" />
		<br />
		Password : <input type="password" name="passwd" value="" />
		<input type="submit" name="submit" value="OK" />
		</form>
	</div>
	<?php require "./includes/footer.php"; ?>
</body>

</html>