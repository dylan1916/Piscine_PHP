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
$query = "SELECT * FROM items";
if (!($qry = mysqli_query($conn, $query)))
	die("Error!" . mysqli_connect_error());
while ($query = mysqli_fetch_array($qry, MYSQLI_ASSOC))
{
	?>
    <h5>Nom : <?= htmlentities($query['item_name'], ENT_QUOTES) ?></h5>
    <h5>Description : <?= htmlentities($query['item_des'], ENT_QUOTES) ?></h5>
    <h5>Quantité : <?= htmlentities($query['item_qty'], ENT_QUOTES) ?></h5>
    <h5>Prix : <?= htmlentities($query['item_price'], ENT_QUOTES) ?></h5>
    <h5>Image : <?= htmlentities($query['item_path'], ENT_QUOTES) ?></h5>
    <h5>Catégorie : <?= htmlentities($query['item_cat'], ENT_QUOTES) ?></h5><br/><br/>
    <form action="del_products.php" method="post">
	<a>Confirm product : <input type="text" name="item"/></a>
    <input type="submit" name="supprimer" value="supprimer">
	</form>
	<form action="modify_products.php" method="post">
	<a>Confirm product : <input type="text" name="item"/></a>
    <input type="submit" name="modifier" value="modifier">
    </form>
    <?php
}
?>
</div>
	<?php require "./includes/footer.php"; ?>
</body>
</html>