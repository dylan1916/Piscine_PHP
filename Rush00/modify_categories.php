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

function cat_modified()
{
	?>
		<div>
			<p>Category modified !</p>
		</div>
	</div>
	<?php
}

if (isset($_POST['submit']) && $_POST['submit'] === "OK")
{
    if (isset($_POST['title'], $_POST['description'], $_POST['cat_path'], $_POST['test']))
    {
        $title = $_POST['title'];
        $description = $_POST['description'];
		$img = $_POST['cat_path'];
		$test = $_POST['test'];
		$conn = db_connect();
		$query = "SELECT * FROM categories WHERE cat_name='$test'";
		if (!($qry = mysqli_query($conn, $query)))
			die ("Error!" . mysqli_connect_error());
		$array = mysqli_fetch_row($qry);
		if ($array[0] < 1)
		{
			not_ok();
			header('Location: modify_categories.php');
		}
        $query = "UPDATE `categories` SET `cat_name`='$title',`cat_des`='$description',`cat_path`='$img' WHERE cat_name='$test'";
		$result = mysqli_query($conn, $query);
        if (!$result)
            die ("Error!" . mysqli_connect_error());
        else
        {
            cat_modified();;
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
	$cat = $_POST['cat'];
	$query = "SELECT * FROM categories WHERE cat_name='$cat'";
	if (!($qry = mysqli_query($conn, $query)))
		die ("Error!" . mysqli_connect_error());
	$array = mysqli_fetch_row($qry);
	if ($array[0] < 1)
	{
		not_ok();
		header('Location: modifydel_categories.php');
	}
    if (!($qry = mysqli_query($conn, $query)))
		die ("Error!" . mysqli_connect_error());
	$query = mysqli_fetch_array($qry, MYSQLI_ASSOC);
}
?>
	<div class="main">
    <form action="" method=POST enctype="multipart/form-data">        
		<h3>Nom de la categorie :</h3><input type="text" name="title" value="<?= htmlentities($query['cat_name'], ENT_QUOTES) ?>">
		<h3>Description de la categorie :</h3><input type="textarea" name="description" value= "<?= htmlentities($query['cat_name'], ENT_QUOTES) ?>"></textarea>
		<h3>Image :</h3><input type="text" name="cat_path" value=<?= htmlentities($query['cat_path'], ENT_QUOTES) ?>><br/>
		</select><br/><br/><br/>
		<a>Confirm with old name category : <input type="text" name="test"/></a>
		<input type="submit" name="submit" value="OK">
	</form>
	</div>
	<?php require "./includes/footer.php"; ?>
</body>
</html>