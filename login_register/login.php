<?php
require 'conn.php';
if(!isset($_GET["key"])){
    header("Location: index.php");
    exit;
}
$role = $_GET["key"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classbox</title>
    <link rel="stylesheet" href="css/stylesheet_login.css" />
</head>

<body>
    <a href="index.php" style="text-align: left; margin-left: 10%;"><img src="../img/arrow.png" alt=""></a>
    
    <div class="container">
        <h1>Login</h1>
        <h2><?= $_GET["key"] ?></h2>
        <form action="login_handler.php" method="post">
            <label for="regNum">Registration Number</label><br>
            <input type="text" name="regNum" id="regNum" require><br>
            <label for="password">Password</label><br>
            <input type="password" name="password" id="password" require><br>
            <input type="text" name="role" value="<?= $role ?>" hidden>
            <button type="submit">Login</button>
        </form>
        <a href="regist.php?key=<?=$_GET["key"] ?>">Create Account</a><br>
    </div>
</body>
</html>