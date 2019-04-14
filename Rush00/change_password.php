<?php
session_start();
include('./includes/mysqli.php');
include('./includes/ifnotuser.php');
function display_notsamepasswd()
{
	?>
		<div>
			<p>Password and confirmation password are not the same.</p>
			<p>Please try again.</p>
		</div>
		</div>
	<?php
}

function pass_changed()
	{
		?>
			<div>
				<p>Password changed!</p>
			</div>
			</div>
		<?php

	}

function not_ok()
{
	?>
		<div>
			<p>Wrong password</p>
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
	if ($_POST['confirmpasswd'] && $_POST['oldpasswd']  && $_POST['newpasswd'] && $_POST['newpasswd'] === $_POST['confirmpasswd'])
	{
		$conn = db_connect();
		$oldpasswd = $_POST['oldpasswd'];
		$newpasswd = $_POST['newpasswd'];
		$oldhashed = hash('whirlpool', $oldpasswd);
		$newhashed = hash('whirlpool', $newpasswd);
		$login = $_SESSION['login'];
		$query = "SELECT * FROM users WHERE login='$login' AND passwd='$oldhashed'";
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
	else if ($_POST['newpasswd'] !== !$_POST['confirmpasswd'])
		display_notsamepasswd();
	else if ((!$_POST['login'] || !$_POST['oldpasswd']  || !$_POST['newpasswd']))
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
		<h2>Changing password...</h2>
		<form method="post" action="change_password.php">
		<a>Old password : <input type="password" name="oldpasswd"/></a>
		<br />
		<a>New password : <input type="password" name="newpasswd"/></a>
		<br />
		<a>Confirm item : <input type="password" name="confirmpasswd"/></a>
   		<input type="submit" name="submit" value="OK" />
		</form>
		<br />
		<?php require "./includes/footer.php"; ?>
	</div>
</body>

</html>