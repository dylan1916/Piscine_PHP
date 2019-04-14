<?php
    function tabinject_articles($conn)
    {
	?><br><br><?php
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, "INSERT INTO items (id_item, item_name, item_des, item_qty, item_price, item_path, item_cat) VALUES (?, ?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, 'issiisi', $id_item, $item_name, $item_des, $item_qty, $item_price, $item_path, $item_cat);
    $id_item = 1;
	$item_name = "Nom Patate 1";
	$item_des = "Des Patates";
	$item_qty = 10;
    $item_path = "http://www.cnipt.fr/wp-content/themes/boilerplate-child/images/logopdtfrance/logo_pdt_de_france.png";
	$item_price = 5;
	$item_cat = 1;
    mysqli_stmt_execute($stmt);
    $id_item = 2;
	$item_name = "Nom Patate 2";
	$item_des = "Des Patates";
	$item_qty = 10;
    $item_path = "http://www.cnipt.fr/wp-content/themes/boilerplate-child/images/logopdtfrance/logo_pdt_de_france.png";
	$item_price = 5;
	$item_cat = 1;
	mysqli_stmt_execute($stmt);
	$id_item = 3;
	$item_name = "Nom Patate 3";
	$item_des = "Des Patates";
	$item_qty = 10;
    $item_path = "http://www.cnipt.fr/wp-content/themes/boilerplate-child/images/logopdtfrance/logo_pdt_de_france.png";
	$item_price = 5;
	$item_cat = 1;
	mysqli_stmt_execute($stmt);
	$id_item = 4;
	$item_name = "Nom Patate 4";
	$item_des = "Des Patates";
	$item_qty = 10;
    $item_path = "http://www.cnipt.fr/wp-content/themes/boilerplate-child/images/logopdtfrance/logo_pdt_de_france.png";
	$item_price = 5;
	$item_cat = 2;
	mysqli_stmt_execute($stmt);
	$id_item = 5;
	$item_name = "Nom Patate 5";
	$item_des = "Des Patates";
	$item_qty = 10;
    $item_path = "http://www.cnipt.fr/wp-content/themes/boilerplate-child/images/logopdtfrance/logo_pdt_de_france.png";
	$item_price = 5;
	$item_cat = 2;
	mysqli_stmt_execute($stmt);
	$id_item = 6;
	$item_name = "Nom Patate 6";
	$item_des = "Des Patates";
	$item_qty = 10;
    $item_path = "http://www.cnipt.fr/wp-content/themes/boilerplate-child/images/logopdtfrance/logo_pdt_de_france.png";
	$item_price = 5;
	$item_cat = 2;
	mysqli_stmt_execute($stmt);
	$id_item = 7;
	$item_name = "Nom Patate 7";
	$item_des = "Des Patates";
	$item_qty = 10;
    $item_path = "http://www.cnipt.fr/wp-content/themes/boilerplate-child/images/logopdtfrance/logo_pdt_de_france.png";
	$item_price = 5;
	$item_cat = 3;
	mysqli_stmt_execute($stmt);
	$id_item = 8;
	$item_name = "Nom Patate 8";
	$item_des = "Des Patates";
	$item_qty = 10;
    $item_path = "http://www.cnipt.fr/wp-content/themes/boilerplate-child/images/logopdtfrance/logo_pdt_de_france.png";
	$item_price = 5;
	$item_cat = 3;
	mysqli_stmt_execute($stmt);
	$id_item = 9;
	$item_name = "Nom Patate 9";
	$item_des = "Des Patates";
	$item_qty = 10;
    $item_path = "http://www.cnipt.fr/wp-content/themes/boilerplate-child/images/logopdtfrance/logo_pdt_de_france.png";
	$item_price = 5;
	$item_cat = 4;
	mysqli_stmt_execute($stmt);
	$id_item = 10;
	$item_name = "Nom Patate 10";
	$item_des = "Des Patates";
	$item_qty = 10;
    $item_path = "http://www.cnipt.fr/wp-content/themes/boilerplate-child/images/logopdtfrance/logo_pdt_de_france.png";
	$item_price = 5;
	$item_cat = 4;
    mysqli_stmt_execute($stmt);

    echo "Articles record created successfully\n";
    mysqli_stmt_close($stmt);
    ?><br><br><?php
    }

    function tabinject_categories($conn)
    {
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,"INSERT INTO categories (id_cat, cat_name, cat_path, cat_des) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, 'isss', $id_cat, $cat_name, $cat_path, $cat_des);

        $id_cat = 1;
        $cat_name = "Patate 1";
        $cat_path = "http://www.cnipt.fr/wp-content/themes/boilerplate-child/images/logopdtfrance/logo_pdt_de_france.png";
		$cat_des = "Des patates 1";
		mysqli_stmt_execute($stmt);
        $id_cat = 2;
        $cat_name = "Patate 2";
        $cat_path = "http://www.cnipt.fr/wp-content/themes/boilerplate-child/images/logopdtfrance/logo_pdt_de_france.png";
		$cat_des = "Des patates 2";
		mysqli_stmt_execute($stmt);
        $id_cat = 3;
        $cat_name = "Patate 3";
        $cat_path = "http://www.cnipt.fr/wp-content/themes/boilerplate-child/images/logopdtfrance/logo_pdt_de_france.png";
		$cat_des = "Des patates 3";
		mysqli_stmt_execute($stmt);
        $id_cat = 4;
        $cat_name = "Patate 4";
        $cat_path = "http://www.cnipt.fr/wp-content/themes/boilerplate-child/images/logopdtfrance/logo_pdt_de_france.png";
		$cat_des = "Des patates 4";
		mysqli_stmt_execute($stmt);
		$id_cat = 5;
        $cat_name = "Patate 5";
        $cat_path = "http://www.cnipt.fr/wp-content/themes/boilerplate-child/images/logopdtfrance/logo_pdt_de_france.png";
		$cat_des = "Des patates 5";
		mysqli_stmt_execute($stmt);
		$id_cat = 6;
        $cat_name = "Patate 6";
        $cat_path = "http://www.cnipt.fr/wp-content/themes/boilerplate-child/images/logopdtfrance/logo_pdt_de_france.png";
		$cat_des = "Des patates 6";
		mysqli_stmt_execute($stmt);
		$id_cat = 6;
        $cat_name = "Patate 7";
        $cat_path = "http://www.cnipt.fr/wp-content/themes/boilerplate-child/images/logopdtfrance/logo_pdt_de_france.png";
		$cat_des = "Des patates 7";
		mysqli_stmt_execute($stmt);
		$id_cat = 7;
        $cat_name = "Patate 8";
        $cat_path = "http://www.cnipt.fr/wp-content/themes/boilerplate-child/images/logopdtfrance/logo_pdt_de_france.png";
		$cat_des = "Des patates 8";
		mysqli_stmt_execute($stmt);

        echo "Categories record created successfully\n";
        mysqli_stmt_close($stmt);
        ?><br><br><?php
    }

    function tabinject_users($conn)
    {
        $pass = hash ('whirlpool', 'admin');
        $query = "INSERT INTO users (login, passwd, lastname, firstname, email, address, admin) VALUES ('admin', '$pass', 'admin', 'admin', 'admin@admin.fr', 'admin', '1')";
        $res = mysqli_query($conn, $query);
        if (!$res)
            die("Admin user not created: " . mysqli_connect_error());
        echo "Admin users created successfully\n";
        ?><br><br><?php
    }
?>
