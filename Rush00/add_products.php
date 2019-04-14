<?php
session_start();
include('./includes/mysqli.php');
include('./includes/ifnotadmin.php');

function item_created()
{
	?>
	<html><head></head>
	<body>
			<p>Success!</p>
			<p>Category successfully created.</p>
	</div>
	</body>
	</html>
	<?php
}

function not_ok()
{
	?>
	<html><head></head>
	<body>
		<p>Check informations</p>
	</body>
	</html>
	<?php
}

if (isset($_POST['submit']) && $_POST['submit'] === "OK")
{
    if (isset($_POST['title'], $_POST['description'], $_POST['price'], $_POST['qty'], $_POST['img']) && $_POST['title'] !== null && $_POST['description'] !== null && $_POST['price'] !== null && $_POST['img'] !== null && $_POST['qty'] !== null)
    {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $qty = $_POST['qty'];
        $img = $_POST['img'];
        $conn = db_connect();
        
        $query = "INSERT INTO items (id_item, item_name, item_des, item_qty, item_price, item_path, item_cat) VALUES (null, '$title', '$description', '$qty', '$price', 'dasdasdasdsadas', '2')";
        $result = mysqli_query($conn, $query);
        if (!$result)
            die ("Error!" . mysqli_connect_error());
        if ($result)
        {
            item_created();
            mysqli_close($conn);
        }
        else
        {
            not_ok();
            mysqli_close($conn);
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
    	<form action="add_products.php" method=POST enctype="multipart/form-data">
		<h3>Titre du produit :</h3><input type="text" name="title">
		<h3>Description du produit :</h3><textarea name="description"></textarea>
		<h3>Prix :</h3><input type="text" name="price"><br/><br/>
		<h3>Quantité :</h3><input type="text" name="qty"><br/><br/>
		<h3>Image :</h3><input type="text" name="img"><br/><br/>
		<h3>Catégorie :</h3>
		<select name="category">
		</select><br/><br/><br/>
		<input type="submit" name="submit" value="OK">
		</form>
	</div>
	<?php require "./includes/footer.php"; ?>
</body>
</html>