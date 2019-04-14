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

function item_modified()
{
	?>
		<div>
			<p>Item modified !</p>
		</div>
	</div>
	<?php
}

if (isset($_POST['submit']) && $_POST['submit'] === "OK")
{
    if (isset($_POST['title'], $_POST['description'], $_POST['price'], $_POST['qty'], $_POST['img'], $_POST['test']))
    {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $qty = $_POST['qty'];
		$img = $_POST['img'];
		$test = $_POST['test'];
		$conn = db_connect();
		$query = "SELECT * FROM items WHERE item_name='$test'";
		if (!($qry = mysqli_query($conn, $query)))
			die ("Error!" . mysqli_connect_error());
		$array = mysqli_fetch_row($qry);
		if ($array[0] < 1)
		{
			not_ok();
			header('Location: modify_products.php');
		}
        $query = "UPDATE `items` SET `item_name`='$title',`item_des`='$description',`item_qty`='$qty',`item_price`='$price',`item_path`='$img',`item_cat`='2' WHERE item_name='$test'";
		$result = mysqli_query($conn, $query);
        if (!$result)
            die ("Error!" . mysqli_connect_error());
        else
        {
            item_modified();;
       	}
	}
	else
		not_ok();
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
	$item = $_POST['item'];
	$query = "SELECT * FROM items WHERE item_name='$item'";
	if (!($qry = mysqli_query($conn, $query)))
		die ("Error!" . mysqli_connect_error());
	$array = mysqli_fetch_row($qry);
	if ($array[0] < 1)
	{
		not_ok();
		header('Location: modifydel_products.php');
	}
    if (!($qry = mysqli_query($conn, $query)))
		die ("Error!" . mysqli_connect_error());
	$query = mysqli_fetch_array($qry, MYSQLI_ASSOC);
}
?>
	<div class="main">
		<form action="" method=POST enctype="multipart/form-data">
		<h3>Titre du produit :</h3><input type="text" name="title" value="<?= htmlentities($query['item_name'], ENT_QUOTES)?>">
		<h3>Description du produit :</h3><input type="textarea" name="description" value= "<?= htmlentities($query['item_des'], ENT_QUOTES) ?>"></textarea>
		<h3>Prix :</h3><input type="text" name="price" value=<?= htmlentities($query['item_price'], ENT_QUOTES) ?>><br/><br/>
		<h3>Quantité :</h3><input type="text" name="qty" value=<?= htmlentities($query['item_qty'], ENT_QUOTES) ?>><br/><br/>
		<h3>Image :</h3><input type="text" name="img" value=<?= htmlentities($query['item_path'], ENT_QUOTES) ?>><br/>
		<h3>Catégorie :</h3>
		<select name="category">
		</select><br/><br/><br/>
		<a>Confirm with old name product : <input type="text" name="test"/></a>
		<input type="submit" name="submit" value="OK">
		</form>
	</div>
	<?php require "./includes/footer.php"; ?>
</body>
</html>