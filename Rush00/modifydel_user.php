<?php
session_start();
include('./includes/mysqli.php');
include('./includes/ifnotadmin.php');
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
$conn = db_connect();
$query = "SELECT * FROM users";
if (!($qry = mysqli_query($conn, $query)))
	die("Error!" . mysqli_connect_error());
while ($query = mysqli_fetch_array($qry, MYSQLI_ASSOC))
{
	?>
	<h5>Id : <?= htmlentities($query['id'], ENT_QUOTES) ?></h5>
	<h5>Login : <?= htmlentities($query['login'], ENT_QUOTES) ?></h5>
	<h5>Lastname : <?= htmlentities($query['lastname'], ENT_QUOTES) ?></h5>
	<h5>Firstname : <?= htmlentities($query['firstname'], ENT_QUOTES) ?></h5>
    <h5>Email : <?= htmlentities($query['email'], ENT_QUOTES) ?></h5>
    <h5>Address : <?= htmlentities($query['address'], ENT_QUOTES) ?></h5>
    <h5>Admin : <?= htmlentities($query['admin'], ENT_QUOTES) ?></h5>
    <form action="del_user.php" method="post">
	<a>Confirm login : <input type="text" name="login"/></a>
    <input type="submit" name="supprimer" value="supprimer">
	</form>
	<form action="modify_user.php" method="post">
	<a>Confirm login : <input type="text" name="login"/></a>
    <input type="submit" name="modifier" value="modifier">
    </form>
    <?php
}
?>
	</div>
	<?php require "./includes/footer.php"; ?>
</body>
</html>