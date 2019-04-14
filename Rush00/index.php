<?php
session_start();
include('./includes/mysqli.php');

?>
<html>

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>potatoes</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" media="screen" href="./css/index.css" />
</head>

<body>
	<?php require "./includes/header.php"; ?>
	<div class="main">
		<h2>Bonjour, ici on vend des patates.</h2>

	<div class="main__container">
    <?php
	$conn = db_connect();
	if (!($qry = mysqli_query($conn, "SELECT * FROM categories")))
		die ("Error" . mysqli_connect_error());
	while ($query = mysqli_fetch_array($qry, MYSQLI_ASSOC))
	{
		?>
			<div class="main__item">
				<img class="main__img" src="<?= htmlentities($query['cat_path'], ENT_QUOTES) ?>" alt="Logo" title="Logo">
					<form class="main__item__form" action="items.php" method="post">
						<input type="hidden" name="id_cat" value="<?= htmlentities($query['id_cat'], ENT_QUOTES) ?>">
						<input type="submit" name="cat_name" value="<?= htmlentities($query['cat_name'], ENT_QUOTES) ?>">
					</form>
				<p><?= htmlentities($query['cat_des'], ENT_QUOTES) ?></p>
			</div>
			<?php
	}
    ?>
	</div>

</div>

	<?php require "./includes/footer.php"; ?>
</body>

</html>