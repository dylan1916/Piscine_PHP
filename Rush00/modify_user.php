<?php
session_start();
include('./includes/mysqli.php');
include('./includes/ifnotadmin.php');

function not_ok()
{
	?>
		<div>
			<p>Wrong informations</p>
		</div>
	</div>
	<?php
}

function user_modified()
{
	?>
		<div>
			<p>User modified !</p>
		</div>
	</div>
	<?php
}

function admin()
{
	?>
		<div>
			<p>Can't modify admin !</p>
		</div>
	</div>
	<?php
}

if (isset($_POST['submit']) && $_POST['submit'] === "OK")
{
	if ($_POST['login'] === admin)
	{
		admin();
		header('Location: modify_user.php');
	}
    if (isset($_POST['login'], $_POST['lastname'], $_POST['firstname'], $_POST['email'], $_POST['address'], $_POST['admin'], $_POST['test']))
    {
		if (isset($_POST['admin']) && $_POST['admin'] === "oui")
			$admin = 1;
		else
			$admin = 0;
		$test = $_POST['test'];
		$login = $_POST['login'];
		$lastname = $_POST['lastname'];
		$firstname = $_POST['firstname'];
		$email = $_POST['email'];
		$address = $_POST['address'];
		$admin = $_POST['admin'];
		$conn = db_connect();
		$query = "SELECT * FROM users WHERE login='$test'";
		if (!($qry = mysqli_query($conn, $query)))
			die ("Error!" . mysqli_connect_error());
		$array = mysqli_fetch_row($qry);
		if ($array[0] < 1)
		{
			not_ok();
			header('Location: modify_user.php');;
		}
        $query = "UPDATE `users` SET `login`='$login',`lastname`='$lastname',`firstname`='$firstname',`email`='$email',`address`='$address',`admin`='$admin' WHERE login='$test'";
		$result = mysqli_query($conn, $query);
        if (!$result)
            die ("Error!" . mysqli_connect_error());
        else
        {
            user_modified();;
       	}
	}
	else
	{
		not_ok();
		header('Location: modify_user.php');
	}
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
    <?php
if (isset($_POST['modifier']) && $_POST['modifier'] === "modifier")
{
    $conn = db_connect();
	$login = $_POST['login'];
	$query = "SELECT * FROM users WHERE login='$login'";
	if (!($qry = mysqli_query($conn, $query)))
		die ("Error!" . mysqli_connect_error());
	$array = mysqli_fetch_row($qry);
	if ($array[0] < 1)
	{
		not_ok();
		header('Location: modifydel_user.php');
	}
    if (!($qry = mysqli_query($conn, $query)))
		die ("Error!" . mysqli_connect_error());
	$query = mysqli_fetch_array($qry, MYSQLI_ASSOC);
}
?>
	<div class="main">
    	<form action="" method=POST enctype="multipart/form-data">
		<H3>Login : </h3><input type="text" name="login" value="<?= htmlentities($query['login'], ENT_QUOTES) ?>">
		<H3>Lastname : </h3><input type="text" name="lastname" value="<?= htmlentities($query['lastname'], ENT_QUOTES) ?>">
		<H3>Firstname : </h3><input type="text" name="firstname" value="<?= htmlentities($query['firstname'], ENT_QUOTES)?>">
		<H3>Email : </h3><input type="text" name="email" value="<?= htmlentities($query['email'], ENT_QUOTES) ?>">
		<H3>Address : </h3><input type="text" name="address" value="<?= htmlentities($query['address'], ENT_QUOTES) ?>">
		<H3>Admin type oui : </h3><input type="text" name="admin" value="<?= htmlentities($query['admin'], ENT_QUOTES) ?>">
		<select name="login">
		</select><br/><br/><br/>
		<a>Confirm with old login : <input type="text" name="test"/></a>
		<input type="submit" name="submit" value="OK">
		</form>
	</div>
	<?php require "./includes/footer.php"; ?>
</body>
</html>