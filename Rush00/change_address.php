<?php
session_start();
include('./includes/mysqli.php');
include('./includes/ifnotuser.php');

function pass_changed()
	{
		?>
			<div>
				<p>Address changed!</p>
			</div>
			</div>
		<?php

	}

function not_ok()
{
	?>
		<div>
			<p>Wrong login</p>
		</div>
	</div>
	<?php

}
function wrong_set()
{
	?>
		<div>
			<p>Missing informations</p>
		</div>
	</div>
	<?php

}

if (isset($_POST['submit']) && $_POST['submit'] === "OK")
{
	if ($_SESSION['login'] == $_POST['login'] && isset($_POST['address'], $_POST['login']) && $_POST['address'] && $_POST['login'])
	{
		$conn = db_connect();
		$login = $_POST['login'];
		$address = $_POST['address'];
		$query = "SELECT * FROM users WHERE login='$login'";
		if (!($res = mysqli_query($conn, $query)))
			die ("Error!" . mysqli_connect_error());
		$array = mysqli_fetch_row($res);
		if ($array[0] < 1)
			not_ok();
		else
		{
			$query = "update users set passwd='$newhashed' WHERE login='$login' and passwd='$oldhashed'";
			$res = mysqli_query($conn, $query);
			if (!$res)
			die ("Error!" . mysqli_connect_error());
			pass_changed();
		}
	}
	else if ($_SESSION['login'] != $_POST['login'])
		not_ok();
	else if (!$_POST['login'] || !$_POST['login'])
		wrong_set();
}

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
		<h2>Hi <?php echo $_SESSION['login']?></h2>
		<h2>Changing address...</h2>
		<form method="post" action="change_address.php">
		<a>Login : <input type="login" name="login"/></a>
		<br />
		<a>New address : <input type="address" name="address"/></a>
   		<input type="submit" name="submit" value="OK" />
		</form>
		<br />
		<?php require "./includes/footer.php"; ?>
	</div>
</body>

</html>