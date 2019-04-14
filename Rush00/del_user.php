<?php
include('./includes/mysqli.php');
include('./includes/ifnotadmin.php');

function not_ok()
{
	?>
		<div>
			<p>Wrong login</p>
		</div>
	</div>
	<?php
}

function user_deleted()
{
	?>
		<div>
			<p>User deleted !</p>
		</div>
	</div>
	<?php
}

function del_admin()
{
	?>
		<div>
			<p>Can't delete super admin !</p>
		</div>
	</div>
	<?php
}

if (isset($_POST['supprimer']) && $_POST['supprimer'] === "supprimer" )
{
	if ($_POST['login'] && $_POST['login'] !== 'admin')
	{
		$conn = db_connect();
		$login = $_POST['login'];
		$query = "SELECT * FROM users WHERE login='$login'";
		if (!($res = mysqli_query($conn, $query)))
			die ("Error!" . mysqli_connect_error());
		$array = mysqli_fetch_row($res);
		if ($array[0] < 1)
		{
			not_ok();
			header('Location: modifydel_user.php');
		}
		else
		{
			$query = "delete from users where login='$login'";;
			$res = mysqli_query($conn, $query);
			if (!$res)
				die ("Error!" . mysqli_connect_error());
			user_deleted();
			header('Location: modifydel_user.php');
		}
	}
	else
		not_ok();
}
else if ($_POST['login'] === 'admin')
	del_admin();	
else
	not_ok();
header('Location: modifydel_user.php');

?>