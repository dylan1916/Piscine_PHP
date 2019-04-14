<?php
session_start();
include('./includes/mysqli.php');
include('./includes/ifnotuser.php');

function email_changed()
	{
		?>
			<div>
				<p>Email changed!</p>
			</div>
			</div>
		<?php

	}

function wrong_email_format()
{
	?>
		<div>
			<p>Wrong email format</p>
		</div>
	</div>
	<?php
}

function missing_informations()
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
	if (isset($_POST['newemail']) && $_POST['newemail'])
	{
		$newemail = $_POST['newemail'];
		$regexmail = '/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD';
		if (!(preg_match($regexmail, $newemail)))
			wrong_email_format();
		else
		{
			$conn = db_connect();
			$login = $_SESSION['login'];
			$query = "SELECT * FROM users WHERE login='$login'";
			if (!($res = mysqli_query($conn, $query)))
				die ("Error!" . mysqli_connect_error());
			$array = mysqli_fetch_row($res);
			if ($array[0] < 1)
				missing_informations();
			else
			{
				$query = "update users set email='$newemail' WHERE login='$login'";
				$res = mysqli_query($conn, $query);
				if (!$res)
					die ("Error!" . mysqli_connect_error());
				email_changed();
			}
		}
	}
	else if ((!$_POST['login'] || !$_POST['oldpasswd']  || !$_POST['newpasswd']))
		missing_informations();
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
		<h2>Changing email...</h2>
		<form method="post" action="change_email.php">
		<a>New email : <input type="text" name="newemail"/></a>
   		<input type="submit" name="submit" value="OK" />
		</form>
		<br />
		<?php require "./includes/footer.php"; ?>
	</div>
</body>

</html>