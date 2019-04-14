<?php
include('./includes/mysqli.php');
include('./includes/ifnotadmin.php');

function not_ok()
{
	?>
		<div>
			<p>Wrong item name</p>
		</div>
	</div>
	<?php
}

function item_deleted()
{
	?>
		<div>
			<p>Item deleted !</p>
		</div>
	</div>
	<?php
}

if (isset($_POST['supprimer']) && $_POST['supprimer'] === "supprimer" )
{
	if ($_POST['item'])
	{
		$conn = db_connect();
		$item = $_POST['item'];
		$query = "SELECT * FROM items WHERE item_name='$item'";
		if (!($res = mysqli_query($conn, $query)))
			die ("Error!" . mysqli_connect_error());
		$array = mysqli_fetch_row($res);
		if ($array[0] < 1)
		{
			not_ok();
			header('Location: modifydel_products.php');
		}
		else
		{
			$query = "delete from items where item_name='$item'";;
			$res = mysqli_query($conn, $query);
			if (!$res)
				die ("Error!" . mysqli_connect_error());
			item_deleted();
		}
	}
	else
		not_ok();
}
else
	not_ok();
header('Location: modifydel_products.php');

?>