<?php
session_start();
include('./includes/mysqli.php');


function add_order($id, $idcateg, $categ)
{
	?>
	<form action="order.php" method="post">
		<input type="hidden" name="id" value="<?= htmlentities($id, ENT_QUOTES) ?>">
		<input type="hidden" name="idcateg" value="<?= htmlentities($idcateg, ENT_QUOTES) ?>">
		<input type="hidden" name="categ" value="<?= htmlentities($categ, ENT_QUOTES) ?>">
		<input type="submit" name="order" value="add to cart">
	</form>
	<?php
}

?>
<html>

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>potatoes</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" media="screen" href="./css/categories.css" />
</head>

<body>
	<?php require "./includes/header.php"; ?>
	<div class="main">
	<?php
	$conn = db_connect();
    $cat_name = $_POST['cat_name'];
    $id_cat = $_POST['id_cat'];
	$query = "SELECT * FROM items WHERE item_cat='$id_cat'";
    if (!($qry = mysqli_query($conn, $query)))
		die("Error!" . mysqli_connect_error());
	?><h2>Categorie : <?= htmlentities($cat_name) ?></h2><?php
	?><div class="main__container"><?php
	while ($query = mysqli_fetch_array($qry, MYSQLI_ASSOC))
	{
		?>
		<div class="main__item">
			<img class="main__img" src="<?= htmlentities($query['item_path'], ENT_QUOTES) ?>"
				alt="Logo" title="Logo">
				<a class="main__item__title"><?= htmlentities($query['item_name'], ENT_QUOTES) ?></a>
			<p><?= htmlentities($query['item_des'], ENT_QUOTES) ?></p>
			<p><?php echo htmlentities($query['item_price'], ENT_QUOTES)."&euro;"; ?></p>
			<p><?php add_order($query['id_item'], $id_cat, $cat_name); ?></p>
		</div>
    	<?php
	}
	?>
		</div>
	</div>
	<?php require "./includes/footer.php"; ?>
</body>
</html>
