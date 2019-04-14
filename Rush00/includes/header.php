<?php


?>

<head>
	<link rel="stylesheet" type="text/css" media="screen" href="./css/header.css" />
</head>

<div class="header">
    <div class="header__container">
      <div class="header__item">
	  <a href="index.php"><img class="header__logo" src="http://www.cnipt.fr/wp-content/themes/boilerplate-child/images/logopdtfrance/logo_pdt_de_france.png" alt="Logo" title="Logo"></a>
      </div>
      <div class="header__item">
        <h1 class="header__title">ft_minishop potatoes</h1>
      </div>
      <div class="header__item">
	  	<a href="cart.php" class="cart">Cart</a>
		<?php
			if (!isset($_SESSION['login']))
			{
				?>
				<a href="signup.php" class="header__sign-up">Sign up</a>
        		<a href="signin.php" class="header__sign-in">Sign in</a>
				<?php
			}

			else if (isset($_SESSION['login']))
			{
				if (isset($_SESSION['admin']) AND $_SESSION['admin'] == 0)
				{
					?>
					<a href="user.php" class="header__log-out">Hi <?php echo $_SESSION['login']?></a>
					<?php
				}
				?>
				<a href="logout.php" class="header__log-out">Log out</a>
				<?php
				if (isset($_SESSION['admin']) AND $_SESSION['admin'] == 1)
				{
					?><a href="admin.php" class="header__admin">Admin</a><?php
				}
			}
				?>
      </div>
    </div>
  </div>
