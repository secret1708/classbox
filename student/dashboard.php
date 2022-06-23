<?php
    session_start();
    require '../login_register/conn.php';
    if(!isset($_SESSION['id'])){
        header("Location: ../login_register/index.php");
        exit;
    }
    $id = $_SESSION['id'];
    $role = $_SESSION['role'];
  
    $user = query("SELECT * FROM student WHERE id = '$id'");
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content= "IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classbox</title>
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="css/stylesheet_dashboard.css" />
</head>
<body>
    <?php
    $title = "Dashboard";
        include_once('../navbar/student.php');
    ?>

    <div class="container">
      <div class="sub-container">
        <h2>Welcome Back!</h2>
        <h3><?php
                ECHO $user[0]["name"];
            ?></h3>
        <h4>Hope your day is as wonderful as you are!</h4>
      </div>
    </div>
</body>
</html>