<?php
    session_start();
	include('./includes/mysqli.php');

    function del_order($id)
    {
        ?>
        <form class="art_block" action="order.php" method="post">
            <input type="hidden" name="art" value="<?php echo $id ?>">
            <input type="submit" name="order" value="del order">
        </form>
        <?php
    }
    function confirm_order($total)
    {
        ?>
        <div>
            <form class="art_block_confirm" action="order.php" method="post">
                <input type="hidden" name="total" value="<?php echo htmlentities($total, ENT_QUOTES) ?>">
                <input type="submit" name="order" value="confirm order">
            </form>
        </div>
<?php
    }
?>

<html>

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>potatoes</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" media="screen" href="./css/cart.css" />
</head>

<body>
	<?php require "./includes/header.php"; ?>
	<div class="main">
<?php
     $total = 0;
     $conn = db_connect();

     if (isset($_SESSION['cart']) && !empty($_SESSION['cart']))
     {
         $new_array = array_count_values($_SESSION['cart']);
         foreach ($new_array as $item => $val)
         {
             $query = mysqli_query($conn, "SELECT * FROM items where id_item='$item'");
             $art = mysqli_fetch_array($query, MYSQLI_ASSOC); ?>
             <div class="cart_block">
                 <img src="<?php echo $art['img_path']; ?>">

                 <p><?php echo "quantity " . $val; ?></p>
                 <p><?php echo $art['item_name']; ?></p>
                 <p><?php echo "Price: \xE2\x82\xAc " . $art['item_price'] * $val; ?></p><?php
                		del_order($art['id']);
                     $total += ($art['item_price'] * $val); ?>
             </div>
             <hr>
             <?php
         }
     }
     if (isset($_SESSION['cart']) AND !empty($_SESSION['cart']))
     {
         ?>
            <div class="div_confirm_order">
                <p>
                    <?php echo "Total Amount: \xE2\x82\xAc " . $total; ?>
                </p>
            </div>
            <div class="div_confirm_order">
                <?php

                        confirm_order($total);
                    ?>
            </div>
<?php
     }
     else if (!isset($_SESSION['cart']) || empty($_SESSION['cart']))
     {
         ?>
         <div class="empty">
             <p>Your cart is empty!</p>
         </div>
         <?php
     }
    ?>
</div>
<?php require "./includes/footer.php"; ?>
</body>
</html>

