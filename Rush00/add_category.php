<?php
session_start();
include('./includes/mysqli.php');
include('./includes/ifnotadmin.php');

function category_created()
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

if (isset($_POST['submit']) && $_POST['submit'] === "add")
{
    if (isset($_POST['name'], $_POST['description'], $_POST['img']) && $_POST['name'] !== null && $_POST['description'] !== null &&  $_POST['img'] !== null)
    {
		$name = $_POST['name'];
		$img = $_POST['img'];
        $description = $_POST['description'];
        $conn = db_connect();
        $query = "INSERT INTO categories (id_cat, cat_name, cat_path, cat_des) VALUES (null, '$name', '$img', '$description')";
        $result = mysqli_query($conn, $query);
        if (!$result)
            die ("Error!" . mysqli_connect_error());
        if ($result)
        {
            category_created();
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
		<form action="add_category.php" method="POST">
			<h3>Titre de la catégorie :</h3><input type="text" name="name"/><br/><br/>
			<h3>Description de la catégorie :</h3><input type="text" name="description"/><br/><br/>
			<h3>Image :</h3><input type="text" name="img"/><br/><br/>
			<input type="submit" name="submit" value="add">
        </form>
	</div>
	<?php require "./includes/footer.php"; ?>
</body>
</html>