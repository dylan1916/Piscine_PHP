<?php
    session_start();
	include('./includes/mysqli.php');

    if (isset($_POST['order']) && $_POST['order'] === "add to cart" && isset($_POST['id']) && $_POST['id'] && isset($_POST['idcateg']) && $_POST['idcateg'] && isset($_POST['categ']) && $_POST['categ'])
    {
        if (!isset($_SESSION['cart']))
            $_SESSION['cart'] = array();
        $_SESSION['cart'][] = $_POST['id'];
		$conn = db_connect();
        $post_idcateg = $_POST['idcateg'];
        $post_categ = $_POST['categ'];
        ?>
        <!DOCTYPE html>
        <html><head><link rel="stylesheet" href="style.css"></head><body>
        <div>
            <p>Success!</p>
            <p>Your order has been added to the cart.</p>
                <ul>
                    <li><form action="index.php" method="post">
                            <input type="submit" name="categ" value="<?php echo "Return"; ?>"></form></li>
                    <li><a href="cart.php"><button>Cart</button></a></li>
                </ul>
        </div></body></html>
        <?php
	}

    elseif (isset($_POST['order']) && $_POST['order'] === "del order" && isset($_SESSION['cart']) && isset($_POST['id']) && $_POST['id'])
    {
        $key = array_search($_POST['id'], $_SESSION['cart']);
        unset($_SESSION['cart'][$key]);
        header('Location: cart.php');
    }
    elseif (isset($_POST['order']) && $_POST['order'] === "confirm order" && isset($_SESSION['cart']) 
    && isset($_SESSION['login']) && $_SESSION['cart'])
    {
        $conn = db_connect();
        $login = $_SESSION['login'];
		$total_price = $_POST['total'];
		$sql = "INSERT INTO cart (log_user, cart_name, cart_price, bought) VALUES ('$login', 'ACHAT', '$total_price', '1')";
        if (mysqli_query($conn, $sql))
			$order_id = mysqli_insert_id($conn);
        foreach ($_SESSION['cart'] as $item_id)
        {
            $query = mysqli_query($conn, "SELECT * FROM items WHERE id_item='$item_id'");
            $row = mysqli_fetch_array($query, MYSQLI_ASSOC);
            $name = $row['item_name'];
            $price = $row['item_price'];
            $array = array_count_values($_SESSION['cart']);
            $item_count = $array[$item_id];
            $sql = "INSERT INTO cart (id_order, log_user, id_item, cart_name, cart_price, cart_qty) VALUES ($order_id, '$login', $item_id, '$name', $price, $item_count)";
            $res = mysqli_query($conn, $sql);
            if ($item_count > 1)
            {
                while ($item_count > 0)
                {
                    if (($key = array_search($item_id, $_SESSION['cart'])) !== false)
                        unset($_SESSION['cart'][$key]);
                    $item_count--;
                }
            }
        }
        unset($_SESSION['cart']);
        header('Location: index.php');
    }
    elseif (!(isset( $_SESSION['login']) && isset($_POST['order']) && $_POST['order'] == "confirm order"))
    {
        ?>
        <!DOCTYPE html>
        <html>
        <head><link rel="stylesheet" href="style.css"></head>
        <body>
        <div>
            <div>
            <p>Error!</p>    
            <p>Please, sign-in</p>
            <a href="signin.php"><button>Sign in</button></a>
            </div>
        </div>
        </body>
        </html><?php
    }
?>
