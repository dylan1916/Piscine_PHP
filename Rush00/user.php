<?php
session_start();
include('./includes/mysqli.php');
include('./includes/ifnotuser.php');

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
		<a href="./change_password.php"><h2>Change password</h2></a>
		<br />
		<a href="./change_address.php"><h2>Change address</h2></a>
		<br />
		<a href="./change_email.php"><h2>Change email</h2></a>
		<br />
		<a href="./delete_account.php"><h2>Delete account</h2></a>
		<br />
	</div>
	<?php require "./includes/footer.php"; ?>
</body>

</html>