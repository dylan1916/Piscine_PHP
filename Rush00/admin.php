<?php
session_start();
include('./includes/ifnotadmin.php');
include('./includes/mysqli.php');

// if (!isset($_SESSION['admin']) || $_SESSION['admin'] === 0)
// {
// 	header('Location: /index.php');
// }

?>
<html>

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>potatoes</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" media="screen" href="./css/admin.css" />
</head>

<body>
	<?php require "./includes/header.php"; ?>
	<div class="main">
		<h2>Hi <?php echo $_SESSION['login']?></h2>
		<a href="./add_products.php"><h2>Ajouter un produit</h2></a>
		<br />
		<a href="./modifydel_products.php"><h2>Modifier / Supprimer un produit</h2></a>
		<br />
		<a href="./add_category.php"><h2>Ajouter une catégorie</h2></a>
		<br />
		<a href="./modifydel_category.php"><h2>Modifier / Supprimer une catégorie</h2></a>
		<br />
		<a href="./add_user.php"><h2>Ajouter un utilisateur</h2></a>
		<br />
		<a href="./modifydel_user.php"><h2>Modifier / Supprimer un utilisateur</h2></a>
		<br />
	</div>
	<?php require "./includes/footer.php"; ?>
</body>

</html>