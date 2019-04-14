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
$query = "SELECT * FROM categories";
if (!($qry = mysqli_query($conn, $query)))
	die("Error!" . mysqli_connect_error());
while ($query = mysqli_fetch_array($qry, MYSQLI_ASSOC))
{
	?>
    <h5>No category : <?= htmlentities($query['id_cat'], ENT_QUOTES) ?></h5>
	<h5>Nom : <?= htmlentities($query['cat_name'], ENT_QUOTES) ?></h5>
    <h5>Description : <?= htmlentities($query['cat_des'], ENT_QUOTES) ?></h5>
    <h5>Image : <?= htmlentities($query['cat_path'], ENT_QUOTES) ?></h5>
    <form action="del_categories.php" method="post">
	<a>Confirm category name : <input type="text" name="cat"/></a>
    <input type="submit" name="supprimer" value="supprimer">
	</form>
	<form action="modify_categories.php" method="post">
	<a>Confirm category name : <input type="text" name="cat"/></a>
    <input type="submit" name="modifier" value="modifier">
    </form>
    <?php
}
?>
</div>
	<?php require "./includes/footer.php"; ?>
</body>
</html>