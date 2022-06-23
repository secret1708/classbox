<?php
    require '../login_register/conn.php';
    $list = query("SELECT * FROM student");
    session_start();

    if(!isset($_SESSION['id'])){
        header("Location: ../login_register/index.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/studentlistcss.css">
    <title>Classbox</title>
    <link rel="stylesheet" href="../css/navbar.css">
    <style>
        .grid-container{
            display: grid;
            grid-template-columns: 10% 50% 20%;
        

        .grid-item{
            text-align: left;
        }
    </style>
</head>
<body>
    <?php
        $title = "Student List";
        include_once('../navbar/teacher.php');
        
    ?>
    <div class="listcontainer">
        <?php 
        $i = 1;
        foreach ($list as $row) : ?>
        <div class="grid-container">
            <div class="grid-item"><?= $i ?></div>
            <div class="grid-item"><?= $row["name"]?> </div>
            <div class="grid-item"><?= $row["reg_number"]?></div>
        </div>
        <hr>
        <?php $i++; endforeach; ?>
    </div>
</body>
</html>