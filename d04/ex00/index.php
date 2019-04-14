<?php
session_start();
if ($_GET && $_GET['login'] && $_GET['passwd'] && $_GET['submit'] == "OK")
{
	$_SESSION['login'] = $_GET['login'];
	$_SESSION['passwd'] = $_GET['passwd'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Session</title>
    <style>
        body
        {
            background-color:#abb2a7;
        } 
        h2
        {
            color: white;
        }
    </style>
</head>
<body>
    <h2><center>Les Sessions</center></h2>
        <fieldset>
            <center>
                <form action="index.php" method="GET">
                    <label>Identifiant: <input type="text" name="login"value="<?php if (isset($_SESSION['login'])) { echo $_SESSION['login'];} ?>"/></label>
                </br>
                </br>
                    <label>Mot de Passe: <input type="password" name="passwd" value="<?php if (isset($_SESSION['passwd'])) { echo $_SESSION['passwd'];} ?>"/></label>
                </br>
                </br>
                <input type="submit" name="submit" value="OK">
                </form>
            <center>
        </fieldset>
</body>
</html>
