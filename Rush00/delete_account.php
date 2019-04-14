<?php
session_start();
include('./includes/mysqli.php');
include('./includes/ifnotuser.php');

function not_ok()
{
	?>
	<body>
	<div>
		<p>Wrong Login or password</p>
	</div>
	<?php
}

if (isset($_POST['submit']) && $_POST['submit'] === "OK" && $_POST['login'] && $_POST['passwd'])
{
	$conn = db_connect();
	$login = $_POST['login'];
	$pass = $_POST['passwd'];
	$hashed = hash('whirlpool', $pass);
	$query = "SELECT * FROM users WHERE login='$login' AND passwd='$hashed'";
	if (!($res = mysqli_query($conn, $query)))
		die ("Error!" . mysqli_connect_error());
	$array = mysqli_fetch_row($res);
	if ($array[0] < 1)
		not_ok();
	else
	{
		$query = "delete from users where login='$login' and passwd='$hashed'";
		$res = mysqli_query($conn, $query);
		if (!$res)
			die ("Error!" . mysqli_connect_error());
		session_destroy();
		header('Location: ../../index.php');
	}
}
else if (isset($_POST['submit']) && $_POST['submit'] == "OK" && (!$_POST['login'] || !$_POST['passwd']))
	not_ok();

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
	<div action="delete_account.php>" class="main">
		<h2>Hi <?php echo $_SESSION['login']?></h2>
		<a href="changepassword.php"><h2>Please type login && password to delete account</h2></a>
		<form method="post">
		<a>Login : <input type="text" name="login"/></a>
		<br />
		<a>Password : <input type="password" name="passwd"/></a>
		<br />
		<a>Confirm delete : </a>
   		<input type="submit" name="submit" value="OK" />
		</form>
		<br />
	</div>
	<?php require "./includes/footer.php"; ?>
</body>

</html>